<ul id="submenu_concursos">
    <li>
        <?php echo link_to(__('Empresa/Entidad'), url_for('user_company_case_study_request'), array('title' => __('Casos de empresa/entidad'))); ?>
    </li>
    <li>
        <?php echo link_to(__('Producto'), url_for('user_product_case_study_request'), array('title' => __('Casos de product'))); ?>
    </li>
</ul>
<?php echo image_tag('check_red.gif') ?> <?php echo __('Revista') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_blue.gif') ?> <?php echo __('Tramitado ') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('check_green.gif') ?> <?php echo __('Cerrado') ?>
<br><br>