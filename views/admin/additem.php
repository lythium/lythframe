
<div id="acf-field-group-wrap" class="wrap lythframeadd">
    <div class="acf-columns-2">
        <h1 class="wp-heading-inline"><?= get_admin_page_title() ?></h1>
        <a class="page-title-action" href="<?= admin_url('admin.php?page=lythframelist') ?>" class="page-title-action">Back to List</a>
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
        <table class="wp-list-table widefat fixed striped pages">
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
            <tbody id="form_addtolist">
                <form id="addtolist">
                    <th>
                        <input type="text" name="unit_name" value="" placeholder="Unit Name">
                    </th>

                    <th>
                        <div class="form-group" id="image_url_group">
                            <input type="hidden" name="image_url" id="image_url" class="text" value="">
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
                        <button id="add_btn" type="submit" class="btn btn-info" value="Save"><i class="icon-spin5 animate-spin"></i><span class="icon_text">Add</span></button>
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
                    <th scope="col" id="field_1" class="manage-column column-title column-primary column-fields">Unit Name</th>
                    <th scope="col" id="field_2" class="manage-column column-fields">image</th>
                    <th scope="col" id="field_3" class="manage-column column-fields">Spell Name</th>
                    <th scope="col" id="field_4" class="manage-column column-fields">Hits</th>
                    <th scope="col" id="field_5" class="manage-column column-fields">Spell Frame</th>
                    <th scope="col" id="field_6" class="manage-column column-fields">Frame Delay Hit</th>
                    <th scope="col" id="field_7" class="manage-column column-fields">Frame Pattern</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="add_list">
                    <!-- item -->
            </tbody>
            <tfoot>
                <tr class="no-items">
                    <td class="colspanchange" colspan="8"> </td>
                </tr>
            </tfoot>
        </table>
        <form id="formlist" method="post" action="<?= admin_url('admin.php?page=lythframeadd') ?>">
            <div>
                <!-- Item -->
            </div>
            <button id="save_btn" type="submit" class="btn btn-info" value="Save"><i class="icon-spin5 animate-spin"></i><span class="icon_text">Add</span></button>
        </form>
    </div>
</div>

<?php
    $obj = new LythFrameSettings();
    echo "<pre>";
    var_dump($obj);
    echo "</pre>";
?>
