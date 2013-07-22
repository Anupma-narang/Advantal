<div id="form_votacion">
<form action="<?php echo url_for('mesa_redondareferendum/create?ponencia='.$ponencia->id) ?>" method=post>
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form->renderHiddenFields() ?>   

    <?php echo $form['value'] ?>
    <input type="submit" value="<?php echo ("Votar") ?>" />
</form>
</div>