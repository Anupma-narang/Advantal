
<div id="form_voto">
<form action="<?php echo url_for('comunidadprivadareferendum/create?contribucioncp='.$contribucioncp->id)?>" method=post>
<?php echo $form->renderGlobalErrors() ?>
   <?php echo $form->renderHiddenFields() ?>   

<?php echo $form['value'] ?>
<input type="submit" value="<?php echo ("Votar") ?>" />
</form>
</div>