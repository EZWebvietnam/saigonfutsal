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
<div id="customer">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Danh sách khách hàng</div>
                  </td>
                  
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form  method="post" accept-charset="utf-8" id="admindata_cus">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>ctv/productctv/ajax_get_customer"/>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                                                              Có <?php echo count($list_customer)?> khách hàng <span class="pages"><span class="pagebar-mainbody">
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
                           
                           <th class="id">Tên khách hàng</th>
                           <th>Địa chỉ</th>
                           <th>SĐT</th>
                           <th>Email</th>
                           <th>Yahoo</th>
                           
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_customer as $customer)
                        {
                        ?>
                     <tr class="row1 ">
                        
                        <td><?php echo $customer['full_name']?></td>
                        <td><?php echo $customer['address']?></td>
                        <td><?php echo $customer['phone']?></td>
                        <td><?php echo $customer['email']?></td>
                        <td><?php echo $customer['yahoo']?></td>
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                                                      
                           Có <?php echo count($list_customer)?> khách hàng 
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
                      $.post("<?php echo base_url();?>ctv/productctv/ajax_get_product",{'page_no':page_no},function(data){
                          $("#customer").html(data);                                            
                          load_hide();
                      });
                  }
                  
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>