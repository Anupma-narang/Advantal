<div id="sf_admin_container">
    <h1>Detalle de nuestro caso de éxito de Producto</h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class="dragbox-content">
                <li>
                    <strong><?php echo __('Fecha') ?>: </strong><?php echo $product->getFCreatedAt("d/m/Y"); ?>
                </li>
                <li>
                    <strong><?php echo __('Estado') ?>: </strong>
                    <?php
                    if ($product->getStatus() == 1) {
                        echo "Revista";
                    } elseif ($product->getStatus() == 2) {
                        echo "Tramitado";
                    } elseif ($product->getStatus() == 3) {
                        echo "Cerrado";
                    }
                    ?>
                </li>
                <li>
                    <strong><?php echo __('Producto') ?>:</strong>
                    <?php echo $product->getName() ?></span>
                </li>
                <li>
                    <strong><?php echo __('Marca') ?>:</strong>
                    <?php echo $product->getMarca() ?></span>
                </li>
                <?php if ($product->getModelo()): ?>
                    <li>
                        <strong><?php echo __('Modelo') ?>:</strong>
                        <?php echo $product->getModelo() ?>
                    </li>
                <?php endif; ?>
                <li>
                    <strong><?php echo __('Sector del producto') ?>:</strong>
                    <?php echo $product->getSector() ?>
                </li>
                <li>
                    <strong><?php echo __('Subsector del producto') ?>:</strong>
                    <?php echo $product->getSubSector() ?>
                </li>
                <?php if ($product->getProductoTipoTres()->getId()): ?>
                    <li>
                        <strong><?php echo __('Tipo de producto') ?>:</strong>
                        <?php echo $product->getTipo() ?>
                    </li>
                <?php endif; ?>
                <br/>
                <li class="comment">
                    <span class="bold"><?php echo __('Descripción del caso de éxito:') ?></span>
                    <p class="mr-span"> </p>
                    <?php echo html_entity_decode($product->getDescription()); ?>
                    <span class="ver_link">
                        <?php echo '<br/>' . link_to('ver +', 'product_case_study/showDescription?id=' . $product->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>&nbsp;&nbsp;
                        <?php //echo link_to('descargar pdf', 'product_case_study/downloadCompanyPdf?id=' . $product->getId()) ?>
                    </span>
                </li>
                <div style="clear:both; height:17px;"></div>
                <li style="margin: 5px 0 0;">
                    <strong><?php echo __('Resumen del caso de éxito') ?>: </strong><p class="mr-span"></p><div class="company_desc"><?php echo html_entity_decode($product->getSummary()); ?></div>
                </li>
            </ul>
            <?php if ($product->getFile1()): ?>
                <div style="clear:both; height:23px;"></div>
                <ul class="dragbox-content" style="float:left; width: 99%; margin-top: -7px; margin-bottom: 0px; min-height: 0">
                    <li style="margin-bottom: 0px;">
                        <strong><?php echo __('Archivo') ?>: </strong>
                        <p class="mr-span"></p>
                        <ul style="margin: 6px 13px 12px;">
                            <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getFile1(); ?>"><?php echo __('Archivo1') ?></a></li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
            <?php if ($product->getLogo() && $product->getFile1() == ''): ?>
                <div style="clear:both; height:13px;"></div>
            <?php elseif ($product->getLogo() == '' && $product->getFile1()): ?>
                <div style="clear:both; height:3px;"></div>
            <?php elseif ($product->getLogo() == '' && $product->getFile1() == ''): ?>
                <div style="clear:both; height:6px;"></div>
            <?php else: ?>
                <div style="clear:both; height:5px;"></div>
            <?php endif; ?>
            <?php if ($product->getLogo()) : ?>
                <ul class="dragbox-content" style="float:left; width: 99%; margin-top: 0px; margin-bottom: 3px; min-height: 0">
                    <li>
                        <span class="bold"><?php echo __('Logo:') ?></span>
                        <!--a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getLogo(); ?>"><?php echo __('Archivo1') ?></a></li-->
                    </li> 
                    <li style="background: none;">
                        <?php echo image_tag('/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getLogo(), array('style' => 'width: 65px; height: 65px;')) ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', 'product_case_study/index', array('class' => 'sf_admin_action_cancel')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .ver_link {
        float: left;
        margin: 0 0 5px -19px;
    }
    .company_desc p{
        margin-bottom: 7px;
    }
    .company_desc ol{
        margin-left: 19px;
    }
    .company_desc ul{
        margin-left: 15px;
    }
    #sf_admin_container ul.sf_admin_actions { float: left; width: 99%; margin: 10px 10px 10px 6px !important; }
</style>