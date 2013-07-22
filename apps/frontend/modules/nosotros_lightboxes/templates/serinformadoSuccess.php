<?php slot('tamano', 'scroll');?>
<?php use_helper('alternativeLink');?>
<h1>Deseo ser informado cada vez que...</h1>
<section class="border-box-n" style="padding-bottom: 25px;">
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Te informamos <strong>mediante un correo electrónico</strong> cada vez que:
            </p>
            <ul>
                <li>
                    Un <strong>concurso</strong> en el que contribuyes <strong>finaliza en 3 días.</strong>
                </li>
                <li>
                    El <strong>Referéndum</strong> de un concurso en el que contribuyes <strong>finaliza en 2 días</strong>, si aún no has votado.
                </li>
                <li>
                    <strong>Participas en beneficio.</strong>
                </li>
                <li>
                    <strong>Haces caja.</strong>
                </li>
                <li>
                    <strong>Cambias de Jerarquía.</strong>
                </li>
            </ul>
            <p>
                Además, <strong>tú eliges si deseas ser informado</strong> cada vez que:
            </p>
            <ul>
                <li>
                    Un colaborador <strong>contribuye en un concurso</strong> creado por ti.
                </li>
                <li>
                    Se crea un nuevo <strong>concurso para tu empresa o entidad favorita</strong> en tu localidad.
                </li>
                <li>
                    Se crea un nuevo <strong>concurso para tu producto favorito.</strong>
                </li>
                <li>
                    Se <strong>publica en la lista blanca</strong> una empresa, entidad o producto en cuyo concurso has contribuido.
                </li>
                <li>
                    Se <strong>publica en la lista negra</strong> una empresa, entidad o producto en cuyo concurso has contribuido.
                </li>
                <li>
                    Se <strong>recomienda o desaprueba en el Directorio de buenos profesionales</strong> a un profesional recomendado por ti.
                </li>
            </ul>
            <h2>
                ¿Cómo puedes darte de alta o baja de estos mensajes?
            </h2>
            <ul>
                <li>
                    <strong>Alta/baja:</strong> entra en <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vosotros/micuenta", "Mi cuenta", "guard/login", array('title' => 'Mi cuenta', 'target'=>'_blank'), array('title' => 'Mi cuenta', 'target'=>'_blank')) ?>-Deseo ser informado cada vez que... e indica qué mensajes quieres recibir.
                </li>
                <li>
                    <strong>Baja</strong>: haz clic en <strong>no quiero recibir más este mensaje</strong>, al recibir alguno.
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<div class="pxh20"></div>