<?php

 ?>
 <div id="acf-field-group-wrap" class="wrap lythframelist">
     <div class="acf-columns-2">
         <h1 class="wp-heading-inline"><?= get_admin_page_title() ?></h1>
         <a class="page-title-action" href="<?= admin_url('admin.php?page=lythframeadd') ?>" class="page-title-action">Ajouter</a>
         <p>Units Spell Frame Delay</p>
         <span>Shortcode : <strong>[lythframe]</strong></span>
         <br>
         <br>
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
                                <form  action="" method="">
                                    <input type="hidden" name="" value="<?php echo $row->id ?>">
                                    <button id="delete_btn" type="submit" class="btn btn-info" value="delete"></i><span class="icon_text">Delete</span></button>
                                    <br>
                                    <button id="update_btn" type="submit" class="btn btn-info" value="update"></i><span class="icon_text">Update</span></button>
                                </form>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="no-items">
                        <td class="colspanchange" colspan="8">Sorry, No unit frame</td>
                    </tr>
                <?php endif; ?>
             </tbody>
         </table>
     </div>
 </div>
