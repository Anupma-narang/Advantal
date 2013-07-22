<?php use_helper('Text') ?>
<style type="text/css">
    .ver_link {float: left;margin: 0 0 5px -19px;}
    ol{ margin-left: 20px; }
    ul{ margin-left: 16px; }
</style>
<div id="sf_admin_container">
    <h1>Detalle de otro caso de éxito de Producto</h1>
    <div id="sf_admin_content">
        <ul class="dragbox-content" >
            <li>
                <span class="bold"><?php echo __('Fecha: ') ?></span>
                <?php echo date('d/m/Y', strtotime($product->getCreatedAt())); ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Estado: ') ?></span>
                <?php if ($product->getStatus() == '1'): ?>
                    <?php echo "Revista"; ?>
                <?php elseif ($product->getStatus() == '2'): ?>
                    <?php echo "Tramitado"; ?>
                <?php elseif ($product->getStatus() == '3'): ?>
                    <?php echo "Cerrado"; ?>
                <?php endif; ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Usuario:') ?></span>
                <?php echo $product->getUserName() ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Producto:') ?></span>
                <?php echo $product->getName() ?>
            </li>

            <li>
                <span class="bold"><?php echo __('Marca:') ?></span>
                <?php echo $product->getMarca() ?>
            </li>
            <?php if ($product->getModelo()): ?>
                <li>
                    <span class="bold"><?php echo __('Modelo:') ?></span>
                    <?php echo $product->getModelo() ?>
                </li>
            <?php endif; ?>
            <li>
                <span class="bold"><?php echo __('Sector del producto:') ?></span>
                <?php echo $product->getProductoTipoUno() ?>
            </li>
            <li>
                <span class="bold"><?php echo __('Subsector del producto:') ?></span>
                <?php echo $product->getProductoTipoDos() ?>
            </li>
            <?php if ($product->getProductoTipoTresId()): ?>
                <li>
                    <span class="bold"><?php echo __('Tipo de producto:') ?></span>
                    <?php echo $product->getTipo() ?>
                </li>
            <?php endif; ?>
            <br/>
            <li class="comment">
                <span class="bold"><?php echo __('Descripción del caso de éxito:') ?></span>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($product->getDescription()) ?>
                <span class="ver_link">
                    <?php echo '<br/>' . link_to('ver +', 'user_product_case_study_request/showDescription?id=' . $product->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1"))) ?>
                </span>
            </li>
            <div style="clear:both; height:17px;"></div>
            <li style="margin: 5px 0 0;">
                <span class="bold"><?php echo __('Resumen del caso de éxito:') ?></span>
                <p class="mr-span"> </p>
                <div class="company_desc"><?php echo html_entity_decode($product->getSummary()) ?></div>
            </li>
        </ul>
        <?php if ($product->getFile1() || $product->getFile2() || $product->getFile3() || $product->getFile4() ): ?>
            <div style="clear:both; height:23px;"></div>
            <ul class="dragbox-content" style="float:left; width: 99%; margin-top: -7px; margin-bottom: 0px; min-height: 0">
                <li style="margin-bottom: 0px;">
                    <strong><?php echo __('Archivo') ?>: </strong>
                    <p class="mr-span"></p>
                    <ul style="margin: 6px 13px 12px;">
                        <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getFile1(); ?>"><?php echo __('Archivo1') ?></a></li>
                        <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getFile2(); ?>"><?php echo __('Archivo2') ?></a></li>
                        <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getFile3(); ?>"><?php echo __('Archivo3') ?></a></li>
                        <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $product->getFile4(); ?>"><?php echo __('Archivo4') ?></a></li>
                    </ul>
                </li>
            </ul>
        <?php endif; ?>
        <?php if ($product->getLogo() && ($product->getFile1() == '' || $product->getFile2() == '' || $product->getFile3() == '' || $product->getFile4() == '')): ?>
            <div style="clear:both; height:13px;"></div>
        <?php elseif ($product->getLogo() == '' && ($product->getFile1() == '' || $product->getFile2() == '' || $product->getFile3() == '' || $product->getFile4() == '')): ?>
            <div style="clear:both; height:3px;"></div>
        <?php elseif ($product->getLogo() == '' && ($product->getFile1() == '' || $product->getFile2() == '' || $product->getFile3() == '' || $product->getFile4() == '')): ?>
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
    <ul class="sf_admin_actions">
        <li class="sf_admin_action_list"><?php echo link_to('Volver al Listado', 'user_product_case_study_request/index') ?></li>
    </ul>
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
