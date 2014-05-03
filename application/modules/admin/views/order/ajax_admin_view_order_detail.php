
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<style>
    table,th,td,tr
    {
        border: 1px solid black;
    }
</style>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Danh sách hóa đơn</h3>
</div>
<?php 
$status = array('0'=>'Khách hàng Chưa thanh toán','1'=>'Khách Đã thanh toán')
?>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form  method="post" accept-charset="utf-8" id="adminform">
        <table bordercolor="#FFCC00" style="background-color:#FFFFCC;" width="1000px" cellpadding="3" cellspacing="3">
	<tr>
               
		<td style="text-align: center; font-weight: bold">Sản phẩm</td>
		<td style="text-align: center; font-weight: bold">Số lượng</td>
		<td style="text-align: center; font-weight: bold">Đơn giá</td>
		<td style="text-align: center; font-weight: bold">Thành tiền</td>
		<td style="text-align: center; font-weight: bold">Hoa hồng CTV</td>
		<td style="text-align: center; font-weight: bold">Ngày tạo</td>
		
	</tr>
        <?php
        $total_money = 0;
        $hoa_hong = 0;
        foreach($list_order_detail as $order)
        {
            
        ?>
	<tr>
		<td><?php echo $order['title']?></td>
		<td><?php echo $order['quantity']?></td>
		<td><?php echo $order['price']?></td>
		<td><?php echo $order['quantity']*$order['price']?></td>
		<td><?php echo $order['commissions']?></td>
		<td><?php echo date('d/m/Y',$order['create_date'])?></td>
		
	</tr>
        <?php $total_money +=$order['quantity']*$order['price'];
               $hoa_hong +=  $order['commissions'];
        
        } ?>
</table>
Tổng số tiền: <?php echo $total_money;?> - Hoa hồng CTV: <?php echo $hoa_hong;?>

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