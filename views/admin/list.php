<?php
    if (isset($_GET)) {
        var_dump($_GET);
    }
 ?>
 <pre>
     <?php $obj1 = new LythFrameSettings() ?>
     <?php var_dump($obj1); ?>
 <br>
     <?php $obj2 = new LythFrameSettings(23) ?>
     <?php var_dump($obj2); ?>
</pre>

 <div id="acf-field-group-wrap" class="wrap lythframelist">
     <div class="acf-columns-2">
         <h1 class="wp-heading-inline"><?= get_admin_page_title() ?></h1>
         <a class="page-title-action" href="<?= admin_url('admin.php?page=lythframeadd') ?>" class="page-title-action">Ajouter</a>
         <p>Units Spell Frame Delay</p>
         <div>
             <div id="lythframe_success" class="alert alert-success" style="display:none;">
                 <p></p>
                 <i class="icon-cancel-circled"></i>
             </div>
             <div id="lythframe_error" class="alert alert-error" style="display:none;">
                 <p></p>
                 <i class="icon-cancel-circled"></i>
             </div>
         </div>
         <span>Shortcode : <strong>[lythframe]</strong></span>
         <br>
         <br>
        <?php if (isset($_GET['id_item']) && !empty($_GET['id_item']) && $_GET['button'] == "update") : ?>
            <?php $obj = new LythFrameSettings($_GET['id_item']); ?>
            <table id="edit-list-item" class="wp-list-table widefat fixed striped pages">
                <thead>
                    <tr>
                        <th scope="col" id="field_1" class="manage-column column-title column-primary column-fields">Unit Name</th>
                        <th scope="col" id="field_2" class="manage-column column-fields">image</th>
                        <th scope="col" id="field_3" class="manage-column column-fields">Spell Name</th>
                        <th scope="col" id="field_4" class="manage-column column-fields">Hits</th>
                        <th scope="col" id="field_5" class="manage-column column-fields">Spell Frame</th>
                        <th scope="col" id="field_6" class="manage-column column-fields">Frame Delay Hit</th>
                        <th scope="col" id="field_7" class="manage-column column-fields">Frame Pattern</th>
                        <th scope="col" id="field_8" class="manage-column column-fields"> </th>
                    </tr>
                </thead>
                <tbody>
                    <form id="update">
                        <th>
                            <input type="hidden" name="id" value="<?php echo $obj->id ?>">
                            <input type="text" name="unit_name" value="<?php echo $obj->unit_name ?>" placeholder="<?php echo $obj->unit_name ?>">
                        </th>
                        <th>
                            <div class="form-group" id="image_url_group" >
                                <input type="hidden" name="image_url" id="image_url" class="text" value="<?php echo $obj->image_url ?>">
                                <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
                            </div>
                            <div class="image_group">
                                <img  src="<?php echo $obj->image_url ?>" alt="" id="upload_image">
                                <a href="" id="close_upload">X</a>
                            </div>
                        </th>
                        <th>
                            <div class="form-group">
                                <label for="spell_name_en">
                                    <input type="text" name="spell_name_en" value="<?php echo $obj->spell_name_en ?>" placeholder="<?php echo $obj->spell_name_en ?>">
                                </label>
                                <br>
                                <label for="spell_name_fr">
                                    <input type="text" name="spell_name_fr" value="<?php echo $obj->spell_name_fr ?>" placeholder="<?php echo $obj->spell_name_fr ?>">
                                </label>
                            </div>
                        </th>
                        <th>
                            <input type="INT" name="hits" value="<?php echo $obj->hits ?>" placeholder="<?php echo $obj->hits ?>">
                        </th>
                        <th>
                            <input type="INT" name="spell_frame" value="<?php echo $obj->spell_frame ?>" placeholder="<?php echo $obj->spell_frame ?>">
                        </th>
                        <th>
                            <input type="text" name="frame_delay_hit" value="<?php echo $obj->frame_delay_hit ?>" placeholder="<?php echo $obj->frame_delay_hit ?>">
                        </th>
                        <th>
                            <input type="text" name="frame_pattern" value="<?php echo $obj->frame_pattern ?>" placeholder="<?php echo $obj->frame_pattern ?>">
                        </th>
                        <th>
                            <button id="update_btn" type="submit" class="btn btn-info" value="update"><i class="icon-spin5 animate-spin"></i><span class="icon_text">Update</span></button>
                        </th>
                    </form>
                </tbody>
                <tfoot>
                    <tr class="no-items">
                        <td class="colspanchange" colspan="8"> </td>
                    </tr>
                </tfoot>
            </table>
            <div class="separator" style="display:block;margin-top:40px;">
                <?php ?>
            </div>
        <?php endif; ?>

         <table id="lythframe-list" class="wp-list-table widefat fixed striped pages">
             <thead>
                 <tr>
                     <th scope="col" id="field_0" class="manage-column column-cb id-column">ID</th>
                     <th scope="col" id="field_1" class="manage-column column-title column-primary column-fields">Unit Name</th>
                     <th scope="col" id="field_2" class="manage-column column-fields">image</th>
                     <th scope="col" id="field_3" class="manage-column column-fields">Spell Name</th>
                     <th scope="col" id="field_4" class="manage-column column-fields">Hits</th>
                     <th scope="col" id="field_5" class="manage-column column-fields">Spell Frame</th>
                     <th scope="col" id="field_6" class="manage-column column-fields">Frame Delay Hit</th>
                     <th scope="col" id="field_7" class="manage-column column-fields">Frame Pattern</th>
                    <th scope="col" id="field_8" class="manage-column column-fields">Action</th>
                 </tr>
             </thead>
             <tbody>
                <?php $results = LythFrameCore::getList(); ?>
                <?php if ($results): ?>
                    <?php foreach ($results as $row): ?>
                        <?php if (empty($_GET['id_item']) || $_GET['id_item'] != $row->id) : ?>
                            <tr>
                                <th>
                                    <span><?php echo $row->id ?></span>
                                </th>
                                <th>
                                    <span><?php echo $row->unit_name ?></span>
                                </th>
                                <th>
                                    <img src="<?php echo $row->image_url ?>" alt="">
                                </th>
                                <th>
                                    <span><?php echo $row->spell_name_en ?></span>
                                    <br>
                                    <span><?php echo $row->spell_name_fr ?></span>
                                </th>
                                <th>
                                    <span><?php echo $row->hits ?></span>
                                </th>
                                <th>
                                    <span><?php echo $row->spell_frame ?></span>
                                </th>
                                <th>
                                    <span><?php echo $row->frame_delay_hit ?></span>
                                </th>
                                <th>
                                    <span><?php echo $row->frame_pattern ?></span>
                                </th>
                                <th>
                                    <form  action="<?= admin_url('admin.php') ?>" method="GET">
                                        <input type="hidden" name="page" value="lythframelist">
                                        <input type="hidden" name="id_item" value="<?php echo $row->id ?>">
                                        <button id="delete_btn" type="submit" class="btn btn-info" name="button" value="delete"></i><span class="icon_text">Delete</span></button>
                                        <br>
                                        <button id="update_btn" type="submit" class="btn btn-info" name="button" value="update"></i><span class="icon_text">Update</span></button>
                                    </form>
                                </th>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="no-items">
                        <td class="colspanchange" colspan="8">Sorry, No unit frame</td>
                    </tr>
                <?php endif; ?>
             </tbody>
             <tfoot>
                 <tr class="no-items">
                     <td class="colspanchange" colspan="8"> </td>
                 </tr>
             </tfoot>
         </table>
     </div>
 </div>
