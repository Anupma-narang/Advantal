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
                            <?php echo $profesional_record->getDireccionCompleta(); ?><span class="direction_complete"><?php echo $profesional_record->getPisoAndPuerta(); ?></span>
                        </strong>
                    </li>
                    <?php if ($profesional_record->getTele() != ''): ?>
                        <li class="tele-prof"><strong><?php echo $profesional_record->getTele() ?></strong></li>
                    <?php endif; ?>

                    <?php if ($profesional_record->getEmailAddress() != ''): ?>
                        <li class="email-prof"><strong><?php echo $profesional_record->getEmailAddress() ?></strong></li>
                    <?php endif; ?>
                    <li class="ciu_grn"><?php echo $profesional_record->getMunicipioProvincia() ?></li>
                    <li class="sect_org_full"><?php echo $profesional_record->getActivityName(); ?></li>
                </ul>
            </div>
            <div class="box_btn" style="float: right; width: auto;">
                <div id="alin_boton" style="font-size: 13px;"><span class="align_ver_detalle"><?php echo link_to('Ver profesional', url_for('profesional_edit', array('id' => $profesional_record->getId())), array('title' => 'Ver profesional')); ?></span></div>
            </div>
        </div>
        <div class="box_btm_c"></div>
    </div>
<?php endforeach; ?>