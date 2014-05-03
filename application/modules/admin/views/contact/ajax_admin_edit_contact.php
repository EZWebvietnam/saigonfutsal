
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Trả lời</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/contactadmin/edit/<?php echo $detail[0]['id'] ?>" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
        <table class="form" style="width: 550px;">
            <tr>
                <td class="label">Họ tên:</td>
                <td colspan="3">
                    <?php echo $detail[0]['full_name']?>
                </td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td colspan="3">
                    <?php echo $detail[0]['email']?>
                </td>
            </tr>
            <tr>
                <td class="label">Nội dung:</td>
                <td colspan="3">
                    <?php echo $detail[0]['noi_dung']?>
                </td>
            </tr>
            <tr>
                <td class="label">Trả lời</td>
                <td colspan="3">
                    <textarea id="editor2" name="content"><?php echo $detail[0]['reply']?></textarea>
                    <script type="text/javascript">
                                CKEDITOR.replace('editor2');
                            </script>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td colspan="3">
                    <input type="submit" value="Cập nhập" class="bt100"/>
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
                var content = CKEDITOR.instances['editor2'].getData();
                $.ajax({
                    type: "POST",
                    url: $("#adminform").attr('action'),
                    data: {reply:content},
                    mimeType: "multipart/form-data",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        $.fancybox.close();
                        reload_callback("<?php echo base_url(); ?>admin/contactadmin/list_contact", page, 'contact_content');
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