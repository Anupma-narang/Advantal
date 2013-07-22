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
    <?php $msg = ' en la Lista blanca'; ?>
<?php endif; ?>
<?php if ($msg != 'null'): ?> 
    <?php
    if ($productosDestacados->count() > 0) {
        $totRes = $pager->count() + $productosDestacados->count();
    } else {
        $totRes = $pager->count();
    }
    ?>
    <div class="spanMsgThis">Hay <?php echo $totRes; ?><?php echo $totRes == 1 ? ' producto ' : ' productos '; ?><?php echo $msg; ?></div>
<?php endif; ?>

<?php if ($pager->count() == 0 && $productosDestacados->count() == 0) : ?>
    <?php if ($buscandoPorSector) : ?>
        <p>Aún no hemos publicado ningun producto en este apartado. Si crees que alguno merece estar aquí ¡<a href='<?php echo url_for('concurso/new?tipo=producto') ?>'>crea un concurso</a>!</p>

    <?php else : ?>
        <p>No hemos encontrado productos con esas características.</p>
    <?php endif ?>
<?php endif ?>

<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => 'lista_blanca_productos', 'params' => array())) ?>
<?php endif; ?>

<?php if ($productosDestacados->count() > 0) : ?>
    <div class='empresas_destacadas'>
        <h2>Productos destacados</h2>
        <?php $emp_cnt = 1; ?>
        <?php foreach ($productosDestacados as $producto) : ?>
            <?php include_partial('producto', array('producto' => $producto, 'key' => $emp_cnt)); ?>
            <?php $emp_cnt++; ?>
        <?php endforeach ?>
        <div class='clear'></div>
    </div>
<?php endif ?>

<?php foreach ($pager as $producto): ?>
    <?php include_partial('producto', array('producto' => $producto)); ?>
<?php endforeach; ?>

<div class='block_reset'>
    <a href='#' id='vuelve_lista' title='Vuelve a la lista blanca de productos'>vuelve a la lista</a>
</div>
<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => 'lista_blanca_productos', 'params' => array())) ?>
<?php endif; ?>
<script type='text/javascript'>
    $(function () {
        $('.dynamicBar').sparkline('html', {
            type:'bar',
            barColor:'green',
            colorMap:{
                '1':'#429D29',
                '2':'#B41B1D',
                '3':'#BEC1C4',
                '4':'#F65E13'
            },
            tooltipFormat:'{{value:levels}}',

            tooltipValueLookups:{
                levels:{ '1':'Sin medalla', '2':'Bronze', '3':'Plata', '4':'Oro' }
            }
        });

    })
</script>
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