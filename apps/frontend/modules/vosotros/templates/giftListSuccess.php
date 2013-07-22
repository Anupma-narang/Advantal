<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>
<div id="content_vosotros">
    <div id="content_laslistas_right">

        <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Escaparate de regalos', 'tituloSeccion' => 'Escaparate de regalos')) ?>
        <div class="box width100"><h1><?php echo __('Escaparate de regalos') ?></h1></div>

        <form action="/vosotros/gift-redemption" method="GET" class="hidden" id="gift-form">
            <input type="hidden" id="gift-id" name="id"/>
            <input type="hidden" id="gift-page" name="page" value="<?php echo $page ?>"/>
        </form>
        <?php if (count($gift_pager)): ?>
            <div id="gift_container">
                <ul>
                    <li>
                        <?php $pos = 1; ?>
                        <?php foreach ($gift_pager as $index => $gift): ?>

                            <div class="gift-block" align="center">

                                <p ><?php echo image_tag('star.png') ?> <a href="javascript:void(0)" data-id="<?php echo $gift->getId() ?>" class="favourit" title="Añade un regalo a Favoritos"><?php echo __('añadir a favoritos') ?></a></p>
                                <?php
                                echo image_tag(sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift->getImage(), array('class' => 'gift-image',
                                    'data-id' => $gift->getId(),
                                    'id' => 'gift_image_' . $gift->getId(),
                                    'onclick' => 'showImage("' . sfConfig::get('sf_gift_upload_path') . '/' . 'med_' . $gift->getImage() . '")',
                                    'data-med' => sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift->getImage()));
                                ?>
                                <p align="center"><span class="negrita " id="gift_name_<?php echo $gift->getId() ?>"><?php echo $gift->getName() ?></span></p>
                                <p><span class="negrita azul" id="gift_point_<?php echo $gift->getId() ?>" data-val="<?php echo $gift->getRequirePoints(); ?>"><?php echo $sf_user->getMoneyInFormat($gift->getRequirePoints()); ?></span><span class="negrita azul" ><?php echo $gift->getRequirePoints() > 1 ? __(' puntos') : __(' punto'); ?></span></p>
                                <div class="hidden gift-summery" id="<?php echo $gift->getId() ?>_summery" >
                                    <div  >
                                        <div class="border-box-n">
                                            <div class="header-left"><div class="header-right"></div></div>
                                            <div class="top-left">
                                                <div class="top-right" >
                                                    <p><a href="javascript:void(0)" onClick="ShowFeatures('<?php echo $gift->getId() ?>')"><?php echo __('Características'); ?></a></p>
                                                    <p><a href="javascript:void(0)" onClick="ShowHirarchy('<?php echo $gift->getId() ?>')"><?php echo __('Disponible para'); ?></a></p>
                                                </div>
                                            </div>
                                            <div class="bottom-left">
                                                <div class="bottom-right"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="<?php echo $gift->getId() ?>_hierarchy" class="hidden">
                                    <span class="negrita verde"><?php echo __('Disponible para'); ?></span>
                                    <ul class="bundle">
                                        <?php foreach ($heirarchy_records as $index => $hierarchy): ?>
                                            <?php if ($gift->getHierarchy() <= $index): ?>
                                                <li><strong><?php echo $hierarchy ?></strong></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <span id="<?php echo $gift->getId() ?>_hierarchy_type" class="hidden"><?php echo $heirarchy_records[$gift->getHierarchy()] ?></span>
                                <div class="hidden" id="<?php echo $gift->getId() ?>_feature" >
                                    <span class="negrita verde"><?php echo __('Características'); ?></span>
                                    <p><?php echo html_entity_decode($gift->getFeatures()) ?></p>

                                </div>
                                <p>
                                    <input type="button" onClick="RedemeGift('<?php echo $gift->getId() ?>',<?php echo $gift->getHierarchy() ?>)" value="<?php echo __('Canjea regalo') ?>" title="Canjea regalo"/>
                                </p>

                            </div>

                            <?php if ($pos % 2 == 0): ?>
                            </li><li>
                            <?php endif; ?>
                            <?php $pos = $pos + 1; ?>
                        <?php endforeach; ?>
                        <?php if ($pos % 2 == 0): ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php else: ?>
            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <?php echo __('No se encontraron registros de regalo.') ?>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($gift_pager->haveToPaginate()): ?>
            <div class="pagination">
                <?php print link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), 'pager(' . $gift_pager->getFirstPage() . ')', array('data-page' => $gift_pager->getFirstPage())) ?>
                <?php print link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), 'pager(' . $gift_pager->getPreviousPage() . ')', array('data-page' => $gift_pager->getPreviousPage())) ?>
                <?php
                $pages = array();
                foreach ($gift_pager->getLinks() as $page) {
                    $pages[] = ($page == $gift_pager->getPage()) ? $page : link_to_function($page, 'pager(' . $page . ')', array('data-page' => $page));
                }
                print implode(' - ', $pages);
                ?>
                <?php print link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), 'pager(' . $gift_pager->getNextPage() . ')', array('data-page' => $gift_pager->getNextPage())) ?>
                <?php print link_to_function(image_tag('/images/last.png', array('title' => 'Última')), 'pager(' . $gift_pager->getLastPage() . ')', array('data-page' => $gift_pager->getLastPage())) ?>
            </div>
        <?php endif; ?>

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
                                    <p>Para hacer caja <strong>necesitas tener al menos 30€</strong> en tu cuenta.</p>
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
                                    Tienes en tu caja la cantidad de <b><?php echo $money; ?>€</b>.
                                </p>
                                <p>
                                    ¿Estás seguro de que quieres hacer caja en este momento? Una vez aceptada, esta acción no podrá deshacerse.
                                </p>
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
        <div class="hidden" id="user_messagebox">
            <div class="border-box-n">
                <div class="header-left"><div class="header-right"></div></div>
                <div class="top-left">
                    <div class="top-right" >
                        <div id="user_message_content">

                        </div>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>

        </div>
        <a href="#user_messagebox" onclick="$.fancybox.close();" class="hidden" id="user_message_ancor">message box</a>
        <div class="hidden" id="user_login_box">
            <div class="border-box-n">
                <div class="header-left"><div class="header-right"></div></div>
                <div class="top-left">
                    <div class="top-right" id="user_message_container">
                        <div id="user_login_content">
                            <p><?php echo __('Para ') ?><strong><?php echo __('canjear un regalo') ?></strong> <?php echo __(' necesitas ser colaborador.'); ?></p>
                            <ul class="bundle">
                                <li><?php echo link_to(__('ya soy colaborador'), url_for('/guard/login?redirect=' . url_for('gift_list', array('page' => $list_page)))) ?></li>
                                <li><?php echo __('¿Aún no eres colaborador? ') ?> i<?php echo link_to(__('Crea una cuenta'), url_for('/registro')) ?> <?php echo __(' ahora!'); ?></li>

                            </ul>
                            <br>
                        </div>

                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>

        </div>
        <a href="#user_login_box" class="hidden" id="user_login" onclick="$.fancybox.close();">message box</a>

        <div class="hidden" id="confirm_box">
            <div class="border-box-n">
                <div class="header-left"><div class="header-right"></div></div>
                <div class="top-left">
                    <div class="top-right" id="confirm_box_content">
                        <p><?php echo __(' Has seleccionado:'); ?></p>
                        <p><span class="box width100 negrita  " id='gift_name'></span></p>
                        <p><img src="<?php echo image_path("preloader-mini.gif"); ?>" id="gift_image"/></p>
                        <p><span class="box width100 negrita azul" id='gift_point'><?php echo __('Puntos canjeables:') ?></span></p>
                        <p><strong><?php echo __('¿Estás seguro de que quieres canjear este regalo?') ?></strong>
                            <?php echo __(' Una vez aceptada, esta acción no podrá deshacerse.') ?>
                        </p>
                        <p class="align-right">
                            <a href="#" id="redeem" title="acepta">acepta</a> | <a href="javascript:void(0)" onclick="$.fancybox.close()" title="cancela">cancela</a>
                        </p>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>

        </div>
        <a href="#confirm_box" class="hidden" id="confirm_box_anchor" onclick="$.fancybox.close();">message box</a>
        <div class="hidden" id="heirarchy_messagebox">
            <div class="border-box-n">
                <div class="header-left"><div class="header-right"></div></div>
                <div class="top-left">
                    <div class="top-right" id="heirarchy_messagebox_content">
                        <p><?php echo __('Para canjear ese regalo necesitas ser al menos ') ?><strong id="heirarchy_type"></strong>.</p>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>

        </div>
        <a href="#heirarchy_messagebox" class="hidden" id="heirarchy_messagebox_anchor"  onclick="$.fancybox.close();">message box</a>
    </div>
