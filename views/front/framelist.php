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
                                <?php $image_alt = LythFrameCore::image_alt_by_url($row->image_url); ?>
                                <img class="aligncenter size-full wp-image-1363" src="<?php echo $row->image_url ?>" alt="<?php echo $image_alt ?>" width="90" height="85" />
                            </th>

                            <th class="table_cel name">
                                <span><?php echo $row->unit_name ?></span>
                            </th>

                            <th class="table_cel spell_name">
                                <span><?php echo $row->spell_name_en ?></span>
                                <br>
                                <span><?php echo $row->spell_name_fr ?></span>
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
