<div id="sf_admin_container">
	<h1>Asignación de caja</h1>
		<div id="Asignacion_puntos_content">
			<div id="Asignacion_puntos_inner">
			<form id="Puntos_form" action="<?php echo url_for('jerarquia/change_caja'); ?>" method="post">
                          <?php echo $form->renderHiddenFields();?>       
                            <fieldset id="sf_fieldset_none">
                                <div class="sf_admin_form_row">
                                    
                                    <div>
                                        <label>Cantidad asignada :</label>
                                        <div class="content"><?php echo $form['cantidad']->render() ?></div>
                                        <?php echo $form['cantidad']->renderError() ?>
                                        
                                    </div>
                                </div>
                                
                                
                                <div class="sf_admin_form_row">
                                    
                                    <div>
                                        <?php //echo $form['usuarios']->renderLabel()?>
                                        <div class="content"><?php //echo $form['usuarios']->render() ?></div>
                                        <?php //echo $form['usuarios']->renderError() ?>
                                        
                                    </div>
                                </div>
                                
                            </fieldset>
                          
                            
                            <p><input type="submit" value="Modificar" />
				
			</form>
			</div>
		</div>	
</div>
