<form id='form_order' action="<?php echo url_for('@lista_negra_producto') ?>" method="GET">
    <p>Ordena por: </p>
    <?php echo $sortForm['order']->render(array('class' => 'order_prodcuto'))?>
    <span id='order_extended'>
        <?php echo $sortForm['marca']->render(array('maxlength' => 70))?>
        <?php echo $sortForm['modelo']->render(array('maxlength' => 20))?>
    </span>
    <?php echo $sortForm['name']->render(); ?>

    <input id='order_search' type='submit' value='Ordena' />
</form>
<a href='<?php echo url_for('recordar_order_lista_negra',  array('tipo' => 'producto'))?>' id='remember' title='Vuelve a mi orden predeterminado de productos no recomendados'>recuerda orden</a>
<a href='<?php echo url_for('volver_order_lista_negra', array('tipo' => 'producto'))?>' id='return_remember' title='Establece como predeterminado este orden de productos no recomendados'>mi orden</a>


