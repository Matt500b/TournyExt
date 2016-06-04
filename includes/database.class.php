<?php

/*

$selData = [
		"type" 			=> "select",
		"columns" 		=> ["*"],
		"table" 		=> "hist",
		"WHERE" 		=> ['address'],
		"AND" 			=> [],
		"OR" 			=> [],
		"values"		=> [3],
		"value_types" 	=> ['i'],
		"limit_start"	=> [],
		"show_number" 	=> []
		];
$data = $db->QUERY($selData);
 */

class database{
    protected $link, $num_rows, $debug, $response;   
	protected $resultSet = array();
	protected $err = array();

    public function __construct($db_host, $db_user, $db_pass, $db_name, $debug, \response $response){
        $this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		$this->debug = $debug;
		$this->response = $response;
    }

	/* UPDATE DATA IN DATABASE */
	public function UPDATE($sql, $args=null) {
		unset($this->resultSet);
		unset($this->err);
		$this->resultSet = array();
		$this->err = array();

		$match = $this->match_sql($sql, "update");
		if (!$match) {
			array_push($this->err, $this->response->error("wrongMethodChosen"));
		}
		else {
			if ($stmt = $this->link->prepare($sql)) {
				if (isset($args)) {
					$method = new ReflectionMethod('mysqli_stmt', 'bind_param');
					$method->invokeArgs($stmt, $this->refValues($args));
				}
				if (!$stmt->execute()) {
					array_push($this->err, array('status'=>0, 'message' => 'execute() failed: ' . htmlspecialchars($stmt->error)));
				}
				array_push($this->resultSet, $this->response->success("update"));
				$stmt->close();
			} else {
				array_push($this->err, array('status'=>0, 'message' => 'prepare() failed: ' . htmlspecialchars($this->link->error)));
			}
		}

		if(!empty($this->err)) {
			if($this->debug) {
				return $this->err;
			}
		}
		else {
			return $this->resultSet;
		}

	}

	/* SELECT DATA FROM DATABASE */
	public function SELECT($sql, $args=null) {
		unset($this->resultSet);
		unset($this->err);
		$this->resultSet = array();
		$this->err = array();

		$match = $this->match_sql($sql, "select");
		if (!$match) {
			array_push($this->err, $this->response->error("wrongMethodChosen"));
		}
		else {
			if ($stmt = $this->link->prepare($sql)) {
				if (isset($args)) {
					$method = new ReflectionMethod('mysqli_stmt', 'bind_param');
					$method->invokeArgs($stmt, $this->refValues($args));
				}
				if (!$stmt->execute()) {
					array_push($this->err, array('status'=>0, 'message' => 'execute() failed: ' . htmlspecialchars($stmt->error)));
				}
				$result = $stmt->get_result();

				if ($result) {
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						array_push($this->resultSet, $row);
					}
				} else {
					array_push($this->resultSet, $this->response->error("select"));
				}
				$stmt->close();
			} else {
				array_push($this->err, array('status'=>0, 'message' => 'prepare() failed: ' . htmlspecialchars($this->link->error)));
			}
		}

