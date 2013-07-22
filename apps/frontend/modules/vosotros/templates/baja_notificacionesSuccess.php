<div align="center">
    <h1>Solicitud de baja de notificaciones</h1>
    <?php
    if ($sf_params->get('tipo') == 'publica_recomend_disaprov_value')
        echo "Has escogido no recibir más este mensaje.";
    else
        echo "Ya no recibirá más este mensaje en su cuenta de correo electrónico";
    ?>

</div>