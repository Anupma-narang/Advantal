<?php if(isset($type)):?>
<h3><?php echo $type?></h3>
<?php endif;?>

<?php if ($sf_params->get('action')=='index'): ?>
    <a id="hide_show_filters" class="hide_show_filters_label" href="#" style=" bottom: 0;display: block;float: left;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a><br />
<?php endif ?>