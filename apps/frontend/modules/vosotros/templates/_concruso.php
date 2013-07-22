<?php use_helper('Date', 'Text', 'Concursos', 'mihelper') ?>
<?php if (!isset($tipo)) $tipo = 'index'; ?>
<?php
$highlight_array = array(1 => 'Este concurso está destacado',
    2 => 'Este es el concurso de la semana',
    3 => 'Este es el concurso del mes',
    4 => 'Este es el concurso del año',);
?>

<?php
$highlight_color = array(1 => 'bg-highlight1',
    2 => 'bg-highlight2',
    3 => 'bg-highlight3',
    4 => 'bg-highlight4',);
?>
<div id="content_concurso_activo">
    <div id="show_detalle_concurso_top">
        <div id="title_concurso">
            <?php if ($sf_params->get('action') == 'show' || $sf_params->get('action') == 'urlaliasshow'): ?>
                <?php echo truncate_text($concurso->name, $length = 50) ?>
            <?php else: ?>
                <?php echo link_to(truncate_text($concurso->name, $length = 50), url_for_concurso($concurso)) ?>
            <?php endif ?>
        </div>
        <div id="alin_der_img">
            <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/" . $concurso->ConcursoCategoria->image) ?>
        </div>
        <div id="fecha">
            <?php echo format_datetime($concurso->created_at, "p", "es_ES") ?>
            &nbsp;

        </div>
        <?php if ($concurso->getFeatured()): ?>
            <span class="hightlight <?php echo $highlight_color[$concurso->getFeatured()] ?>">
                <?php echo $highlight_array[$concurso->getFeatured()] ?>
            </span>
        <?php endif; ?>
    </div>

    <div id="show_detalle_concurso_middle">
        <div id="box_left">
            <div id="categoria_concurso" class="label">
                <?php echo $concurso->ConcursoCategoria->name ?>
            </div>
            <?php if ($concurso->getConcursoTipoId() == 1): ?>
                <div id="empresa" class="label">
                    <?php echo $concurso->getEmpresa()->getName() ?>
                </div>
                <div id="direccion" class="label">
                    <?php echo $concurso->getRoadType()->getName() ?>
                    &nbsp;
                    <?php echo $concurso->getConcursoAddress() ?><?php if ($concurso->getConcursoNumero() != '') echo ', ' . $concurso->getConcursoNumero() ?>
                </div>

                <?php if ($sf_params->get('module') == 'concurso' && ($sf_params->get('action') == 'show' || $sf_params->get('action') == 'urlaliasshow') && ($concurso->getConcursoPiso() != '' || $concurso->getConcursoPuerta() != '')): ?>
                    <div id="mas_direccion" class="label">
                        <?php if ($concurso->getConcursoPiso()) echo 'Piso: ' . $concurso->getConcursoPiso(); ?>
                        &nbsp;
                        <?php if ($concurso->getConcursoPuerta()) echo 'Puerta: ' . $concurso->getConcursoPuerta() ?>
                    </div>
                <?php endif; ?>

                <div id="localidad" class="label">
                    <?php echo $concurso->getCityandState() ?>
                </div>
                <div id="empresa_actividad" class="label">
                    <?php
                    if (!$concurso->getEmpresa()->getEmpresaSectorTresId())
                        echo $concurso->getEmpresa()->getEmpresaSectorDos();
                    else
                        echo $concurso->getEmpresa()->getEmpresaSectorTres();
                    ?>
                </div>
            <?php elseif ($concurso->getConcursoTipoId() == 2): ?>
                <div id="producto_nombre" class="label">
                    <?php echo $concurso->getProducto()->getName() ?>
                </div>
                <div id="producto_marca" class="label">
                    <?php echo $concurso->getProducto()->getMarca() ?>
                </div>
                <div id="producto_modelo" class="label">
                    <?php echo $concurso->getProducto()->getModelo() ?>
                </div>
                <div id="producto_tipo" class="label">
                    <?php
                    if (!$concurso->getProducto()->getProductoTipoTres()->getName())
                        echo $concurso->getProducto()->getProductoTipoDos()->getName();
                    else
                        echo $concurso->getProducto()->getProductoTipoTres()->getName()
                        ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="box_cen">
            <div id="box_cen_uno"></div>
            <div id="box_cen_dos">
                <!--            Falta la relacion la tabla empresa				-->
                <div id="box_cen_dos_a">
                    <?php //echo $concurso->Empresa->name      ?>
                </div>
                <div id="box_cen_dos_b">
                    <?php
                    if (($sf_user->isAuthenticated()) && ($concurso->getUserId() == $sf_user->getGuardUser()->getId()))
                        echo __('Creado por ti');
                    else
                        echo __('Creado por: %%username%%', array('%%username%%' => $concurso->getUser()->getUserName()));
                    ?>
                </div>
                <div id="box_cen_dos_c">
                    <?php echo $concurso->getConcursoEstado()->getName() ?>
                </div>
                <?php ((count($concurso->getContribucionesActivas()) - 1) < 0 ? $n_contribuciones = 0 : $n_contribuciones = count($concurso->getContribucionesActivas()) - 1) ?>
                <?php if ($concurso->getConcursoEstadoId() != 1): ?>

                    <?php include_component('contribucion', 'contributionCount', array('concurso' => $concurso, 'contribution_status_array' => $option['contribution_status_array'])); ?>

                <?php endif; ?>
            </div>
        </div>

        <div id="box_botoon">
            <?php if ($tipo == 'show'): ?>
                <div id="Expand_collapse" title="<?php echo __('ver +') ?>"></div>
                <br />
            <?php endif; ?>
            Descripción de la incidencia:<br />
            <?php echo html_truncate(530, html_entity_decode($concurso->getIncidencia()), link_to(__('ver +'), url_for_concurso_incidencia($concurso), array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0')))) ?>
        </div>


        <?php if (isset($option['contribtion_flag'])): ?>
            <div id="alin_boton"><span class="align_ver_detalle cn-cmd" data-id="<?php echo $concurso->getId() ?>">contribuye</span></div>
            <div id="contribution-<?php echo $concurso->getId() ?>" class="hidden cn-box">
                <?php include_component('contribucion', 'list', array('concurso' => $concurso, 'contribution_status_array' => $option['contribution_status_array'])) ?>
            </div>
        <?php else: ?>
            <?php if ($tipo == 'index'): ?>
                <?php if (isset($from)): ?>
                    <div id="alin_boton"><span class="align_ver_detalle"><?php echo link_to_concurso($concurso, $from); ?></span></div>
                <?php elseif (isset($contest_type)): ?>
                    <div id="alin_boton"><span class="align_ver_detalle"><?php echo link_to_concurso($concurso, $contest_type . '_' . $type . '_' . $list); ?></span></div>
                <?php elseif (isset($is_referendum)): ?>
                    <div id="alin_boton"><span class="align_ver_detalle"><?php echo link_to_concurso($concurso, 'my_referendum' . '_' . $type . '_' . $list); ?></span></div>
                <?php elseif (!isset($concurso['contribution_id'])): ?>
                    <div id="alin_boton"><span class="align_ver_detalle"><?php echo link_to('Ver concurso', url_for('contest_edit', array('id' => $concurso->getId(), 'from' => 'contest-draft'))); ?></span></div>
                <?php else: ?>
                    <div id="alin_boton"><span class="align_ver_detalle"><?php echo link_to('Ver contribuciones ', url_for('contribution_edit', array('concurso_id' => $concurso->getId(), 'from' => 'contribution-draft', 'id' => $concurso->getContributionId()))); ?></span></div>
                <?php endif; ?>
            <?php elseif ($tipo == 'show'): ?>
                <?php echo link_to_contribuye($concurso) ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div id="show_detalle_concurso_bot"></div>
</div>

<?php if ($tipo == 'show'): ?>
    <script>
        $(document).ready(function() {
            var expand = false;
            $('#Expand_collapse').click(function() {
                if (!expand) {
                    $('#box_botoon').css('height', 'auto');
                    $('#box_botoon').css('min-height', '90px');

                    $(this).css('background-position', '-19px 0');
                    expand = true;
                }
                else {
                    $('#box_botoon').css('height', '110px');
                    $(this).css('background-position', '0 0');
                    expand = false;
                }
                ;
            });
        });
    </script>
<?php endif; ?>
