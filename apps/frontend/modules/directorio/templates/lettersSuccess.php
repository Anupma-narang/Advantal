<div class="comentarios">
    <div class="list">
        <br />
        <?php foreach ($profesionalLetters as $key => $letter): ?>
            <?php /*if ($letter['profesional_letter_type_id'] == 1 && $key == 0 && count($profesionalLetters) >= 2): ?>
                <div class="item">
                    <div class="titulo" style="color: #B41B1D; float: left; min-width: 365px; width: 100%;">
                        <strong>Recomendación de alta de auditoscopia, <?php echo date_format(new DateTime($profesional->getCreatedAt()), 'd/m/Y') ?>:</strong>
                        <br /><br />
                    </div>
                </div>
            <?php endif;*/ ?>
            <?php $username = $profesional->getLetterUsername($letter['user_id']); ?>
            <div class="item">
                <div class="titulo" style="color:#B41B1D;">
                    <strong>
                        <?php echo (($letter['is_first'] == 1) ? '<span style="color:#B41B1D;font-weight: bold;">Recomendación de alta de auditoscopia</span>' : '<span style="color:#006400;font-weight: bold;">' . $letter['name'] . '</span>, <span style="color: #FF1919;font-weight: bold;">' . $username ) . '</span>, <span style="font-weight: blod;">' . date("d/m/Y", strtotime($letter['created_at'])) . '</span>'; ?>:
                    </strong>
                </div>
                <div class="comentario">
                    <?php echo html_entity_decode($letter['description']); ?>
                </div>
                <?php if ($is_authenticated): ?>
                    <?php $login_user = sfContext::getInstance()->getUser()->getUsername(); ?>
                    <?php if ($login_user == $username && $letter['plan_accion']): ?>
                        <div class="comentario">
                            <p>
                                <?php echo link_to('ver Plan de acción', 'directorio/showPlanAccion?id=' . $letter['id'], array("class" => "plan_ver", "popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200"))) ?>
                            </p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <?php if ($letter['profesional_letter_type_id'] == 1): ?>
            <a href="<?php echo url_for("lista_profesional_detalle", array('slug' => $profesional->getSlug(), 'move_to' => 'detail_point')) ?>">ver +</a>
        <?php else: ?>
            <a href="<?php echo url_for("lista_profesional_detalle_des", array('slug' => $profesional->getSlug(), 'move_to' => 'detail_point')) ?>">ver +</a>
        <?php endif; ?>
    </div>
</div>
<style type="text/css">
    #dialog .comentarios p, #dialog .comentario, #dialog .titulo {
        font-size: 14px;
    }
    #dialog .comentarios p{
        margin: 1em 0 1em 0;
    }
    p a.plan_ver{
        color: #F65E13 !important;
    }
</style>