
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
            <td style="text-align: center; font-weight: bold">Mã hóa đơn</td>
		<td style="text-align: center; font-weight: bold">Họ tên</td>
		<td style="text-align: center; font-weight: bold">Địa chỉ</td>
		<td style="text-align: center; font-weight: bold">Phone</td>
		<td style="text-align: center; font-weight: bold">Email</td>
		<td style="text-align: center; font-weight: bold">Yahoo</td>
		<td style="text-align: center; font-weight: bold">Tổng tiền</td>
		<td style="text-align: center; font-weight: bold">Hoa hồng</td>
		<td style="text-align: center; font-weight: bold">Ngày tạo</td>
		<td style="text-align: center; font-weight: bold">Trạng thái</td>
	</tr>
        <?php
        $total_money = 0;
        foreach($list_order as $order)
        {
            $sum_money = 0;
            $comission = 0;
            $detail_or = $this->ordermodel->list_order_dt($order['id_order_c']);
            if(!empty($detail_or))
            {
                foreach($detail_or as $order_dt)
                {
                    $sum_money +=($order_dt['price']*$order_dt['quantity']);
                    $comission +=$order_dt['commissions'];
                }
            }
        ?>
	<tr>
                <td><?php echo $order['id_order_c']?></td>
		<td><?php echo $order['full_name']?></td>
		<td><?php echo $order['address']?></td>
		<td><?php echo $order['phone']?></td>
		<td><?php echo $order['email']?></td>
		<td><?php echo $order['yahoo']?></td>
		<td><?php echo $sum_money ?></td>
		<td><?php echo $comission ?></td>
		<td><?php echo date('d/m/Y',$order['create_date'])?></td>
		<td><?php echo $status[$order['status']]?></td>
	</tr>
        <?php if($order['status'] == 1) {$total_money +=$comission;}} ?>
</table>
Tổng số tiền: <?php echo $total_money;?> - Đã lĩnh: <?php echo $tien_da_linh; ?> - Còn lại: <?php echo $total_money - $tien_da_linh?>

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