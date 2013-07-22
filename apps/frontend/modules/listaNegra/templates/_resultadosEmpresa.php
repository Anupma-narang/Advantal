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
$ma_ignoreStateList = array("A Coruña", "Albacete", "Alicante", "Almería", "Vitoria-Gasteiz", "Oviedo", "Ávila", "Badajoz", "Barcelona", "Bilbao", "Burgos", "Cáceres", "Cádiz", "Santander", "Castellón de la Plana", "Ceuta", "Ciudad Real", "Córdoba", "Cuenca", "Girona", "Granada", "Guadalajara", "Donostia-San Sebastián", "Huelva", "Huesca", "Palma", "Jaén", "León", "Lleida", "Logroño", "Lugo", "Madrid", "Málaga", "Melilla", "Murcia", "Pamplona/Iruña", "Ourense", "Palencia", "Palmas de Gran Canaria (Las)", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Zamora", "Zaragoza");
?>

<!-- for activity and state_id and location -->
<?php if (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && $ms_values['localidad_id'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $location = CityTable::getInstance()->findOneById($ms_values['localidad_id']); ?>
    <?php if ($location && $location->getIsCapital()): ?>
        <?php $msg = ' de ' . $sectoresActivos['sector3']['texto'] . ' en ' . $location->getName(); ?>
    <?php else: ?>
        <?php $msg = ' de ' . $sectoresActivos['sector3']['texto'] . ' en ' . $location . ' (' . $statename . ')'; ?>
    <?php endif; ?>
    <!-- for subsector and state_id and location -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && $ms_values['localidad_id'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $location = CityTable::getInstance()->findOneById($ms_values['localidad_id']); ?>
    <?php if ($location && $location->getIsCapital()): ?>
        <?php $msg = ' de ' . $sectoresActivos['sector2']['texto'] . ' en ' . $location->getName(); ?>
    <?php else: ?>
        <?php $msg = ' de ' . $sectoresActivos['sector2']['texto'] . ' en ' . $location . ' (' . $statename . ')'; ?>
    <?php endif; ?>
    <!-- for sector and state_id and location -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && $ms_values['localidad_id'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $location = CityTable::getInstance()->findOneById($ms_values['localidad_id']); ?>
    <?php if ($location && $location->getIsCapital()): ?>
        <?php $msg = ' de ' . $sectoresActivos['sector1']['texto'] . ' en ' . $location->getName(); ?>
    <?php else: ?>
        <?php $msg = ' de ' . $sectoresActivos['sector1']['texto'] . ' en ' . $location . ' (' . $statename . ')'; ?>
    <?php endif; ?>
    <!-- for activity and state_id -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $msg = ' de ' . $sectoresActivos['sector3']['texto'] . ' en ' . $statename; ?>
    <!-- for subsector and state_id -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $msg = ' de ' . $sectoresActivos['sector2']['texto'] . ' en ' . $statename; ?>
    <!-- for sector and state_id -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $msg = ' de ' . $sectoresActivos['sector1']['texto'] . ' en ' . $statename; ?>
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
      <?php $msg = ' de ' . $ms_values['name'] . ' en ' . $ms_values['categoria_excelencia']; ?>
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
    <div class="spanMsgThis">Hay <?php echo $pager->count(); ?><?php echo $pager->count() == 1 ? ' empresa o entidad ' : ' empresas y entidades '; ?><?php echo $msg; ?></div>
<?php endif; ?>

<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_negra_empresa', 'params' => array())) ?>
<?php endif; ?>
<?php if ($pager->count() == 0) : ?>
    <p>No hemos encontrado empresas o entidades con esas características.</p>
<?php endif ?>


<?php foreach ($pager as $empresa): ?>
    <?php include_partial('empresa', array('empresa' => $empresa)); ?>
<?php endforeach; ?>


<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_negra_empresa', 'params' => array())) ?>
<?php endif; ?>

<div class='block_reset'>
    <a href='#' id='vuelve_lista' title='Vuelve a la lista negra de empresas y entidades'>vuelve a la lista</a>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.spanMsg').text($('.spanMsgThis').text());
        $('#user_message_ancor').fancybox({padding:5});
        $('.favourit').unbind('click').bind('click', function(){
            var c_id = $(this).data('id');
            $.ajax({
                url: '/empresa/addToFavorite',
                data: {company: c_id},
                success:function(message){
                    $('#user_message_content').html(message);
                    $('#user_message_ancor').trigger('click');
                }
            });
        });
    })
</script>