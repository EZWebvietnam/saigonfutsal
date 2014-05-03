<?php

function full_url($s) {
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $s['REQUEST_URI'];
}
?>
<meta charset="utf-8" />
<script type="text/javascript">
    $(document).ready(function() {
        $("a.grouped_elements").fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none'
        });
    });
</script>
<div id="message">
    <table class="table_full" style="width: 100%;">
        <tr>
            <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <div class="h-title">Danh sách tin nhắn</div>
                        </td>

                    </tr>
                </table>
                <div class="box-content">
                    <div class="box_find">
                    </div>
                    <form  method="post" accept-charset="utf-8" id="admindata_mess">
                        <input type="hidden" id="page" value="0"/>
                        <input type="hidden" id="callback" value="<?php echo base_url(); ?>ctv/messagememberctv/list_message"/>
                        <table class="admindata">
                            <thead>
                                <tr>
                                    <th class="head" colspan="7">
                                        Có <?php echo count($list_message) ?> tin nhắn <span class="pages"><span class="pagebar-mainbody">
                                                <?php
                                                if ($total_page == 1 || $page == 1) {
                                                    
                                                } else {
                                                    ?>
                                                    <a href="javascript:;" onclick="khachhang(<?php echo $page ?> - 1)">&lt;</a>
                                                <?php } ?>
                                                <?php
                                                for ($i = 1; $i <= $total_page; $i++) {
                                                    if ($i == $page) {
                                                        ?>
                                                        <span class="pagebar-selections"><span class="pagelink-current"><?php echo $page ?></span></span>
                                                    <?php } else { ?>
                                                        <a href="javascript:; " onclick="khachhang(<?php echo $i ?>)"><?php echo $i ?></a>
                                                    <?php } ?>

                                                <?php } ?>
                                                <?php
                                                if ($total_page == 1 || $page == $total_page) {
                                                    
                                                } else {
                                                    ?>
                                                    <a href="javascript:;" onclick="khachhang(<?php echo $page ?> + 1)">&gt;</a>
                                                <?php } ?>
                                            </span>
                                        </span>
                                    </th>
                                </tr>
                                <tr>

                                    <th class="id">Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th>Tình trạng</th>
                                    <th class="publish">Chức năng</th>
                                </tr>
                            </thead>
                            <?php
                            $status = array('0' => 'Chưa đọc', '1' => 'Đã đọc');
                            foreach ($list_message as $message) {
                                if ($message['status'] == 1) {
                                    ?>
                                    <tr class="row1 ">

                                        <td><?php echo $message['title'] ?></td>
                                        <td><?php echo sub_string(loaibohtmltrongvanban($message['content']), 300); ?></td>
                                        <td><?php echo date('d/m/Y', $message['create_date']); ?></td>
                                        <td><?php echo $status[$message['status']] ?></td>
                                        <td>
                                            <a class="grouped_elements" href="<?php echo base_url(); ?>ctv/messagememberctv/view/<?php echo $message['id_message'] ?>" title="Xem chi tiết"><img width="16" height="16" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/icon/view.png"></a>
                                            <a class="delete_record" href="<?php echo base_url();?>ctv/messagememberctv/delete/<?php echo $message['id_message']?>" title="Xóa"><img src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/del.png"></a>  
                                        </td>
                                    </tr>
                                <?php } else { ?> 
                                    <tr class="row1 ">

                                        <td><b><?php echo $message['title'] ?></b></td>
                                        <td><b><?php echo sub_string(loaibohtmltrongvanban($message['content']), 300); ?></b></td>
                                        <td><b><?php echo date('d/m/Y', $message['create_date']); ?></b></td>
                                        <td><b><?php echo $status[$message['status']] ?></b></td>
                                        <td><a onclick="update_status(<?php echo $message['id_message'] ?>)" class="grouped_elements" href="<?php echo base_url(); ?>ctv/messagememberctv/view/<?php echo $message['id_message'] ?>" title="Xem chi tiết"><img width="16" height="16" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/icon/view.png"></a>
                                        <a class="delete_record" href="<?php echo base_url();?>ctv/messagememberctv/delete/<?php echo $message['id_message']?>" title="Xóa"><img src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/del.png"></a>  
                                        </td>
                                    </tr>          
                                <?php }
                            }
                            ?>       
                            <tfoot>
                            <td colspan="7">

                                Có <?php echo count($list_message) ?> tin nhắn
                                <span class="pages">
                                    <span class="pagebar-mainbody">
                                        <?php
                                        if ($total_page == 1 || $page == 1) {
                                            
                                        } else {
                                            ?>
                                            <a href="javascript:;" onclick="khachhang(<?php echo $page ?> - 1)">&lt;</a>
                                        <?php } ?>
                                        <?php
                                        for ($i = 1; $i <= $total_page; $i++) {
                                            if ($i == $page) {
                                                ?>
                                                <span class="pagebar-selections"><span class="pagelink-current"><?php echo $page ?></span></span>
                                            <?php } else { ?>
                                                <a href="javascript:; " onclick="khachhang(<?php echo $i ?>)"><?php echo $i ?></a>
                                            <?php } ?>

                                        <?php } ?>
                                        <?php
                                        if ($total_page == 1 || $page == $total_page) {
                                            
                                        } else {
                                            ?>
                                            <a href="javascript:;" onclick="khachhang(<?php echo $page ?> + 1)">&gt;</a>
<?php } ?>
                                    </span>
                                </span>
                            </td>
                            </tfoot>
                        </table>
                    </form>
                    <script type="text/javascript">
                        function khachhang(page_no) {
                            load_show();
                            $.post("<?php echo base_url(); ?>ctv/messagectv/list_message", {'page_no': page_no}, function(data) {
                                $("#message").html(data);
                                load_hide();
                            });
                        }
                        function update_status(id)
                        {
                            $.post("<?php echo base_url(); ?>ctv/messagememberctv/update_status", {'id': id}, function(data) {
                                var page_no = 1;
                                $.post("<?php echo base_url(); ?>ctv/messagememberctv/list_message", {'page_no': page_no}, function(data) {
                                    $("#message").html(data);
                                });
                            });
                        }
                    </script>  
                </div>
            </td>
        </tr>
    </table>
</div>