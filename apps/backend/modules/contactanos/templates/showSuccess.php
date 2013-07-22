<?php use_helper('Text') ?>
<?php
$contact_us_status = array('1' => 'Revista ',
    '2' => 'Tramitado',
    '3' => 'Cerrado');
?>
<div id="sf_admin_container">
    <h1>Detalle del contacto</h1>

    <div id="sf_admin_content">
        <h2>
            <?php echo __('Contáctanos') ?>
        </h2>
        <ul class="dragbox-content">
            <li><span class="bold"><?php echo __('Fecha: ') ?></span><?php echo date('d/m/Y', strtotime($contactanos->getCreatedAt())); ?></li>
            <li><span class="bold"><?php echo __('Estado: ') ?></span><?php echo $contact_us_status[$contactanos->getStatus()]; ?></li>

            <?php if ($contactanos->getUserId()): ?>
                <li><span class="bold"><?php echo __('Usuario: ') ?></span>
                    <?php echo $contactanos->getsfGuardUser()->getUsername() ?>
                </li>
            <?php endif; ?>

            <li><span class="bold"><?php echo __('Nombre: ') ?></span><?php echo $contactanos->getNombre(); ?></li>
            <li><span class="bold"><?php echo __('Apellido 1: ') ?></span><?php echo $contactanos->getApellido1() ?></li>
            <li><span class="bold"><?php echo __('Apellido 2: ') ?></span><?php echo $contactanos->getApellido2() ?></li>
            <li><span class="bold"><?php echo __('Correo electrónico: ') ?></span><?php echo $contactanos->getEmail() ?></li>
            <?php if ($contactanos->getPhone()): ?>
                <li><span class="bold"><?php echo __('Teléfono: ') ?></span><?php echo $contactanos->getPhone() ?></li>
            <?php endif; ?>
            <br>
            <li>
                <span class="bold"><?php echo __('Comentario: ') ?></span>
                <p class="mr-span"></p>
                <?php echo html_entity_decode($contactanos->getComentario()) ?>
                <div style="clear: both; height: 16px;"></div>
                <span class="ver_link">
                    <?php echo link_to('ver +', 'contactanos/showPlan?id=' . $contactanos->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
                <?php //echo link_to('descargar pdf', 'contactanos/downloadAuditPdf?id=' . $contactanos->getId()) ?>
            </li>
            <?php if ($contactanos->getFichero1() || $contactanos->getFichero2() || $contactanos->getFichero3() || $contactanos->getFichero4() || $contactanos->getFichero5()): ?>
                <div style="clear: both; height: 22px; font-weight:bold"></div>
                <li>
                    <span class="bold"><?php echo __('Archivos:') ?></span>
                    <ul>
                        <?php if ($contactanos->getFichero1()): ?>
                            <li><b><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $contactanos->getFichero1(); ?>"><?php echo __('Archivo1') . strstr($contactanos->getFichero1(), '.') ?></a></b></li>
                        <?php endif; ?>
                        <?php if ($contactanos->getFichero2()): ?>
                            <li><b><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $contactanos->getFichero2(); ?>"><?php echo __('Archivo2') . strstr($contactanos->getFichero2(), '.') ?></a></b></li>
                        <?php endif; ?>
                        <?php if ($contactanos->getFichero3()): ?>
                            <li><b><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $contactanos->getFichero3(); ?>"><?php echo __('Archivo3') . strstr($contactanos->getFichero3(), '.') ?></a></b></li>
                        <?php endif; ?>
                        <?php if ($contactanos->getFichero4()): ?>
                            <li><b><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $contactanos->getFichero4(); ?>"><?php echo __('Archivo4') . strstr($contactanos->getFichero4(), '.') ?></a></b></li>
                        <?php endif; ?>
                        <?php if ($contactanos->getFichero5()): ?>
                            <li><b><a target="_blank" href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $contactanos->getFichero5(); ?>"><?php echo __('Archivo5') . strstr($contactanos->getFichero5(), '.') ?></a></b></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <div style="clear: both; height: 3px;"></div>
            <?php else: ?>
                <div style="clear: both; height: 11px;"></div>
            <?php endif; ?>
        </ul>
    </div>

    <ul class="sf_admin_actions" style="margin-left: 6px !important;">
        <li class="sf_admin_action_list"><a href="<?php echo url_for('contactanos') ?>">Volver al Listado</a></li>
    </ul>
</div>
<style type="text/css">
    .ver_link{ float:left;margin: 0px 0px 5px -19px; }
</style>