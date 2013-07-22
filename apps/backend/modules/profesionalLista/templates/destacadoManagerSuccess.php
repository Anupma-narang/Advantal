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
            <h2>Gestión de destacados</h2>
            <h3 style="font-weight: normal;">Profesional: <strong><?php echo $profesional->getLastNameOne() . ' ' . $profesional->getLastNameTwo() . ' ' . $profesional->getFirstName(); ?></strong></h3>

            <ul class='destacados'>

                <li>   <?php echo print_boolean_ok($profesional->isDestacadaPorSector()) ?>
                    <span class='title'>Destacado por actividad - <strong><?php echo $profesional->getTipo() ?></strong></span>
                    <span class='action_destacado'>

                        <a
                            class='alternar-destacado <?php echo $profesional->isDestacadaPorSector() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Sólo puedes destacar hasta 5 profesionales por actividad.'
                            href="<?php echo url_for('profesional_alternar_destacado', array('id' => $profesional->getId(), 'tipo' => 'sector')) ?>"><?php echo $profesional->isDestacadaPorSector() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_<?php echo $profesional->hasActividad() ? 'profesional_tipo_tres' : 'profesional_tipo_dos' ?>_<?php echo $profesional->getTipoId() ?>'>
                            <?php foreach ($profesional->getDestacadosPorSector() as $destacado) : ?>
                            <li id='profesional_<?php echo $destacado->getProfesional()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getProfesional()->getLastNameOne() . ' ' . $destacado->getProfesional()->getLastNameTwo() . ' ' . $destacado->getProfesional()->getFirstName() ?>
                                <!--span class='edit_action'><a
                                        href='<?php echo url_for('profesional_show_destacados', array('id' => $destacado->getProfesional()->getId())) ?>'>Editar</a>
                                </span-->
                            </li>
                        <?php endforeach ?>
                    </ul>

                </li>
                <li><?php echo print_boolean_ok($profesional->isDestacadaPorProvincia()) ?>
                    <span class='title'>Destacado por provincia - <strong><?php echo $profesional->getStates() ?></strong></span>
                    <span class='action_destacado'>

                        <a
                            class='alternar-destacado <?php echo $profesional->isDestacadaPorProvincia() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Sólo puedes destacar hasta 5 profesionales por provincia.'
                            href="<?php echo url_for('profesional_alternar_destacado', array('id' => $profesional->getId(), 'tipo' => 'provincia')) ?>"><?php echo $profesional->isDestacadaPorProvincia() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_states_<?php echo $profesional->getStatesId() ?>'>
                        <?php foreach ($profesional->getDestacadosPorProvincia() as $destacado) : ?>
                            <li id='profesional_<?php echo $destacado->getProfesional()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getProfesional()->getLastNameOne() . ' ' . $destacado->getProfesional()->getLastNameTwo() . ' ' . $destacado->getProfesional()->getFirstName() ?>
                                <?php
                                /*<span class='edit_action'><a
                                        href='<?php echo url_for('profesional_show_destacados', array('id' => $destacado->getProfesional()->getId())) ?>'>Editar</a>
                                </span> */
                                ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li><?php echo print_boolean_ok($profesional->isDestacadaPorLocalidad()) ?>
                    <span class='title'>Destacado por localidad - <strong><?php echo $profesional->getCity() ?></strong></span>
                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $profesional->isDestacadaPorLocalidad() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Sólo puedes destacar hasta 5 profesionales por localidad.'

                            href="<?php echo url_for('profesional_alternar_destacado', array('id' => $profesional->getId(), 'tipo' => 'localidad')) ?>"><?php echo $profesional->isDestacadaPorLocalidad() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_city_<?php echo $profesional->getCityId() ?>'>
                        <?php foreach ($profesional->getDestacadosPorLocalidad() as $destacado) : ?>
                            <li id='profesional_<?php echo $destacado->getProfesional()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getProfesional()->getLastNameOne() . ' ' . $destacado->getProfesional()->getLastNameTwo() . ' ' . $destacado->getProfesional()->getFirstName() ?>
                                <!--span class='edit_action'><a
                                        href='<?php echo url_for('profesional_show_destacados', array('id' => $destacado->getProfesional()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

                <li><?php echo print_boolean_ok($profesional->isDestacadaPorSectorProvincia()) ?>
                    <span class='title'>Destacado por actividad y provincia
                        - <strong><?php echo $profesional->getTipo() . ' en ' . $profesional->getStates() ?></strong></span>
                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $profesional->isDestacadaPorSectorProvincia() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Sólo puedes destacar hasta 5 profesionales por actividad y provincia.'

                            href="<?php echo url_for('profesional_alternar_destacado', array('id' => $profesional->getId(), 'tipo' => 'sector_provincia')) ?>"><?php echo $profesional->isDestacadaPorSectorProvincia() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_combinadoProvincia_<?php echo $profesional->getId() ?>'>
                        <?php foreach ($profesional->getDestacadosPorSectorAndProvincia() as $destacado) : ?>
                            <li id='profesional_<?php echo $destacado->getProfesional()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getProfesional()->getLastNameOne() . ' ' . $destacado->getProfesional()->getLastNameTwo() . ' ' . $destacado->getProfesional()->getFirstName() ?>
                                <!--span class='edit_action'><a href='<?php echo url_for('profesional_show_destacados', array('id' => $destacado->getProfesional()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

                <li><?php echo print_boolean_ok($profesional->isDestacadaPorSectorLocalidad()) ?>
                    <span class='title'>Destacado por actividad y localidad
                        - <strong><?php echo $profesional->getTipo() . ' en ' . $profesional->getCity() ?></strong></span>

                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $profesional->isDestacadaPorSectorLocalidad() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Sólo puedes destacar hasta 5 profesionales por actividad y localidad.'

                            href="<?php echo url_for('profesional_alternar_destacado', array('id' => $profesional->getId(), 'tipo' => 'sector_localidad')) ?>"><?php echo $profesional->isDestacadaPorSectorLocalidad() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_combinadoLocalidad_<?php echo $profesional->getId() ?>'>
                        <?php foreach ($profesional->getDestacadosPorSectorAndLocalidad() as $destacado) : ?>
                            <li id='profesional_<?php echo $destacado->getProfesional()->getId() ?>'
                                class='ui-state-default'><?php echo $destacado->getProfesional()->getLastNameOne() . ' ' . $destacado->getProfesional()->getLastNameTwo() . ' ' . $destacado->getProfesional()->getFirstName() ?>
                                <!--span class='edit_action'><a
                                        href='<?php echo url_for('profesional_show_destacados', array('id' => $destacado->getProfesional()->getId())) ?>'>Editar</a></span-->
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

            </ul>
        </div>
        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver a profesionales', 'profesional_lista') ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'profesional_lista_edit', array('id' => $profesional->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
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
                $.get('<?php echo url_for('profesional_destacada_sort') ?>', { elements:order, type:this.id }, function (data) {
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

