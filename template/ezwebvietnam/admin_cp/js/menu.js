$(document).ready(function() {
    
    $("#menu li a").click(function () {
            $("#menu li a").removeClass('select');
            $(this).addClass("select");
            var idmenu = $(this).attr('rel');
            $(".menucontent").hide();
            $("#div_"+idmenu).show();
        }
    );
    
    $("#submenu li a").click(function () {
            $("#submenu li a").removeClass('select');
            $(this).addClass("select");
        }
    );    
    /*
    $('#appmenu').bind('mouseenter mouseleave', function() {
            var select = $("#menu li id.select").attr('rel');
            $(".menucontent").hide();
            $("#div_"+select).show();            
        }
    );
    */ 
});