<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<script src="<?php echo base_url()?>js_upload/ajaxfileupload.js"></script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Thay đổi mật khẩu</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/login/change_pass" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="adminform">
        <table class="form" style="width: 550px;">

            <tr>
                <td class="label">Mật khẩu cũ</td>
                <td colspan="3">
                    <input id="old_pass" type="password" name="old_pass"/>
                </td>
            </tr>
            <tr>
                <td class="label">Mật khẩu mới</td>
                <td colspan="3">
                    <input id="new_pass" type="password" name="new_pass"/>
                </td>
            </tr>
            
            
            <td><input class="bt100" type="submit" id="change_pass" value="Thêm"></td>

            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#change_pass').attr('disabled','disabled');
       $('#old_pass').change(function(){
           $.ajax({
               type: "POST",
                    url: "<?php echo base_url();?>admin/login/check_pass",
                    data: {password:$('#old_pass').val()},
                    mimeType: "multipart/form-data",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        if(data.error==0)
                        {
                            $('#change_pass').attr('disabled',false);
                        }
                        else
                        {
                            $('#change_pass').attr('disabled','disabled');
                        }
                    }
               
           });
           
       });
        $("#adminform").validate({
            rules: {
                old_pass: "required",
                new_pass: "required",
               
            },
            messages: {
                old_pass: "Vui lòng nhập",
                new_pass: "Vui lòng nhập"
                

            }
            , submitHandler: function(form) {
                var page = 1;
                dataString = $("#adminform").serialize();
                
                $.ajax({
                    type: "POST",
                    url: $("#adminform").attr('action'),
                    data: dataString,
                    mimeType: "multipart/form-data",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        $.fancybox.close();
                        show_msg(data.msg);
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
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