</div>
<div class="hidden" id="gift_image_container">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" >
                <img src="<?php echo image_path("preloader-mini.gif"); ?>" id="image_content"/>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#gift_image_container" class="hidden" id="gift_image_anchor">message box</a>
<form action="/vosotros/gift-list" method="GET" class="hidden" id="filterForm">
    <input type="hidden" id="filterForm_page" name="page" value="<?php echo $page ?>"/>
</form>
<script type="text/javascript">
                                                        var user_heirarchy = <?php echo $sf_user->getHierarchy() ?>;
                                                        var user_points = <?php echo $redeem_points ?>;
                                                        $('document').ready(function() {


                                                            $("#caja_box").fancybox({padding: 5});
                                                            $("#user_message_ancor").fancybox({padding: 5});
                                                            $("#user_login").fancybox({padding: 5});
                                                            $("#confirm_box_anchor").fancybox({padding: 5});
                                                            $("#heirarchy_messagebox_anchor").fancybox({padding: 5});
                                                            $("#gift_image_anchor").fancybox({padding: 5});


                                                            if (<?php echo $message == true ? 1 : 0 ?>) {
                                                                $('#user_message_content').html('<?php echo __('Tu <strong>canje se ha realizado</strong> con éxito.') ?>');
                                                                $('#user_message_ancor').trigger('click');
                                                            }
                                                            // exeucte caja accept event
                                                            $(".gift-image").bind('mouseover', function() {
                                                                $('.gift-summery').addClass('hidden');
                                                                var gift_id = $(this).data('id');
                                                                $('#' + gift_id + '_summery').removeClass('hidden');
                                                                $('#' + gift_id + '_summery').bind('mouseenter', function() {
                                                                    $(this).parent().data('enter', '1');
                                                                });

                                                                $('#' + gift_id + '_summery').bind('mouseleave', function() {

                                                                    if ($(this).parent().data('enter') == '1') {
                                                                        $(this).parent().data('enter', '0');
                                                                        $('.gift-summery').addClass('hidden');
                                                                    }

                                                                });
                                                            });


                                                            //end caja accept event

                                                            $('#redeem').bind('click', function() {
                                                                $('#gift-id').val($('#redeem').data('id'));
                                                                $('#gift-form').submit();
                                                            });



                                                        });

                                                        function ShowFeatures(gift_id) {
                                                            $.fancybox.close();
                                                            $('#user_message_content').html($('#' + gift_id + '_feature').html());
                                                            $('#user_message_ancor').trigger('click');
                                                        }
                                                        function ShowHirarchy(gift_id) {
                                                            $.fancybox.close();
                                                            $('#user_message_content').html($('#' + gift_id + '_hierarchy').html());
                                                            $('#user_message_ancor').trigger('click');
                                                        }
                                                        function RedemeGift(gift_id, heirarchy) {

                                                            $('.gift-summery').addClass('hidden');
                                                            if (<?php echo $user == null ? 1 : 0 ?>) {
                                                                $.fancybox.close();
                                                                $("#user_login").trigger('click');

                                                            }
                                                            else if (user_heirarchy < heirarchy) {
                                                                $.fancybox.close();
                                                                $('#heirarchy_type').html($('#' + gift_id + '_hierarchy_type').html());
                                                                $("#heirarchy_messagebox_anchor").trigger('click');
                                                            }
                                                            else if (user_points < $('#gift_point_' + gift_id).data('val')) {
                                                                $('#user_message_content').html("<?php echo html_entity_decode('No tienes <strong>suficientes puntos</strong> para canjear ese regalo.') ?>");
                                                                $("#user_message_ancor").trigger('click');
                                                            }
                                                            else {
                                                                $.fancybox.close();
                                                                $('#gift_name').html($('#gift_name_' + gift_id).html());
                                                                $('#gift_point').html('Puntos canjeables:' + $('#gift_point_' + gift_id).data('val'));
                                                                $('#gift_image').attr('src', $('#gift_image_' + gift_id).data('med'));
                                                                $('#redeem').data('id', gift_id);
                                                                $("#confirm_box_anchor").trigger('click');
                                                            }

                                                        }
                                                        function showImage(source_image) {
                                                            $('#image_content').attr('src', source_image);
                                                            console.log($('#image_content').attr('src'));
                                                            $("#gift_image_anchor").trigger('click');
                                                        }

</script>




<script type="text/javascript">
    var pager = function(page) {
        $('#filterForm_page').val(page);
        $('#filterForm').submit();
    }
    $(document).ready(function() {
        $('#user_message_ancor').fancybox({padding: 5});
        $('.favourit').bind('click', function() {
            var c_id = $(this).data('id');
            $.ajax({
                url: '/vosotros/addToFavorite',
                data: {gift_id: c_id},
                success: function(message) {
                    $('#user_message_content').html(message);
                    $('#user_message_ancor').trigger('click');
                }
            });
        });
    })
</script>