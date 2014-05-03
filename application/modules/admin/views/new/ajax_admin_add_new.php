<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<!--<script src="<?php echo base_url() ?>js_upload/jquery.fileUploader.js"></script>-->
<!--<script src="<?php echo base_url()?>js_upload/ajaxfileupload.js"></script>-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#upload_file').click(function(){
            var input = $('input[type=submit]');
            var form = input.length > 0 ? $(input[0].form) : $();
           
            fileUpload(input[0].form,'<?php echo base_url();?>upload/do_upload_new','upload','<?php echo base_url(); ?>admin/newsadmin/add'); 
            return false;
        });
        $("a.grouped_elements").fancybox({
            'padding': 0,
            'titleShow': false,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'hideOnOverlayClick': false,
            'hideOnContentClick': false,
            'overlayShow': true,
            'type': 'ajax'
        });
    });
</script>

<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Thêm tin tức</h3>
</div>
<div class="m-pop">
    
    <form action="<?php echo base_url(); ?>admin/newsadmin/add" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="adminform" name="adminform">
        <table class="form" style="width: 1200px;">

            <tr>
                <td class="label">Tên bài viết</td>
                <td colspan="3">
                    <input id="title_" type="texbox" name="title"/>
                </td>
            </tr>
            <tr>
                <td class="label">Hình ảnh</td>
                <td colspan="3">
                    <input type="file" name="userfile"/>
                    <input id="upload_file"  type="button" class="bt100" value="Upload" onClick="">
                    <div id="iframeId">
                        <div id="upload"></div>
                    </div>
                    <input type='hidden' name='file' id='file'/>
                  
                    
                </td>
            </tr>
            <tr>
                <td class="label">Nội dung</td>
                <td colspan="3">
                    <textarea id="editor2" name="content"></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('editor2');
                    </script>
                </td>
            </tr>
            <td><input class="bt100" type="submit" value="Thêm"></td>

            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#adminform").validate({
            rules: {
                title: "required"
            },
            messages: {
                title: "Vui lòng nhập tên"                
            }
            , submitHandler: function(form) {
                var page = 1;
                dataString = $("#adminform").serialize();
                var content = CKEDITOR.instances['editor2'].getData();
                $.ajax({
                    type: "POST",
                    url: $("#adminform").attr('action'),
                    data: {title:$('#title_').val(),file:$('#file').val(),content:content},
                    mimeType: "multipart/form-data",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        $.fancybox.close();
                        reload_callback("<?php echo base_url(); ?>admin/newsadmin/list_new/?nocache="+Math.random(), page, 'new_content');
                        show_msg(data.msg);
                    }
                });
            }
        });
    });
</script>

