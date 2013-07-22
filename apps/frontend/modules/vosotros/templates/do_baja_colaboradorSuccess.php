<?php use_stylesheet('caja.css') ?>
<?php use_stylesheet('forms.css') ?>
<?php //use_javascript('jquery.custom_radio_checkbox.js')           ?>
<?php //use_stylesheet('jquery.custom_radio_checkbox.css')           ?>

<div id="content_vosotros">
    <div id="content_breadcroum">
        <?php echo link_to("inicio", "home/index") ?> >> <?php echo link_to('vosotros', '@vosotros') ?> >> <?php echo link_to('baja de colaborador', 'vosotros/baja_colaborador') ?> >> procesar baja
    </div>
    <div style="clear:both"></div>
    <?php include_partial('global/flashes') ?>
    <br/>
    <div class="border-box">
        <div class="top-left">
            <div class="top-right">
                <p>
                    Hola
                    <span style="font-weight: bold; color: #2F4F4F;"><?php echo $sf_user->getGuardUser()->getUsername() ?></span>:
                </p>
                <p>
                    Antes de que nos dejes definitivamente, nos gustaría <strong>pedirte
                        1 minuto</strong> para contestar este cuestionario y ayudarnos a
                    mejorar:
                </p>
                <p>
                    <strong>¿Te has dado de baja de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> por algunas de las
                        siguientes razones?</strong> (escoge tantas como quieras):
                </p>
                <form
                    action="<?php echo url_for('vosotros/parse_baja_colaborador') ?>"
                    method="GET">
                    <table>
                        <tbody>
                            <?php foreach ($preguntas as $p): ?>
                                <tr>
                                    <?php if ($p->getCuestionarioValuesTypes()->getCode() == 'bool'): ?>
                                        <td width="471">
                                            <label class="bundle" for="pregunta_<?php echo $p->getId() ?>"><?php echo $p ?></label>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="pregunta_<?php echo $p->getId() ?>">
                                        </td>
                                    <?php elseif ($p->getCuestionarioValuesTypes()->getCode() == 'str'): ?>
                                        <td colspan="2">
                                            <br/><label class="bundle" for="pregunta_<?php echo $p->getId() ?>"><?php echo $p ?></label><br/>
                                            <ul id="Text_pregunta_<?php echo $p->getId() ?>_error" class="error_list" style="display:none">
                                                <li>Has superado el espacio permitido.</li>
                                            </ul>
                                            <textarea class="textarea_pregunta" id="Text_pregunta_<?php echo $p->getId() ?>" name="pregunta_<?php echo $p->getId() ?>" rows=5 cols=70></TEXTAREA>
                                                                                        								</td>
                                    <?php else: ?>
                                                                                        								<td colspan="2">
                                                                                        									<label class="bundle" for="pregunta_<?php echo $p->getId() ?>"><?php echo $p ?></label>
                                                                                        									<input type="text" size="10" name="pregunta_<?php echo $p->getId() ?>">
                                                                                        								</td>
                                    <?php endif; ?>
                                            							</tr>
                            <?php endforeach; ?>
						</tbody>
					</table>
					<br/>
					<p>¡Muchas gracias por haber contribuido con nosotros y esperamos
						verte otra vez en breve!</p>
					<br>
					<div style="text-align: right;">
						<input type="submit" value="<?php echo __('confirma') ?>" />&nbsp;
                        <?php echo link_to(__('cancela'), '/vosotros/micuenta') ?>
					</div>
				</form>
			</div>
		</div>
		<div class="bottom-left">
			<div class="bottom-right"></div>
		</div>

	</div>
</div>

<script type="text/javascript">
    $.each($(".textarea_pregunta"), function(key, value) {
        $(this).keydown(function(e, key, value) {
            var keycode = (e.keyCode ? e.keyCode : (e.which ? e.which : e.charCode));
            var text = $(this).val();
            console.log(text.length);
            if ((text.length > 1000) && (keycode != 8)) {
                $("#" + $(this).attr('id') + "_error").show();
                return false;
            }
            else {
                $("#" + $(this).attr('id') + "_error").hide();
            }
        });
    });
</script>
