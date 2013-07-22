<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="content_vosotros">

    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Ranking de colaboradores', 'tituloSeccion' => 'Ranking de colaboradores')) ?>

    <div class="box"><h1><?php echo __('Ranking de colaboradores') ?></h1></div>
    <div class="block width100">
        <div class="block ">
            <span class="left-text heading "><?php echo __('Somos') ?></span><span class="left-text verde heading">&nbsp;<?php echo count($total_contributors) ?>&nbsp;</span><span class="left-text heading"> <?php echo __('colaboradores en la Comunidad') ?></span>
        </div>
        <?php if ($sf_user->getGuardUser()): ?>
            <div class="block width50 right-text" >
                <span class="heading blue bold"><?php echo __('Tú') ?></span>
                <span class="heading"><?php echo __(' estás en la posición ') ?></span><span class="verde"><?php echo $contributor_position; ?></span>
            </div>
            <span class="block left-right heading"><?php echo __('Tienes ') . $sf_user->getMoneyInFormat($points) . __(' puntos acumulados'); ?></span>
        <?php endif; ?>


    </div>

    <div class="buscador">

        <span class="buscar-concurso"><?php echo __('BUSCAR COLABORADORES POR JERARQUíA') ?></span>
        <a id='top' name='top'></a>

        <div class="buscador-top"></div>

        <div class="buscador-wrapper hierarch">

            <div class="content-top"></div>
            <div class="content-middle">
                <form class="form_login" method="GET">

                    <div class="basico">

                        <div class="columna">
                            <label class=""><?php echo __('Usuario/Alias') ?></label>
                            <?php echo $hierarchy_ranking_form['user']->render(array('class' => 'tamano_32_c ac_input')) ?>
                        </div>
                        <div class="columna">
                            <label class=""><?php echo __('Jerarquía') ?></label>
                            <?php echo $hierarchy_ranking_form['hierarchy']->render() ?>
                        </div>
                        <input type="hidden" val="1" name="page" id="page-index"/>
                        <div class="botonera">
                            <a class="resetForm" href="javascript:void(0)" title="Nueva búsqueda de colaboradores en el ranking"><?php print __('nueva búqueda') ?></a>
                            <input class='btn' type="button" value="Buscar" id="submit_cmd" title="Buscar colaboradores en el ranking">
                        </div>
                </form>
            </div>

        </div>
        <div class="buscador-bottom"></div>
    </div>
</div>


<div id="ranking-container">
    <?php
    include_partial('heirarchy_ranking', array('hierarchy_ranking_pager' => $hierarchy_ranking_pager,
        'user' => (isset($user) ? $user : null),
        'hierarchy_list' => $hierarchy_list,
        'uri' => $uri,
        'page_value' => $page));
    ?>

</div>

<!-- el lightbox para avisar al usuario - concurso-->
<div style="display: none">
    <div id="caja_dialog_box">
        <div class="border-box">
            <div class="top-left">
                <div class="top-right">
                    <?php if ($error) { ?>
                        <p><?php echo html_entity_decode($error); ?></p>
                    <?php } else { ?>
                        <p>Tienes en tu caja la cantidad de <b><?php echo $money; ?>€</b>.<br>
                            ¿Estás seguro de que quieres hacer caja en este momento? Una vez aceptada, esta
                            acción no podrá deshacerse.<br><br>
                            <a href="#" id="caja">acepta</a> | <a href="javascript:void(0)" onclick="$.fancybox.close()">cancela</a></p>
                    <?php } ?>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
    </div>
</div>
<!-- user confirmation caja message -->
<div class="hidden" id="user_caja_messagebox">
    <div class="border-box">
        <div class="top-left">
            <div class="top-right" id="user_message_content">
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#user_caja_messagebox" class="hidden" id="user_message_ancor">message box</a>
</div>
<a href="#" class="hidden" id="cnt-mover">message box</a>
<script type="text/javascript">
                                $('document').ready(function() {
                                    $("#submit_cmd").bind('click', function() {
                                        $('#page-index').val(1);
                                        $('html, body').animate({scrollTop: $('#content_vosotros').position().top}, 'fast');
                                        showRewardRanking("<?php echo url_for('hierarchy_ranking'); ?>");
                                    });

                                    $("#caja_box").fancybox({padding: 25});
                                    $("#user_message_ancor").fancybox({padding: 25});

                                    //end caja accept event
                                    $('#hierarchy_ranking_user').unbind('keypress').bind('keypress', function(e) {
                                        if (e.keyCode == 13)
                                        {
                                            $('#page-index').val(1);
                                            $('html, body').animate({scrollTop: $('#content_vosotros').position().top}, 'fast');
                                            showRewardRanking("<?php echo url_for('hierarchy_ranking'); ?>");
                                            return false;
                                        }
                                    });


                                    $('#cnt-mover').bind('click', function() {
                                        var location = window.location + '';
                                        if ((location.split("#").length - 1) < 1) {
                                            window.location = window.location + $('#cnt-mover').attr('href');
                                        }

                                    });
                                    if (<?php echo $box_value ? '1' : '0' ?>) {

                                        $('#cnt-mover').attr('href', '#<?php echo $box_value ?>');
                                        $('#<?php echo $box_value ?>').find('.cr-content').css('background-color', 'yellow');
                                        $('#cnt-mover').trigger('click');

                                    }
                                });
                                function showUserMessageBox(message) {
                                    $.fancybox.close();
                                    $("#user_message_content").html(message);
                                    $("#user_message_ancor").trigger('click');
                                }
</script>

