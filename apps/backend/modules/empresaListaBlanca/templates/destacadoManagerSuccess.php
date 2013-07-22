<?php use_helper('utilAdmin'); ?>
<?php use_stylesheet('ui-lightness/jquery-ui-1.8.18.custom.css'); ?>
<div id="sf_admin_container">
    <div id="sf_admin_content">
        <?php if ($sf_user->hasFlash('msg')) : ?>
            <div class='error'>
                <?php echo $sf_user->getFlash('msg'); ?>
            </div>
        <?php endif ?>

        <div class="sf_admin_list">
            <h2>Gestión de los destacados</h2>

            <h3 style="font-weight: normal;">Empresa/Entidad: <b><?php echo $empresa ?></b></h3>
            <ul class='destacados'>

                <li>   <?php echo print_boolean_ok($empresa->isDestacadaPorSector()) ?>
                    <span class='title'>Destacada por actividad - <b><?php echo $empresa->getTresSector() ?></b></span>
                    <span class='action_destacado'>

                        <a
                            class='alternar-destacado <?php echo $empresa->isDestacadaPorSector() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 empresas/entidades por actividad.'
                            href="<?php echo url_for('empresa_alternar_destacado', array('id' => $empresa->getId(), 'tipo' => 'sector')) ?>"><?php echo $empresa->isDestacadaPorSector() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable'
                        id='destacado_<?php echo $empresa->hasActividad() ? 'empresa_sector_tres' : 'empresa_sector_dos' ?>_<?php echo $empresa->getSectorId() ?>'>
                            <?php foreach ($empresa->getDestacadosPorSector() as $destacado) : ?>
                            <li id='empresa_<?php echo $destacado->getEmpresa()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getEmpresa() ?>
                                <!--span class='edit_action'><a
                                        href='<?php echo url_for('empresa_show_destacados', array('id' => $destacado->getEmpresa()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>

                </li>
                <li><?php echo print_boolean_ok($empresa->isDestacadaPorProvincia()) ?>
                    <span class='title'>Destacada por provincia - <b><?php echo $empresa->getStates() ?></b></span>
                    <span class='action_destacado'>

                        <a
                            class='alternar-destacado <?php echo $empresa->isDestacadaPorProvincia() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 empresas/entidades por provincia.'
                            href="<?php echo url_for('empresa_alternar_destacado', array('id' => $empresa->getId(), 'tipo' => 'provincia')) ?>"><?php echo $empresa->isDestacadaPorProvincia() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_states_<?php echo $empresa->getStatesId() ?>'>
                        <?php foreach ($empresa->getDestacadosPorProvincia() as $destacado) : ?>
                            <li id='empresa_<?php echo $destacado->getEmpresa()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getEmpresa() ?>
                                <!--span class='edit_action'><a
                                        href='<?php echo url_for('empresa_show_destacados', array('id' => $destacado->getEmpresa()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li><?php echo print_boolean_ok($empresa->isDestacadaPorLocalidad()) ?>
                    <span class='title'>Destacada por localidad - <b><?php echo $empresa->getLocalidad() ?></b></span>
                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $empresa->isDestacadaPorLocalidad() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 empresas/entidades por localidad.'

                            href="<?php echo url_for('empresa_alternar_destacado', array('id' => $empresa->getId(), 'tipo' => 'localidad')) ?>"><?php echo $empresa->isDestacadaPorLocalidad() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_localidad_<?php echo $empresa->getLocalidadId() ?>'>
                        <?php foreach ($empresa->getDestacadosPorLocalidad() as $destacado) : ?>
                            <li id='empresa_<?php echo $destacado->getEmpresa()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getEmpresa() ?>
                                <!--span class='edit_action'><a
                                        href='<?php echo url_for('empresa_show_destacados', array('id' => $destacado->getEmpresa()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

                <li><?php echo print_boolean_ok($empresa->isDestacadaPorSectorProvincia()) ?>
                    <span class='title'>Destacada por actividad y provincia
                        - <b><?php echo $empresa->getTresSector() . ' en ' . $empresa->getStates() ?></b></span>
                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $empresa->isDestacadaPorSectorProvincia() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 empresas/entidades por actividad y provincia.'

                            href="<?php echo url_for('empresa_alternar_destacado', array('id' => $empresa->getId(), 'tipo' => 'sector_provincia')) ?>"><?php echo $empresa->isDestacadaPorSectorProvincia() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_combinadoProvincia_<?php echo $empresa->getId() ?>'>
                        <?php foreach ($empresa->getDestacadosPorSectorAndProvincia() as $destacado) : ?>
                            <li id='empresa_<?php echo $destacado->getEmpresa()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getEmpresa() ?>
                                <!--span class='edit_action'><a

                                        href='<?php echo url_for('empresa_show_destacados', array('id' => $destacado->getEmpresa()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

                <li><?php echo print_boolean_ok($empresa->isDestacadaPorSectorLocalidad()) ?>
                    <span class='title'>Destacada por actividad y localidad
                        - <b><?php echo $empresa->getTresSector() . ' en ' . $empresa->getLocalidad() ?></b></span>

                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $empresa->isDestacadaPorSectorLocalidad() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 empresas/entidades por actividad y localidad.'

                            href="<?php echo url_for('empresa_alternar_destacado', array('id' => $empresa->getId(), 'tipo' => 'sector_localidad')) ?>"><?php echo $empresa->isDestacadaPorSectorLocalidad() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_combinadoLocalidad_<?php echo $empresa->getId() ?>'>
                        <?php foreach ($empresa->getDestacadosPorSectorAndLocalidad() as $destacado) : ?>
                            <li id='empresa_<?php echo $destacado->getEmpresa()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getEmpresa() ?><span class='edit_action'><a
                                        href='<?php echo url_for('empresa_show_destacados', array('id' => $destacado->getEmpresa()->getId())) ?>'>Editar</a></span>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

            </ul>
        </div>
        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver a empresas', 'empresa_lista_blanca') ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'empresa_lista_blanca_edit', array('id' => $empresa->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>

<style type="text/css">
    ul.destacados > li {
        width: 100%;
    }
    ul.destacados > li img {
        float: left;
    }
    ul.destacados > li .title {
        width: 90%;
        display: block;
        margin: 3px 0 0 30px; 
    }
    ul.destacados > li ul li.ui-state-default {
        word-wrap: break-word;
        padding-left: 30px !important;
    }
    ul.destacados > li ul li span.nb_order {
        margin-left: -27px !important;
    }
</style>
<script type='text/javascript'>
    function setNumbers(list) {
        nbTag = '<span class="nb_order"/>';
        $.each($(list).find('li'), function(i, el) {
            $(el).find('.nb_order').remove();
            $(el).prepend( $(nbTag).html(i + 1));
        });
    }


    $(function () {
        $(".sortable").sortable({
            placeholder:"ui-state-highlight",
            create: function(event, ui) {
                setNumbers(this);
            },
            update:function (event, ui) {
                var order = $(this).sortable('toArray');
                $.get('<?php echo url_for('empresa_destacada_sort') ?>', { elements:order, type:this.id }, function (data) {
                    setNumbers(ui.item.closest('ul'));
                })
            }
        });

        $("#sortable").disableSelection();


        $('a.alternar-destacado').click(function () {
            if ($(this).html() == 'Destacar') {
                items = $(this).closest('li').find('ul:first').find('li');
                if (items.length >= 5) {
                    alert($(this).attr('data-error'));
                    return false;

                }
            }


        });
    });


</script>

