var mouse_is_inside = false;

$(document).ready(function() {
    $(".login_btn3").click(function() {
        var t_id;
        t_id = $(this).attr('id');
        var loginBox3 = $("#share_box_"+t_id);
        if (loginBox3.is(":visible"))
            loginBox3.fadeOut("fast");
        else
            loginBox3.fadeIn("fast");
        return false;
    });
    
    $(".login_box3").hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").click(function(){
        if(! mouse_is_inside) $(".login_box3").fadeOut("fast");
    });
});