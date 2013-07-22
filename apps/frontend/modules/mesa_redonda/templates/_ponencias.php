<?php use_helper('Date', 'Text') ?>
<?php if ($orden == 0): ?> <div class="ponencia_destacada"> <?php else: ?> <div class="ponencia_normal"> <?php endif; ?>

        <div id="concurso_mesa">
            <div id="mrl"> <span class="mr_titulo"><?php echo $ponencia->name ?> </span>
<!--                <span class="mr_fecha"><?php //echo "Fecha Ponencia: " . $ponencia->fecha_alta ?></span>-->
                <span class="mr_categoria"><?php echo $ponencia->MesaRedonda->MesaredondaCategoria   ?></span>
<!--                    <span class="mr_alias">Creada por Lali</span>-->
                <!--<span class="mr_estado">Estado: Activa</span>  -->
            </div> 
            
<!--            <div id="mrr">
                <span class="mr_img">
                    <?php //echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/" . $ponencia->MesaRedonda->MesaredondaCategoria->image) ?>
                </span>
            </div>-->
            
            <?php if ($ponencia->MesaRedonda->mesaredonda_estado_id == 2): ?>
                <div id="mrb"> 
                    <span class="mr_boton"> <?php echo link_to("da una ponencia", "ponenciauno/new?mesa_redonda_id=".$ponencia->mesa_redonda_id) ?>
                    </span>
                </div>
                <?php //echo link_to1("dar ponencia", "ponenciauno/new?mr=".$ponencia->mesa_redonda_id) ?>

            <?php elseif ($ponencia->MesaRedonda->mesaredonda_estado_id == 3): ?> 
                <div id="mrb"> 
<!--                    <span class="mr_boton">
                        <?php //echo link_to("Votar mesa redonda", "mesa_redonda/show?id=" . $mesaredonda->id) ?>
                    </span>-->

                <?php include_component("mesa_redonda", "votacion", array("ponencia" => $ponencia, "mesaredonda" => $ponencia->MesaRedonda)) ?>
                </div>           

 <?php endif; ?>
        </div>

        <!--</div>-->
    </div>
