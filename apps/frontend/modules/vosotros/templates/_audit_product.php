<?php use_helper('mihelper'); ?>
<div class="item">
    <?php if ($audit_record->getconcursoDestacado()->getId()) : ?>
        <a href="<?php echo url_for('concurso/show?id=' . $audit_record->getConcursoDestacado()->getId()) ?>">
        <?php endif ?>
        <div class="col_left">
            <ul class='lista_detalles'>

                <li class="title"><?php echo $audit_record->getName(); ?> <?php echo $audit_record->getMarca(); ?> <?php echo $audit_record->getModelo() ?></li>
                <li class="sector"><?php echo $audit_record->getTipo(); ?></li>
                <li><a class='auditorias' title='Comentarios de los colaboradores' href='<?php echo url_for('lista_blanca_comentarios', array('slug' => $audit_record->getSlug(), 'tipo' => 'producto')) ?>'>Auditorías realizadas (<?php echo $audit_record->countAuditoriasRealizadas() ?>) <a></li>
                            <li><a class='categoria_excelencia' title='Indicadores de excelencia'
                                   href="<?php echo url_for('lista_blanca_categoria_excelencia', array('tipo' => 'producto', 'slug' => $audit_record->getSlug())) ?>">
                                    Indicadores de excelencia
                                </a></li>
                            <li><a href="#">Añadir a favoritos</a></li>
                            </div>
                            <div class="col_center">
                                <?php if (null != $audit_record->getEvolucionAsString()) : ?>

                                    <a class='fancybox-media' href='<?php echo url_for('producto_show_chart', array('id' => $audit_record->getId())) ?>'>
                                        <div class='dynamicBar'><?php echo $audit_record->getEvolucionAsString() ?></div>
                                    </a>

                                <?php endif ?>

                            </div>
                            <div class="col_right">
                                <?php if ($audit_record->getMedalla()): ?>
                                    <img class="medalla" alt="<?php echo "Medalla de " . $audit_record->getMedalla() ?>"
                                         src="<?php echo '/images/img_listas/medalla-' . $audit_record->getMedalla() . '.png' ?>"/>
                                     <?php endif ?>
                                <!-- <a class="btn-audita login_required"
                                   href="<?php echo url_for('lista_blanca_audita_producto', array('slug' => $audit_record->getSlug()), array('dialog_id' => 'login_required')) ?>">Audita</a> -->
                                <a class="btn-audita login_required" data-id="<?php echo $audit_record->getId() ?>"
                                   href="javascript:void(0)"><?php echo __('ver producto'); ?></a>
                            </div>

                            <?php if ($audit_record->getconcursoDestacado()->getId()) : ?>
                            </a>
                        <?php endif ?>

                        </div>    
                        <div class="hidden a-list" id="audit-list-<?php echo $audit_record->getId() ?>"></div>