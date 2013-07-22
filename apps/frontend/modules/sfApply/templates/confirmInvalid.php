<?php use_stylesheet('caja.css') ?>
<?php use_helper('I18N') ?>
<div>
    <div class="border-box">
        <div class="top-left">
            <div class="top-right">
                <p>Este código de confirmación <strong>no es válido.</strong></p>
                <p>Esto se puede deber a que ya has confirmado tu cuenta de colaborador. Si es así, haz clic en "entra en auditoscopia".</p>
                <p><strong>Otras posibles razones</strong> para que no funcione son:</p>
                <p>
                <ul>
                    <li>Si has copiado la URL de tu correo de confirmación, por favor, asegúrate de que es correcta y está completa.<br /><br /></li>
                    <li>Si has recibido el correo de confirmación hace demasiado tiempo y nunca has confirmado tu cuenta, es posible que haya sido eliminada. En este caso, necesitas crear una nueva cuenta.</li>
                </ul>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>

    <?php include_partial('sfApply/continue') ?>
</div>
