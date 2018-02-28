<?php

?>
<div id="acf-field-group-wrap" class="wrap lythframeadd">
    <div class="acf-columns-2">
        <h1 class="wp-heading-inline"><?= get_admin_page_title() ?></h1>
        <a class="page-title-action" href="<?= admin_url('admin.php?page=lythframelist') ?>" class="page-title-action">Back to List</a>
        <p>Units Spell Frame Delay</p>
        <table class="wp-list-table widefat fixed striped pages">
            <thead>
                <tr>
                    <th scope="col" id="fields" class="manage-column column-title column-primary column-fields">Unit Name</th>
                    <th scope="col" id="fields" class="manage-column column-fields">image</th>
                    <th scope="col" id="fields" class="manage-column column-fields">Spell Name</th>
                    <th scope="col" id="fields" class="manage-column column-fields">Hits</th>
                    <th scope="col" id="fields" class="manage-column column-fields">Spell Frame</th>
                    <th scope="col" id="fields" class="manage-column column-fields">Frame Delay Hit</th>
                    <th scope="col" id="fields" class="manage-column column-fields">Frame Pattern</th>
                    <th scope="col" id="fields" class="manage-column column-fields"> </th>
                </tr>
            </thead>
            <tbody id"the-list">
                <form id="addtolist">
                    <th>
                        <input type="text" name="unit_name" value="" placeholder="Unit Name">
                    </th>

                    <th>
                        <div class="form-group" id="image_url_group">
                            <label for="image_url" >
                                <input type="hidden" name="image_url" id="image_url" class="text" value="">
                            </label>
                            <br>
                            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
                        </div>
                        <div class="image_group">
                            <img  src="" alt="" id="upload_image">
                            <a href="" id="close_upload">X</a>
                        </div>
                    </th>

                    <th>
                        <div class="form-group">
                            <label for="spell_name_en">
                                <input type="text" name="spell_name_en" value="" placeholder="Spell Name">
                            </label>
                            <br>
                            <label for="spell_name_fr">
                                <input type="text" name="spell_name_fr" value="" placeholder="Spell Name Fr">
                            </label>
                        </div>
                    </th>

                    <th>
                        <input type="INT" name="hits" value="" placeholder="Number hits">
                    </th>

                    <th>
                        <input type="INT" name="spell_frame" value="" placeholder="Spell frame">
                    </th>

                    <th>
                        <input type="text" name="frame_delay_hit" value="" placeholder="2-8-8-8-8-8-8">
                    </th>
                    <th>
                        <input type="text" name="frame_pattern" value="" placeholder="2-10-18-26-34-42-50">
                    </th>
                    <th>
                        <input type="submit" class="btn btn-info" value="Save">
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
            <?php
            // $pattern = "5-54-58-87-95-155";
            // $result = LythFrameValidate::isPattern($pattern, 7);
            // var_dump($result);
            ?>
        </div>

        <table class="wp-list-table widefat fixed striped pages">
            <thead>
                <tr>
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
                <form class="" action="index.html" method="post">

                </form>
            </tbody>
            <tfoot>
                <tr class="no-items">
                    <td class="colspanchange" colspan="8"> </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
