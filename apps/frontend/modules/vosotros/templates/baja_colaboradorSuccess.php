<?php use_stylesheet('caja.css') ?>
<div id="content_vosotros">
    <div id="content_breadcroum">
        <?php echo link_to("inicio", "home/index") ?> >> <?php echo link_to('vosotros', '@vosotros') ?> >> baja de colaborador
    </div>  
    <div style="clear:both"></div>

    <div class="border-box">
        <div class="top-left">
            <div class="top-right">    
                <p>Has seleccionado <strong>darme de baja</strong> de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>.</p>
                <p>¿Estás seguro de que quieres darte de baja de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>? Una vez aceptada, esta acción no podrá deshacerse.</p>
                <div style="text-align: right;">
                    <?php echo link_to_function(__('cancela'), "history.back()") ?>&nbsp;|&nbsp;
                    <?php echo link_to(__('acepta'), url_for('vosotros/do_baja_colaborador')); ?>
                </div>    	
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>	
    <br/>    
</div>