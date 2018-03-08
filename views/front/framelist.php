<div id="lythframe">
    <table class="table" style="height: contain;" width="100%">
        <thead class="table_header" style="height: 100%;">
            <tr class="table_row row_title">
                <td class="table_cel image_unit"><a id="frame_fix_header">Fixe Header</a></td>
                <td class="table_cel name"><strong>Unité</strong></td>
                <td class="table_cel spell_name"><strong>Compétence</strong></td>
                <td class="table_cel hits"><strong> Hits</strong></td>
                <td class="table_cel delay"><strong>Frame Delay</strong></td>
                <td class="table_cel patern"><strong>Patern</strong></td>
            </tr>
        </thead>
        <tbody class="table_body" style="height: 100%;">
            <?php if ($multiList): ?>
                <?php foreach ($multiList as $listForFrame): ?>
                    <tr class="table_row separator_row">
                        <td class="table_cel" style="width: 100%;"><?php echo $listForFrame['frame']; ?> Frames</td>
                    </tr>
                    <?php foreach ($listForFrame['list'] as $row): ?>
                        <tr class="table_row">
                            <th class="table_cel image_unit">
                                <?php $image_id = LythFrameCore::image_id_by_url($row->image_url); ?>
                                <?php echo wp_get_attachment_image( $image_id, 'thumbnail'); ?>
                            </th>

                            <th class="table_cel name">
                                <?php if (!empty($row->url_post)): ?>
                                    <a href="<?php echo $row->url_post ?>" target="_blank" rel=""><?php echo $row->unit_name ?></a>
                                <?php else: ?>
                                    <span><?php echo $row->unit_name ?></span>
                                <?php endif; ?>
                            </th>

                            <th class="table_cel spell_name">
                                <span><?php echo $row->spell_name_en ?></span>
                                <?php if (!empty($row->spell_name_fr)): ?>
                                    <span>(<?php echo $row->spell_name_fr ?>)</span>
                                <?php endif; ?>
                            </th>

                            <th class="table_cel hits">
                                <span><?php echo $row->hits ?> hits</span>
                            </th>

                            <th class="table_cel delay">
                                <span><?php echo $row->frame_delay_hit ?></span>
                            </th>

                            <th class="table_cel patern">
                                <span><?php echo $row->frame_pattern ?></span>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="no-items">
                    <td class="colspanchange" colspan="8">Sorry, No unit frame</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
