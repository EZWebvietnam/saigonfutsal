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
<div id="result">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Thống kê thu nhập</div>
                  </td>
                  <td>
                     <div class="h-title">Đã lĩnh: <?php echo number_format($tien_linh);?></div>||<div class="h-title">Chưa lĩnh: <?php echo number_format($tien_chua_linh);?></div>||<div class="h-title">Còn dư: <?php echo number_format($tien_chua_linh);?></div>
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form  method="post" accept-charset="utf-8" id="admindata_kh">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>ctv/productctv/ajax_thu_nhap"/>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                                                              Có <?php echo count($list_tn)?> dòng <span class="pages"><span class="pagebar-mainbody">
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
                           
                           <th class="id">Sản phẩm</th>
                           <th>Số tiền</th>
                           <th>Thời gian</th>
                           <th>Tình trạng</th>
                           
                           
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_tn as $tn)
                        {
                        ?>
                     <tr class="row1 ">
                        
                        <td><?php echo $tn['title']?></td>
                        <td><?php echo $tn['commissions']?></td>
                        <td><?php echo date('d/m/Y',$tn['create_date']);?></td>
                        <td><?php 
                        $array = array('0'=>'Chưa lĩnh tiền','1'=>'Đã lĩnh tiền');
                        echo $array[$tn['status_money']];?></td>
                        
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                                                      
                           Có <?php echo count($list_tn)?> dòng
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
                          $("#result").html(data);                                            
                          load_hide();
                      });
                  }
                  
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>