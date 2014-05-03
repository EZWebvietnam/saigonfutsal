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
    <h3>Thêm khuyến mại</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/saleadmin/add" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="adminform">
        <table class="form" style="width: 550px;">
         <tr>
                <td class="label">Sản phẩm</td>
                <td colspan="3">
                    <select name="id_product" id="id_product">
                        <?php
                        foreach ($list_product as $product) {
                            ?>
                            <option value="<?php echo $product['id_product'] ?>"><?php echo $product['title'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">Giảm giá</td>
                <td colspan="3">
                    <input id="percent" type="texbox" name="percent"/>
                </td>
            </tr>
            <tr>
                <td class="label">Ngày hết hạn</td>
                <td colspan="3">
                    <input id="exp_date" type="texbox" name="exp_date"/>
                </td>
            </tr>
            
            <td><input class="bt100" type="submit" value="Thêm"></td>

            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $( "#exp_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $("#adminform").validate({
            rules: {
                percent: "required",
                exp_date: "required"
            },
            messages: {
                percent: "Vui lòng nhập phần trăm giảm giá",
                exp_date: "Vui lòng nhập ngày hết hạn"

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
                        reload_callback("<?php echo base_url(); ?>admin/saleadmin/list_sale", page, 'sale_content');
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