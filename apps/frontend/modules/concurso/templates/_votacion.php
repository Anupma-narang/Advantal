<?php $eid = $contribucion->getId() . ($contribucion->getDestacado() ? 'D' : ''); ?>

<div class="votacion" title="Vota en el Referéndum de este concurso">
  <?php if ($puntos): ?>
    <p>
      <?php print format_number_choice('[0]Has votado esta contribución con 0 puntos.|[1]Has votado esta contribución con 1 punto.|(1,+Inf]Has votado esta contribución con %count% puntos.', array('%count%' => $puntos), $puntos) ?>
    <div class="num_colaboradores_han_votado">
      <?php print format_number_choice('[0]Han votado 0 colaboradores.|[1]Ha votado 1 colaborador.|(1,+Inf]Han votado %%count%% colaboradores.', array('%%count%%' => $numero_votantes), $numero_votantes) ?>
    </div>
  </p>
<?php else: ?>
  <div id="Form_voto_<?php print $eid ?>" style="float: right">
    <a name="Form_voto_<?php print $eid ?>"></a>
    <?php if (($sf_user->isAuthenticated()) && ($contribucion->getUserId() == $sf_user->getGuardUser()->getId())): ?>
      <?php echo __('Tu contribución:') ?>
    <?php else: ?>
      <?php echo __('Vota:') ?>
    <?php endif; ?>

    <form id="Votacion_form_<?php echo $eid ?>">
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['value']->render() ?>
    </form>
    <div style="clear:both" class="num_colaboradores_han_votado">
      <?php print format_number_choice('[0]Han votado 0 colaboradores|[1]Ha votado 1 colaborador|(1,+Inf]Han votado %%count%% colaboradores', array('%%count%%' => $numero_votantes), $numero_votantes) ?>
    </div>
  </div>
  <a href="#contribucion_destacada_top" id="scroll_anchor" class="hidden">scroll</a>
  <script>
    $(document).ready(function() {
      $('#Votacion_form_<?php echo $eid ?> :input').click(function(){
  <?php if (!$sf_user->isAuthenticated()): ?>
          $.fancybox({beforeLoad : function() {
              this.content = $("#login_required_box").html().replace("[title]", "Para <strong>votar en un concurso</strong> necesitas ser colaborador.").replace("[href]", "/guard/login?redirect="+encodeURI("<?php print sfContext::getInstance()->getRequest()->getUri() ?>")+"?cnt=<?php echo $eid ?>");
            }});
  <?php elseif (($sf_user->isAuthenticated()) && ($contribucion->getUserId() == $sf_user->getGuardUser()->getId())): ?>
          $.fancybox({content: $('#Cant_vote_myself'),padding: 0});
  <?php elseif (!$sf_user->canVotedContribucion($contribucion)): ?>
          $.fancybox({content: $('#Not_contri_dialog_votacion'),padding: 0});
  <?php elseif ($sobrepasa_limite_votos): ?>
          $.fancybox({content: $('#Too_many_votes_dialog'),padding: 0});
  <?php else: ?>
          jQuery.ajax({
            url: '<?php echo url_for('concursoreferendum/create?contribucion_id=' . $contribucion->getId()) ?>',
            type:'POST',
            dataType:'html',
            data:jQuery(this.form.elements).serialize(),
            success:function(data, textStatus){ 
              $.ajax({
                url: '/vosotros/getCashUpdates',
                type: 'GET',
                data: { points: true},
                success:function(html_content){
                  $('#point-log').html(html_content);
                }
              });
              jQuery('#Form_voto_<?php echo $eid ?>').html(data); 
            }
                
                
          });
  <?php endif; ?>
        $('.concurso_referendum_value_'+$(this).val()).attr('checked', false);});
      $(".num_colaboradores_han_votado").text('<?php print format_number_choice('[0]Han votado 0 colaboradores.|[1]Ha votado 1 colaborador.|(1,+Inf]Han votado %%count%% colaboradores.', array('%%count%%' => $numero_votantes), $numero_votantes) ?>');
           
    });
    $(document).ready(function() {
              
      /*if(<?php echo $sf_request->getParameter('scroll') ? '1' : '0' ?>){
        $('#scroll_anchor').bind('click', function (e) {
          window.location.href = this.href;
        }); 
        $('#scroll_anchor').click();
            
              
      }*/
    });
            
              
  </script>
<?php endif; ?>
</div>
<div style="display: none"><div id="Not_contri_dialog_votacion"><div class="border-box"><div class="top-left"><div class="top-right">
          <p>Para votar en un concurso necesitas haber contribuido en el mismo</p>
        </div></div><div class="bottom-left"><div class="bottom-right"></div></div></div></div></div>
<div style="display: none"><div id="Too_many_votes_dialog"><div class="border-box"><div class="top-left"><div class="top-right">
          <p>Ya has usado tus 5 votos.</p> 
          <p>Gracias por votar.</p>
        </div></div><div class="bottom-left"><div class="bottom-right"></div></div></div></div></div>
<div style="display: none"><div id="Cant_vote_myself"><div class="border-box"><div class="top-left"><div class="top-right">
          <p>No puedes votar tus propias contribuciones</p>
        </div></div><div class="bottom-left"><div class="bottom-right"></div></div></div></div></div>
