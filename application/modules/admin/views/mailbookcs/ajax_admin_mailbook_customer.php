<?php 
   function full_url($s)
   {
       $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
       $sp = strtolower($s['SERVER_PROTOCOL']);
       $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
       $port = $s['SERVER_PORT'];
       $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
       $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
       return $protocol . '://' . $host . $port . $s['REQUEST_URI'];
   }
   ?>
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
<div id="mailbookcs_content">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Danh sách Khách hàng đăng ký nhận quà</div>
                     
                  </td>
                  <td style="float: right;">
                     
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form action="<?php echo base_url();?>admin/customeradmin/deletes" method="post" accept-charset="utf-8" id="admindata_mailbookcs">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>admin/customeradmin/list_mail_customer"/>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                              <a class="del" onclick="return action_del('admindata_mailbookcs','mailbookcs');"><span>Xóa</span></a>                                Có <?php echo count($list_mail)?><span class="pages"><span class="pagebar-mainbody">
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
                           <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata_mailbookcs')"></th>
                           <th>Họ tên</th>
                           <th>Email</th>
                           <th>SĐT</th>
                           <th class="publish">Chức năng</th>
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_mail as $product_ref)
                        {
                        ?>
                     <tr class="row1 ">
                        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $product_ref['id']?>"></td>
                        <td><?php echo $product_ref['full_name']?></td>
                        <td><?php echo $product_ref['email']?></td>
                        <td><?php echo $product_ref['phone']?></td>
                        <td align="center">
                           <a class="delete_record" href="<?php echo base_url();?>admin/customeradmin/delete/<?php echo $product_ref['id']?>" title="Xóa"><img src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/del.png"></a>        
                            
                        </td>
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                           <a class="del" onclick="return action_del('admindata_mailbookcs','mailbookcs');"><span>Xóa</span></a>                            
                           Có <?php echo count($list_mail)?>
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
                  function khachhang(page_no){  
                      load_show();   
                      $.post("<?php echo base_url();?>admin/customeradmin/list_mail_customer",{'page_no':page_no},function(data){
                          $("#mailbook_content").html(data);                                            
                          load_hide();
                      });
                  }
                  
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>
