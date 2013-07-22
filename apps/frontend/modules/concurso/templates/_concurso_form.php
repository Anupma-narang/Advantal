<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('jquery.filestyle.js') ?>
<?php
$params = '';
if ($form->getObject()->isNew() && $parent_id > 0) {
  $params .= 'new?tipo=' . $tipo . '&id=' . $parent_id;
} elseif ($form->getObject()->isNew()) {
  $params .= 'new?tipo=' . $tipo;
} else {
  $params .= 'edit?tipo=' . $tipo . '&id=' . $form->getObject()->getId();
}
?>
<script type="text/javascript">
    $(document).ready(function() {
 $("input#prof_submit").click(function() {
            $("input#prof_submit").removeClass("red_button");
            $("input#prof_submit").addClass("gray_button");
            $("input#prof_submit").attr('disabled', 'disabled');
            $("form").submit();
        });
  });
	</script>
<form id="newConcursoForm"
      action="<?php echo url_for('concurso/' . $params) ?>"
      method="post"
      <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>


  <?php if ($tipo == "empresa"): ?>
    <div style="clear: both"></div>
     
    <div class="border-box">
      <div class="top-left">
        <div class="top-right">
          <h2 style="clear: both">
            <?php echo __('Datos de la empresa/entidad') ?>
          </h2>
         
           <?php if ($form->hasErrors()): ?>
  <ul class="error_list"><li>El formulario no se ha guardado porque se ha producido algún error.</li></ul>
  <?php endif; ?>
         </div>
      </div>
          
           
          
      <div class="bottom-left">
        <div class="bottom-right"></div>
      </div>
    </div>
    <div class="border-box">
      <div class="top-left">
        <div class="top-right">
          <table>
            <tbody>
              <tr>
                <th align="left"><?php echo $form['empresa_nombre']->renderLabel() ?>
                </th>
                <th></th>
              </tr>
              <tr>
                <td><?php echo $form['empresa_nombre']->renderError() ?></td>
                <td></td>
              </tr>
             
                            <tr>
                            <td>
                                <?php $empresa_nombreClass = ''; ?>
                                <?php if ($form['empresa_nombre']->hasError()): ?>
                                    <?php $empresa_nombreClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['empresa_nombre']->render(array('class' => 'hidden ' . $empresa_nombreClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['empresa_nombre']->render(array('class' =>'visible32 '. $empresa_nombreClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
              <tr>
                <th align="left"><?php echo $form['empresa_sector_uno_id']->renderLabel() ?></th>
              </tr>
              <tr>
                <td><?php echo $form['empresa_sector_uno_id']->renderError() ?>
                </td>
                </tr>
                    <tr>
                            <td>
                                <?php $empresa_sector_uno_idClass = ''; ?>
                                <?php if ($form['empresa_sector_uno_id']->hasError()): ?>
                                    <?php $empresa_sector_uno_idClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['empresa_sector_uno_id']->render(array('class' => 'hidden ' . $empresa_sector_uno_idClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['empresa_sector_uno_id']->render(array('class' =>'visible32 '. $empresa_sector_uno_idClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>


              <tr>
                <td>
                  <div class="blocker"></div>
                  <?php //echo $form['empresa_sector_uno_id'] ?>

                </td>
                <td></td>
              </tr>
              <tr>
                <th align="left"><?php echo $form['empresa_sector_dos_id']->renderLabel() ?></th>
                <th></th>
              </tr>
              <tr>
                <td><?php echo $form['empresa_sector_dos_id']->renderError() ?>
                </td>
                <td></td>
              </tr>
               <tr>
                            <td>
                                <?php $empresa_sector_dos_idClass = ''; ?>
                                <?php if ($form['empresa_sector_dos_id']->hasError()): ?>
                                    <?php $empresa_sector_dos_idClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['empresa_sector_dos_id']->render(array('class' => 'hidden ' . $empresa_sector_dos_idClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['empresa_sector_dos_id']->render(array('class' =>'visible32 '. $empresa_sector_dos_idClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
              <tr>
                <td>
                  <div class="blocker"></div>
                  <?php //echo $form['empresa_sector_dos_id'] ?>
                </td>
                <td></td>
              </tr>
              <tr>
                <th align="left"><?php echo $form['empresa_sector_tres_id']->renderLabel() ?></th>
                <th></th>
              </tr>
              <tr>
                <td><?php echo $form['empresa_sector_tres_id']->renderError() ?>
                </td>
              </tr>
                 <tr>
                            <td>
                                <?php $empresa_sector_tres_idClass = ''; ?>
                                <?php if ($form['empresa_sector_tres_id']->hasError()): ?>
                                    <?php $empresa_sector_tres_idClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['empresa_sector_tres_id']->render(array('class' => 'hidden ' . $empresa_sector_tres_idClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['empresa_sector_tres_id']->render(array('class' =>'visible32 '. $empresa_sector_tres_idClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
            <td>
              <div class="blocker"></div>
              <?php //echo $form['empresa_sector_tres_id'] ?>
            </td>
            </tr>

            <!--      </div>-->
          <?php elseif ($tipo == "producto"): ?>
            <div style="clear: both"></div>
            <div class="border-box">
              <div class="top-left">
                <div class="top-right">
                  <h2 style="clear: both">
                    <?php echo __('Datos del producto') ?>
                  </h2>
                </div>
              </div>
              <div class="bottom-left">
                <div class="bottom-right"></div>
              </div>
            </div>
            <div class="border-box">
              <div class="top-left">
                <div class="top-right">
                  <table>
                    <tbody>
                      <tr>
                        <th align="left"><?php echo $form['producto']->renderLabel() ?>
                        </th>
                        <th></th>
                      </tr>
                      <tr>
                        <td><?php echo $form['producto']->renderError() ?> <?php echo $form['producto']->render(array('class' => 'tamano_32_c')) ?>
                          <span id="sugerencias_elemento"></span> <?php ?></td>
                      </tr>
                      <tr>
                        <th align="left"><?php echo $form['producto_nombre']->renderLabel() ?></th>
                        <th align="left"><?php echo $form['modelo']->renderLabel() ?>
                        </th>
                      </tr>
                      <tr>
                        <td><?php echo $form['producto_nombre']->renderError() ?> <?php echo $form['producto_nombre'] ?>
                        </td>
                        <td><?php echo $form['modelo']->renderError() ?> <?php echo $form['modelo'] ?>
                        </td>
                      </tr>
                      <tr>
                        <th align="left"><?php echo $form['producto_tipo_uno_id']->renderLabel() ?></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td><?php echo $form['producto_tipo_uno_id']->renderError() ?>
                        </td>
                        <td></td>


                      <tr>
                        <td>
                          <div class="blocker"></div>
                          <?php echo $form['producto_tipo_uno_id'] ?>
                        </td>
                      </tr>
                      <tr>
                        <th align="left"><?php echo $form['producto_tipo_dos_id']->renderLabel() ?></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td><?php echo $form['producto_tipo_dos_id']->renderError() ?>
                        </td>


                      <tr>
                        <td>
                          <div class="blocker"></div>
                          <?php echo $form['producto_tipo_dos_id'] ?></td>
                      </tr>
                      <tr>
                        <th align="left"><?php echo $form['producto_tipo_tres_id']->renderLabel() ?></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td><?php echo $form['producto_tipo_tres_id']->renderError() ?>
                        </td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>
                          <div class="blocker"></div>
                          <?php echo $form['producto_tipo_tres_id'] ?></td>
                        <td></td>
                      </tr>
                    <?php endif; ?>
                    <?php if ($tipo == "empresa"): ?>
                      <tr>
                        <th align="left"><?php echo $form['road_type_id']->renderLabel() ?>
                        </th>
                        <th></th>
                      </tr>
                      <tr>
                        <td><?php echo $form['road_type_id']->renderError() ?></td>
                        <td></td>
                      </tr>
                         <tr>
                            <td>
                                <?php $road_type_idClass = ''; ?>
                                <?php if ($form['road_type_id']->hasError()): ?>
                                    <?php $road_type_idClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['road_type_id']->render(array('class' => 'hidden ' . $road_type_idClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['road_type_id']->render(array('class' =>'visible32 '. $road_type_idClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                      <tr><td colspan="2">
                          <table><tbody>
                              <tr>
                                <th width="280" align="left"><?php echo $form['concurso_address']->renderLabel() ?></th>
                                <th width="100" align="left"><?php echo $form['concurso_numero']->renderLabel() ?></th>
                                <th width="100" align="left"><?php echo $form['concurso_piso']->renderLabel() ?></th>
                                <th width="100" align="left"><?php echo $form['concurso_puerta']->renderLabel() ?></th>
                              </tr>
                              <tr>
                                <td><?php echo $form['concurso_address']->renderError() ?></td>
                                <td><?php echo $form['concurso_numero']->renderError() ?></td>
                                <td><?php echo $form['concurso_piso']->renderError() ?></td>
                                <td><?php echo $form['concurso_puerta']->renderError() ?></td>
                              <tr>
                                    
                            <td>
                                <?php $concurso_addressClass = ''; ?>
                                <?php if ($form['concurso_address']->hasError()): ?>
                                    <?php $concurso_addressClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['concurso_address']->render(array('class' => 'hidden ' . $concurso_addressClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['concurso_address']->render(array('class' =>''. $concurso_addressClass)) ?>
                                <?php endif; ?>
                            </td>
                        
                              <td width="52">  
								<?php $concurso_numeroClass = ''; ?>
                                <?php if ($form['concurso_numero']->hasError()): ?>
                                    <?php $concurso_numeroClass = 'errornumero'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['concurso_numero']->render(array('class' => 'hidden ' . $concurso_numeroClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['concurso_numero']->render(array('class' =>'numero '. $concurso_numeroClass)) ?>
                                <?php endif; ?>
                                </td>
                                <td>
									<?php $concurso_pisoClass = ''; ?>
                                    <?php if ($form['concurso_piso']->hasError()): ?>
                                        <?php $concurso_pisoClass = 'errorpiso'; ?>
                                    <?php endif; ?>
    
                                    <?php if ($profile): ?>
                                        
                                        <?php echo $form['concurso_piso']->render(array('class' => 'hidden ' . $concurso_pisoClass)) ?>
                                    <?php else: ?>
                                        <?php echo $form['concurso_piso']->render(array('class' =>'piso '. $concurso_pisoClass)) ?>
                                    <?php endif; ?>
                                
                                </td>
                                <td>
								   	<?php $concurso_puertaClass = ''; ?>
                                    <?php if ($form['concurso_puerta']->hasError()): ?>
                                        <?php $concurso_puertaClass = 'errornumero'; ?>
                                    <?php endif; ?>
    
                                    <?php if ($profile): ?>
                                        
                                        <?php echo $form['concurso_puerta']->render(array('class' => 'hidden ' . $concurso_puertaClass)) ?>
                                    <?php else: ?>
                                        <?php echo $form['concurso_puerta']->render(array('class' =>'numero '. $concurso_puertaClass)) ?>
                                    <?php endif; ?>
								
                                
                                </td>
                              </tr>
                            </tbody></table>
                        </td><tr>
                        <th align="left"><?php echo $form['states_id']->renderLabel() ?>
                        </th>
                        <th align="left"><?php echo $form['city_id']->renderLabel() ?>
                        </th>
                      </tr>
                      <tr>
                        <td><?php echo $form['states_id']->renderError() ?>   	<?php $states_idClass = ''; ?>
                                    <?php if ($form['states_id']->hasError()): ?>
                                        <?php $states_idClass = 'errorContact'; ?>
                                    <?php endif; ?>
    
                                    <?php if ($profile): ?>
                                        
                                        <?php echo $form['states_id']->render(array('class' => 'hidden ' . $states_idClass)) ?>
                                    <?php else: ?>
                                        <?php echo $form['states_id']->render(array('class' =>''. $states_idClass)) ?>
                                    <?php endif; ?>
                        </td>
                        <td><?php echo $form['city_id']->renderError() ?> <?php $city_idClass = ''; ?>
                                    <?php if ($form['city_id']->hasError()): ?>
                                        <?php $city_idClass = 'errorContact'; ?>
                                    <?php endif; ?>
    
                                    <?php if ($profile): ?>
                                        
                                        <?php echo $form['city_id']->render(array('class' => 'hidden ' . $city_idClass)) ?>
                                    <?php else: ?>
                                        <?php echo $form['city_id']->render(array('class' =>''. $city_idClass)) ?>
                                    <?php endif; ?>
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="bottom-left">
              <div class="bottom-right"></div>
            </div>
          </div>
          <br />
          <div class="border-box">
            <div class="top-left">
              <div class="top-right">
                <h2>
                  <?php echo __('Descripción del concurso') ?>
                </h2>
              </div>
            </div>
            <div class="bottom-left">
              <div class="bottom-right"></div>
            </div>
          </div>

          <div class="border-box">
            <div class="top-left">
              <div class="top-right">
                <table>
                  <tbody>
                    <tr>
                      <th colspan="2" align="left"><div class="etiqueta_naranja">
                    <?php echo $form['name']->renderLabel() ?>
                  </div></th>
                  </tr>
                  
                  
                    <tr>
                            <td colspan="2"><?php echo $form['name']->renderError() ?></td>
                        </tr>

                        <tr>
                            <td><?php echo $form['name']->renderLabel(null, array('class' => 'bundle')) ?></td></tr>
                            <tr>
                            <td>
                                <?php $nameClass = ''; ?>
                                <?php if ($form['name']->hasError()): ?>
                                    <?php $nameClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['name']->render(array('class' => 'hidden ' . $nameClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['name']->render(array('class' =>'visible32 '. $nameClass)) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        
                  <tr>
                    <th colspan="2" align="left"><?php echo $form['incidencia']->renderLabel() ?>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <ul id="Error_max_length_incidencia" class="error_list" style="display:none">
                        <li>Has superado el espacio permitido para la descripción de la incidencia.</li>
                      </ul>
                      <?php echo $form['incidencia']->renderError() ?>
                      <?php echo $form['incidencia'] ?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2" align="left"><?php echo $form['concurso_categoria_id']->renderLabel() ?>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo $form['concurso_categoria_id']->renderError() ?>
                         <?php $concurso_categoria_idClass = ''; ?>
                                <?php if ($form['concurso_categoria_id']->hasError()): ?>
                                    <?php $concurso_categoria_idClass = 'errorContact'; ?>
                                <?php endif; ?>

                                <?php if ($profile): ?>
                                    
                                    <?php echo $form['concurso_categoria_id']->render(array('class' => 'hidden ' . $concurso_categoria_idClass)) ?>
                                <?php else: ?>
                                    <?php echo $form['concurso_categoria_id']->render(array('class' =>''. $concurso_categoria_idClass)) ?>
                                <?php endif; ?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2" align="left"><?php echo $form['contribucion']['plan_accion']->renderLabel() ?>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <?php echo $form['contribucion']['plan_accion']->renderError() ?>
                      <ul id="Error_max_length_plan_accion" class="error_list" style="display:none">
                        <li>Has superado el espacio permitido para tu Plan de acción</li>
                      </ul>
                      <?php echo $form['contribucion']['plan_accion'] ?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2" align="left"><div class="etiqueta_marron">
                    <?php echo $form['contribucion']['resumen']->renderLabel() ?>
                  </div></th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <?php echo $form['contribucion']['resumen']->renderError() ?>
                      <ul id="Error_max_length_resumen" class="error_list" style="display:none">
                        <li>Has superado el espacio permitido para el resumen de tu Plan de acción.</li>
                      </ul>
                      <?php echo $form['contribucion']['resumen'] ?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2" align="left"><?php echo __('Añadir archivos') ?>
                    </th>
                  </tr>

                  <?php $current_uploads = $sf_request->getFiles($form->getName()); ?>
                  <tr>
                    <td><?php echo $form["archivo_1"]["file"]->renderError() ?></td>
                  </tr>
                  <tr id="Archivo_1">
                    <td>
                      <span title="Añade un archivo para complementar tu concurso de ideas"><?php echo $form["archivo_1"]["file"] ?></span>
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
                      <span title="Añade un archivo para complementar tu concurso de ideas"><?php echo $form["archivo_2"]["file"] ?></span>
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
                      <span title="Añade un archivo para complementar tu concurso de ideas"><?php echo $form["archivo_3"]["file"] ?></span>
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
                      <span title="Añade un archivo para complementar tu concurso de ideas"><?php echo $form["archivo_4"]["file"] ?></span>
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
                      <span title="Añade un archivo para complementar tu concurso de ideas"><?php echo $form["archivo_5"]["file"] ?></span>
                      <span style="padding-left:130px;">
                        <input type="button" id="file5_delete" value="-" />
                      </span></td>
                  </tr>

                  <tr>
                    <td colspan="2"><b><?php echo __('*Datos requeridos.') ?></b></td>

                  </tr>

                  <tr>
                    <td colspan=2><?php echo $form["borrador"]->render() ?> <?php echo $form["borrador"]->renderLabel() ?>
                    </td>

                  </tr>
                  </tbody>
                </table>

                <table>
                  <tfoot>
                    <tr>
                      <td><?php if (!$form->getObject()->isNew()): ?> <input
                            type="hidden" name="sf_method" value="put" /> <?php endif; ?>
                          <?php echo $form->renderGlobalErrors() ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><?php echo $form->renderHiddenFields() ?> 
                        <input type="submit" value="<?php echo __("publica") ?>" title="Publica un concurso de ideas para mejorar una empresa, entidad pública o producto" class="red_button" id="prof_submit"/>
                        <?php if (isset($from)): ?>
                          <?php echo link_to(__('cancela'), url_for($from)) ?>
                        <?php else: ?>
                          <?php
                          $concurso_url = 'concurso/index';
                          $concurso_url .= '?tipo=' . $sf_user->getAttribute('concurso_estado_tipo', 'empresa');
                          $concurso_url .= '&page=' . $sf_user->getAttribute('concurso_estado_page', 1);
                          ?>
                          <?php echo link_to(__('cancela'), "$concurso_url") ?>
                        <?php endif; ?>

                      </td>
                    </tr>
                  </tfoot>
                </table>
                </form>
              </div>
            </div>
            <div class="bottom-left">
              <div class="bottom-right"></div>
            </div>

<?php if ($form["contribucion"]["resumen"]->hasError()): ?>
    <style type="text/css">
        span.cke_skin_kama {
            border: 2px solid red;
        }

    </style>
<?php endif; ?>
<style type="text/css">
    input.errorContact{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
	 input.errornumero{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
		width:52px;
    }
	 input.errorpiso{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
		width:20px;
    }
	 select.errorContact{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
    ul.error_list li {
        background-attachment: scroll;
        background-color: transparent;
        background-position: 4px 5px;
        background-repeat: no-repeat;
        background-size: auto auto;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: bold;
        list-style: none outside none;
        padding: 0 0 0 25px;
        margin: 0px;
    }
    .visible32{
            width : 258px;
        }
    .numero{
	width:52px;	
	}
	.piso{
	width:20px;	
	}
</style>
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
              });

              $('.file_1').change(function(){
                $("#file1_delete").show();
              });

              $("#file1_addmore").click(function(){
                $("#Archivo_2").show();
              });
              $("#file1_delete").click(function(){
                $('#concurso_archivo_1_file_newfile').attr({ value: '' });
                $('#concurso_archivo_1_file_persistid').attr({ value: '' });
                $('.file_1').attr({ value: '' });
                $('#filename_uploaded1').hide();
                $("#file1_delete").hide();
                $('#file_1').show();
              });

              $("#file2_addmore").click(function(){
                $("#Archivo_3").show();
              });
              $("#file2_delete").click(function(){
                $('#concurso_archivo_2_file_newfile').attr({ value: '' });
                $('#concurso_archivo_2_file_persistid').attr({ value: '' });
                $('.file_2').attr({ value: '' });
                $('#filename_uploaded2').hide();
                $("#Archivo_2").hide();
                $('#file_2').show();
              });

              $("#file3_addmore").click(function(){
                $("#Archivo_4").show();
              });
              $("#file3_delete").click(function(){
                $('#concurso_archivo_3_file_newfile').attr({ value: '' });
                $('#concurso_archivo_3_file_persistid').attr({ value: '' });
                $('.file_3').attr({ value: '' });
                $('#filename_uploaded3').hide();
                $("#Archivo_3").hide();
                $('#file_3').show();
              });

              $("#file4_addmore").click(function(){
                $("#Archivo_5").show();
              });
              $("#file4_delete").click(function(){
                $('#concurso_archivo_4_file_newfile').attr({ value: '' });
                $('#concurso_archivo_4_file_persistid').attr({ value: '' });
                $('.file_4').attr({ value: '' });
                $('#filename_uploaded4').hide();
                $("#Archivo_4").hide();
                $('#file_4').show();
              });

              $("#file5_delete").click(function(){
                $('#concurso_archivo_5_file_newfile').attr({ value: '' });
                $('#concurso_archivo_5_file_persistid').attr({ value: '' });
                $('.file_5').attr({ value: '' });
                $('#filename_uploaded5').hide();
                $("#Archivo_5").hide();
                $('#file_5').show();
              });
            </script>
