<?php if (isset($type)): ?>
    <h3><?php echo $type ?></h3>
<?php endif; ?>

<?php if ($sf_params->get('action') == 'index'): ?>
    <?php echo image_tag('check_green.gif') ?> <?php echo __('Destacado de la semana') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_blue.gif') ?> <?php echo __('Destacado del mes') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_red.gif') ?> <?php echo __('Destacado del año') ?>
    <br><br>
    <div>
        <div style="width:100%; padding-bottom: 8px;">
            <a id="hide_show_filters" href="#" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%; outline:none;"><strong>Esconder/Mostrar filtros</strong></a>
        </div>
    </div>
<?php endif; ?>