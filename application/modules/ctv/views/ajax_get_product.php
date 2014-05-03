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
<div id="product">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Danh sách khóa học</div>
                  </td>
                  <td style="float: right;">
                     <div class="addlink"><a href="<?php echo base_url(); ?>ctv/productctv/add_product" class="add grouped_elements"><span>Thêm mới</span></a></div>
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form action="<?php echo base_url();?>ctv/productctv/deletes" method="post" accept-charset="utf-8" id="admindata_pro">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>ctv/productctv/ajax_get_product"/>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                              <a class="del" onclick="return action_del('admindata_pro','khachhang');"><span>Xóa</span></a>                                Có <?php echo count($list_product_ref)?> sản phẩm<span class="pages"><span class="pagebar-mainbody">
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
                           <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata_pro')"></th>
                           <th class="id">Tên sản phẩm</th>
                           <th>Giới thiệu</th>
                           <th>Ngày hết hạn</th>
                           <th>Giá</th>
                           <th>Hoa hồng</th>
                           <th>Link</th>
                           <th class="publish">Chức năng</th>
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_product_ref as $product_ref)
                        {
                        ?>
                     <tr class="row1 ">
                        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $product_ref['user_product_id']?>"></td>
                        <td><?php echo $product_ref['title']?></td>
                        <td><?php echo $product_ref['description']?></td>
                        <td><?php echo $product_ref['exp_date']?></td>
                        <td><?php echo $product_ref['cost']?></td>
                        <td><?php echo ($product_ref['cost']*$product_ref['comission'])/100?></td>
                        <?php 
                        if($product_ref['position']==0)
                        {
                        ?>
                        <td><a href="<?php echo base_url();?>ref/<?php echo $this->session->userdata('user_id') ?>">Link</a></td>
                        <?php } else {?>
                        <td><a href="<?php echo base_url();?>san-pham/<?php echo $product_ref['id_product'] ?>-<?php echo mb_strtolower(url_title(removesign($product_ref['title'])))?>/ref/<?php echo $this->session->userdata('user_id') ?>">Link</a></td>
                        <?php } ?>
                        <td align="center">
                           <a class="delete_record" href="<?php echo base_url();?>ctv/productctv/delete/<?php echo $product_ref['user_product_id']?>" title="Xóa"><img src="http://quanlybanhang.360vnit.com/app/templates/icon/del.png"></a>        
                        </td>
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                           <a class="del" onclick="return action_del('admindata_pro','product');"><span>Xóa</span></a>                            
                           Có <?php echo count($list_product_ref)?> sản phẩm
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
                          $("#product").html(data);                                            
                          load_hide();
                      });
                  }
                  
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>