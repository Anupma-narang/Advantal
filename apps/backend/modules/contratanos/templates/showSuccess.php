<?php use_helper('Text') ?>
<style type="text/css">
    .ver_link {
        float: left;
        margin: 0 0 5px -19px;
    }
</style>
<div id="sf_admin_container">
    <h1>Detalle del formulario Contrátanos para Empresa/Entidad</h1>

    <div id="sf_admin_content">
        <h2>
            <?php echo __('Contrátanos ') ?>
        </h2>
        <ul class="dragbox-content" >
            <li>
                <span class="bold"><?php echo __('Fecha: ') ?></span>
                <?php echo date('d/m/Y', strtotime($contratanos->getCreatedAt())); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Estado: ') ?></span>
                <?php include_partial('estado', array('estado' => $contratanos->getStatus())); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Empresa/Entidad: ') ?></span>
                <?php echo $contratanos->getName(); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Actividad:') ?></span>
                <?php echo $contratanos->getActividad() ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Cargo:') ?></span>
                <?php echo $contratanos->getCargo() ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Nombre: ') ?></span>
                <?php echo $contratanos->getNombre(); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Apellido 1: ') ?></span>
                <?php echo $contratanos->getApellido1() ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Apellido 2: ') ?></span>
                <?php echo $contratanos->getApellido2() ?>
            </li>
            <?php /* if ($contratanos->getPhone()): ?>
              <li>
              <span class="bold"><?php echo __('Teléfono: ') ?></span>
              <?php echo $contratanos->getPhone() ?>
              </li>
              <?php endif; */ ?>
            <li>
                <span class="bold"><?php echo __('NIF/NIE/CIF:') ?></span>
                <?php echo $contratanos->getCif() ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Correo electrónico:') ?></span>
                <?php echo $contratanos->getEmail() ?>
            </li>
            <?php if ($contratanos->getPhone()): ?>
                <li>
                    <span class="bold"><?php echo __('Teléfono:') ?></span>
                    <?php echo $contratanos->getPhone() ?>
                </li>
            <?php endif; ?>
            <?php
            $TipoVia = $audit = Doctrine::getTable('RoadType')->findOneBy('id', $contratanos->getRoadTypeId());
            if ($TipoVia):
                ?>
                <li>
                    <span class="bold"><?php echo __('Tipo vía:') ?></span>
                    <?php echo $TipoVia->getName() ?>
                </li>
            <?php endif; ?>
            <?php if ($contratanos->getDireccion()): ?>
                <li>
                    <span class="bold"><?php echo __('Dirección:') ?></span>
                    <?php echo $contratanos->getDireccion() ?>
                </li>
            <?php endif; ?>
            <?php if ($contratanos->getNum()): ?>
                <li>
                    <span class="bold"><?php echo __('Nº:') ?></span>
                    <?php echo $contratanos->getNum() ?>
                </li>
            <?php endif; ?>
            <?php if ($contratanos->getPiso()): ?>
                <li>
                    <span class="bold"><?php echo __('Piso:') ?></span>
                    <?php echo $contratanos->getPiso() ?>
                </li>
            <?php endif; ?>
            <?php if ($contratanos->getPuerta()): ?>
                <li>
                    <span class="bold"><?php echo __('Puerta:') ?></span>
                    <?php echo $contratanos->getPuerta() ?>
                </li>
            <?php endif; ?>
            <?php if ($contratanos->getCp()): ?>
                <li>
                    <span class="bold"><?php echo __('C.P.:') ?></span>
                    <?php echo $contratanos->getCp() ?>
                </li>
            <?php endif; ?>
            <li>
                <span class="bold"><?php echo __('Provincia:') ?></span>
                <?php $state = Doctrine::getTable('States')->find($contratanos->getStatesId()); ?>
                <?php echo $state->getName(); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Localidad:') ?></span>
                <?php /* $city = Doctrine::getTable('City')->find($contratanos->getCityId()); ?>
                  <?php $state = Doctrine::getTable('States')->find($contratanos->getStatesId()); ?>
                  <?php echo $city->getName();
                  echo ($state) ? " (" . $state->getName() . ")" : ""; */ ?>
                <?php echo $contratanos->getCpMunicipioProvincia(); ?>
            </li>
            <br/>
            <li>
                <span class="bold"><?php echo __('Comentario:') ?></span>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($contratanos->getAyudar()) ?>
                <span class="ver_link">
                    <?php echo '<br/>' . link_to('ver +', 'contratanos/showPlan?id=' . $contratanos->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, titlebar=1"))) ?>
                    <?php //echo link_to('descargar pdf', 'contratanos/downloadCompanyPdf?id=' . $contratanos->getId())  ?>
                </span>
            </li>
            <?php if ($contratanos->getServicio() || $contratanos->getAntes() == "SI" || $contratanos->getAntes() == "1"): ?>
                <br />
                <div style="clear: both; height: 22px;"></div>
            <?php endif; ?>
            <?php if ($contratanos->getServicio()): ?>
                <li>
                    <span class="bold"><?php echo __('Servicio a contratar:') ?></span>
                    <?php echo $contratanos->getServicio(); ?>
                </li>
            <?php endif; ?>
            <?php if ($contratanos->getAntes() == "SI" || $contratanos->getAntes() == "1"): ?>
                <li>
                    <span class="bold"><?php echo __('Objeto de AEC antes:') ?></span>
                    <?php echo ($contratanos->getAntes() == 1) ? "SI" : "NO"; ?>
                </li>
            <?php endif; ?>
            <?php if (($contratanos->getAntes() == "SI" || $contratanos->getAntes() == "1") && $contratanos->getWhat()): ?>
                <li>
                    <span class="bold"><?php echo __('¿Cuál/es?:') ?></span>
                    <?php echo $contratanos->getWhat(); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div style="clear: both; height: 6px;"></div>
    <ul class="sf_admin_actions" style="margin-left: 6px !important; margin-top: 0 !important;">
        <li class="sf_admin_action_list"><br /><a href="<?php echo url_for('contratanos') ?>">Volver al Listado</a></li>
    </ul>
</div>