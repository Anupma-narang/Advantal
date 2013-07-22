<?php use_helper('Date', 'Text', 'Concursos', 'mihelper') ?>
<div id="box_cen_dos_d">
  <?php $text = format_number_choice('[0]0 contribuciones|[1]1 contribución|(1,+Inf]%count% contribuciones', array('%count%' => $contribution_count[0]['c_count']), $contribution_count[0]['c_count']);?>

  <?php echo  link_to($text, url_for_concurso($concurso)); ?>
</div>
<?php if ($sf_user->isAuthenticated()): ?>

  <div id="box_cen_dos_e">
    <?php echo format_number_choice('[0]Tú has contribuido 0 veces|[1]Tú has contribuido 1 vez|(1,+Inf]Tú has contribuido %count% veces', array('%count%' => $contribution_count[0]['c_count']), $contribution_count[0]['c_count'])
    ?>
  </div>
<?php endif; ?>