
<?php slot('tamano', 'pequeno');?>
<section class="border-box-n pequeno">
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p><?php echo htmlspecialchars_decode($texto); ?>.</p>
            <ul class="bundle">
                <li>
                    <?php echo link_to('ya soy colaborador.', url_for('guard/login').($sf_params->get('redirect') ? ('?redirect='.$sf_params->get('redirect')) : ''), array('title'=>'ya soy colaborador','target'=>'_parent')) ?>
                </li>
                <li>
                    ¿Aún no eres colaborador? ¡<?php echo link_to('Crea una cuenta', '@apply', array('title'=>'Crea una cuenta','target'=>'_parent')) ?> ahora!
                </li>
            </ul>
            <br/>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
