<?php use_helper('Date', 'I18N', 'Text', 'Concursos') ?>
<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('jquery.filestyle.js') ?>

<div id="content_breadcroum">
  <?php echo link_to("Inicio", "home/index") ?>
  >>
  <?php echo link_to('Concurso', 'concurso/index') ?>
  >>
  <?php echo $concurso->getConcursoTipoId() == 1 ? link_to('Empresa/Entidad', 'concurso/index?tipo=empresa') : link_to('Producto', 'concurso/index?tipo=producto') ?>
  >>
  <?php echo link_to(__('contribuye'), 'contribucionuno/new?concurso_id=' . $concurso->getId()) ?>
</div>

<div id="content_contribucion_nuevo">
  <div id="contribucion_crear">
    <div id="contribucion_crear_texto">Contribuye</div>
  </div>
  <div id="content_contribuciones">
    <div class="border-box">
      <div class="top-left">
        <div class="top-right">
          <table border="0">
            <tbody>
              <tr>
                <th>Título del concurso: </th>
              </tr>
              <tr>
                <td><input type="text" value="<?php echo $concurso->getName() ?>" disabled="disabled" size=40></td>
              </tr>
              <tr>
                <th>Fecha: </th>
              </tr>
              <tr>
                <td><input type="text" value="<?php echo format_datetime($concurso->getCreatedAt(), "p", "es_ES") ?>" disabled="disabled" size=40></td>
              </tr>
              <tr>
                <th>Categoria del concurso: </th>
              </tr>
              <tr>
                <td><input type="text" value="<?php echo $concurso->getConcursoCategoria()->getName() ?>" disabled="disabled" size=40></td>
              </tr>
              <?php if ($concurso->getConcursoTipoId() == 1): //empresa?>
                <tr>
                  <th>Empresa/Entidad: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getEmpresa()->getName() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <th>Dirección: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getEmpresa()->getDireccion() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <td>
                    <table><tbody>
                        <tr>
                          <th>Nº</th><th>Piso</th><th>Puerta</th>
                        </tr>
                        <tr>
                          <td><input type="text" value="<?php echo $concurso->getConcursoNumero() ?>" disabled="disabled" size=11></td>
                          <td><input type="text" value="<?php echo $concurso->getConcursoPiso() ?>" disabled="disabled" size=11></td>
                          <td><input type="text" value="<?php echo $concurso->getConcursoPuerta() ?>" disabled="disabled" size=11></td>
                        </tr>
                      </tbody></table>
                  </td>
                </tr>
                <tr>
                  <th>Provincia: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getStates() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <th>Localidad: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getCity() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <th>Actividad de la empresa o entidad: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getEmpresa()->getEmpresaSectorTresId() ? $concurso->getEmpresa()->getEmpresaSectorTres() : $concurso->getEmpresa()->getEmpresaSectorDos() ?>" disabled="disabled" size=40></td>
                </tr>
              <?php else: ?>
                <tr>
                  <th>Producto: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getProducto()->getName() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <th>Marca: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getProducto()->getMarca() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <th>Modelo: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getProducto()->getModelo() ?>" disabled="disabled" size=40></td>
                </tr>
                <tr>
                  <th>Tipo de producto: </th>
                </tr>
                <tr>
                  <td><input type="text" value="<?php echo $concurso->getProducto()->getProductoTipoTresId() ? $concurso->getProducto()->getProductoTipoTres() : $concurso->getProducto()->getProductoTipoDos() ?>" disabled="disabled" size=40></td>
                </tr>
              <?php endif; ?>
              <tr>
                <td>
                  <?php echo link_to(__('ver Descripción de la incidencia'), url_for_incidencia($contribucion), array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0'))) ?>
                </td>
              </tr>
              <tr>
                <td>
                  <?php echo link_to(__('ver Plan de acción'), url_for_plan_accion($contribucion), array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0'))) ?>
                </td>
              </tr>
            </tbody>
          </table>
          <form id="newContributionForm" action="<?php echo url_for('contribucionuno/new?concurso_id=' . $concurso->getId() . '&contribucion_id=' . $contribucion->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <?php if (!$form->getObject()->isNew()): ?>
              <input type="hidden" name="sf_method" value="put" />
            <?php endif; ?>
            <table border="0">
              <tfoot>
                <tr>
                  <td colspan="2"><?php echo $form->renderHiddenFields() ?>
                    <input type="submit" value="<?php echo __("contribuye") ?>" />
                    <?php if ($from == 'nothing'): ?>
                      <?php echo link_to_function('cancela', 'history.go(-1);') ?>
                    <?php else: ?>
                      <?php echo link_to('cancela', url_for('contribution-draft')) ?>
                    <?php endif; ?>
                  </td>
                </tr>
              </tfoot>
              <tbody>
                <!-- NAME -->
                <tr>
                  <th><?php echo $form['name']->renderLabel() ?></th>
                </tr>
                <tr>
                  <td><?php echo $form['name']->renderError() ?></td>
                </tr>
                <tr>
                  <td><?php echo $form['name']->render() ?></td>
                </tr>
                <!-- INCIDENCIA -->
                <tr>
                  <th><?php echo $form['incidencia']->renderLabel() ?></th>
                </tr>
                <tr>
                  <td>
                    <?php echo $form['incidencia']->renderError() ?>
                    <ul id="Error_max_length_incidencia" class="error_list" style="display:none">
                      <li>Has superado el espacio permitido para la descripción de la incidencia.</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $form['incidencia']->render() ?></td>
                </tr>
                <!-- PLAN DE ACCION -->
                <tr>
                  <th><?php echo $form['plan_accion']->renderLabel() ?></th>
                </tr>
                <tr>
                  <td>
                    <?php echo $form['plan_accion']->renderError() ?>
                    <ul id="Error_max_length_plan_accion" class="error_list" style="display:none">
                      <li>Has superado el espacio permitido para tu Plan de acción</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $form['plan_accion']->render() ?></td>
                </tr>
                <!-- RESUMEN -->
                <tr>
                  <th><?php echo $form['resumen']->renderLabel() ?></th>
                </tr>
                <tr>
                  <td>
                    <?php echo $form['resumen']->renderError() ?>
                    <ul id="Error_max_length_resumen" class="error_list" style="display:none">
                      <li>No puedes superar las 10 líneas para el resumen de tu Plan de acción.</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $form['resumen']->render() ?></td>
                </tr>

                <tr>
                  <th colspan="2" align="left"><?php echo __('añadir ficheros') ?>
                  </th>
                </tr>

                <?php $current_uploads = $sf_request->getFiles($form->getName()); ?>
                <tr>
                  <td><?php echo $form["archivo_1"]["file"]->renderError() ?></td>
                </tr>
                <tr id="Archivo_1">
                  <td>
                    <?php echo $form["archivo_1"]["file"] ?>
                    <span style="padding-left:130px;">
                      <input type="button" id="file1_addmore" value="+" />
                      <input type="button" id="file1_delete" value="-" />
                    </span></td>
                </tr>
                <tr>
                  <td><?php echo $form["archivo_2"]["file"]->renderError() ?></td>
                </tr>
                <tr id="Archivo_2">
                  <td>
                    <?php echo $form["archivo_2"]["file"] ?>
                    <span style="padding-left:130px;">
                      <input type="button" id="file2_addmore" value="+" />
                      <input type="button" id="file2_delete" value="-" />
                    </span></td>
                </tr>
                <tr>
                  <td><?php echo $form["archivo_3"]["file"]->renderError() ?></td>
                </tr>
                <tr id="Archivo_3">
                  <td>
                    <?php echo $form["archivo_3"]["file"] ?>
                    <span style="padding-left:130px;">
                      <input type="button" id="file3_addmore" value="+" />
                      <input type="button" id="file3_delete" value="-" />
                    </span></td>
                </tr>
                <tr>
                  <td><?php echo $form["archivo_4"]["file"]->renderError() ?></td>
                </tr>
                <tr id="Archivo_4">
                  <td>
                    <?php echo $form["archivo_4"]["file"] ?>
                    <span style="padding-left:130px;">
                      <input type="button" id="file4_addmore" value="+" />
                      <input type="button" id="file4_delete" value="-" />
                    </span></td>
                </tr>
                <tr>
                  <td><?php echo $form["archivo_5"]["file"]->renderError() ?></td>
                </tr>
                <tr id="Archivo_5">
                  <td>
                    <?php echo $form["archivo_5"]["file"] ?>
                    <span style="padding-left:130px;">
                      <input type="button" id="file5_delete" value="-" />
                    </span></td>
                </tr>

                <tr>
                  <td colspan="2"><span class="form_contribucion">(*) Datos obligatorios </span></td>

                </tr>
                <tr>
                  <td colspan=2> <?php echo $form["borrador"]->render() ?> <?php echo $form["borrador"]->renderLabel() ?> </td>

                </tr>
                                <!--<tr>
                                    <th colspan="2" align="left"><?php echo __('Añadir ficheros') ?></th>
                                </tr>
                                <tr>
                                    <td><?php echo $form["archivo_1"]["file"] ?><?php echo button_to_function('+', '$("#contribucion_archivo_2_file").click(); $("#Archivo_2").show();$("#Archivo_d1").hide()', array('id' => 'Archivo_b1', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#contribucion_archivo_1_file").val("");$("#Archivo_b1").hide();$("#Archivo_d1").hide();', array('id' => 'Archivo_d1', 'style' => 'display:none')) ?>
                                    </td>
                                </tr>
                                <tr id="Archivo_2" style="display:none">
                                    <td><?php echo $form["archivo_2"]["file"] ?><?php echo button_to_function('+', '$("#contribucion_archivo_3_file").click(); $("#Archivo_3").show()', array('id' => 'Archivo_b2', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#Archivo_2").hide();$("#Archivo_b2").hide();$("#contribucion_archivo_2_file").val("");$("#Archivo_d1").show()') ?>
                                    </td>
                                </tr>
                                <tr id="Archivo_3"style="display:none">
                                    <td><?php echo $form["archivo_3"]["file"] ?><?php echo button_to_function('+', '$("#contribucion_archivo_4_file").click(); $("#Archivo_4").show()', array('id' => 'Archivo_b3', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#Archivo_3").hide();$("#Archivo_b3").hide();$("#contribucion_archivo_3_file").val("")') ?>
                                    </td>
                                </tr>
                                <tr id="Archivo_4"style="display:none">
                                    <td><?php echo $form["archivo_4"]["file"] ?><?php echo button_to_function('+', '$("#contribucion_archivo_5_file").click(); $("#Archivo_5").show()', array('id' => 'Archivo_b4', 'style' => 'display:none')) ?><?php echo button_to_function('-', '$("#Archivo_4").hide();$("#Archivo_b4").hide();$("#contribucion_archivo_4_file").val("")') ?>
                                    </td>
                                </tr>
                                <tr id="Archivo_5"style="display:none">
                                    <td><?php echo $form["archivo_5"]["file"] ?><?php echo button_to_function('-', '$("#Archivo_5").hide();$("#contribucion_archivo_5_file").val("")') ?>
                                    </td>
                                </tr>-->
              </tbody>
            </table>
        </div>
      </div>
      <div class="bottom-left">
        <div class="bottom-right"></div>
      </div>
    </div>
  </div>

    <!--<script type="text/javascript">
        $("#contribucion_archivo_1_file").change(function(){if($(this).val()){$("#Archivo_b1").show();$("#Archivo_d1").show();}else{$("#Archivo_b1").hide();$("#Archivo_d1").hide();}});
        $("#contribucion_archivo_2_file").change(function(){if($(this).val())$("#Archivo_b2").show();});
        $("#contribucion_archivo_3_file").change(function(){if($(this).val())$("#Archivo_b3").show();});
        $("#contribucion_archivo_4_file").change(function(){if($(this).val())$("#Archivo_b4").show();});
    </script>-->


  <script type="text/javascript">
    $(document).ready(function() {
		
      for (i=1; i<=5; i++)
        $("input.file_"+i).filestyle({image: "/images/fichero.png", imagewidth : 118,width : 150});
		
      if($('#filename_uploaded1').length){
        $("#file1_delete").show();
        $('#file_1').hide();
      } else {
        $("#file1_delete").hide();
      }
      if($('#filename_uploaded2').length){
        $("#Archivo_2").show();
        $('#file_2').hide();
      } else {
        $("#Archivo_2").hide();
      }
      if($('#filename_uploaded3').length){
        $("#Archivo_3").show();
        $('#file_3').hide();
      } else {
        $("#Archivo_3").hide();
      }
      if($('#filename_uploaded4').length){
        $("#Archivo_4").show();
        $('#file_4').hide();
      } else {
        $("#Archivo_4").hide();
      }
      if($('#filename_uploaded5').length){
        $("#Archivo_5").show();
        $('#file_5').hide();
      } else {
        $("#Archivo_5").hide();
      }
      
      $('#contribucion_borrador').bind('click', function(){
        $('#newContributionForm').submit();
      });
    });
		
    $('.file_1').change(function(){
      $("#file1_delete").show();
    });
		
    $("#file1_addmore").click(function(){
      $("#Archivo_2").show();
    });
    $("#file1_delete").click(function(){
      $('#contribucion_archivo_1_file_newfile').attr({ value: '' });
      $('#contribucion_archivo_1_file_persistid').attr({ value: '' });
      $('.file_1').attr({ value: '' });
      $('#filename_uploaded1').hide();
      $("#file1_delete").hide();
      $('#file_1').show();
    });
		
    $("#file2_addmore").click(function(){
      $("#Archivo_3").show();
    });
    $("#file2_delete").click(function(){
      $('#contribucion_archivo_2_file_newfile').attr({ value: '' });
      $('#contribucion_archivo_2_file_persistid').attr({ value: '' });
      $('.file_2').attr({ value: '' });
      $('#filename_uploaded2').hide();
      $("#Archivo_2").hide();
      $('#file_2').show();
    });
		
    $("#file3_addmore").click(function(){
      $("#Archivo_4").show();
    });
    $("#file3_delete").click(function(){
      $('#contribucion_archivo_3_file_newfile').attr({ value: '' });
      $('#contribucion_archivo_3_file_persistid').attr({ value: '' });
      $('.file_3').attr({ value: '' });
      $('#filename_uploaded3').hide();
      $("#Archivo_3").hide();
      $('#file_3').show();
    });
		
    $("#file4_addmore").click(function(){
      $("#Archivo_5").show();
    });
    $("#file4_delete").click(function(){
      $('#contribucion_archivo_4_file_newfile').attr({ value: '' });
      $('#contribucion_archivo_4_file_persistid').attr({ value: '' });
      $('.file_4').attr({ value: '' });
      $('#filename_uploaded4').hide();
      $("#Archivo_4").hide();
      $('#file_4').show();
    });
		
    $("#file5_delete").click(function(){
      $('#contribucion_archivo_5_file_newfile').attr({ value: '' });
      $('#contribucion_archivo_5_file_persistid').attr({ value: '' });
      $('.file_5').attr({ value: '' });
      $('#filename_uploaded5').hide();
      $("#Archivo_5").hide();
      $('#file_5').show();
    });
  </script>