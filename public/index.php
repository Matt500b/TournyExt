<?php

//echo '<a href="/tournament/index.php">Proceed...</a>';

// Database Class testing test

include '../includes/functions.php';

$data = $db->SELECT("SELECT * 
					FROM hist 
					WHERE id = ?", 
					array('i', 2));

$data2 = $db->SELECT("SELECT * 
					FROM hist 
					WHERE id = ?", 
					array('i', 3));

$insData = [
		"type" => "insert",
		"columns" => ["address", "value"],
		"table" => "hist",
		"values" => [7, 202],
		"value_types" => ['ii']
		];	
		
$selData = [
		"type" => "select",
		"columns" => ["*"],
		"table" => "hist",
		"WHERE" => ['address'],
		//"AND" =>
		//"OR" =>
		"values" => [3],
		"value_types" => ['i']
		];	
		
		
//$test = $db->QUERY($selData);

//$insTest = $db->INSERT('INSERT INTO hist (address, value) VALUES (?,?)', array('ii', 1, 20));


echo '<pre>';	
//var_dump($data);
var_dump($data2);
//var_dump($data);
//var_dump($insTest);
echo '</pre>';
