<?php

 ?>
 <div id="acf-field-group-wrap" class="wrap lythframelist">
     <div class="acf-columns-2">
         <h1 class="wp-heading-inline"><?= get_admin_page_title() ?></h1>
         <a class="page-title-action" href="<?= admin_url('admin.php?page=lythframeadd') ?>" class="page-title-action">Ajouter</a>
         <p>Units Spell Frame Delay</p>
         <table class="wp-list-table widefat fixed striped pages">
             <thead>
                 <tr>
                     <th scope="col" id="fields" class="manage-column column-cb id-column">ID</th>
                     <th scope="col" id="fields" class="manage-column column-title column-primary column-fields">Unit Name</th>
                     <th scope="col" id="fields" class="manage-column column-fields">image</th>
                     <th scope="col" id="fields" class="manage-column column-fields">Spell Name</th>
                     <th scope="col" id="fields" class="manage-column column-fields">Hits</th>
                     <th scope="col" id="fields" class="manage-column column-fields">Spell Frame</th>
                     <th scope="col" id="fields" class="manage-column column-fields">Frame Delay Hit</th>
                     <th scope="col" id="fields" class="manage-column column-fields">Frame Pattern</th>
                 </tr>
             </thead>
             <tbody id"the-list">
                <?php $results = LythFrameSettings::getList(); ?>
                <?php if ($results): ?>
                        <tr>

                        </tr>
                <?php else: ?>
                    <tr class="no-items">
                        <td class="colspanchange" colspan="8">Sorry, No unit frame</td>
                    </tr>
                <?php endif; ?>
             </tbody>
         </table>
     </div>
 </div>
