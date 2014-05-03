$(document).ready(function() {
    $("#submenu a.v_link").click(function() {
        load_show();
        addTab($(this));
        return false;
    });

    $('#tabs a.tab').live('click', function() {
        // Get the tab name
        var contentname = $(this).attr("id") + "_content";
        // hide all other tabs
        $("#contenttab div.sub_tabui").hide();
        $("#tabs li").removeClass("current");
        $("#tabs li .remove").remove(); 
        if( $(this).attr('id') != 'banlamviec'){
            $(this).parent().append("<a class=\"remove\" href=\"javascript:;\"></a>"); 
        }        
        $("#" + contentname).show();
        $(this).parent().addClass("current");
        return false;
    });

    $('#tabs a.remove').live('click', function() {
        var tabid = $(this).parent().find(".tab").attr("id");
        var contentname = tabid + "_content";
        $("#" + contentname).remove();
        $(this).parent().remove();
        if ($("#tabs li.current").length == 0 && $("#tabs li").length > 0) {
            var firsttab = $("#tabs li:last-child");
            firsttab.addClass("current");
            banlamviec = firsttab.find("a#banlamviec").length;
            if(banlamviec == 0){
                firsttab.append("<a href=\"javascript:;\" class=\"remove\"></a>");
            }
            
            var firsttabid = $(firsttab).find("a.tab").attr("id");
            $("#" + firsttabid + "_content").show();
        }
    });
});
function addTab(link) {
    if ($("#" + $(link).attr("rel")).length != 0){
        load_show();
        var contentname = $(link).attr("id") + "_content"; 
        $("#tabs li").removeClass("current");
        $("#tabs li a#"+$(link).attr("rel")).parent().addClass("current"); 
        $("#tabs li .remove").remove(); 
        $("#tabs li a#"+$(link).attr("rel")).parent().append("<a class=\"remove\" href=\"javascript:;\"></a>");
    
        var a_href = $(link).attr('href');
        exploded = a_href.split('#');
        var url_page = a_href;
        $.ajax({          
            type: "POST",
            url: url_page,
            async:false,
            cache: false,
            dataType: "html",
            success: function(data){
                load_hide();
                $("#contenttab div.sub_tabui").hide();
                $("#" + $(link).attr("rel") + "_content").html(data).show();                   
            }
        }); 
                
        return false;    
    }
    
    load_show();
                    
    // hide other tabs
    $("#tabs li .remove").remove(); 
    $("#tabs li a#"+$(link).attr("rel")).parent().append("<a class=\"remove\" href=\"javascript:;\"></a>");
    $("#tabs li").removeClass("current");
    $("#contenttab div.sub_tabui").hide();

    $("#tabs").append("<li class='current'><a class='tab' id='" +
    $(link).attr("rel") + "' href='javascript:;'>" + $(link).text() + 
    "</a><a href='javascript:;' class='remove'></a></li>");
    
    var a_href = $(link).attr('href');
    exploded = a_href.split('#');

    
    var url_page = a_href;
    $.ajax({          
        type: "POST",
        url: url_page,
        async:false,
        cache: false,
        dataType: "html",
        success: function(data){
            load_hide();
            $("#contenttab").append("<div class='sub_tabui' id='" + $(link).attr("rel") + "_content'>"+ data +"</div>");
        }
    }); 
    $("#" + $(link).attr("rel") + "_content").show();
    return false;
}

function addTabui(link,div_content,tab_name) {
    // If tab already exist in the list, return
    if ($("#" +div_content).length != 0){
        load_show();
        var contentname = div_content + "_content"; 
        $("#tabs li").removeClass("current");
        $("#tabs li .remove").remove(); 
        $("#tabs li a#"+div_content).parent().addClass("current"); 
        
        var url_page = link;
        $.ajax({          
            type: "POST",
            url: url_page,
            async:false,
            cache: false,
            dataType: "html",
            success: function(data){
                load_hide();
                $("#contenttab div.sub_tabui").hide();
                $("#"+div_content+"_content").html(data).show();                  
            }
        }); 
                
        return false;    
    }
    
    load_show();
                    
    // hide other tabs
    $("#tabs li").removeClass("current");
    $("#tabs li .remove").remove(); 
    $("#contenttab div.sub_tabui").hide();

    $("#tabs").append("<li class='current'><a class='tab' id='" +div_content+ "' href='javascript:;'>" + tab_name +  "</a><a href='javascript:;' class='remove'></a></li>");

    var url_page = link;
    $.ajax({          
        type: "POST",
        url: url_page,
        async:false,
        cache: false,
        dataType: "html",
        success: function(data){
            load_hide();
            $("#contenttab").append("<div class='sub_tabui' id='" + div_content + "_content'>"+ data +"</div>");
        }
    }); 
    $("#" + div_content + "_content").show();
    return false;
}
