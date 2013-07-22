<div id="g-slid">
    <form action="/vosotros/gift-redemption" method="GET" class="hidden" id="gift-form">
        <input type="hidden" id="gift-id" name="id"/>
    </form>
    <ul>
        <?php $count = 0; ?>
        <li class="l-gift" >
            <?php foreach ($gift_list as $index => $gift): ?>
                <div class="g-con">
                    <div  class="gift-image " data-id="<?php echo $gift['id'] ?>" data-rank="<?php echo $gift['hierarchy'] ?>">
                        <?php
                        if (file_exists(sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift['image'])) {
                            echo image_tag(sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift['image'], array('class' => 'gift-image',
                                'data-id' => $gift['id'],
                                'id' => 'gift_image_' . $gift['id'],
                                'onclick' => 'showImage("' . sfConfig::get('sf_gift_upload_path') . '/' . 'med_' . $gift['image'] . '")',
                                'data-med' => sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift['image']));
                        }
                        ?>
                    </div>

                    <div class="np " data-id="<?php echo $gift['id'] ?>" data-rank="<?php echo $gift['hierarchy'] ?>">
                        <span class="negrita " id="gift_name_<?php echo $gift['id'] ?>">
                            <?php echo truncate_text($gift['name'], 30) ?>
                        </span>
                        <span class="negrita azul g-pon" >
                            <tspan id="gift_point_<?php echo $gift['id'] ?>"><?php echo $gift['require_points']; ?></tspan>
                            <?php echo __(' puntos'); ?>
                        </span>

                    </div>
                    <span class="link">
                        <input type="button" class="gift" data-id="<?php echo $gift['id'] ?>" value="<?php echo __('Canjea regalo') ?>" title="Canjea regalo"/>
                    </span>

                </div>
                <div class="hidden gift-summery" id="<?php echo $gift['id'] ?>_summery" >
                    <div  >
                        <div class="border-box-n">
                            <div class="header-left"><div class="header-right"></div></div>
                            <div class="top-left">
                                <div class="top-right" >
                                    <p><a href="javascript:void(0)" onClick="ShowFeatures('<?php echo $gift['id'] ?>')"><?php echo __('Características'); ?></a></p>
                                    <p><a href="javascript:void(0)" onClick="ShowHirarchy('<?php echo $gift['id'] ?>')"><?php echo __('Disponible para'); ?></a></p>
                                </div>
                            </div>
                            <div class="bottom-left">
                                <div class="bottom-right"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="hidden" id="<?php echo $gift['id'] ?>_feature" >
                    <span class="negrita verde"><?php echo __('Características'); ?></span>
                    <p><?php echo html_entity_decode($gift['features']) ?></p>

                </div>
                <div id="<?php echo $gift['id'] ?>_hierarchy" class="hidden" style="width: 200px">
                    <span class="negrita verde"><?php echo __('Disponible para'); ?></span>
                    <ul class="bundle heirarchy-ul" style="width: 200px">
                        <?php foreach ($heirarchy_records as $index => $hierarchy): ?>
                            <?php if ($gift['hierarchy'] <= $index): ?>
                                <li ><strong><?php echo $hierarchy ?></strong></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php if (($count + 1) % 3 == 0 && $count < 5): ?>
                </li><li class="l-gift">
                <?php endif; ?>
                <?php $count++; ?>
            <?php endforeach; ?>
        </li>
    </ul>
</div>
<div class="hidden" id="confirm_box">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" id="confirm_box_content">
                <p><?php echo __(' Has seleccionado:'); ?></p>
                <p><span class="box width100 negrita  " id='gift_name'></span></p>
                <p><img src="/images/round_preload.gif" id="gift_image"/></p>
                <p><span class="box width100 negrita azul" id='gift_point'><?php echo __('Puntos canjeables:') ?></span></p>
                <p><strong><?php echo __('¿Estás seguro de que quieres canjear este regalo?') ?></strong>
                    <?php echo __(' Una vez aceptada, esta acción no podrá deshacerse.') ?>
                </p>
                <p class="align-right">
                    <a href="#" id="redeem" title="acepta" data-id="">acepta</a> | <a href="javascript:void(0)" onclick="$.fancybox.close()" title="cancela">cancela</a>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#confirm_box" class="hidden" id="confirm_box_anchor" onclick="$.fancybox.close();">message box</a>
<div class="hidden" id="user_messagebox">
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
<a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>
<div class="hidden" id="heirarchy_messagebox">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" id="heirarchy_messagebox_content">
                <p><?php echo __('Para canjear ese regalo necesitas ser al menos ') ?><span id="heirarchy_type"></span></p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

