<?php if ($parent_menu_type == 'user_case_study'): ?>
    <!-- <a class="float-right" href="/vosotros/userProductCaseStudyRequest">cuéntanos tu caso de éxito</a> -->
<?php endif; ?>
<?php foreach ($pager as $index => $product_record): ?>
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" id="">
                <div style="float: left; width: 100%">
                    <?php if ($product_record->getLogo() && file_exists("images/uploads/documents/" . $product_record->getLogo())): ?>
                        <div class="width100" style="padding-bottom: 5px;">
                            <img width="62" height="62" src="/images/uploads/documents/<?php echo $product_record->getLogo() ?>">
                        </div>
                    <?php endif; ?>
                    <div style="float: left; width: 75%">
                        <?php if ($submenu_type == 'user_case_study'): ?>
                            <?php if ($is_authenticated): ?>
                                <p class="rojo_marron">
                                    <strong><?php echo __('Creado por ') . ($product_record->getUserName() == $sf_user->getUsername() ? 'ti' : $product_record->getUserName()); ?></strong>
                                </p>
                            <?php else: ?>
                                <p class="rojo_marron">
                                    <strong><?php echo __('Creado por ') . ($product_record->getUserName()); ?></strong>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="rojo_marron">
                            <b><?php echo $product_record->getName(); ?></b>
                            <span class="gris_macra">
                                <b><?php echo $product_record->getMarca(); ?></b>
                            </span>
                            <span class="gris">
                                <b><?php echo $product_record->getModelo(); ?></b>
                            </span>
                        </p>
                        <p class="naranja">
                            <b><?php echo $product_record->getTipo(); ?></b>
                        </p>
                    </div>
                    <div style="float: right; width: 25%">
                        <div class="float-right">
                            <?php if (!$product_record->getLogo() && !file_exists("images/uploads/documents/" . $product_record->getLogo())): ?>
                                <div style="height: <?php echo ($product_record->getLogo()) ? '65px' : '3px'; ?>">&nbsp;</div>
                            <?php endif; ?>
                            <?php if ($product_record->getProductoTipoUno()->getImage() && file_exists("images/uploads/thumbnails/" . $product_record->getProductoTipoUno()->getImage())): ?>
                                <img width="62" height="62" src="/images/uploads/thumbnails/<?php echo $product_record->getProductoTipoUno()->getImage() ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div style="float:left; font-size: 13px; width: 100%">
                    <strong><?php echo __('Resumen del caso de éxito'); ?></strong>
                </div>
                <div class="pers70 sum-box" style="font-size: 13px;">
                    <br/>
                    <?php echo html_entity_decode($product_record->getSummary()); ?>
                </div>
                <div style="float:right; width:123px; margin-top: -30px;">
                    <?php $category_type = ($submenu_type == 'our_case_study') ? 'ProductCaseStudy' : 'UserProductCaseStudy'; ?>
                    <?php $type = ($category_type == "ProductCaseStudy") ? "productcase" : "userproductcase"; ?>
                    <?php echo link_to('ver caso de éxito', 'vosotros/showProductCaseStudyDetail?id=' . $product_record->getId() . '&type=' . $type, array("class" => "btn-ver-caso", "popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
<?php endforeach; ?>
<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => url_for('/vosotros/' . lcfirst($category_type)), 'params' => array())) ?>
<?php endif; ?>
<style type="text/css">
    p.rojo_marron, p.azul, p.gris, p.verde, p.naranja{
        word-wrap: break-word;
        width: 360px;
    }
    .pers70{
        width: 75%;
    }
    .gris_macra{
        color:#166494;
    }
    .pers70 ol{
        margin-left: -17px;
    }
    .pers70 ul{
        margin-left: -6px;
    }
    div.pers70 ul li {
        list-style-type: disc;
    }
    p.rojo_marron, p.azul{
        text-align: left;
        overflow: hidden;
        text-align: left;
        text-overflow: ellipsis;
        white-space: normal;
        width: 360px;
    }
    p.azul, p.gris, p.naranja{
        text-align: left;
        overflow: hidden;
        text-align: left;
        text-overflow: ellipsis;
        white-space: normal;
        width: 360px;
    }
    p.verde{
        text-align: left;
    }
    .pagination ul li{
        float: left;
    }
    .pagination ul li a{
        text-decoration: none;
    }
    .pagination ul li.active a, .pagination ul li.pagina a{
        border-right: 1px solid #4D5357;
        padding: 0 2px;
    }
    .pagination ul li.active a{
        color: #F65E13;
    }
    .top-right{
        font-size: 12px;
    }
</style>
