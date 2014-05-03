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
    <h3>Trả lời</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/faqadmin/edit/<?php echo $detail[0]['id']?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="adminform">
        <table class="form" style="width: 1200px;">

            <tr>
                <td class="label">Tiêu đề</td>
                <td colspan="3">
                    <?php echo $detail[0]['title']?>
                </td>
            </tr>
            <tr>
                <td class="label">Ngày gửi</td>
                <td colspan="3">
                    <?php echo $detail[0]['create_date']?>
                </td>
            </tr>
            <tr>
                <td class="label">Tóm tắt</td>
                <td colspan="3">
                   <?php echo $detail[0]['question']?>
                </td>
            </tr>
            <tr>
                <td class="label">Nội dung</td>
                <td colspan="3">
                    <textarea id="editor2" name="content"><?php echo $detail[0]['answer']?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('editor2');
                    </script>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td colspan="3">
                   <input class="bt100" type="submit" value="Trả lời">
                </td>
            </tr>
            <td></td>

            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#cost_').priceFormat();
        $("#adminform").validate({
            rules: {
               
                content: "required"
               
            },
            messages: {
               
                content: "Vui lòng nhập nội dung"
               

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
                        reload_callback("<?php echo base_url(); ?>admin/faqadmin/list_faq", page, 'faq_content');
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