		if(!empty($this->err)) {
			if($this->debug) {
				return $this->err;
			}
		}
		else {
			return $this->resultSet;
		}
	}

	/* INSERT DATA INTO THE DATABASE */
	public function INSERT($sql, $args=null) {
		unset($this->resultSet);
		unset($this->err);
		$this->resultSet = array();
		$this->err = array();

		$match = $this->match_sql($sql, "insert");
		if (!$match) {
			array_push($this->err, $this->response->error("wrongMethodChosen"));
		}
		else {
			if ($stmt = $this->link->prepare($sql)) {
				if (isset($args)) {
					$method = new ReflectionMethod('mysqli_stmt', 'bind_param');
					$method->invokeArgs($stmt, $this->refValues($args));
				}
				if (!$stmt->execute()) {
					array_push($this->err, array('status'=>0, 'message' => 'execute() failed: ' . htmlspecialchars($stmt->error)));
				}
				array_push($this->resultSet, $this->response->success("insert"));
				$stmt->close();
			} else {
				array_push($this->err, array('status'=>0, 'message' => 'prepare() failed: ' . htmlspecialchars($this->link->error)));
			}

		}

		if(!empty($this->err)) {
			if($this->debug) {
				return $this->err;
			}
		}
		else {
			return $this->resultSet;
		}
	}

	/* DELETE DATA FROM THE DATABASE */
	public function DELETE($sql, $args=null) {
		unset($this->resultSet);
		unset($this->err);
		$this->resultSet = array();
		$this->err = array();

		$match = $this->match_sql($sql, "delete");
		if (!$match) {
			array_push($this->err, $this->response->error("wrongMethodChosen"));
		}
		else {
			if ($stmt = $this->link->prepare($sql)) {
				if (isset($args)) {
					$method = new ReflectionMethod('mysqli_stmt', 'bind_param');
					$method->invokeArgs($stmt, $this->refValues($args));
				}
				if (!$stmt->execute()) {
					array_push($this->err, array('status'=>0, 'message' => 'execute() failed: ' . htmlspecialchars($stmt->error)));
				}
				array_push($this->resultSet, $this->response->success("delete"));
				$stmt->close();
			} else {
				array_push($this->err, array('status'=>0, 'message' => 'prepare() failed: ' . htmlspecialchars($this->link->error)));
			}

		}

		if(!empty($this->err)) {
			if($this->debug) {
				return $this->err;
			}
		}
		else {
			return $this->resultSet;
		}
	}

	/* CONSTRUCTOR FOR ALL QUERIES */
	public function QUERY($data) {
		$type = strtoupper($data['type']);
		$table = $data['table'];
		$columns = $data['columns'];
		
		$values = (isset($data['values']) ? $data['values'] : null);
		$value_types = (isset($data['value_types']) ? $data['value_types'] : null);
		$arguments = (isset($values, $value_types) ? array_merge($value_types, $values) : null);
		
		$where = (isset($data['WHERE']) ? $data['WHERE'] : null);
		$and = (isset($data['AND']) ? $data['AND'] : null);
		$or = (isset($data['OR']) ? $data['OR'] : null);
		$cond = ["WHERE" =>$where, "AND"=>$and, "OR"=>$or];

		
		switch($type) {
			case 'SELECT':
				$query = $this->build_select_query($table, $columns, $cond);
				$qRs = $this->SELECT($query, $arguments);
				return $qRs;
				break;
			case 'INSERT':
				$query = $this->build_insert_query($table, $columns, $values);
				$qRs = $this->INSERT($query, $arguments);
				return $qRs;
				break;
			case 'DELETE':
				return 'DELETE';
				break;
			default:
				return 'You need to input a valid query.';
		}
	}

	/* RETURNS ID OF THE LAST QUERY FROM THE INSERT QUERY */    
    public function INSERT_ID(){
     return $this->resultSet = mysqli_insert_id($this->link);
    }

	/* CHECK THE SQL QUERY BASED */
	private function match_sql($sql, $selector) {
		preg_match("/^(SELECT|DELETE|INSERT|UPDATE)/i", $sql, $type);
		$match = (isset($type) ? $type[0] : null);

		if(!is_null($match)) {
			if(strtolower($match) == strtolower($selector)) {
				return true;
			}
			else {
				return false;
			}
		}
	}

	/* BUILDS SELECT QUERY BASED ON GIVEN DATA */
	private function build_select_query($table=null, $cols=null, $cond=null) {
		$sql = 'SELECT ';
		if(isset($cols)) {
			for($i=0; $i<count($cols); $i++) {
				if($i == count($cols)-1) {
					$sql .= $cols[$i];
				}
				else {
					$sql .= $cols[$i] .',';
				}
					
			}
		}
		$sql .= ' FROM ' . $table;
		if(isset($cond) && $cond['WHERE']!== null) {
			$sql .= ' WHERE ' . $cond['WHERE'][0] . '=?';
			for($i=0; $i<count($cond['AND']); $i++) {
				if ($i==0) {
					$sql .= ', AND ' . $cond['AND'][$i] . ' = ?';
				}
				else if($i == count($cond['AND']-1)) {
					$sql .= ' AND ' . $cond['AND'][$i] . ' = ?';
				}
				else {
					$sql .= ' AND ' . $cond['AND'][$i] . ' = ?,';
				}
			}
			for($i=0; $i<count($cond['OR']); $i++) {
				if ($i==0) {
					$sql .= ', OR ' . $cond['OR'][$i] . ' = ?';
				}
				else if($i == count($cond['OR']-1)) {
					$sql .= ' OR ' . $cond['OR'][$i] . ' = ?';
				}
				else {
					$sql .= ' OR ' . $cond['OR'][$i] . ' = ?,';
				}
			}
		}
		return $sql;
	}
	
	/* BUILDS INSERT QUERY BASED ON GIVEN DATA */
	private function build_insert_query($table=null, $cols=null, $values=null) {
		$sql = 'INSERT INTO ' . $table;
		
		if(isset($cols) && $cols[0] != "*") {
			$sql .= ' (';
			for($i=0; $i<count($cols); $i++) {
				if($i == count($cols)-1) {
					$sql .= $cols[$i];
				}
				else {
					$sql .= $cols[$i] .',';
				}
					
			}
			$sql .= ') ';
		}
		
		$sql .= 'VALUES (';
		for($i=0; $i<count($values); $i++) {
			if($i == count($values)-1) {
				$sql .= '?';
			}
			else {
				$sql .= '?,';
			}
		}
		$sql .= ')';
		
		return $sql;
	}
	
	/* BUILDS DELETE QUERY BASED ON GIVEN DATA */
	private function build_delete_query($table=null, $cond=null) {
		$sql = 'DELETE FROM ' . $table;

		if(isset($cond) && $cond['WHERE']!== null) {
			$sql .= ' WHERE ' . $cond['WHERE'][0] . '=?';
			for($i=0; $i<count($cond['AND']); $i++) {
				if ($i==0) {
					$sql .= ', AND ' . $cond['AND'][$i] . ' = ?';
				}
				else if($i == count($cond['AND']-1)) {
					$sql .= ' AND ' . $cond['AND'][$i] . ' = ?';
				}
				else {
					$sql .= ' AND ' . $cond['AND'][$i] . ' = ?,';
				}
			}
			for($i=0; $i<count($cond['OR']); $i++) {
				if ($i==0) {
					$sql .= ', OR ' . $cond['OR'][$i] . ' = ?';
				}
				else if($i == count($cond['OR']-1)) {
					$sql .= ' OR ' . $cond['OR'][$i] . ' = ?';
				}
				else {
					$sql .= ' OR ' . $cond['OR'][$i] . ' = ?,';
				}
			}
		}
		return $sql;
	}
	
	private function refValues($arr){
		if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
		{
			$refs = array();
			foreach($arr as $key => $value)
				$refs[$key] = &$arr[$key];
			return $refs;
		}
		return $arr;
	}
	
	
}

class testDB {
	protected $link, $num_rows, $debug;
	protected $resultSet = array();
	protected $err = array();
	public $string;

	public function __construct($db_host, $db_user, $db_pass, $db_name, $debug){
		$this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		$this->debug = $debug;
	}

	public function SELECT($cols=null) {
		$this->string = "SELECT";
		
		for($i=0; $i<count($cols); $i++) {
			$this->string .= ' ' . $cols[$i];
		}

		return $this;
	}
	public function FROM($table) {
		$this->string .= " FROM " . $table;
		return $this;
	}
	public function WHERE($col) {
		$this->string .= " WHERE " . $col . " = ?";
		return $this;
	}
	public function RUN() {
		return $this->string;
	}
}