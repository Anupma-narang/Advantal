<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="content_vosotros">
    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Ranking de recompensas', 'tituloSeccion' => 'Ranking de recompensas')) ?>

    <div class="box"><h1><?php echo __('Ranking de recompensas') ?></h1></div>
    <div class="block width100">
        <div class="block ">
            <span class="left-text heading "><?php echo __('Somos') ?></span><span class="left-text verde heading"> &nbsp;<?php echo count($total_contributors) ?>&nbsp;</span><span class="left-text heading"><?php echo __('colaboradores en el ranking') ?></span>
        </div>
        <?php if ($sf_user->getGuardUser() && $contributor_position): ?>
            <div class="block width50 right-text" >
                <span class="heading blue bold"><?php echo __('Tú') ?></span>
                <span class="heading"><?php echo __(' estás en la posición ') ?></span><span class="verde"><?php echo $contributor_position; ?></span>
            </div>

            <span class="block left-right heading"><?php echo __('Tienes una caja de'); ?></span>
            <span class="red block heading"><?php echo $sf_user->getMoneyInFormat($money) . ' €' ?></span>
            <a href="#caja_dialog_box" id="caja_box" class="block">
                <input type="button" value="<?php echo __('hacer caja') ?>" title="Hacer caja"/>
            </a>
        <?php endif; ?>


    </div>



    <div class="buscador">

        <span class="buscar-concurso"><?php echo __('BUSCAR COLABORADORES POR RECOMPENSA') ?></span>
        <a id='top' name='top'></a>

        <div class="buscador-top"></div>

        <div class="buscador-wrapper">

            <div class="content-top"></div>
            <div class="content-middle">
                <form class="form_login" method="GET">

                    <div class="basico">

                        <div class="columna">
                            <label class=""><?php echo __('Usuario/Alias') ?></label>
                            <?php echo $reward_ranking_form['user']->render(array('class' => 'tamano_32_c ac_input')) ?>
                        </div>
                        <div class="columna">
                            <label class=""><?php echo __('Caja acumulada') ?></label>
                            <?php echo $reward_ranking_form['rank']->render() ?>
                        </div>
                        <input type="hidden" val="1" name="page" id="page-index"/>
                        <div class="botonera">
                            <a class="resetForm" href="javascript:void(0)" title="Nueva búsqueda de colaboradores en el ranking de recompensas"><?php print __('nueva búqueda') ?></a>
                            <input class='btn' type="button" value="Buscar" id="submit_cmd" title="Buscar colaboradores en el ranking de recompensas">
                        </div>
                </form>
            </div>
            <div class="content-bottom"></div>
        </div>
        <div class="buscador-bottom"></div>
    </div>
</div>
<div id="ranking-container" class="buscador">
    <?php
    include_partial('reward_ranking', array('reward_ranking_pager' => $reward_ranking_pager,
        'user' => isset($user) ? $user : null,
        'page_value' => $page,
        'uri' => $uri));
    ?>
</div>

<!-- el lightbox para avisar al usuario - concurso-->
<div style="display: none">
    <div id="caja_dialog_box">
        <div class="border-box-n ">
            <div class="header-left"><div class="header-right"></div></div>
            <div class="top-left">
                <div class="top-right">
                    <?php if ($error || $caja_error): ?>
                        <?php if ($error): ?>
                            <p>Has intentado hacer caja <strong>sin tener la cantidad mínima necesaria</strong>. </p>
                            <p>Para hacer caja <strong>necesitas tener al menos 30 €</strong> en tu cuenta.</p>
                            <p>Muchas gracias por tu comprensión.</p>
                        <?php else: ?>

                            <p>
                                Has solicitado hacer caja <strong>sin indicar correctamente un método de cobro</strong> de recompensas.
                            </p>
                            <p>
                                Por favor, indica un método de cobro de recompensas válido en <?php echo link_to("Mi cuenta ", "/vostros/micuenta", array('title' => 'Mi cuenta')) ?> – <strong>Método de cobro de recompensas.</strong>
                            </p>
                            <p>
                                Gracias por tu colaboración.
                            </p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>
                            Has solicitado <strong>hacer caja correctamente</strong>.
                        </p>
                        <p>
                            Tienes en tu caja la cantidad de <b><?php echo $sf_user->getMoneyInFormat($money); ?> €</b>.
                        </p>
                        <p>
                            ¿Estás seguro de que quieres hacer caja en este momento?
                        </p>
                        <p>Una vez aceptada, esta acción no podrá deshacerse.</p>
                        <p class="align-right">
                            <a href="#" id="caja" title="acepta">acepta</a> | <a href="javascript:void(0)" onclick="$.fancybox.close()" title="cancela">cancela</a>
                        </p>
                    <?php endif; ?>
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
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
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

<div id="is_caja" class="hidden">
    <p>Has <strong>hecho caja</strong> correctamente.</p>
    <p>En breve recibirás la cantidad de <strong><?php echo $sf_user->getMoneyInFormat($caja_amount) ?> €</strong> en tu cuenta.</p>
    <p>¡Disfruta de tu recompensa!</p>
</div>

</div>
<a href="#" class="hidden" id="cnt-mover">message box</a>
<a href="#ranking-container" id="reset-pos" class="hidden">hidden</a>
<script type="text/javascript">
                                var request_list = new Array();
                                $('document').ready(function() {
                                    //submit form for search result
                                    $("#submit_cmd").bind('click', function() {
                                        $('#page-index').val(1);

                                        $.each(request_list, function(pos, request) {
                                            request.abort();
                                        });
                                        request_list = new Array();
                                        $('html, body').animate({scrollTop: $('#content_vosotros').position().top}, 'fast');
                                        showRewardRanking("<?php echo url_for('reward_ranking'); ?>");
                                    });


                                    $("#caja_box").fancybox({padding: 5});
                                    $("#user_message_ancor").fancybox({padding: 5});
                                    $('#is_caja_anchor').fancybox({padding: 5});
                                    if (<?php echo $is_caja == true ? 1 : 0 ?>) {
                                        showUserMessageBox($('#is_caja').html());

                                    }
                                    // exeucte caja accept event
                                    $("#caja").bind('click', function() {

                                        request = $.ajax({
                                            url: '/vosotros/caja',
                                            type: 'POST',
                                            success: function(data) {
                                                // $("#cashup-log").html(data);
                                                window.location = '<?php echo url_for('reward_ranking') ?>/caja/true/caja_amount/' + data;
                                                //$.fancybox.close();
                                                //$("#user_message_content").html($('#caja_value').html());
                                                //$("#user_message_ancor").trigger('click');
                                            }
                                        });
                                    });
                                    //end caja accept event



                                });
                                function showUserMessageBox(message) {
                                    $.fancybox.close();
                                    $("#user_message_content").html(message);
                                    $("#user_message_ancor").trigger('click');
                                }
</script>

