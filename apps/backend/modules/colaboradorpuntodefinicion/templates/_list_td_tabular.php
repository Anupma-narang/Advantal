<td class="sf_admin_text sf_admin_list_td_codigo">
    <?php echo $colaboradorpuntodefinicion->getCodigo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_descripcion">
    <?php echo $colaboradorpuntodefinicion->getDescripcion() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_automatic">
    <?php echo get_partial('colaboradorpuntodefinicion/list_field_boolean', array('value' => $colaboradorpuntodefinicion->getIsAutomatic())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_puntos">
    <?php echo number_format($colaboradorpuntodefinicion->getPuntos(), 0, '.', '.'); ?>
</td>
