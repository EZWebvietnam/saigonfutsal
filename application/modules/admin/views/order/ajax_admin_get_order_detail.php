<meta charset="utf-8" />
<script type="text/javascript">
   $(document).ready(function() {
       $("a.grouped_elements").fancybox({
           'padding'            : 0,
           'autoScale'            : false,
           'transitionIn'        : 'none',
           'transitionOut'        : 'none'
       });
   });
</script>

<div id="order_detail_content">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Danh sách CT Hóa Đơn</div>
                  </td>
                  <td style="float: right;">
                     
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form action="<?php echo base_url();?>admin/orderadmin/deletes" method="post" accept-charset="utf-8" id="admindata_order_detail">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>admin/orderadmin/list_order"/>
                  
                  <?php 
$status = array('0'=>'Chưa nhận tiền','1'=>'Đã nhận tiền')
?>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                              
                           <?php 
                           if($total_page == 1 || $page == 1)
                           {
                            
                           }
                           else
                           {
                           ?>
                           <a href="javascript:;" onclick="khachhang(<?php echo $page ?>-1)">&lt;</a>
                           <?php } ?>
                           <?php 
                           for($i=1;$i<=$total_page;$i++)
                           {
                            if($i==$page)
                            {
                           ?>
                           <span class="pagebar-selections"><span class="pagelink-current"><?php echo $page ?></span></span>
                           <?php } else {?>
                           <a href="javascript:; " onclick="khachhang(<?php echo $i ?>)"><?php echo $i ?></a>
                           <?php } ?>
                          
                           <?php } ?>
                           <?php 
                           if($total_page == 1 || $page == $total_page)
                           {
                            
                           }
                           else
                           {
                           ?>
                           <a href="javascript:;" onclick="khachhang(<?php echo $page ?>+1)">&gt;</a>
                           <?php } ?>
                           </span>
                              </span>
                           </th>
                        </tr>
                        <tr>
                           
                           <th class="id">Tên</th>
                           <th>Sản phẩm</th>
                           <th>Số lượng</th>
                           <th>Tiền</th>
                           <td>Hoa hồng</td>
                           <td>Tình trạng</td>
                           
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_order as $ctv_ref)
                        {
                        ?>
                     <tr class="row1 ">
                        
                        <td><?php echo $ctv_ref['full_name']?></td>
                        <td><?php echo $ctv_ref['title']?></td>
                        <td><?php echo $ctv_ref['quantity']?></td>
                        <td><?php echo $ctv_ref['price']?></td>
                        <td><?php echo $ctv_ref['commissions']?></td>
                        <td>
                            <?php if($ctv_ref['status_money']==0)
                            {?>
                            <img width="16" height="16" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/0.png" style="cursor: pointer;" title="Chưa nhận tiền" <?php if ($ctv_ref['id_ref_detail']!=0) {?>onclick="change_status_order(<?php echo $ctv_ref['id_order_detail']?>,<?php echo $page?>)"<?php } ?>/>CTV Chưa nhận tiền
                            <?php } else {?>
                            <img width="16" height="16" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/1.png" title="Đã nhận tiền"/>CTV Đã nhận tiền
                            <?php } ?>
                        </td>
                        
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                           
                           Có <?php echo count($list_order)?> Hóa Đơn
                           <span class="pages">
                           <span class="pagebar-mainbody">
                           <?php 
                           if($total_page == 1 || $page == 1)
                           {
                            
                           }
                           else
                           {
                           ?>
                           <a href="javascript:;" onclick="khachhang(<?php echo $page ?>-1)">&lt;</a>
                           <?php } ?>
                           <?php 
                           for($i=1;$i<=$total_page;$i++)
                           {
                            if($i==$page)
                            {
                           ?>
                           <span class="pagebar-selections"><span class="pagelink-current"><?php echo $page ?></span></span>
                           <?php } else {?>
                           <a href="javascript:; " onclick="khachhang(<?php echo $i ?>)"><?php echo $i ?></a>
                           <?php } ?>
                          
                           <?php } ?>
                           <?php 
                           if($total_page == 1 || $page == $total_page)
                           {
                            
                           }
                           else
                           {
                           ?>
                           <a href="javascript:;" onclick="khachhang(<?php echo $page ?>+1)">&gt;</a>
                           <?php } ?>
                           </span>
                           </span>
                        </td>
                     </tfoot>
                  </table>
               </form>
                
               <script type="text/javascript">
                   function change_status_order(id,page)
                   {
                       $.post("<?php echo base_url();?>admin/orderadmin/change_status_order_detail",{'id':id},function(data){
                           khachhang(page);
                      });
                       
                   }
                  function khachhang(page_no){  
                      load_show();   
                      $.post("<?php echo base_url();?>admin/orderadmin/list_order_detail",{'page_no':page_no},function(data){
                          $("#order_detail_content").html(data);                                            
                          load_hide();
                      });
                  }
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>
