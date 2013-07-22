<?php use_helper('Date', 'Text', 'Concursos', 'mihelper') ?>
<?php
if (!isset($tipo))
    $tipo = 'index';
?>

<div id="content_concurso_activo">
    <div id="show_detalle_concurso_top">
        <div id="title_concurso">
            <?php if ($sf_params->get('action') == 'show' || $sf_params->get('action') == 'urlaliasshow'): ?>
                <?php print truncate_text($concurso->name, $length = 50) ?>
            <?php else: ?>
                <?php print link_to(truncate_text($concurso->name, $length = 50), url_for_concurso($concurso)) ?>
            <?php endif ?>
        </div>
        <?php if (sfContext::getInstance()->getRequest()->getParameter('tipo') != 'producto'): ?>
            <span class="rss" title="Añade concursos de ideas de Empresa y Entidad a RSS"></span>
        <?php else: ?>
            <span class="rss" title="Añade concursos de ideas de Producto a RSS"></span>
        <?php endif; ?>
        <div id="alin_der_img">
            <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/" . $concurso->ConcursoCategoria->image) ?>
        </div>
        <div id="fecha">
            <?php echo format_datetime($concurso->created_at, "p", "es_ES") ?>
        </div>
    </div>

    <div id="show_detalle_concurso_middle">
        <div id="box_left">
            <div id="categoria_concurso" class="label">
                <?php echo $concurso->ConcursoCategoria->name ?>
            </div>
            <?php if ($concurso->getConcursoTipoId() == 1): ?>
                <div id="empresa" class="label">
                    <?php echo ($concurso->getEmpresa()) ? $concurso->getEmpresa()->getName() : '' ?>
                </div>
                <div id="direccion" class="label">
                    <?php echo $concurso->getRoadType()->getName() ?>
                    &nbsp;
                    <?php echo $concurso->getConcursoAddress() ?><?php
                if ($concurso->getConcursoNumero() != '')
                    echo ', ' . $concurso->getConcursoNumero()
                        ?>
                </div>

                <?php if ($sf_params->get('module') == 'concurso' && ($sf_params->get('action') == 'show' || $sf_params->get('action') == 'urlaliasshow') && ($concurso->getConcursoPiso() != '' || $concurso->getConcursoPuerta() != '')): ?>
                    <div id="mas_direccion" class="label">
                        <?php
                        if ($concurso->getConcursoPiso())
                            echo 'Piso: ' . $concurso->getConcursoPiso();
                        ?>
                        &nbsp;
                        <?php
                        if ($concurso->getConcursoPuerta())
                            echo 'Puerta: ' . $concurso->getConcursoPuerta()
                            ?>
                    </div>
                <?php endif; ?>

                <div id="localidad" class="label">
                    <?php echo $concurso->getCityandState() ?>
                </div>
                <div id="empresa_actividad" class="label">
                    <?php
                    if ($concurso->getEmpresa() && !$concurso->getEmpresa()->getEmpresaSectorTresId())
                        echo $concurso->getEmpresa()->getEmpresaSectorDos();
                    elseif ($concurso->getEmpresa() && $concurso->getEmpresa()->getEmpresaSectorTres())
                        echo $concurso->getEmpresa()->getEmpresaSectorTres();
                    ?>
                </div>
            <?php elseif ($concurso->getConcursoTipoId() == 2): ?>
                <div id="producto_nombre" class="label">
                    <?php echo ($concurso->getProducto()) ? $concurso->getProducto()->getName() : '' ?>
                </div>
                <div id="producto_marca" class="label">
                    <?php echo ($concurso->getProducto()) ? $concurso->getProducto()->getMarca() : '' ?>
                </div>
                <div id="producto_modelo" class="label">
                    <?php echo ($concurso->getProducto()) ? $concurso->getProducto()->getModelo() : '' ?>
                </div>
                <div id="producto_tipo" class="label">
                    <?php
                    if ($concurso->getProducto() && $concurso->getProducto()->getProductoTipoTres() && !$concurso->getProducto()->getProductoTipoTres()->getName())
                        echo $concurso->getProducto()->getProductoTipoDos()->getName();
                    elseif ($concurso->getProducto() && $concurso->getProducto()->getProductoTipoTres())
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
                    <?php //echo $concurso->Empresa->name    ?>
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
                    <div id="box_cen_dos_d">
                        <?php $text = format_number_choice('[0]0 contribuciones|[1]1 contribución|(1,+Inf]%count% contribuciones', array('%count%' => $n_contribuciones), $n_contribuciones) ?>
                        <?php print ($sf_params->get('module') == 'concurso' and $sf_params->get('action') == 'show') ? $text : link_to($text, url_for_concurso($concurso), array('title' => 'Ver contribuciones del concurso')); ?>
                    </div>
                    <?php if ($sf_user->isAuthenticated()): ?>
                        <?php
                        $n_mis_contribuciones = Doctrine::getTable('contribucion')
                                ->createQuery()
                                ->where('concurso_id=?', $concurso->getId())
                                ->andWhere('user_id=?', $sf_user->getGuardUser()->getId())
                                ->andWhere('contribucion_estado_id=?', 2)
                                ->andWhere('principal = false')
                                ->count();
                        ?>
                        <div id="box_cen_dos_e">
                            <?php //if($n_mis_contribuciones>0) $n_mis_contribuciones--    ?>
                            <?php echo format_number_choice('[0]Tú has contribuido 0 veces|[1]Tú has contribuido 1 vez|(1,+Inf]Tú has contribuido %count% veces', array('%count%' => $n_mis_contribuciones), $n_mis_contribuciones) ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div><a href="javascript:void(0)" data-id="<?php echo $concurso->getId() ?>" class="favourit" title="Añade un concurso a Favoritos">añadir a favoritos</a></div>
            </div>
        </div>

        <div id="box_botoon">
            <?php if ($tipo == 'show'): ?>
                <div id="Expand_collapse" title="<?php echo __('ver +') ?>"></div>
                <br />
            <?php endif; ?>
            Descripción de la incidencia:<br />
            <?php print html_truncate(530, html_entity_decode($concurso->getIncidencia()), link_to(__('ver +'), url_for_concurso_incidencia($concurso), array('title' => ($tipo == 'index') ? 'Ver concurso de ideas' : 'Ver detalle del concurso destacado', 'popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0')))) ?>
        </div>

        <?php if ($tipo == 'index'): ?>
            <div id="alin_boton"><span class="align_ver_detalle"><?php print link_to_concurso($concurso); ?></span></div>
        <?php elseif ($tipo == 'show'): ?>
            <?php if ($contribution_id == null): ?>
                <?php print link_to_contribuye($concurso) ?>
                <?php include_partial('concurso/contribucion', array('contribucion' => $concurso->getContribucionPrincipal(), 'destacada' => true, 'page' => $page)) ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div id="show_detalle_concurso_bot"></div>
</div>

<?php if ($tipo == 'show'): ?>
    <script>
        $(document).ready(function() {
            var expand=false;
            $('#Expand_collapse').click(function(){
                if(!expand){
                    $('#box_botoon').css('height','auto');
                    $('#box_botoon').css('min-height', '90px');

                    $(this).css('background-position', '-19px 0');
                    expand=true;
                }
                else{
                    $('#box_botoon').css('height','110px');
                    $(this).css('background-position', '0 0');
                    expand=false;
                };
            });
        });
    </script>
<?php endif; ?>
