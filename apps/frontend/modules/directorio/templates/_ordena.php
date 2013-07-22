<div style="float:left;">
    <form id='form_order' action="<?php echo url_for('@lista_profesional') ?>" method="GET">
        <span>Ordena por: </span>
        <?php echo $sortForm['order']->render(array('style' => 'width:100px')) ?>
        <span id='order_extended'>
            <?php echo $sortForm['states_id']->render(array('style' => 'width:162px')) ?>
            <?php echo $sortForm['city_id']->render(array('style' => 'width:162px')) ?>
            <input id='order_search' type='submit' value='Ordena' />
        </span>
        <?php echo $sortForm['name']->render() ?>
    </form>
</div>
<div class="clear"></div>
<a href='<?php echo url_for('profesional_recordar_order') ?>' id='remember' title='Vuelve a mi orden predeterminado de profesionales recomendados'>recuerda orden</a>
<a rel='profesional' href='<?php echo url_for('volver_order_profesional') ?>' id='return_remember' title='Establece como predeterminado este orden de profesionales recomendados'>mi orden</a>

<script type="text/javascript">
    $(document).ready(function() {
        sortProvinciaList("orderForm_states_id");
        //setTimeout('sortProvinciaList("orderForm_states_id")', 2000);
    });
</script>

