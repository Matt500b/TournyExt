$(document).ready(function() {

    var $userimg = $('.simple-dd-menu');
    var $simpleMenu = $('.simple-dd-menu ul');
    var $xsTriangle = $('.drop-down-tri');
    $userimg.mouseover(function() {
        $xsTriangle.css('border-top-color', '#1A84FF');
        $simpleMenu.addClass('fadeInUp').css('display', 'block');
    })
    //begining of click outside of menu function
    $.fn.clickOff = function(callback, selfDestroy) {
        var clicked = false;
        var parent = this;
        var destroy = selfDestroy || true;

        parent.click(function() {
            clicked = true;
        });

        $(document).click(function(event) {
            if (!clicked) {
                callback(parent, event);
            }
            clicked = false;
        });
    };

    //function below works when click outside of div

    $simpleMenu.clickOff(function() {
        $simpleMenu.css('display', 'none');
        $xsTriangle.css('border-top-color', 'transparent');
    });
    // document ready end
})