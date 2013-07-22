<div class="con-p">
    <div class="bd-l list-f">
        <?php if (count($whilte_list_comapny_records)): ?>
            <span class="rw-h"><?php echo __('Lista blanca') ?></span>
            <ul class="cn-lt">
                <?php foreach ($whilte_list_comapny_records as $index => $comapny): ?>
                    <li class="<?php echo $index % 2 ? '' : 'blue-back' ?>">
                        <a href="<?php echo url_for('lista_blanca_empresa_detalle', array('slug' => $comapny->getSlug())); ?>" class="home-block-link">
                            <?php $image = $comapny->getEmpresaSectorUno() ? $comapny->getEmpresaSectorUno()->getImage() : $comapny->getEmpresaSectorDos()->getImage() ?>
                            <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . $image) ?></div>
                            <div class="cn-r">

                                <strong class="cn-ep bc width25 block"><?php echo truncate_text($comapny->getName(), 28); ?></strong>
                                <strong class="gr-l gc width25 block">
                                    <?php $city_state_length = strlen($comapny->getStateValue() . ' ' . $comapny->getCityValue()) ?>
                                    <?php echo truncate_text($comapny->getCityValue(), $city_state_length > 28 ? 28 : $city_state_length); ?>
                                    <?php echo $comapny->getStateValue(); ?>
                                </strong>
                                <strong class="rc-l org"><?php echo truncate_text($comapny->getTresSector(), 28); ?></strong>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="bd-r list-f hidden">
        <?php if (count($black_list_comapny_records)): ?>
            <span class="rn-h"><?php echo __('Lista negra') ?></span>
            <ul class="cn-lt">
                <?php foreach ($black_list_comapny_records as $index => $comapny): ?>
                    <li class="<?php echo $index % 2 ? '' : 'blue-back' ?>">
                        <a href="<?php echo url_for('lista_blanca_empresa_detalle', array('slug' => $comapny->getSlug())); ?>" class="home-block-link">
                            <?php $image = $comapny->getEmpresaSectorUno() ? $comapny->getEmpresaSectorUno()->getImage() : $comapny->getEmpresaSectorDos()->getImage() ?>
                            <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . $image) ?></div>
                            <div class="cn-r">

                                <strong class="cn-ep bc width25 block"><?php echo truncate_text($comapny->getName(), 28); ?></strong>
                                <strong class="gr-l gc width25 block">
                                    <?php $city_state_length = strlen($comapny->getStateValue() . ' ' . $comapny->getCityValue()) ?>
                                    <?php echo truncate_text($comapny->getCityValue(), $city_state_length > 28 ? 28 : $city_state_length); ?>
                                    <?php echo $comapny->getStateValue(); ?>
                                </strong>
                                <strong class="rc-l org"><?php echo truncate_text($comapny->getTresSector(), 28); ?></strong>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="b-btn btn-footer">
        <span class="wc-b btn-f" onclick="showList('contenido_home_cuatro_b', 'bd-l')" title="Lista blanca de empresas y entidades recomendadas por los consumidores"></span>
        <span class="bc-b btn-f" onclick="showList('contenido_home_cuatro_b', 'bd-r')" title="Lista negra de empresas y entidades no recomendadas por los consumidores"></span>
    </div>
    <div class="bd-f ">
        <div class="bd-l-s sview right">

            <form class="s-view hidden" action="/las-listas/lista-blanca/empresas" method="POST">
                <input type="text" id="empresa_filters_name" size="15" value="" name="empresa_filters[name]">
                <input type="hidden" value="1" name="static"/>
            </form>
            <?php echo link_to('&nbsp;', url_for('lista_blanca_empresa'), array('title' => 'Ver todas las empresas y entidades en la lista blanca', 'class' => 'bt_ver')); ?>
        </div>

        <div class="bd-r-s sview hidden right">
            <form class="s-view hidden" action="/las-listas/lista-negra/empresa" method="POST">
                <input type="hidden" value="1" name="static"/>
                <input type="text" id="empresa_filters_name" size="15" value="" name="empresa_filters[name]">

            </form>
            <?php echo link_to('&nbsp;', url_for('lista_negra_empresa'), array('title' => 'Ver todas las empresas y entidades en la lista negra', 'class' => 'bt_ver')); ?>
        </div>


    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#contenido_home_cuatro_b .bc-b").click(function(){
            if($("#contenido_home_cuatro_b .con-p .bd-l").hasClass('hidden')){
                $("#contenido_home_cuatro_b .rss").attr("title", "Añade empresas y entidades no recomendadas a RSS");
            }
        });
        $("#contenido_home_cuatro_b .wc-b").click(function(){
            if($("#contenido_home_cuatro_b .con-p .bd-r").hasClass('hidden')){
                $("#contenido_home_cuatro_b .rss").attr("title", "Añade empresas y entidades recomendadas a RSS");
            }
        });
        
        showList('contenido_home_cuatro_b','<?php echo $sf_user->getAttribute('contenido_home_cuatro_b') ? $sf_user->getAttribute('contenido_home_cuatro_b') : 'bd-l' ?>');

    });
</script>