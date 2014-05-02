var mouse_is_inside = false;

$(document).ready(function() {
    $(".login_btn2").click(function() {
        var loginBox2 = $("#login_box2");
        if (loginBox2.is(":visible"))
            loginBox2.fadeOut("fast");
        else
            loginBox2.fadeIn("fast");
        return false;
    });
    
    $("#login_box2").hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").click(function(){
        if(! mouse_is_inside) $("#login_box2").fadeOut("fast");
    });
});