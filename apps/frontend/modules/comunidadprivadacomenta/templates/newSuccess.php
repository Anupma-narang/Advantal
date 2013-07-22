<?php use_helper("I18N")?>  
<?php //include_stylesheets_for_form($form) ?>
<?php //include_javascripts_for_form($form) ?>

<div class="color_text" id="content_titulo_contribucion">crea comentario </div>
<div id="content_contribuciones">
<!--         <div id="concurso_crear">
            <div id="concurso_crear_texto"> Crear contribucion</div>
          </div>-->
        <div id="concurso_form">
<form action="<?php echo url_for('comunidadprivadacomenta/'.($form->getObject()->isNew() ? 'create': 'update'))?>"
    <?php //.(!$form->getObject()->isNew() ? 'id='.$form->getObject()->getId() : '')) ?>
method="post" <?php //$form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php //if (!$form->getObject()->isNew()): ?>
<!--<input type="hidden" name="sf_method" value="put" />-->
<?php //endif; ?>
 <table border="0">
    <tfoot>
     <tr>
       <td colspan="2">
         <?php echo $form->renderHiddenFields() ?>
         &nbsp;
        <!-- <a href="<?php //echo url_for('contribucion/index') ?>"><?php // echo __('listar')?></a>-->
         <?php // if (!$form->getObject()->isNew()): ?>
           &nbsp;<?php //echo link_to(__('Borrar'), 'contribucion/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
         <?php // endif; ?>
         <input type="submit" value="<?php echo __("Enviar")?>" />
       </td>
     </tr>
    </tfoot>

<tbody>
     <?php echo $form->renderGlobalErrors() ?>
      <tr align="left" valign="top"><td colspan="2">
              <strong>Título*</strong>
              <span class="rojo">
                           <?php if ($form['name']->renderError()): {echo "Contenido obligatorio"; } endif; ?>

              </span></td>
      </tr>     
    
    <tr>
       <th><?php //echo $form['name']->renderLabel() ?></th>
       <td>
         <?php //echo $form['name']->renderError() ?>
         <?php echo $form['name'] ?>
       </td>
     </tr>
<!--     <tr align="left" valign="top">
         <td colspan="2"><strong>Descripción de la incidencia*</strong><span class="rojo">
     <?php //if ($form['incidencia']->renderError()): {echo "Contenido obligatorio"; } endif; ?>
                               
                            </span></td>
     </tr>-->
     <tr>
       <th ><?php //echo $form['incidencia']->renderLabel() ?></th>
       <td>
         <?php //echo $form['incidencia']->renderError() ?>
         <?php //echo $form['incidencia'] ?>
       </td>
     </tr>
          <tr align="left" valign="top"><td colspan="2"><strong>Plan de acción*</strong><span class="rojo">
                               <?php if ($form['plan_accion']->renderError()): {echo "Contenido obligatorio"; } endif; ?>
                               
                            </span></td></tr>
     
     
     <tr>
       <th><?php //echo $form['plan_accion']->renderLabel() ?></th>
       <td>
         <?php //echo $form['plan_accion']->renderError() ?>
         <?php echo $form['plan_accion'] ?>
       </td>
     </tr>
<!--   <tr align="left" valign="top"><td colspan="2"><strong>Resumen*</strong><span class="rojo">
                   <?php //if ($form['resumen']->renderError()): {echo "Contenido obligatorio"; } endif; ?>

                </span></td>
   </tr>-->
      <tr>
       <th><?php //echo $form['resumen']->renderLabel() ?></th>
       <td>
         <?php //echo $form['resumen']->renderError() ?>
         <?php //echo $form['resumen'] ?>
       </td>
     </tr>
                     <tr>
                    <td colspan="2">(*) Datos obligatorios </td>
                </tr>
     

</tbody>
 </table>

</form>
        </div> <!-- fin concurso-fomr-->

          </div>