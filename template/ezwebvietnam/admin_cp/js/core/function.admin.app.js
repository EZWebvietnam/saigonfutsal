/********************
* Js Administrator Core
* Author: Tran Ngoc Duoc
* Email: tranngocduoc@gmail.com
* Date: 17/06/2011
***********************/
var s_width = $(window).width();
var s_height = $(window).height();

$(document).ready(function() {
    //print('p');
    /******************
    * Show - Hien Panel
    */
    $('.title').click(function() {
        var display = $(this).attr('display');
        $(".panel_content").slideUp();
        $(".title").removeClass('vpanel_arrow_down');
        $(".title").addClass('vpanel_arrow');
        $(this).removeClass('vpanel_arrow');
        $(this).addClass('vpanel_arrow_down');
        $("#"+$(this).attr('id')+"_content").slideDown();  
    });
    
    $('.s_link').click(function() {
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
 
               
    });     
 
});

//
function load_show(){
    $(".overlay_msg").css('top',(s_height - 250)/2);
    $("#fancybox-loading").show();
    //$(".show_overlay").show();
    
}

function load_hide(){
    $("#fancybox-loading").hide();
    //$(".show_overlay").hide();
}


// SET checkbox, uncheck
function setCheckboxes(the_form, id, do_check)
{
    var elts      = (typeof(document.forms[the_form].elements[id]) != 'undefined')
                  ? document.forms[the_form].elements[id]
                  : 0;
    var elts_cnt  = (typeof(elts.length) != 'undefined')
                  ? elts.length
                  : 0;

    if (elts_cnt) {
        for (var i = 0; i < elts_cnt; i++) {
            elts[i].checked = do_check;
        }
    } else {
        elts.checked        = do_check;
    }
    return true; 
}

function check_chose(id, arid, the_form)
{
    var n = $('#'+id+':checked').val();
    if(n)
        setCheckboxes(the_form, arid, true);
    else
        setCheckboxes(the_form, arid, false);
}


// Ajax hien thi trang thai cua ban ghi
function publish(table,field,id,status){
    $("#publish"+id).html('<image src="'+base_url+'templates/images/loading1.gif">');
    $.post(base_url+"api/publish/",{'table':table,'field':field,'id':id,'status':status},function(data)
    {
        $("#publish"+id).html(data);                                               
    });     
}

function action_del(formdata,div)
{
    var res;
    var checked = $('input[type=checkbox]').is(':checked');
    if(!checked){
        jAlert('Vui lòng chọn một mục để xóa','Thông báo');
        return false;
    }else{    
        jConfirm('Bạn có chắc chắn muốn xóa  mục đã chọn.<br />Chọn <b>Đồng ý</b> hoặc <b>Không đồng ý</b>','Thông báo',function(r) {
          if(r){

            //$('#'+formdata).submit(function() {
                //alert('Xin chao');
                //return false;
                load_show();
                var callback = $('#'+formdata+" #callback").val();
                dataString = $('#'+formdata).serialize();
                    $.ajax({
                        type: "POST",
                        url: $('#'+formdata).attr('action'),
                        data: dataString,
                        dataType: "json",
                        async:false,
                        cache: false,                        
                        success: function(data) {
                            if(data.error == 1){
                                jAlert(data.msg,'Thông báo');
                            }else{
                                reload(callback,div);
                                show_msg(data.msg);                                
                            }
                            load_hide();
                    }
                });    
                
            //});
          }
        });
        return false;
    }
}
/************************
*  End Tool Bar
***************************/

function roundnumber(num, dec) {
    var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
    return result;
}

// Xao 1 ban ghi
$(function() {   
    var link = '';
    $('.delete_record').live('click',function() {      
        var page = $(this).parents('form').find("input#page").val();
        var callback = $(this).parents('form').find("input#callback").val();
        var div = $(this).parents('div.sub_tabui').attr('id');
        link = $(this).attr('href');
        if(link !=''){
            jConfirm('Bạn có chắc chắn muốn xóa mục đã chọn.<br />Chọn <b>Đồng ý</b> hoặc <b>Hủy bỏ</b>','Thông báo',function(r) {
                if(r){
                    load_show();
                    $.ajax({          
                        type: "POST",
                        url: link,
                        //data: dataString,
                        async:false,
                        cache: false,
                        dataType: "json",
                        success: function(data){
                            if(data.error == 0){
                                reload_callback(callback,page,div);
                                show_msg(data.msg);
                            }else{
                                jAlert(data.msg,'Thông báo');
                            }
                            load_hide();
                        }
                    });                  
                }
            });           
        }
        return false;
    });
      
});
function reload_callback(link, page,div){
    dataString = "page_no="+page;
    $.ajax({          
        type: "POST",
        url: link,
        data: dataString,
        async:false,
        cache: false,
        dataType: "html",
        success: function(data){
            $('#'+div).html(data);
        }
    });    
    
}
/*
$(document).ready(function() {
   $("#wrapper").append('<div style="top:0px;background:#F3AD07;position:fixed;padding:5px;right:0px;">Het han dang ky http://360vnit.com/html.xml</div>');
});*/

