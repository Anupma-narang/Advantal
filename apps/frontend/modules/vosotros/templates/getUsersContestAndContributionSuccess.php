<?php use_helper('Concursos') ?>
<div class="user-condivibution-contest-list">

    <span>
        <?php echo $is_current_user ? __('Has creado ') : __('Ha creado ') ?>
        <a class="l-anch" data-path="box<?php echo $user_id; ?>" href='<?php echo $is_logged ? (!count($contests) ? '#contest_anchor_box_' . $user_id : 'javascript:void(0)') : '#user_login_box' ?>' class='contest-block fancybox' id="contest_anchor_<?php echo $user_id; ?>"><?php echo count($contests); ?></a>
        <?php echo count($contests) == 1 ? __(' concurso.') : __(' concursos.') ?>
    </span>

</div>
<div class="user-condivibution-contest-list">

    <span>
        <?php echo $is_current_user ? __('Has realizado ') : __('Ha realizado ') ?>
        <a class="l-anch" data-path="box<?php echo $user_id; ?>" href='<?php echo $is_logged ? (!count($contributions) ? '#contribution_anchor_box_' . $user_id : 'javascript:void(0)') : '#user_login_box' ?>' class='condivibution-block fancybox' id="condivibution_anchor_<?php echo $user_id; ?>" ><?php echo count($contributions); ?></a>
        <?php echo count($contributions) == 1 ? __(' contribución.') : __(' contribuciones.') ?>
    </span>
</div>


<?php if ($is_logged): ?>



    <?php if (count($contests)): ?>
        <div class="y-box hidden" id="user_contest_messagebox_<?php echo $user_id; ?>">
            <div style="margin:5px" class="close"></div>
            <div class="pointer"></div>
            <div class="y-content">
                <h2>
                    <?php echo!$is_current_user ? __('Concursos creados por ') . $user->getUsername() : __('Concursos creados por ti') ?>
                </h2>
                <ul class="ul-dialog">
                    <?php foreach ($contests as $contest): ?>
                        <li>
                            <?php echo link_to_contest($contest, $contest['name']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php else: ?>

        <div class="border-box-n hidden" id="contest_anchor_box_<?php echo $user_id; ?>">

            <div class="header-left"><div class="header-right"></div></div>
            <div class="top-left">
                <div class="top-right" >
                    <?php if ($is_current_user): ?>
                        <strong><?php echo __('Aún no has creado ningún concurso.') ?></strong>
                    <?php else: ?>
                        <strong><?php echo __('Este colaborador aún no ha creado ningún concurso.') ?></strong>
                    <?php endif; ?>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>





    <?php if (count($contributions)): ?>
        <div class="y-box hidden" id="user_condivibution_messagebox_<?php echo $user_id; ?>">
            <div style="margin:5px" class="close"></div>
            <div class="pointer"></div>
            <div class="y-content">
                <h2>
                    <?php echo!$is_current_user ? __('Contribuciones realizadas por ') . $user->getUsername() : __('Contribuciones creadas por ti') ?>
                </h2>
                <ul class="ul-dialog">
                    <?php foreach ($contributions as $contribution): ?>
                        <li>
                            <?php //echo link_to_contest($contribution->getConcurso(),$contribution->getConcurso()->getName() ,null, $contribution['concurso_id'])?>
                            <?php echo link_to($contribution['name'], url_for_concurso($contribution->getConcurso(), null, $contribution['id'])) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="border-box-n hidden" id="contribution_anchor_box_<?php echo $user_id; ?>">
            <div class="header-left"><div class="header-right"></div></div>
            <div class="top-left">
                <div class="top-right" >
                    <?php if ($is_current_user): ?>
                        <strong><?php echo __('Aún no has creado ninguna contribución.') ?></strong>
                    <?php else: ?>
                        <strong><?php echo __('Este colaborador aún no ha creado ninguna contribución.') ?></strong>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>

    <?php endif; ?>



<?php else: ?>


<?php endif; ?>


<script type="text/javascript">
    $('document').ready(function() {

        if (<?php echo!count($contributions) ? '1' : '0' ?>) {
            $("#<?php echo 'condivibution_anchor_' . $user_id; ?>").fancybox({padding: 5});
        }
        if (<?php echo!count($contest) ? '1' : '0' ?>) {
            $("#<?php echo 'contest_anchor_' . $user_id; ?>").fancybox({padding: 5});
        }


        if (<?php echo "$is_logged" ? "1" : "0" ?>) {
            $("#contest_anchor_<?php echo $user_id; ?>").bind('click', function() {

                $('.y-box').hide();
                $("#user_contest_messagebox_<?php echo $user_id; ?>").show();
            });
            $("#condivibution_anchor_<?php echo $user_id; ?>").bind('click', function() {
                if ($('this').attr('href') == 'contest_anchor_box_<?php echo $user_id; ?>') {

                } else {
                    $('.y-box').hide();
                    $("#user_condivibution_messagebox_<?php echo $user_id; ?>").show();
                }

            });
        } else {
            $.fancybox.close();
            $("#contest_anchor_<?php echo $user_id; ?>").fancybox({padding: 5});
            $("#condivibution_anchor_<?php echo $user_id; ?>").fancybox({padding: 5});
        }

        $('.close').bind('click', function() {
            $(this).parent().hide();
        });
        $('#cnt-mover').bind('click', function() {
            var location = window.location + '';
            if ((location.split("#").length - 1) < 1) {
                window.location = window.location + $('#cnt-mover').attr('href');
            }

        });
        if (<?php echo $sf_user->getGuardUser() ? '0' : '1' ?>) {
            $('.l-anch').unbind('click').bind('click', function() {
                $('#login-uri').attr('href', $('#login-uri').data('path') + '?box=' + $(this).data('path'));
            });
            if (<?php echo $box_value ? '1' : '0' ?>) {

                $('#cnt-mover').attr('href', '#<?php echo $box_value ?>');
                $('#<?php echo $box_value ?>').find('.cr-content').css('background-color', 'yellow');
                $('#cnt-mover').trigger('click');

            }
        } else {

            if (<?php echo $box_value ? '1' : '0' ?>) {

                $('#cnt-mover').attr('href', '#<?php echo $box_value ?>');
                $('#<?php echo $box_value ?>').find('.cr-content').css('background-color', 'yellow');
                $('#cnt-mover').trigger('click');

            }
        }

    });

</script>