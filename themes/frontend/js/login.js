var mouse_is_inside = false;

$(document).ready(function() {
    $(".login_btn").click(function() {
        var loginBox = $("#login_box");
        if (loginBox.is(":visible"))
            loginBox.fadeOut("fast");
        else
            loginBox.fadeIn("fast");
        return false;
    });
    
    $("#login_box").hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });
    

    $("body").click(function(){
        if(! mouse_is_inside) $("#login_box").fadeOut("fast");
    });
});



$(document).ready(function() {
    $(".login_btn").click(function() {
        var loginBox = $("#profile_box");
        if (loginBox.is(":visible"))
            loginBox.fadeOut("fast");
        else
            loginBox.fadeIn("fast");
        return false;
    });
    
    $("#profile_box").hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").click(function(){
        if(! mouse_is_inside) $("#profile_box").fadeOut("fast");
    });
});