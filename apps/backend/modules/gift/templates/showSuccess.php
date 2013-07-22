
<?php use_helper('Text') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Detalle del regalo') ?></h1>

    <div id="sf_admin_content">
        <div style="float: right;" id="concurso_actions">
            <h2><?php echo __('Acciones sobre el regalos') ?></h2>
            <ul>
                <li>
                    <?php if ($gift->getFeatured()): ?>
                        <?php echo link_to(__('Quitar home', array(), 'messages'), 'gift/removeFeatured?id=' . $gift->getId(), array('class' => 'remove')) ?>
                    <?php else: ?>
                        <?php echo link_to(__('Home', array(), 'messages'), 'gift/setFeatured?id=' . $gift->getId(), array('class' => 'featured')) ?>
                    <?php endif; ?>
                </li>
                <li>
                    <?php echo link_to(__('Orden Home', array(), 'messages'), 'gift/setFeaturedOrder?id=' . $gift->getId(), array('class' => 'normal')) ?>
                </li>

            </ul>
        </div>
        <h2>
            <?php echo __($gift->getName(), array(), 'name') ?>
        </h2>
        <ul class="dragbox-content">
            <li><span class="bold"><?php echo __('Fecha: ') ?></span><?php echo format_datetime($gift->getCreatedAt(), "dd/MM/y", "es_ES") ?>
            </li>

            <li>
                <span class="bold">
                    <?php echo __('Regalo') ?>:</span>

                <?php echo $gift->getName() ?>
            </li>
            <li>
                <span class="bold">
                    <?php echo __('Puntos necesarios') ?>:</span>
                <?php echo $gift->getRequirePoints() ?>
            </li>
            <li>
                <span class="bold">
                    <?php echo __('Jerarquía') ?>:</span>
                <?php $heirarchy_records = Doctrine::getTable('Jerarquia')->getHierarchyList(); ?>
                <?php echo $heirarchy_records[$gift->getHierarchy()]; ?>
            </li>

            <li>
                <span class="bold">
                    <?php echo __('Imagen') ?>:</span>
                <br>
                <?php echo image_tag('uploads' . DIRECTORY_SEPARATOR . 'gift' . DIRECTORY_SEPARATOR . 'thumb_' . $gift->getImage(), array()) ?>
            </li>

            <?php if ($gift->getFeatured()): ?>
                <li>
                  <span class="bold"><?php echo __('Home') ?>: Si</span>
                </li>
            <?php endif; ?>
            <?php if ($gift->getFeaturedOrder()): ?>
                <li>
                    <span class="bold">
                        <?php echo __('Orden Home') ?>:</span>
                    <?php echo $gift->getFeaturedOrder() ?>
                </li>
            <?php endif; ?>
            <br>
            <li>
                <span class="bold">
                    <?php echo __('Características') ?>:</span>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($gift->getFeatures()) ?>
            </li>

        </ul>
        <div style="clear: both; height: 1px;"></div>
        <ul class="sf_admin_actions" style="margin-left: 6px !important;">
            <li class="sf_admin_action_list">
                <?php echo link_to('Volver al Listado', '@gift', array('class' => 'normal')) ?>
            </li>
        </ul>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.featured').bind('click', function(){
            if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
                alert('<?php echo __('No puedes destacar más de 6 regalos del Escaparate en la Home.') ?>');
                return false;
            }
        });
    });
</script>