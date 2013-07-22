<form id='form_order' action="<?php echo url_for('lista_blanca_productos') ?>" method="GET">
    <p>Ordena por: </p>
    <?php echo $sortForm['order']->render()?>
    <span id='order_extended'>
        <?php echo $sortForm['marca']->render(array('maxlength' => 70))?>
        <?php echo $sortForm['modelo']->render(array('maxlength' => 20))?>

    <input id='order_search' type='submit' value='Ordena' />
            </span>

    <?php echo $sortForm['name']->render(); ?>

</form>
<a href='<?php echo url_for('recordar_order_producto')?>' id='remember' title='Vuelve a mi orden predeterminado de productos recomendados'>recuerda orden</a>
<a rel='producto' href='<?php echo url_for('volver_order_producto')?>' id='return_remember' title='Establece como predeterminado este orden de productos recomendados'>mi orden</a>



