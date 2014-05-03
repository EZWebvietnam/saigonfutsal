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
<div id="setting_content">
   <table class="table_full" style="width: 100%;">
      <tr>
         <td style="background: #FFF;padding: 5px 5px 5px 5px;" valign="top">
            <table style="width: 100%;">
               <tr>
                  <td>
                     <div class="h-title">Cấu hình website</div>
                  </td>
                  <td style="float: right;">
                     <div class="addlink"><a href="<?php echo base_url(); ?>admin/settingadmin/about" class="add grouped_elements"><span>Giới thiệu</span></a><a href="<?php echo base_url(); ?>admin/settingadmin/edit_address" class="add grouped_elements"><span>Địa chỉ</span></a></div>
                  </td>
               </tr>
            </table>
            <div class="box-content">
               <div class="box_find">
               </div>
               <form  method="post" accept-charset="utf-8" id="admindata_kh">
                  <input type="hidden" id="page" value="0"/>
                  <input type="hidden" id="callback" value="<?php echo base_url();?>admin/settingadmin/list_setting"/>
                  <table class="admindata">
                     <thead>
                        <tr>
                           <th class="head" colspan="7">
                                                          
                           </th>
                        </tr>
                        <tr>
                           
                           <th class="id">Author</th>
                           <th>Title</th>
                           <th>Publisher</th>
                           <th>Copyright</th>
                           <th>Robots</th>
                           <th>Distribution</th>
                           <th>Rating</th>
                           <th>Keywords</th>
                           <th>Logo</th>
                           <th>Icon</th>
                           <th>Description</th>
                           <th class="publish">Chức năng</th>
                        </tr>
                     </thead>
                    
                     <tr class="row1 ">
                        
                        <td><?php echo $setting['author']?></td>
                        <td><?php echo $setting['title'];?></td>
                        <td><?php echo $setting['publisher'];?></td>
                        <td><?php echo $setting['copyright']?></td>
                        <td><?php echo $setting['robots']?></td>
                        <td><?php echo $setting['distribution']?></td>
                        <td><?php echo $setting['rating']?></td>
                        <td><?php echo sub_string($setting['keywords'],20);?></td>
                        <td><?php echo $setting['logo']?></td>
                        <td><?php echo $setting['icon']?></td>
                        <td><?php echo sub_string($setting['description'],20)?></td>
                        <td align="center">
                            <a class="grouped_elements" href="<?php echo base_url();?>admin/settingadmin/edit" title="Sửa"><img width="16" height="16" src="<?php echo base_url();?>template/ezwebvietnam/admin_cp/icon/edit.png"></a>
                        </td>
                     </tr>
                      
                     <tfoot>
                        <td colspan="7">
                                                   
                           
                           
                        </td>
                     </tfoot>
                  </table>
               </form>
                
               
            </div>
         </td>
      </tr>
   </table>
</div>
