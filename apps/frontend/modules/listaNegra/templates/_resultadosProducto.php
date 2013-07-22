<?php use_stylesheet("/css/fancybox/jquery.fancybox.css") ?>
<?php use_stylesheet("/css/box_style.css") ?>
<script type="text/javascript">
    $(function () {
        $('#content_laslistas_right #content-results').hide();
        $('#content_laslistas_right #content-results:first').show();
    })
</script>

<?php
$msg = "null";
$ms_values = $sf_data->getRaw("ms_values");
unset($ms_values["from"]);
$sectoresActivos = $sf_data->getRaw("sectoresActivos");
?>
<!-- for activity and marca and modelo -->
<?php if (isset($sectoresActivos['sector1']) && $ms_values['marca'] != "" && $ms_values['modelo'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector3']['texto'] . ' con marca ' . $ms_values['marca'] . ' y modelo ' . $ms_values['modelo']; ?>   
    <!-- for subsector and marca and modelo -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['marca'] != "" && $ms_values['modelo'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector2']['texto'] . ' con marca ' . $ms_values['marca'] . ' y modelo ' . $ms_values['modelo']; ?>   
    <!-- for sector and marca and modelo -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['marca'] != "" && $ms_values['modelo'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector1']['texto'] . ' con marca ' . $ms_values['marca'] . ' y modelo ' . $ms_values['modelo']; ?>   
    <!-- for activity and modelo -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['modelo'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector3']['texto'] . ' con modelo ' . $ms_values['modelo']; ?>
    <!-- for subsector and modelo -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['modelo'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector2']['texto'] . ' con modelo ' . $ms_values['modelo']; ?>
    <!-- for sector and modelo -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['modelo'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector1']['texto'] . ' con modelo ' . $ms_values['modelo']; ?>   
    <!-- for activity and marca -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['marca'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>    
    <?php $msg = ' en ' . $sectoresActivos['sector3']['texto'] . ' de la marca ' . $ms_values['marca']; ?>
    <!-- for subsector and marca -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['marca'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>    
    <?php $msg = ' en ' . $sectoresActivos['sector2']['texto'] . ' de la marca ' . $ms_values['marca']; ?>
    <!-- for sector and marca -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['marca'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>    
    <?php $msg = ' en ' . $sectoresActivos['sector1']['texto'] . ' de la marca ' . $ms_values['marca']; ?>
    <!-- for sector -->
<?php elseif (isset($sectoresActivos['sector1']) && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector1']['texto']; ?>
    <!-- for subsector -->
<?php elseif (isset($sectoresActivos['sector1']) && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector2']['texto']; ?>
    <!-- for activity -->
<?php elseif (isset($sectoresActivos['sector1']) && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector3']['texto']; ?>
    <!-- for Empresa/Entidad and Categoria excelencia-->
<?php elseif (count(array_filter($ms_values)) > 1): ?>
    <?php $msg = ' con esas características'; ?>
    <?php /* elseif ($ms_values['name'] != "" && $ms_values['categoria_excelencia'] != ""): ?>
      <?php $msg = ' en ' . $ms_values['name'] . ' en ' . $ms_values['categoria_excelencia']; ?>
      <!-- for Empresa/Entidad -->
      <?php elseif ($ms_values['name'] != ""): ?>
      <?php $msg = ' con ' . $ms_values['name']; ?>
      <!-- for Categoria excelencia -->
      <?php elseif ($ms_values['categoria_excelencia'] != ""): ?>
      <?php $msg = ' con ' . $ms_values['categoria_excelencia']; */ ?>
<?php else: ?>
    <?php $msg = ' en la Lista negra'; ?>
<?php endif; ?>
<?php if ($msg != 'null'): ?>    
    <div class="spanMsgThis">Hay <?php echo $pager->count(); ?><?php echo $pager->count() == 1 ? ' producto ' : ' productos '; ?><?php echo $msg; ?></div>
<?php endif; ?>

<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_negra_producto', 'params' => array())) ?>
<?php endif; ?>
<?php if ($pager->count() == 0) : ?>
    <p>No hemos encontrado productos con esas características.</p>
<?php endif ?>


<?php foreach ($pager as $producto): ?>
    <?php include_partial('producto', array('producto' => $producto)); ?>
<?php endforeach; ?>


<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_negra_producto', 'params' => array())) ?>
<?php endif; ?>

<div class='block_reset'>
    <a href='#' id='vuelve_lista' title='Vuelve a la lista negra de productos'>vuelve a la lista</a>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.spanMsg').text($('.spanMsgThis').text());
        $('#user_message_ancor').fancybox({padding:5});
        $('.favourit').bind('click', function(){
            var c_id = $(this).data('id');
            $.ajax({
                url: '/producto/addToFavorite',
                data: {product: c_id},
                success:function(message){
                    $('#user_message_content').html(message);
                    $('#user_message_ancor').trigger('click');
                }
            });
        });
    })
</script>