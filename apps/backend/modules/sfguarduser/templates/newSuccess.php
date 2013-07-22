<div id="sf_admin_container">

    <h1>Nuevo colaborador</h1>
    <?php if ($add_more): ?><div class="notice">El elemento se ha creado correctamente y ahora puede crear otro elemento.</div><?php endif ?>
    <div id="sf_admin_header"></div>
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <form method="post" action="<?php echo url_for('@sfguarduser_action_new') ?>">
                <?php echo $form->renderHiddenFields(); ?>

                <fieldset id="sf_fieldset_usuario">
                    <h2 style="font-weight: bold;font-size: 16px">Usuario</h2>
                    <?php include_partial('flashes'); ?>
                    <?php
                    $fields = array(
                        'username', 'email_address', 'email_address_again', 'password', 'password_again'
                    );
                    ?>

                    <?php foreach ($fields as $field): ?>
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_<?php echo $field ?> <?php if ($form[$field]->hasError()): ?>errors<?php endif ?>">
                            <?php echo $form[$field]->renderError() ?>
                            <div>
                                <?php echo $form[$field]->renderLabel() ?>
                                <div class="content">
                                    <?php echo $form[$field]->render() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </fieldset>

                <fieldset id="sf_fieldset_privilegios">
                    <h2 style="font-weight: bold;font-size: 16px">Privilegios</h2>
                    <?php
                    $fields_privilegios = array(
                        'is_active', 'is_disabled', 'permissions_list'
                    );
                    ?>

                    <?php foreach ($fields_privilegios as $field): ?>
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_<?php echo $field ?> <?php if ($form[$field]->hasError()): ?>errors<?php endif ?>">
                            <?php echo $form[$field]->renderError() ?>
                            <div>
                                <?php echo $form[$field]->renderLabel() ?>
                                <div class="content">
                                    <?php echo $form[$field]->render() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </fieldset>

                <ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
                    <li class="sf_admin_action_list">
                        <a href="/backend.php/sfguarduser">Volver al Listado</a>
                    </li>
                    <li class="sf_admin_action_save">
                        <input type="submit" value="Guardar">
                        <input type="submit" value="Guardar y crear otro" name="add_more">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
<style>
    #sf_admin_container label{
        width:13em!important;
    }
    #sf_admin_container .sf_admin_form_field_permissions_list label{
        font-weight: bold !important;
    }
</style>