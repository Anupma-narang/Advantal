<div class="con-p">
    <div class="bd-l list-f">
        <?php if (count($white_list_product_records)): ?>
            <span class="rw-h"><?php echo __('Lista blanca') ?></span>
            <ul class="cn-lt">
                <?php foreach ($white_list_product_records as $index => $product): ?>
                    <li class="<?php echo $index % 2 ? '' : 'green-back' ?>">
                        <a href="<?php echo url_for('lista_blanca_producto_detalle', array('slug' => $product->getSlug())); ?>" class="home-block-link">
                            <?php $image = $product->getProductoTipoUno() ? $product->getProductoTipoUno()->getImage() : $product->getProductoTipoDos()->getImage(); ?>
                            <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/thumbnails/" . $image) ?></div>
                            <!-- <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR . $image) ?></div> -->
                            <div class="cn-r">

                                <strong class="cn-ep width25 block cbbro-color"><?php echo truncate_text($product->getName(), 28); ?></strong>
                                <span class="gr-l width25 block ">

                                    <strong class="cbb-color"><?php echo truncate_text($product->getMarca(), 35); ?></strong>
                                    <strong class="cbgr1-color"><?php echo truncate_text($product->getModelo(), 14); ?></strong>
                                </span>
                                <?php $type = $product->getProductoTipoTres() ? $product->getProductoTipoTres() : $product->getProductoTipoDos(); ?>
                                <strong class="oc rc-l width25 block org"><?php echo truncate_text($type, 28) ?></strong>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="bd-r list-f hidden">
        <?php if (count($black_list_product_records)): ?>
            <span class="rn-h"><?php echo __('Lista negra') ?></span>
            <ul class="cn-lt">
                <?php foreach ($black_list_product_records as $index => $product): ?>
                    <li class="<?php echo $index % 2 ? '' : 'green-back' ?>">
                        <a href="<?php echo url_for('lista_blanca_producto_detalle', array('slug' => $product->getSlug())); ?>" class="home-block-link">
                            <?php $image = $product->getProductoTipoUno() ? $product->getProductoTipoUno()->getImage() : $product->getProductoTipoDos()->getImage(); ?>
                            <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/thumbnails/" . $image) ?></div>
                            <!-- <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR . $image) ?></div> -->
                            <div class="cn-r">

                                <strong class="cn-ep width25 block cbbro-color"><?php echo truncate_text($product->getName(), 28); ?></strong>
                                <span class="gr-l width25 block ">
                                    <strong class="cbb-color"><?php echo truncate_text($product->getMarca(), 32); ?></strong>
                                    <strong class="cbgr1-color"><?php echo truncate_text($product->getModelo(), 11); ?></strong>
                                </span>
                                <?php $type = $product->getProductoTipoTres() ? $product->getProductoTipoTres() : $product->getProductoTipoDos(); ?>
                                <strong class="oc rc-l width25 block org"><?php echo truncate_text($type, 28) ?></strong>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="b-btn btn-footer">
        <span class="wc-b btn-f" onclick="showList('contenido_home_cuatro_c', 'bd-l')" title="Lista blanca de productos recomendados por los consumidores"></span>
        <span class="bc-b btn-f" onclick="showList('contenido_home_cuatro_c', 'bd-r')" title="Lista negra de productos no recomendados por los consumidores"></span>
    </div>
    <div class="bd-l-s sview right">

        <form class="s-view hidden" action="/las-listas/lista-blanca/productos" method="POST">
            <input type="text" id="producto_filters_name" size="15" value="" name="producto_filters[name]" autocomplete="off" class="ac_input">
            <input type="hidden" value="1" name="static"/>
        </form>
        <?php echo link_to('&nbsp;', url_for('lista_blanca_productos'), array('title' => 'Ver todos los productos en la lista blanca', 'class' => 'bt_ver')); ?>
    </div>

    <div class="bd-r-s sview hidden right">


        <form class="s-view hidden" action="/las-listas/lista-negra/productos" method="POST">
            <input type="hidden" value="1" name="static"/>
            <input type="text" id="producto_filters_name" size="15" value="" name="producto_filters[name]" autocomplete="off" class="ac_input">

        </form>
        <?php echo link_to('&nbsp;', url_for('lista_negra_producto'), array('title' => 'Ver todos los productos en la lista negra', 'class' => 'bt_ver')); ?>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#contenido_home_cuatro_c .bc-b").click(function(){
            if($("#contenido_home_cuatro_c .con-p .bd-l").hasClass('hidden')){
                $("#contenido_home_cuatro_c .rss").attr("title", "Añade productos no recomendados a RSS");
            }
        });
        $("#contenido_home_cuatro_c .wc-b").click(function(){
            if($("#contenido_home_cuatro_c .con-p .bd-r").hasClass('hidden')){
                $("#contenido_home_cuatro_c .rss").attr("title", "Añade productos recomendados a RSS");
            }
        });
        showList('contenido_home_cuatro_c','<?php echo $sf_user->getAttribute('contenido_home_cuatro_c') ? $sf_user->getAttribute('contenido_home_cuatro_c') : 'bd-l' ?>');
    });
</script>