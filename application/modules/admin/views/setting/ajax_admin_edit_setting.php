
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Cấu hình</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/settingadmin/edit" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
        <table class="form" style="width: 550px;">

            <tr>
                <td class="label">Author</td>
                <td colspan="3">
                    <input id="author" type="text" value="<?php echo $setting['author'] ?>" name ="author"/>
                </td>
            </tr>
            <tr>
                <td class="label">Title</td>
                <td colspan="3">
                    <input id="title" type="text" value="<?php echo $setting['title'] ?>" name ="title"/>
                </td>
            </tr>
             <tr>
                <td class="label">Publisher</td>
                <td colspan="3">
                    <input id="publisher" type="text" value="<?php echo $setting['publisher'] ?>" name ="publisher"/>
                </td>
            </tr>
            <tr>
                <td class="label">Copyright</td>
                <td colspan="3">
                    <input id="coppyright" type="text" value="<?php echo $setting['copyright'] ?>" name ="coppyright"/>
                </td>
            </tr>
            <tr>
                <td class="label">Robots</td>
                <td colspan="3">
                    <input id="robots" type="text" value="<?php echo $setting['robots'] ?>" name ="robots"/>
                </td>
            </tr>
             <tr>
                <td class="label">Distribution</td>
                <td colspan="3">
                    <input id="distribution" type="text" value="<?php echo $setting['distribution'] ?>" name ="distribution"/>
                </td>
            </tr>
            <tr>
                <td class="label">Rating</td>
                <td colspan="3">
                    <input id="rating" type="text" value="<?php echo $setting['rating'] ?>" name ="rating"/>
                </td>
            </tr>
            <tr>
                <td class="label">Keysword</td>
                <td colspan="3">
                    <textarea id="keyword" name="keyword"> <?php echo $setting['keywords'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">Descriptions</td>
                <td colspan="3">
                    <textarea name="descriptions" id="descriptions"> <?php echo $setting['description'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">Logo</td>
                <td colspan="3">
                    <?php 
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].ROT_DIR.'file/uploads/logo/'.$setting['logo']) && is_file($_SERVER['DOCUMENT_ROOT'].ROT_DIR.'file/uploads/logo/'.$setting['logo'])&&$setting['logo']!='')
                    {
                    ?>
                    <img src="<?php echo base_url();?>file/uploads/logo/<?php echo $setting['logo']?>" width="100" height="100"/>
                    <?php } else {?>
                    <img src="<?php echo base_url();?>file/uploads/no_image.gif" width="100" height="100"/>
                    <?php } ?>
                    <br/>
                    <input type="text" name="logo" value="<?php echo $setting['logo']?>"/><br/>
                    <input type="file" name="userfile"/><br/>
                    <input id="userfile" name="userfile" type="button" class="bt100" value="Upload" onClick="fileUpload(this.form,'<?php echo base_url();?>upload/upload_logo','upload','<?php echo base_url(); ?>admin/settingadmin/edit'); return false;">
                   <div id="upload"></div>
                    <input type='hidden' name='file' id='file'/>
                </td>
            </tr>
            <tr>
                <td class="label">Icon</td>
                <td colspan="3">
                    <input id="icon" type="text" value="<?php echo $setting['icon'] ?>" name ="icon"/>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td colspan="3">
                    <input type="submit" value="Cập nhập" class="bt100"/>
                </td>
            </tr>
            <td></td>
            
            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#cost_').priceFormat();
        $("#adminform").validate({
            rules: {
                
            },
            messages: {
            }
            , submitHandler: function(form) {
                var page = 1;
                dataString = $("#adminform").serialize();
               
                $.ajax({
                    type: "POST",
                    url: $("#adminform").attr('action'),
                    data: dataString,
                    mimeType: "multipart/form-data",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        $.fancybox.close();
                        reload_callback("<?php echo base_url(); ?>admin/settingadmin/list_setting", page, 'setting_content');
                        show_msg(data.msg);
                    }
                });
            }
        });
    });
</script>
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