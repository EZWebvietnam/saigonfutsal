<meta charset="utf-8" />
<script type="text/javascript">
   $(document).ready(function() {
       $.ajaxSetup({ cache: false });
       $("a.grouped_elements").fancybox({
           'padding'            : 0,
           'autoScale'            : false,
           'transitionIn'        : 'none',
           'transitionOut'        : 'none'
       });
   });
</script>
<div id="new_content">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Danh sách tin tức</div>
                  </td>
                  <td style="float: right;">
                     <div class="addlink"><a href="<?php echo base_url(); ?>admin/newsadmin/add" class="add grouped_elements"><span>Thêm</span></a></div>
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form action="<?php echo base_url();?>admin/newsadmin/deletes" method="post" accept-charset="utf-8" id="admindata_new">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>admin/newsadmin/list_new"/>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                              <a class="del" onclick="return action_del('admindata_new','new');"><span>Xóa</span></a>                                Có <?php echo count($list_new)?> bài viết <span class="pages"><span class="pagebar-mainbody">
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
                           <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata_new')"></th>
                           <th class="id">Tiêu đề</th>
                           <th>Nội dung</th>
                           <th class="publish">Chức năng</th>
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_new as $new)
                        {
                        ?>
                     <tr class="row1 ">
                        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $new['id']?>"></td>
                        <td><?php echo $new['title']?></td>
                        <td><?php echo sub_string(loaibohtmltrongvanban($new['content']),300);?></td>
                        <td align="center"><a class="grouped_elements" href="<?php echo base_url();?>admin/newsadmin/edit/<?php echo $new['id']?>" title="Sửa"><img width="16" height="16" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/edit.png"></a>
                            <a class="grouped_elements" href="<?php echo base_url();?>admin/newsadmin/view/<?php echo $new['id']?>" title="Xem chi tiết"><img width="16" height="16" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/view.png"></a>
                           <a class="delete_record" href="<?php echo base_url();?>admin/newsadmin/delete/<?php echo $new['id']?>" title="Xóa"><img src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/del.png"></a>        
                        </td>
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                           <a class="del" onclick="return action_del('admindata_new','new');"><span>Xóa</span></a>                            
                           Có <?php echo count($list_new)?> bài viết
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
                      $.post("<?php echo base_url();?>admin/newsadmin/list_new",{'page_no':page_no},function(data){
                          $("#new_content").html(data);                                            
                          load_hide();
                      });
                  }
                  
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>
