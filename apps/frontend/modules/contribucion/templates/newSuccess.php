<?php use_helper("I18N")?>  
<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
    
        <div id="content_contribuciones">                         
        <div id="content_breadcroum"><a href="#">inicio</a> &gt;&gt; <a href="#">concursos</a>
        </div>
       <div id="content_contribuciones_arriba">BUSCAR UN CONCURSO</div>
      <div id="content_contribuciones_buscador">
        <div id="boton_activo"><span class="concurso_link"><a href="#">Empresa / Entidad</a></span></div>
        <div id="boton_no_activo"><span class="concurso_link"><a href="#"> Producto</a></span></div>
      </div>         
          <div id="concurso_crear">
            <div id="concurso_crear_texto"> Crear contribucion</div>
          </div>
        <div id="concurso_form">
<form action="<?php echo url_for('contribucion/'.($form->getObject()->isNew() ? 'create': 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>"
method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
 <table>
    <tfoot>
     <tr>
       <td colspan="2">
         <?php echo $form->renderHiddenFields() ?>
         &nbsp;
<!--         <a href="<?php //echo url_for('contribucion/index') ?>"><?php // echo __('listar')?></a>-->
         <?php if (!$form->getObject()->isNew()): ?>
           &nbsp;<?php echo link_to(__('Borrar'), 'contribucion/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
         <?php endif; ?>
         <input type="submit" value="<?php echo __("Enviar")?>" />
       </td>
     </tr>
    </tfoot>

<tbody>
     <?php echo $form->renderGlobalErrors() ?>
     <tr>
       <th><?php echo $form['name']->renderLabel() ?></th>
       <td>
         <?php echo $form['name']->renderError() ?>
         <?php echo $form['name'] ?>
       </td>
     </tr>
    
     <tr>
       <th><?php echo $form['plan_accion']->renderLabel() ?></th>
       <td>
         <?php echo $form['plan_accion']->renderError() ?>
         <?php echo $form['plan_accion'] ?>
       </td>
     </tr>
      <tr>
       <th><?php echo $form['resumen']->renderLabel() ?></th>
       <td>
         <?php echo $form['resumen']->renderError() ?>
         <?php echo $form['resumen'] ?>
       </td>
     </tr>
     
     

</tbody>
 </table>

</form>
        </div> <!-- fin concurso-fomr-->

          </div>