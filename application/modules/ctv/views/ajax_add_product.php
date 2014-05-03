
<script type="text/javascript">
$(document).ready(function() {
    $("input").each(function() { 
        $("input.readonly").css('background-color','#f2f2f2');
    });
});
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Thêm khóa học</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
<form action="<?php echo base_url();?>ctv/productctv/add_product" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
<table class="form" style="width: 550px;">
    
    <tr>
        <td class="label">Tên khóa học</td>
        <td colspan="3">
        <select name="product" style="width: 99%;">
        <?php 
        
        foreach($product as $pro)
        {
        ?>
        <option value="<?php echo $pro['id_product']?>"><?php echo $pro['title']?></option>
        <?php } ?>
        </select>
        </td>
    </tr>
    
        <td></td>
        <td><input type="submit" class="bt100" name="bt_submit" value="Thêm"/></td>
    </tr>
    
</table>
</form><script type="text/javascript">
$(document).ready(function() {
    $('#credit_limit').priceFormat();
    $('#discount').priceFormat();    
    $("#adminform").validate({
        rules: {
            customer_address: "required"
        },
        messages:{
            customer_address: "Vui lòng chọn khóa học"
        }        
        ,submitHandler: function(form) {
            var page = 1;
            dataString = $("#adminform").serialize();
            $.ajax({
                type: "POST",
                url: $("#adminform").attr('action'),
                data: dataString,
                dataType: "json",
                success: function(data) {
                    $.fancybox.close();  
                    reload_callback("<?php echo base_url();?>ctv/productctv/ajax_get_product",page,'product');
                    show_msg(data.msg);
                }
            }); 
        }        
    });    
});
</script>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("a.grouped_elements").fancybox({
        'padding'            : 0,
        'titleShow' : false,
        'autoScale'            : false,
        'transitionIn'        : 'none',
        'transitionOut'        : 'none',
        'hideOnOverlayClick' : false,
        'hideOnContentClick' : false,
        'overlayShow' : true,
        'type'                : 'ajax'
    }); 
});
</script>