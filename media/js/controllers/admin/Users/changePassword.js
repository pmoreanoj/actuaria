$(document).ready(function () {
    $(document).on("click", "#sbt", function (event) {
        
        var password=$("#password").val();
        
        if(password!==""){
            notification("Se procede a cambiar la contrase&ntilde;a", "information", "top");
            
        }
        else{
            notification("Ingrese la nueva contrase&ntilde;a por favor", "error", "top");
            event.preventDefault();
        }
        
        
    });  
});

function notification(text, type, layout) {
    var n = noty({
        layout: layout,
        type: type,
        text: text,
        closeWith: ['backdrop'],
        timeout: true,
        animation: {
            open: 'animated fadeInDown', // Animate.css class names
            close: 'animated fadeOutUp', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });

    setTimeout(function () {
        $.noty.close(n.options.id);
    }, 3000);
}