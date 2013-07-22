<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>
<div id="sf_admin_container" >
    <h1><?php echo __('Asignación de Jerarquía') ?></h1>
    <h3><?php echo $user->getUsername() ?></h3>
    <form method="POST" id="submit_frm" action="<?php echo url_for('edit_hierarchy', array('id' => $user->getId())) ?>">


        <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_user_id">
            <div>
                <label for="jerarquia_name"><b><?php echo __('Jerarquía'); ?></b></label>
                <div class="content"></div>
                <?php echo $sf_guard_user_profile_form['hierarchy']; ?>
                <?php echo $sf_guard_user_profile_form->renderHiddenFields(); ?>
            </div>
        </div>

        </fieldset>
        <ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
            <li class="sf_admin_action_save">
                <a href="/backend.php/colaboradores">Volver al Listado</a>
                <button type="button" value="Guardar" id="submit_form"><?php echo __('Guardar'); ?></button>

            </li> 
        </ul>
    </form>
</div>

<script type="text/javascript">
    $('document').ready(function(){
    
        $('#submit_form').bind('click',function(){
          <?php
          if($user->getIsDisabled())
          {
            $error = __("No puedes asignar jerarquías a un usuario dado de baja.");
          ?>
            alert('<?php echo $error ?>');
            window.location = '<?php echo url_for("colaboradores/index") ?>';
            return false;
          <?php } ?>
            var confirm_box  = confirm('<?php echo __('¿Estás seguro de que quieres asignar esta Jerarquía a este colaborador?'); ?>');
            if(confirm_box == true){
                $("#submit_frm").submit();
            }
        });
    });
</script>