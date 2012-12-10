var mouse_is_inside = false;

$(document).ready(function() {
    $(".login-btn").click(function() {
        var loginBox = $("#login-box");
        if (loginBox.is(":visible"))
            loginBox.fadeOut("fast");
        else
            loginBox.fadeIn("fast");
        return false;
    });
    
    $("#login-box").hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").click(function(){
        if(! mouse_is_inside) $("#login-box").fadeOut("fast");
    });

    $(".info-btn").click(function(e) {
        e.preventDefault();
        var loginBox = $("#profile-box");
        loginBox.slideToggle("slow");
        
        
        
    });

});
