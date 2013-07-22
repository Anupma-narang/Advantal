<form id='form_order' action="<?php echo url_for('@lista_blanca_empresa') ?>" method="GET">
    <p>Ordena por: </p>
    <?php echo $sortForm['order']->render()?>
    <span id='order_extended'>
        <?php echo $sortForm['states_id']->render()?>
        <?php echo $sortForm['localidad_id']->render()?>
        <input id='order_search' type='submit' value='Ordena' />
    </span>

    <?php echo $sortForm['name']->render()?>

</form>
<a href='<?php echo url_for('recordar_order')?>' id='remember' title='Vuelve a mi orden predeterminado de empresas y entidades recomendadas'>recuerda orden</a>
<a rel='empresa' href='<?php echo url_for('volver_order_empresa')?>' id='return_remember' title='Establece como predeterminado este orden de empresas y entidades recomendadas'>mi orden</a>


<script type="text/javascript">
        $(document).ready(function(){
            sortProvinciaList("orderForm_states_id");
        });
    </script>
