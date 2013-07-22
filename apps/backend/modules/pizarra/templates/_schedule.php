<?php $days_array = array(
          1=>__('Lunes'), 
          2=>__('Martes'), 
          3=>__('Miércoles'),
          4=>__('Jueves'),
          5=>__('Viernes'),
          6=>__('Sábado'),
          7=>__('Domingo'));
      $months_array = array(
          1=>__('Enero'), 
          2=>__('Febrero'), 
          3=>__('Marzo'),
          4=>__('Abril'),
          5=>__('Mayo'),
          6=>__('Junio'),
          7=>__('Julio'),
          8=>__('Agosto'),
          9=>__('Septiembre'),
          10=>__('Octubre'),
          11=>__('Noviembre'),
          12=>__('Diciembre')
          );
    ?>
<table  cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><?php echo __('Desde ') . date('d-m-Y H:i:s', strtotime($pizarra->getDesde())) ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo  __(' Hasta ') . date('d-m-Y H:i:s', strtotime($pizarra->getHasta()))?></td>
  </tr>
  <tr>
    <td>
      <table  cellspacing="0" cellpadding="0" border="0px">
        <?php $days_record = explode(",", $pizarra->getDays());?>
        <?php foreach($days_record as $index => $day):?>
         <?php if($day):?>
        <tr><td>
            <?php echo $days_array[$day];?> 
          </td></tr>
         
         <?php endif;?>
        <?php endforeach;?>
      </table>
    </td>
    <td>
      <table  cellspacing="0" cellpadding="0">
        <?php $months_record = explode(",", $pizarra->getMonths());?>
        <?php foreach($months_record as $index => $month):?>
         <?php if($month):?>
                <tr><td>
                    <?php echo $months_array[$month];?>
                  </td></tr>
          
         <?php endif;?>
        <?php endforeach;?>
      </table>
    </td>
  </tr>
  
</table>