</div>
<a href="#heirarchy_messagebox" class="hidden" id="heirarchy_messagebox_anchor"  onclick="$.fancybox.close();">message box</a>
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
<div id="toolTip" class="hidden"></div>
<script type="text/javascript">
                                        var user_heirarchy = <?php echo $sf_user->getHierarchy() ?>;
                                        var user_points = <?php echo $redeem_points ?>;
                                        $(document).ready(function() {
                                            $("#caja_box").fancybox({padding: 5});
                                            $("#user_message_ancor").fancybox({padding: 5});
                                            $("#user_login").fancybox({padding: 5});
                                            $("#confirm_box_anchor").fancybox({padding: 5});
                                            $("#heirarchy_messagebox_anchor").fancybox({padding: 5});
                                            $("#gift_image_anchor").fancybox({padding: 5});
                                            $("#g-slid").easySlider({
                                                nextId: "g-next",
                                                prevId: "g-prev",
                                                cName: 'l-gift'

                                            });
                                            console.log($("li", $("#g-slid")).width());
                                            // exeucte caja accept event
                                            /*$(".gift-image").bind('mouseover', function(){

                                             $('.gift-summery').addClass('hidden');
                                             var gift_id = $(this).data('id');

                                             $('#'+gift_id+'_summery').removeClass('hidden');
                                             $('#'+gift_id+'_summery').bind('mouseenter', function(){
                                             $(this).parent().data('enter', '1');
                                             });

                                             $('#'+gift_id+'_summery').bind('mouseleave', function(){

                                             if($(this).parent().data('enter') == '1'){
                                             $(this).parent().data('enter','0');
                                             $('.gift-summery').addClass('hidden');
                                             }

                                             });
                                             });*/
                                            $(".gift-image").bind('mouseover', function() {
                                                var gift_id = $(this).data('id');
                                                $('#toolTip').html($('#' + gift_id + '_summery').html());
                                                $('.heirarchy-ul').css('width', '200px');
                                                $('.heirarchy-ul').css('margin-left', '0px');
                                                $('#user_message_content').css('width', '250px');

                                            });

                                            $('.gift-image').data('powertiptarget', 'toolTip');
                                            $('.gift-image').powerTip({
                                                placement: 'n',
                                                mouseOnToPopup: true


                                            });

                                            /*$('.favourit').bind('click', function(){
                                             var c_id = $(this).data('id');
                                             $.ajax({
                                             url: '/vosotros/addToFavorite',
                                             data: {gift_id: c_id},
                                             success:function(message){
                                             $('#user_message_content').html(message);
                                             $('#user_message_ancor').trigger('click');
                                             }
                                             });
                                             });*/

                                            $('.gift').bind('click', function() {

                                                var heirarchy = $(this).data('heirarchy');
                                                var gift_id = $(this).data('id');
                                                console.log(gift_id);

                                                if (<?php echo $user == null ? 1 : 0 ?>) {
                                                    $.fancybox.close();
                                                    $("#user_login").trigger('click');

                                                }
                                                else if (user_heirarchy < heirarchy) {
                                                    $.fancybox.close();
                                                    $('#heirarchy_type').html($('#' + gift_id + '_hierarchy_type').html());
                                                    $("#heirarchy_messagebox_anchor").trigger('click');
                                                }
                                                else if (user_points < $('#gift_point_' + gift_id).html()) {
                                                    $('#user_message_content').html("<?php echo html_entity_decode('No tienes <strong>suficientes puntos</strong> para canjear ese regalo') ?>");
                                                    $("#user_message_ancor").trigger('click');
                                                }
                                                else {
                                                    $.fancybox.close();
                                                    $('#gift_name').html($('#gift_name_' + gift_id).html());
                                                    $('#gift_point').html('Puntos canjeables:' + $('#gift_point_' + gift_id).html());
                                                    $('#gift_image').attr('src', $('#gift_image_' + gift_id).data('med'));
                                                    $('#redeem').data('id', gift_id);
                                                    $("#confirm_box_anchor").trigger('click');


                                                }
                                            });
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
                                            $('#' + gift_id + '_hierarchy').find('li').css('float', 'none');
                                            $('#user_message_content').html($('#' + gift_id + '_hierarchy').html());
                                            $('#user_message_ancor').trigger('click');
                                        }
                                        function showImage(source_image) {

                                            $('#image_content').attr('src', source_image);
                                            $("#gift_image_anchor").trigger('click');
                                        }
</script>