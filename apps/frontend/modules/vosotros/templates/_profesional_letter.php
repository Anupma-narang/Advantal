<?php use_stylesheet("/css/box_style.css") ?>
<?php use_helper('mihelper', 'alternativeLink'); ?>
<?php foreach ($profesional as $index => $profesional_record): ?>
    <div class="box_main">
        <div class="box_top_c"></div>
        <div class="box_mid">
            <div class="box_left" style="height: auto !important;">
                <ul>
                    <li class="head_full">
                        <?php echo $string = html_entity_decode($profesional_record->getLastNameOne() . ' ' . $profesional_record->getLastNameTwo() . ', ' . $profesional_record->getFirstName()); ?>
                    </li>
                    <li class="adre_full">
                        <strong>
                            <?php echo $profesional_record->getProfesional()->getDireccionCompleta(); ?><span class="direction_complete"><?php echo $profesional_record->getProfesional()->getPisoAndPuerta(); ?></span>
                        </strong>
                    </li>
                    <?php if ($profesional_record->getProfesional()->getTele() != ''): ?>
                        <li class="tele-prof"><strong><?php echo $profesional_record->getProfesional()->getTele() ?></strong></li>
                    <?php endif; ?>

                    <?php if ($profesional_record->getProfesional()->getEmailAddress() != ''): ?>
                        <li class="email-prof"><strong><?php echo $profesional_record->getProfesional()->getEmailAddress() ?></strong></li>
                    <?php endif; ?>
                    <li class="ciu_grn"><?php echo $profesional_record->getProfesional()->getMunicipioProvincia() ?></li>
                    <li class="sect_org_full"><?php echo $profesional_record->getProfesional()->getActivityName(); ?></li>
                </ul>
            </div>
            <?php //$prof_letter_type = $profesional_record->getProfesionalLetterType($profesional_record->getId()); //echo $profesional_record->getProfesionalLetter()->getId(); ?>
            <?php $prof_letter_type_id = $profesional_record->getLetterTypeId(); ?>
            <div class="box_btn" style="float: right; width: auto;">
                <div id="alin_botons" style="font-size: 13px;">
                    <span class="align_ver_detalle">
                        <?php if ($prof_letter_type_id == 1): ?>
                            <?php echo link_to('Ver recomendación', url_for('profesional_recomend_edit', array('id' => $profesional_record->getProfesional()->getId(), 'letter_id' => $profesional_record->getLetterId())), array("title" => "Ver recomendación")); ?>
                        <?php else: ?>
                            <?php echo link_to('Ver desaprobación', url_for('profesional_disaproval_edit', array('id' => $profesional_record->getProfesional()->getId(), 'letter_id' => $profesional_record->getLetterId())), array("title" => "Ver desaprobación")); ?>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="box_btm_c"></div>
    </div>
<?php endforeach; ?>