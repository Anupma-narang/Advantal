<div id="sf_admin_container">
    <h1>Editar colaborador</h1>
    <?php if ($created_ok): ?><div class="notice">El elemento se ha creado correctamente.</div><?php endif ?>
    <div id="sf_admin_header"></div>
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <form method="post" action="<?php echo url_for('@sfguarduser_action_edit?id=' . $id) ?>" enctype="multipart/form-data">
                <?php echo $form->renderHiddenFields(false); ?>

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

                <fieldset id="sf_fieldset_perfil">
                    <h2 style="font-weight: bold;font-size: 16px">Perfil</h2>

                    <?php
                    $fields = array(
                        'name', 'surname1', 'surname2', 'sex', 'fecha_nac', 'formacion_academica_id', 'colaborador_nivel_uno_id',
                        'colaborador_nivel_dos_id', 'direccion', 'numero', 'piso', 'puerta', 'cp', 'states_id', 'city_id',
                        'telefono', 'image'
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
                                    <?php 
                                          if($field  == "permissions_list")
                                          {
                                            $fieldId= "permission";
                                          }                                          
                                          else if($field  == "is_disabled")
                                          {
                                            $fieldId = "status";
                                          }
                                    ?>
                                    <?php echo $form[$field]->render(array('id' => (isset($fieldId) ? $fieldId: '')) ) ?>
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
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    if($("#status").is(':checked'))
    {
      $("#permission").parent().parent().parent().hide();
    }

    $("#status").click(function(){
      if($(this).is(':checked'))
      {
        $("#permission").parent().parent().parent().hide();
      }else
      {
        $("#permission").parent().parent().parent().show();
      }
    });

    
    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
    foreach (StatesTable::getCiudadesAutonomas() as $city)
        printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
        ?>

                if (state2city[f.val()])
                    g.val(state2city[f.val()]).attr("disabled", "disabled");
            }
            
    function disable_nivel2(f, g) {
<?php // Amas de casa(22),Desempleados(23),Estudiantes(24) y otros(25)   ?>
        g.attr("disabled", f.val() == 22 || f.val() == 23 || f.val() == 24 || f.val() == 25);
    }

    $(document).ready(function() {
        sortProvinciaList("sf_guard_user_states_id");

        $("form").bind("submit", function() {
            $("#sf_guard_user_city_id").removeAttr("disabled");
        });
        var emailold = $('#sf_guard_user_email_address').val();
        $('#sf_guard_user_email_address_again').val(emailold);

        if ($('#sf_guard_user_states_id option:selected').text() == 'Madrid') {
            $('#sf_guard_user_states_id option:selected').removeAttr("selected");
        }
        $("#sf_guard_user_states_id").change(function() {
            ceuta_melilla($(this), $("#sf_guard_user_city_id"))
        });
        $("#sf_guard_user_colaborador_nivel_uno_id").bind("change", function() {
            disable_nivel2($(this), $("#sf_guard_user_colaborador_nivel_dos_id"));
        });
        ceuta_melilla($("#sf_guard_user_states_id"), $("#sf_guard_user_city_id"));
        disable_nivel2($("#sf_guard_user_colaborador_nivel_uno_id"), $("#sf_guard_user_colaborador_nivel_dos_id"));
    });
</script>

<style>
    #sf_admin_container label{
        width:13em!important;
    }
    #sf_admin_container .sf_admin_form_field_permissions_list label{
        font-weight: bold !important;
    }
</style>