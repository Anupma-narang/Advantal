<form id="formulario" method="post">
    <table>
		<tbody>
			<tr>
				<td></td><td><?php echo $form->renderGlobalErrors() ?></td>
				<td></td>
			</tr>
			<tr>
				<td width="270"></td>
				<td width="300"><?php if($form['password']->getError()):?>
					<ul class="error_list barra_corta">
						<li><?php echo $form['password']->getError()?></li>
					</ul> <?php endif;?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td><?php echo $form['password']->renderLabel(null, array('class' => 'bundle'))?>
				</td>
                                <?php $passwordClass = ''; ?>
                            <?php if ($form['password']->hasError()): ?>
                                <?php $passwordClass = 'errorchang'; ?>
                            <?php endif; ?>
				<td><?php echo $form['password']->render(array('class' => 'tamano_16_c '.$passwordClass))?></td>
				<td></td>
			</tr>
			<tr>
				<td width="270"></td>
				<td width="300"><?php if($form['new_password']->getError()):?>
					<ul class="error_list barra_corta">
						<li><?php echo $form['new_password']->getError()?></li>
					</ul> <?php endif;?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td><?php echo $form['new_password']->renderLabel(null, array('class' => 'bundle'))?>
				</td>
                                <?php $new_passwordClass = ''; ?>
                            <?php if ($form['new_password']->hasError()): ?>
                                <?php $new_passwordClass = 'errorchang'; ?>
                            <?php endif; ?>
				<td><?php echo $form['new_password']->render(array('class' => 'tamano_16_c '.$new_passwordClass))?></td>
				<td></td>
			</tr>
			<tr>
				<td width="270"></td>
				<td width="300"><?php if($form['new_password2']->getError()):?>
					<ul class="error_list barra_corta">
						<li><?php echo $form['new_password2']->getError()?></li>
					</ul> <?php endif;?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td><?php echo $form['new_password2']->renderLabel(null, array('class' => 'bundle'))?>
				</td>
                                <?php $new_password2Class = ''; ?>
                            <?php if ($form['new_password2']->hasError()): ?>
                                <?php $new_password2Class = 'errorchang'; ?>
                            <?php endif; ?>
				<td><?php echo $form['new_password2']->render(array('class' => 'tamano_16_c '.$new_password2Class))?></td>
				<td></td>
			</tr>			
		</tbody>		
		<tfoot>
	<tr>
		<td colspan="2"><?php echo $form->renderHiddenFields() ?>
			          <?php echo jq_submit_to_remote('ajax_submit', 'guarda', array(
        'url'      	=> url_for("change_pass/index"),
//		'loading' 	=> '$("#Pass_Error").hide(); $("#Pass_Ok").hide(); $("#Pass_Preload").show();$("#Pass_Preload").css("display","inline");$("#Pass_Preload").css("float", "right");',
//        'complete'	=> '$("#Pass_Preload").hide(); $("#Pass_Ok").show()',
        'update'   => array('success' => 'ChangePass_form')
		)) ?>&nbsp;<?php echo link_to_function('cancela', " show_change_password = false;$('#ChangePass_form').hide(); $('#Pass_Ok').hide();")?>
		</td>
	</tr>
	</tfoot>
	</table>
</form>
<style type="text/css">
        input.errorchang{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
    </style>