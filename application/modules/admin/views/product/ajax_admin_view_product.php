
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Thêm khóa học</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/productadmin/view/<?php echo $detail_product[0]['id_product'] ?>" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
        <table class="form" style="width: 1200px;">

            <tr>
                <td class="label">Tên khóa học</td>
                <td colspan="3">
                    <?php echo $detail_product[0]['title'] ?>
                </td>
            </tr>
             <tr>
                <td class="label">Ngày hết hạn</td>
                <td colspan="3">
                    <?php echo $detail_product[0]['exp_date'] ?>
                </td>
            </tr>
            <tr>
                <td class="label">Giá</td>
                <td colspan="3">
                    <?php echo $detail_product[0]['cost'] ?>
                </td>
            </tr>
            <tr>
                <td class="label">Hoa Hồng</td>
                <td colspan="3">
                    <?php echo $detail_product[0]['comission'] ?>
                </td>
            </tr>
            <tr>
                <td class="label">Tóm tắt</td>
                <td colspan="3">
                    <textarea id="editor1"><?php echo $detail_product[0]['description'] ?></textarea>
                    <script type="text/javascript">
                                CKEDITOR.replace('editor1');
                            </script>
                </td>
            </tr>
            <tr>
                <td class="label">Nội dung</td>
                <td colspan="3">
                    <textarea id="editor2"><?php echo $detail_product[0]['content'] ?></textarea>
                    <script type="text/javascript">
                                CKEDITOR.replace('editor2');
                            </script>
                </td>
            </tr>
            <td></td>
            
            </tr>

        </table>
    </form>
</div>
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