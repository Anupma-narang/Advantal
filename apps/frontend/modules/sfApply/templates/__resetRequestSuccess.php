<?php use_helper('I18N') ?>
<?php slot('sf_apply_login') ?>
<?php end_slot() ?>
<div id="formUser"> 
    <!--<div class="sf_apply sf_apply_reset_request">-->
    <form method="POST" action="<?php echo url_for('sfApply/resetRequest') ?>" name="sf_apply_reset_request" id="sf_apply_reset_request">
        <table border="0" width="600" align="center">
            <tfoot>
                <tr>
                    <td colspan="2" align="left">
                        <input type="submit" value="<?php echo __("Resetea mi password") ?>"> 
                        <?php echo __("o") ?> 
                        <?php echo link_to(__('Cancelar'), sfConfig::get('app_sfApplyPlugin_after', '@homepage')) ?>
                    </td>   </tr>
            </tfoot>
            <tbody><tr><td><?php echo __(<<<EOM
Si has olvidado tu usuario o password? No hay problema! Introduce tu usuario <strong>or</strong>
tu mail y haz clic en "Reseta mi password." Recibirás un mail conteniendo tu usuario y un link que te permitirá cambiar
la password si lo deseas.
EOM
                        ) ?>
                    </td>
                </tr>
                <tr align="left"> <td colspan="2"> Introduce Usuario ó Email*  <span class="rojo">

<?php if ($form['username_or_email']->renderError()): {
        echo "Contenido obligatorio";
    } endif; ?>

                        </span>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    </td></tr>
                <tr align="left"> 
                    <td>
                       
                        <?php echo $form['username_or_email'] ?>
                    </td>
                </tr> 

            </tbody></table>

    </form>
</div>
