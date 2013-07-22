<?php use_helper('Text') ?>

<div id="sf_admin_container">
    <h1>Detalle de la auditoría</h1>

    <div id="sf_admin_content">
        <h2>
            <?php echo __('Auditoría') ?>
        </h2>
        <ul class="dragbox-content">
            <li>
                <span class="bold"><?php echo __('Fecha: ') ?></span>
                <?php echo date('d/m/Y', strtotime($auditanos->getCreatedAt())); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Estado: ') ?></span>
                <?php include_partial('estado', array('estado' => $auditanos->getStatus())); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Usuario: ') ?></span>
                <?php echo $auditanos->getUserNames($auditanos->getUserId()); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Jerarquía: ') ?></span>
                <?php echo $auditanos->getJerarquia($auditanos->getUserId()); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Correo electrónico: ') ?></span>
                <?php echo $auditanos->getEmail() ?>
            </li>
            <?php if ($auditanos->getPhone()): ?>
                <li>
                    <span class="bold"><?php echo __('Teléfono: ') ?></span>
                    <?php echo $auditanos->getPhone() ?>
                </li>
            <?php endif; ?>
            <li>
                <span class="bold"><?php echo __('Provincia: ') ?></span>
                <?php echo $auditanos->getProvincia($auditanos->getUserId()) ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Localidad: ') ?></span>
                <?php
                $location = $auditanos->getLoacalidadObject($auditanos->getUserId());
                //echo $location->getName();
                echo $auditanos->getCpMunicipioProvincia($auditanos->getUserId());
                ?>
            </li>

            <br>
            <li>
                <span class="bold"><?php echo __('Plan de acción: ') ?></span>
                <p class="mr-span"> </p>
                <div class="desc"><?php echo html_entity_decode($auditanos->getPlan()) ?></div>
                <span class="ver_link">
                    <?php echo '<br/>' . link_to('ver +', 'auditanos/showPlan?id=' . $auditanos->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                    <?php //echo link_to('descargar pdf', 'auditanos/downloadAuditPdf?id=' . $auditanos->getId()) ?>
                </span>
            </li>

            <?php if ($auditanos->getFichero1() || $auditanos->getFichero2() || $auditanos->getFichero3() || $auditanos->getFichero4() || $auditanos->getFichero5()): ?>
                <div style="clear:both; height: 18px;"></div>
                <li>
                    <span class="bold"><?php echo __('Archivos:') ?></span>
                    <ul>
                        <?php if ($auditanos->getFichero1()): ?>
                            <li><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $auditanos->getFichero1(); ?>"><?php echo __('Archivo1') . strstr($auditanos->getFichero1(), '.') ?></a></li>
                        <?php endif; ?>
                        <?php if ($auditanos->getFichero2()): ?>
                            <li><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $auditanos->getFichero2(); ?>"><?php echo __('Archivo2') . strstr($auditanos->getFichero2(), '.') ?></a></li>
                        <?php endif; ?>
                        <?php if ($auditanos->getFichero3()): ?>
                            <li><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $auditanos->getFichero3(); ?>"><?php echo __('Archivo3') . strstr($auditanos->getFichero3(), '.') ?></a></li>
                        <?php endif; ?>
                        <?php if ($auditanos->getFichero4()): ?>
                            <li><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $auditanos->getFichero4(); ?>"><?php echo __('Archivo4') . strstr($auditanos->getFichero4(), '.') ?></a></li>
                        <?php endif; ?>
                        <?php if ($auditanos->getFichero5()): ?>
                            <li><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $auditanos->getFichero5(); ?>"><?php echo __('Archivo5') . strstr($auditanos->getFichero5(), '.') ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

        </ul>
    </div>
    <div style="clear: both; height: 8px;"></div>
    <ul class="sf_admin_actions" style="margin-left: 6px !important;">
        <li class="sf_admin_action_list"><a href="<?php echo url_for('auditanos') ?>">Volver al Listado</a></li>
    </ul>
</div>
<style type="text/css">
    .ver_link{
        float:left;
        margin: 0px 0px 5px -19px;
    }
    .desc ol{
        margin-left: 19px;
    }
    .desc ul{
        margin-left: 15px;
    }
</style>