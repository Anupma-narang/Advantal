<div id="sf_admin_container">
    <h1>Detalle de otro caso de éxito de Empresa/Entidad</h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class="dragbox-content">
                <li><strong>Fecha: </strong>
                    <?php echo $company->getFCreatedAt("d/m/Y"); ?>
                </li>
                <li><strong><?php echo __('Estado:') ?></strong>
                    <?php include_partial('estado', array('estado' => $company->getStatus())); ?>
                </li>
                <li><strong><?php echo __('Usuario:') ?></strong>
                    <?php echo $company->getUserName($company->getUserId()); ?>
                </li>
                <li><strong><?php echo __('Empresa/Entidad:') ?></strong>
                    <?php echo $company->getName() ?>
                </li>
                <?php if (($company->getStates() != "Toda España" && $company->getDireccion()) || ($company->getStates() == "Toda España" && $company->getDireccion())): ?>
                    <li><strong><?php echo __('Dirección:') ?></strong>
                        <?php echo $company->getDireccion() ?>
                    </li>
                <?php endif; ?>
                <?php if (($company->getStates() != "Toda España" && $company->getNumero()) || ($company->getStates() == "Toda España" && $company->getNumero())): ?>
                    <li><strong><?php echo __('Nº:') ?></strong>
                        <?php echo $company->getNumero() ?>
                    </li>
                <?php endif; ?>
                <?php if ($company->getPiso()): ?>
                    <li><strong><?php echo __('Piso:') ?></strong>
                        <?php echo $company->getPiso() ?>
                    </li>
                <?php endif; ?>

                <?php if ($company->getPuerta()): ?>
                    <li><strong><?php echo __('Puerta:') ?></strong>
                        <?php echo $company->getPuerta() ?>
                    </li>
                <?php endif; ?>
                <li><strong><?php echo __('Provincia:') ?></strong>
                    <?php echo $company->getStates() ?>
                <li>

                <li><strong><?php echo __('Localidad:') ?></strong>
                    <?php echo $company->getCpMunicipioProvinciaCongi() ?>
                </li>

                <li><strong><?php echo __('Sector:') ?></strong>
                    <?php echo $company->getEmpresaSectorUno() ?>
                </li>

                <li><strong><?php echo __('Subsector:') ?></strong>
                    <?php echo $company->getEmpresaSectorDos() ?>
                </li>

                <?php if ($company->getEmpresaSectorTres()->getId()) : ?>
                    <li><strong><?php echo __('Actividad:') ?></strong>
                        <?php echo $company->getEmpresaSectorTres() ?>
                    </li>
                <?php endif; ?>
                <br/>
                <li class="comment" style="margin-bottom: 5px;">
                    <span class="bold">Descripción del caso de éxito:</span>
                    <p class="mr-span"> </p>
                    <div class="comenario_p">
                        <?php echo html_entity_decode($company->getDescription()) ?>
                    </div>
                    <span class="ver_link">
                        <?php echo '<br/>' . link_to('ver +', 'user_company_case_study/showDescription?id=' . $company->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                        <?php //echo link_to('descargar pdf', 'user_company_case_study/downloadCompanyPdf?id=' . $company->getId()) ?>
                    </span>
                </li>
                <div style="clear:both; height:22px;"></div>
                <li><span class="bold">Resumen del caso de éxito:</span><p class="mr-span"> </p>
                    <div class="comenario_p">
                        <?php echo html_entity_decode($company->getSummary()) ?>
                    </div>
                </li>
            </ul>
            <?php if ($company->getFile1()): ?>
                <div style="clear:both; height:16px;"></div>
                <ul class="dragbox-content" style="float:left; width: 99%; margin-top: -3px; min-height: 0">
                    <li>                    
                        <strong><?php echo __('Archivo') ?>: </strong>
                        <p class="mr-span"></p>
                        <ul style="margin: 6px 13px 10px;">
                            <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $company->getFile1(); ?>"><?php echo __('Archivo1') ?></a></li>
                        </ul>
                    </li>
                </ul>
            <?php elseif ($company->getLogo() == '' && $company->getFile1() == ''): ?>
                <div style="clear:both; height:3px;"></div>
            <?php endif; ?>
            <?php if ($company->getLogo() && $company->getFile1() == ''): ?>
                <div style="clear:both; height:10px;"></div>
            <?php elseif ($company->getLogo() && $company->getFile1()): ?>
                <div style="clear:both; height:2px;"></div>
            <?php endif; ?>
            <?php if ($company->getLogo()) : ?>
                <ul class="dragbox-content" style="float:left; width: 99%; margin-top: 0px; margin-bottom: 3px; min-height: 0">
                    <li>
                        <span class="bold"><?php echo __('Logo:') ?></span>
                        <!--a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $company->getLogo(); ?>"><?php echo __('Archivo1') ?></a></li-->
                    </li> 
                    <li style="background: none;">
                        <?php echo image_tag('/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $company->getLogo(), array('style' => 'width: 65px; height: 65px;')) ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'>
                <?php echo link_to('Volver al Listado', 'user_company_case_study/index') ?>
            </li>
        </ul>
    </div>
</div>

<style type="text/css">
    #sf_admin_container ul.sf_admin_actions { float: left; width: 99%; margin: 10px 10px 10px 6px !important; }
    .ver_link{ float:left;margin: 13px 0px 5px -19px; }
    .comment p{ width: 100%; }
    .comenario_p p{ margin: 0; }
    ol{ margin-left: 20px; }
    ul{ margin-left: 16px; }
</style>