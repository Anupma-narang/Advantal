<?php
$days_array = array(
    1 => __('Lunes'),
    2 => __('Martes'),
    3 => __('Miércoles'),
    4 => __('Jueves'),
    5 => __('Viernes'),
    6 => __('Sábado'),
    7 => __('Domingo'));
$months_array = array(
    1 => __('Enero'),
    2 => __('Febrero'),
    3 => __('Marzo'),
    4 => __('Abril'),
    5 => __('Mayo'),
    6 => __('Junio'),
    7 => __('Julio'),
    8 => __('Agosto'),
    9 => __('Septiembre'),
    10 => __('Octubre'),
    11 => __('Noviembre'),
    12 => __('Diciembre')
);
?>
<?php $speed_array = array(10000 => '10 segundos', 30000 => '30 segundos', 60000 => '60 segundos'); ?>
<?php $hierarch = array(0 => 'Público'); ?>

<?php $hierarch = array_merge($hierarch, Doctrine::getTable('Jerarquia')->getHierarchyList()); ?>
<?php use_helper('Text') ?>

<div id="sf_admin_container">
    <h1>Detalle de mensajes de la Pizarra</h1>

    <div id="sf_admin_content">
        <h2>
            <?php echo __($pizarra->getName(), array(), 'name') ?>
        </h2>
        <ul class="dragbox-content">
            <li><span class="bold"><?php echo __('Fecha: ') ?></span><?php echo format_datetime($pizarra->getCreatedAt(), "dd/MM/y", "es_ES") ?>
            </li>

            <li><span class="bold"><?php echo __('Sección: ') ?></span>
                <?php $pizarra_section = Doctrine::getTable('PizarraSectionMapping')->getSectionList($pizarra->getId()) ?>
                <?php $pos = 0; ?>
                <?php foreach ($pizarra_section as $section): ?>
                    <?php echo ($pos++ ? ', ' : '') . $section; ?>
                <?php endforeach; ?>
            </li>
            <li><span class="bold"><?php echo __('Visibilidad: ') ?></span><?php echo $hierarch[$pizarra->getVisibilidad()] ?></li>
            <li><span class="bold"><?php echo __('Velocidad: ') ?></span><?php echo $speed_array[$pizarra->getVelocidad()] ?></li>
            <li><span class="bold"><?php echo __('Desde: ') ?></span><?php echo $pizarra->getDesde() ?></li>
            <li><span class="bold"><?php echo __('Hasta: ') ?></span><?php echo $pizarra->getHasta() ?></li>
            <li><span class="bold"><?php echo __('Días: ') ?></span>

                <?php $days_record = explode(",", $pizarra->getDays()); ?>
                <?php foreach ($days_record as $index => $day): ?>
                    <?php if ($day): ?>

                        <?php echo $days_array[$day] . ($index ? ', ' : ''); ?> 


                    <?php endif; ?>
                <?php endforeach; ?>

            </li>
            <br>
            <li><span class="bold"><?php echo __('Mensaje: ') ?></span>
                <p class="mr-span"> </p>
                <?php echo html_entity_decode($pizarra->getText()); ?></li>
        </ul>
    </div>
    <div style="clear: both; height: 1px;"></div>
    <ul class="sf_admin_actions" style="margin-left: 6px !important;">
        <li class="sf_admin_action_list">
            <?php echo link_to('Volver al Listado', '@pizarra', array('class' => 'normal')) ?>
        </li>
    </ul>
</div>