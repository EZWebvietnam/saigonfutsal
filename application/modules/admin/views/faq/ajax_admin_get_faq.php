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
<div id="faq_content">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Danh sách Hỏi đáp</div>
                  </td>
                  <td style="float: right;">
                     
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form action="<?php echo base_url();?>admin/faqadmin/deletes" method="post" accept-charset="utf-8" id="admindata_faq">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>admin/faqadmin/list_faq"/>
                  
                  <?php 
$status = array('0'=>'Chưa trả lời','1'=>'Đã trả lời ')
?>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                              <a class="del" onclick="return action_del('admindata_faq','faq');"><span>Xóa</span></a>                                Có <?php echo count($list_ctv)?> hỏi đáp <span class="pages"><span class="pagebar-mainbody">
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
                           <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata_faq')"></th>
                           <th class="id">Tên</th>
                           <th>Email</th>
                           <th>Câu hỏi</th>
                           <th>Trả lời</th>
                           <td>Tình trạng</td>
                           <th class="publish">Chức năng</th>
                        </tr>
                     </thead>
                     <?php 
                        foreach($list_ctv as $ctv_ref)
                        {
                        ?>
                     <tr class="row1 ">
                        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $ctv_ref['id']?>"></td>
                        <td><?php echo $ctv_ref['name']?></td>
                        <td><?php echo $ctv_ref['email']?></td>
                        <td><?php echo $ctv_ref['question']?></td>
                        <td><?php echo $ctv_ref['answer']?></td>
                        <td><?php echo $status[$ctv_ref['status']]?></td>
                        <td align="center">
                            <a class="grouped_elements" href="<?php echo base_url();?>admin/faqadmin/edit/<?php echo $ctv_ref['id']?>" title="Trả lời"><img width="16" height="16" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/edit.png"></a>
                            
                            
                            <a class="delete_record" href="<?php echo base_url();?>admin/faqadmin/delete/<?php echo $ctv_ref['id']?>" title="Xóa"><img src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/del.png"></a>        
                        </td>
                     </tr>
                     <?php }?>       
                     <tfoot>
                        <td colspan="7">
                           <a class="del" onclick="return action_del('admindata_faq','faq');"><span>Xóa</span></a>                            
                           Có <?php echo count($list_ctv)?> hỏi đáp
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
                      $.post("<?php echo base_url();?>admin/orderadmin/list_order",{'page_no':page_no},function(data){
                          $("#faq_content").html(data);                                            
                          load_hide();
                      });
                  }
               </script>  
            </div>
         </td>
      </tr>
   </table>
</div>
