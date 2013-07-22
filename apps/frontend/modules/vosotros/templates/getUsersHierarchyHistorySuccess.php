<?php use_helper('Concursos') ?>
<div class="user-contribution-contest-list">

    <span>
        <?php echo $is_current_user ? __('Has creado ') : __('Ha creado ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_contest_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contest-block fancybox l-anch target' id="contest_anchor"><?php echo count($contests); ?></a>
        <?php echo count($contests) == 1 ? __(' concurso.') : __(' concursos.') ?>
    </span>

</div>
<div class="user-contribution-contest-list">

    <span>
        <?php echo $is_current_user ? __('Has realizado ') : __('Ha realizado ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_contribution_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($contributions); ?></a>
        <?php echo count($contributions) == 1 ? __(' contribución.') : __(' contribuciones.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has votado en ') : __('Ha votado en ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_referendum_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($referendas); ?></a>
        <?php echo count($referendas) == 1 ? __(' Referéndum.') : __(' Referéndums.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has realizado ') : __('Ha realizado ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_audit_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($audits); ?></a>
        <?php echo __(' auditorías.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has comentado ') : __('Ha comentado ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_comment_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($comment_records); ?></a>
        <?php echo count($comment_records) == 1 ? __(' vez.') : __(' veces.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has escrito ') : __('Ha escrito ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_recommend_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($recommendation_letters); ?></a>
        <?php echo count($recommendation_letters) == 1 ? __(' carta de recomendación.') : __(' cartas de recomendación.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has escrito ') : __('Ha escrito ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_disapprove_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($disapproval_letters); ?></a>
        <?php echo count($disapproval_letters) == 1 ? __(' carta de desaprobación.') : __(' cartas de desaprobación.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has recomendado a ') : __('Ha recomendado a ') ?>
        <span class="green-link"><?php echo count($recommended_registered_users); ?></span>
        <?php echo count($recommended_registered_users) == 1 ? __(' amigo.') : __(' amigos.'); ?>

    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Nos has auditado a nosotros ') : __('Nos ha auditado a nosotros ') ?>
        <span class="green-link"><?php echo count($auditanos_records); ?></span>
        <?php echo count($auditanos_records) == 1 ? __(' vez.') : __(' veces.') ?>
    </span>
</div>
<div class="user-contribution-contest-list">
    <span>
        <?php echo $is_current_user ? __('Has informado de ') : __('Ha informado de ') ?>
        <a  data-path="box<?php echo $user->getId(); ?>"  data-target ="#user_case_study_messagebox" href='<?php echo $is_logged ? 'javascript:void(0)' : '#user_login_box' ?>' class='contribution-block fancybox l-anch target' id="contribution_anchor" ><?php echo count($user_company_case_study_records) + count($user_product_case_study_records); ?></a>
        <?php echo count($user_company_case_study_records) + count($user_product_case_study_records) == 1 ? __(' caso de éxito.') : __(' casos de éxito.') ?>
    </span>
</div>

<?php if ($is_logged): ?>
    <!-- contest message box -->
    <div class="y-box hidden" id="user_contest_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Concursos creados por ') . $user->getUsername() : __('Concursos creados por ti') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($contests as $contest): ?>
                    <li><?php //echo link_to($contest['name'], '/concurso/show/id/' . $contest['id'])      ?>
                        <?php echo link_to_contest($contest, $contest['name']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- end contest message box -->
    <!--contribution message box -->
    <div class="y-box hidden" id="user_contribution_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Contribuciones realizadas por ') . $user->getUsername() : __('Contribuciones creados por ti') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($contributions as $contribution): ?>
                    <li>
                        <?php //echo link_to($contribution['name'], url_for('/concurso/show/id/' . $contribution['concurso_id'] . '/contribucion_id/' . $contribution['id'])) ?>
                        <?php echo link_to($contribution['name'], url_for_concurso($contribution->getConcurso(), null, $contribution['id'])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!--end contribution message box -->
    <!-- referendum message box -->
    <div class="y-box hidden" id="user_referendum_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Referéndums en que ha participado ') . $user->getUsername() : __('Referéndums en que has participado') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($referendas as $referenda): ?>
                    <li><?php echo $referenda->getConcurso()->getName() ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!--end referendum message box -->
    <!-- audit message box -->
    <div class="y-box hidden" id="user_audit_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Auditorías que ha realizado ') . $user->getUsername() : __('Auditorías que has realizado') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($audits as $audit): ?>
                    <?php if ($audit['company_name']): ?>
                        <li><?php echo link_to($audit['company_name'], url_for('lista_blanca_empresa_detalle', array('slug' => $audit['company_slug'], 'tipo' => 'empresa'))) ?></li>
                    <?php else: ?>
                        <li><?php echo link_to($audit['product_name'], url_for('lista_blanca_producto_detalle', array('slug' => $audit['product_slug'], 'tipo' => 'producto'))) ?></li>
                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>
        </div>
    </div>
    <!-- end audit message box -->
    <!-- audit message box -->
    <div class="y-box hidden" id="user_comment_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Comentarios que ha realizado ') . $user->getUsername() : __('Comentarios que has realizado') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($comment_records as $comment): ?>
                    <?php if ($comment['company_name']): ?>
                        <li><?php echo link_to($comment['company_name'], url_for('lista_blanca_empresa_detalle', array('slug' => $comment['company_slug'], 'tipo' => 'empresa'))) ?></li>
                    <?php else: ?>
                        <li><?php echo link_to($comment['Producto']['product_name'] . ' ' . $comment['Producto']['marca'] . ' ' . $comment['Producto']['modelo'], url_for('lista_blanca_producto_detalle', array('slug' => $comment['product_slug'], 'tipo' => 'producto'))); ?></li>
                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>
        </div>
    </div>
    <!-- end audit message box -->
    <!-- recommend message box -->
    <div class="y-box hidden" id="user_recommend_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Cartas de recomendación que ha escrito ') . $user->getUsername() : __('Cartas de recomendación que has escrito') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($recommendation_letters as $letters): ?>
                    <li><?php echo link_to($letters['name'], url_for('lista_profesional_detalle', array('slug' => $letters['professional_slug']))) ?></li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
    <!-- end recommend message box -->
    <!-- disapprove message box -->
    <div class="y-box hidden" id="user_disapprove_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Cartas de desaprobación que ha escrito ') . $user->getUsername() : __('Cartas de desparobación que has escrito') ?>
            </h2>
            <ul class="ul-dialog">
                <?php foreach ($disapproval_letters as $letters): ?>
                    <li><?php echo link_to($letters['name'], url_for('lista_profesional_detalle', array('slug' => $letters['professional_slug']))) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- end disapprove message box -->
    <!-- friends message box -->
    <div class="y-box hidden" id="user_friends_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo!$is_current_user ? __('Amigos que ha recomendado ') . $user->getUsername() : __('Amigos que has recomendado') ?>
            </h2>
            <ul class="ul-dialog">

            </ul>
        </div>
    </div>
    <!-- end firends message box -->
    <!-- case study message box -->
    <div class="y-box hidden" id="user_case_study_messagebox">
        <div style="margin:5px" class="close"></div>
        <div class="pointer"></div>
        <div class="y-content">
            <h2>
                <?php echo __('Casos de éxito de los que has informado') ?>
            </h2>
            <ul class="ul-dialog">

                <?php foreach ($user_company_case_study_records as $company_cast_study_record): ?>
                    <?php if ($company_cast_study_record['company_name']): ?>
                        <li><?php echo link_to($company_cast_study_record['company_name'], url_for('vosotros/userCompanyCaseStudy', array())) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach ($user_product_case_study_records as $product_cast_study_record): ?>
                    <?php if ($product_cast_study_record['product_name']): ?>
                        <li><?php echo link_to($product_cast_study_record['product_name'], url_for('vosotros/userProductCaseStudy', array())) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- end case study message box -->
<?php else: ?>

<?php endif; ?>


<script type="text/javascript">
    $('document').ready(function() {
        $('.close').bind('click', function() {
            $(this).parent().hide();
        });
        if (<?php echo "$is_logged" ? "1" : "0" ?>) {
            $(".target").bind('click', function() {
                $('.y-box').hide();
                $($(this).data('target')).show();
            });

        } else {
            $.fancybox.close();
            $("#contest_anchor").fancybox({padding: 5});
            $("#contribution_anchor").fancybox({padding: 5});
        }

        if (<?php echo $sf_user->getGuardUser() ? '0' : '1' ?>) {
            $('.l-anch').unbind('click').bind('click', function() {
                console.log($(this).data('path'));
                $('#login-uri').attr('href', $('#login-uri').data('path') + '?box=' + $(this).data('path'));
            });
        }

    });

</script>