<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cartas/assets') ?>
<div id="sf_admin_container">
<div class="sf_apply sf_apply_settings provider_form">
<span>Indica a continuación el beneficio total que se repartirá entre los ganadores del carta</span>
<?php foreach($concurso->getGanadores() as $i=>$ganador):?>
    <?php if ($i == 0): ?>
        <span class="primer_puesto"><?php echo link_to($ganador['username'], 'sfGuardUser/edit?id='.$ganador['user_id']) ?> con <?php echo $ganador['puntos'] ?> votos (le corresponde el 48% del total)</span>
    <?php elseif ($i == 1): ?>
        <span class="segundo_puesto"><?php echo link_to($ganador['username'], 'sfGuardUser/edit?id='.$ganador['user_id']) ?> con <?php echo $ganador['puntos'] ?> votos(le corresponde el 24% del total)</span>
    <?php elseif ($i == 2): ?>
        <span class="tercer_puesto"><?php echo link_to($ganador['username'], "sfGuardUser/edit?id=".$ganador['user_id']) ?> con <?php echo $ganador['puntos'] ?> votos (le corresponde el 16% del total)</span>
    <?php endif; ?>
<?php endforeach;?>
    <form action="<?php echo url_for('concurso/observed?concurso_id='.$concurso->id)?>"	method="post">
    <?php echo $form->renderGlobalErrors() ?>
	<?php echo $form->renderHiddenFields() ?>
        <?php echo $form?>
    	<input type="submit" value="<?php echo __("Participar en Beneficio") ?>" />
    </form>
</div>
</div>
