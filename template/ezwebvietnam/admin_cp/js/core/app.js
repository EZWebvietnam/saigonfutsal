$(document).ready(function() {
    //setInterval(check_login,5000);
    $("a.grouped_elements").fancybox({
        'padding'            : 0,
        'titleShow' : false ,
        'autoScale'            : false,
        'transitionIn'        : 'elastic',
        'transitionOut'        : 'elastic',
        'hideOnOverlayClick' : false,
        'hideOnContentClick' : false,
        'overlayShow' : false,
        'opacity' : false,
        'type'                : 'ajax'

    }); 
    /*
    $('.v_link').click(function() {
        load_show();
        var a_href = $(this).attr('href');
        exploded = a_href.split('#');

        
        var url_page = base_url+exploded[1];
        $.ajax({          
            type: "POST",
            url: url_page,
            async:false,
            cache: false,
            dataType: "html",
            success: function(data){
                load_hide();
                $('#content').html(data);
            }
        });         
    
               
    }); */
    
    $('.f_link').click(function() {
        load_show();
        var a_href = $(this).attr('href');
        exploded = a_href.split('#');

        
        var url_page = base_url+exploded[1];
        $.fancybox({
            'padding'            : 0,
            'titleShow' : false ,
            'autoScale'            : false,
            'transitionIn'        : 'elastic',
            'transitionOut'        : 'elastic',
            'hideOnOverlayClick' : false,
            'hideOnContentClick' : false,
            'overlayShow' : false,
            'opacity' : false,
            'type'                : 'ajax',
            'href'                : url_page

        }); 
        load_hide();
               
    });      
});

function reload(page,div_id){
    load_show();
    $.ajax({          
        type: "POST",
        url: page,
        async:false,
        cache: false,
        dataType: "html",
        success: function(data){
            $('#'+div_id+'_content').html(data);
            load_hide(); 
        }
    });    
}

function check_login(){
    $.getJSON(base_url+"api/check_login",function(data){
            if(data.error == 1){
                jAlert("Phiên làm việc của bạn đã hết. Vui lòng đăng nhập lại",'Thông báo');
                setInterval(redirect_login,1000);
            }
    });
}
function redirect_login(){
    window.location = base_url;
}


function page(link){
    load_show();
    $.ajax({          
        type: "POST",
        url: base_url+link,
        //data: dataString,
        async:false,
        cache: false,
        dataType: "html",
        success: function(data){
            $('#content').html(data);
            load_hide();
        }
    });      
}

function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function show_msg(msg){
    html ='<div class="_error">';
        html +='<div>'+msg+'</div>';
        html +='<div class="_close"><a onclick="close_msg()">Đóng</a></div>';
    html +='</div>';
    //$("#msg").html(html);
    $('#msg').html(html).slideToggleWidth("slow");
    auto_close_msg();

}
function auto_close_msg(){
    setTimeout(remove_msg, 5000); 
}

function remove_msg(){
    if($("#msg").length > 0){
        $("#msg").slideToggleWidth("slow");
        $("#msg").html('');
    }
}

function close_msg(){
    $("#msg").slideToggleWidth("slow");
}

function ToNumber(nStr) {
    if (nStr != null && nStr != NaN) {
        var rgx = /[₫\s.]/;
        while (rgx.test(nStr)) {
            nStr = nStr.replace(rgx, '');
        }
        return eval(nStr) + 0;
    }
    return 0;

}

//formatCurrency
function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' +
    num.substring(num.length - (4 * i + 3));
    var currency = (((sign) ? '' : '-') + num);
    return currency;
}

$.fn.extend({
  slideRight: function() {
    return this.each(function() {
      $(this).animate({width: 'show'});
    });
  },
  slideLeft: function() {
    return this.each(function() {
      $(this).animate({width: 'hide'});
    });
  },
  slideToggleWidth: function() {
    return this.each(function() {
      var el = $(this);
      if (el.css('display') == 'none') {
        el.slideRight();
      } else {
        el.slideLeft();
      }
    });
  }
});
// Set language
function set_lang(lang){
    $.post(base_url+"api/setlang/",{'lang':lang},function(data){
      location.reload();  
    });     
}
// Openr Images
function openKCFinder(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Đang tải ảnh...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                base_url_str = base_url.replace('http://'+document.domain,'');
                base_url_str = base_url_str.replace('admin/','');
                $("#news_img").val(url.replace(base_url_str,''));
                var img = document.getElementById('img');
                var o_w = img.offsetWidth;
                var o_h = img.offsetHeight;
                var f_w = div.offsetWidth;
                var f_h = div.offsetHeight;
                if ((o_w > f_w) || (o_h > f_h)) {
                    if ((f_w / f_h) > (o_w / o_h))
                        f_w = parseInt((o_w * f_h) / o_h);
                    else if ((f_w / f_h) < (o_w / o_h))
                        f_h = parseInt((o_h * f_w) / o_w);
                    //img.style.width = f_w + "px";
                    //img.style.height = f_h + "px";
                } else {
                   // f_w = o_w;
                   // f_h = o_h;
                }
                //img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                //img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };
    window.open(base_url+'templates/ckeditor/kcfinder/browse.php?type=images&dir=images/news',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}

            
function insertReadmore(editor) {
    contents =  cke.getData();
    if (contents.match(/<hr\s+id=(\"|')system-readmore(\"|')\s*\/*>/i)) {
        alert('Đọc thêm đã được thêm vào');
        return false;
    } else {
        jInsertEditorText('<hr id=\"system-readmore\" />', editor);
    }
}
function jInsertEditorText( text,editor ) {
    CKEDITOR.instances[editor].insertHtml( text);
}
function popup(mylink, windowname){
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string')
       href=mylink;
    else
       href=mylink.href;
    window.open(href, windowname, 'width=750,height=500,scrollbars=yes');
    return false;
}
