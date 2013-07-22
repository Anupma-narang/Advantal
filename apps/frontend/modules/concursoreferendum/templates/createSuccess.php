<?php
$eid = $contribucion->getId() . ($contribucion->getDestacado() ? 'D' : '');
$has_votado_msg = format_number_choice('[0]Has votado esta contribución con 0 puntos.|[1]Has votado esta contribución con 1 punto.|(1,+Inf]Has votado esta contribución con %count% puntos.', array('%count%' => $puntuacion), $puntuacion);
?><p>
<div id="Voto_dialog_<?php print $eid ?>" class="bocadillo">
  <span style="float: right;"><?php echo link_to_function(image_tag('/images/close.png'), "$('#Voto_dialog_$eid').hide('slow');$('#hasvotado$eid').show();") ?></span>
  <p><?php print $has_votado_msg ?></p>
</div>
<span id="hasvotado<?php print $eid ?>"><?php print $has_votado_msg ?></span><br/>
<span class="num_colaboradores_han_votado">
  <?php print format_number_choice('[0]Han votado 0 colaboradores|[1]Ha votado 1 colaborador|(1,+Inf]Han votado %%count%% colaboradores', array('%%count%%' => $numero_votantes), $numero_votantes) ?>
</span>
</p>
<a href="#Flash" id="flash_anchor" style="display: hidden"></a>
<script>
  $(document).ready(function(){
    $("#flash_anchor").bind('click', function(){
      window.location.href = $(this).attr('href');
    });
  });
  $("#hasvotado<?php print $eid ?>").hide();
  $(".concurso_referendum_<?php echo $puntuacion ?>").hide();
  setTimeout("$('#Voto_dialog_<?php print $eid ?>').hide('slow');$('#hasvotado<?php print $eid ?>').show();", 4000);
    
  $(".num_colaboradores_han_votado").text('<?php print format_number_choice('[0]Han votado 0 colaboradores|[1]Ha votado 1 colaborador|(1,+Inf]Han votado %%count%% colaboradores', array('%%count%%' => $numero_votantes), $numero_votantes) ?>');
    
<?php if ($numero_votos_usuario >= 5): ?>
    var flash='<div class="top-left"><div class="top-right"><div class="close" title="cierra este mensaje"></div><div class="flash_notice"> Has utilizado los 5 votos posibles para este concurso.</div></div></div><div class="bottom-left"><div class="bottom-right"></div></div></div>';
    $('#Flash').html(flash);
    $('.close').click(function(){
      $('#Flash').hide();
    });
      
    setTimeout(function(){
      $('#flash_anchor').trigger('click');
    },3000);
    /*$('html,body').animate({
          scrollTop: 0
      }, 2000);*/
<?php endif; ?>
</script>
