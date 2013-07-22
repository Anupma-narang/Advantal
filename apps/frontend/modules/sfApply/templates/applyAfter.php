<?php use_stylesheet('caja.css')?>
<div>
	<div class="border-box">
		<div class="top-left">
			<div class="top-right">
				<p>Gracias por crear una cuenta en <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>.</p>
				<p>Por favor, comprueba el mensaje que has recibido en tu correo electrónico para <strong>confirmar que quieres ser colaborador</strong>.</p>
                                <?php echo link_to('vuelve a auditoscopia sin confirmar alta','@homepage')?>
                                <br/>
                                
                        </div>
		</div>
		<div class="bottom-left">
			<div class="bottom-right"></div>
		</div>
	</div>
	<br/>
	
	<?php //include_partial('sfApply/continue') ?>
</div>
