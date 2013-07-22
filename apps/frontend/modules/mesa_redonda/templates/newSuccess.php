<!--<head> -->
    
<?php //include_stylesheets() ?>
    <?php //include_javascripts() ?>
    <?php include_javascripts_for_form($form)  ?>
<?php use_helper("I18N") ?> 
<!--</head>
<body>-->
<!--    <div id="content_empresa">-->
<!--    <div id="content_empresa_header"></div>-->
    
<!--   <div id="content_empresa_body"> -->
<div id="concurso_mesa_new">

<form action="<?php echo url_for('mesa_redonda/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
      <?php if (!$form->getObject()->isNew()): ?>
          <input type="hidden" name="sf_method" value="put" />
          <?php endif; ?>
    <table border="0">
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php echo $form->renderHiddenFields() ?>
                    <input type="submit" value="<?php echo __("Enviar") ?>" />
                </td>
            </tr>
        </tfoot>

        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
<!--            <tr><td colspan="2"><strong>Nombre: </strong></td></tr>-->
            <tr><td colspan="2"><strong>Nombre*</strong> <span class="rojo">
                  
          <?php if ($form['name']->renderError()):{ echo "<strong>Contenido obligatorio</strong>"; } endif; ?>
              
              </span></td></tr>
            <tr>
            <th align="left"><?php //echo $form['name']->renderLabel() ?></th>
                <td>
                    <?php //echo $form['name']->renderError() ?>
                    <?php echo $form['name'] ?>
                </td>
            </tr> 
              <tr><td colspan="2"><strong>Categoria de Mesa redonda</strong></td></tr>
            <tr>
                <th align="left"><?php //echo $form['mesaredonda_categoria_id']->renderLabel() ?></th>
                <td>
                    <?php echo $form['mesaredonda_categoria_id']->renderError() ?>
                    <?php echo $form['mesaredonda_categoria_id'] ?>
                </td>
            </tr>
            
            <tr><td colspan="2"><strong>Plan de acción*</strong> <span class="rojo">
                  
          <?php if ($form['plan_accion']->renderError()):{ echo "<strong>Contenido obligatorio</strong>"; } endif; ?>
              
              </span></td></tr>
<!--              <tr><td colspan="2"></td></tr>-->
                       <tr align="left">
                <th><?php //echo $form['plan_accion']->renderLabel() ?></th>
                <td>
                    <?php //echo $form['plan_accion']->renderError() ?>
                    <?php echo $form['plan_accion'] ?>
                </td>
            </tr>
            <tr><td colspan="2"><strong>Resumen del plan de acción*</strong> <span class="rojo">
                  
          <?php if ($form['resumen']->renderError()):{ echo "<strong>Contenido obligatorio</strong>"; } endif; ?>
              
              </span></td></tr>
<!--              <tr><td colspan="2"></td></tr>-->
                       <tr align="left">
                <th valign="top"><?php //echo $form['resumen']->renderLabel() ?></th>
                <td>
                    <?php //echo $form['resumen']->renderError() ?>
                    <?php echo $form['resumen'] ?>
                </td>
            </tr>

                <tr>
          <td colspan="2">(*) Datos obligatorios </td>
        </tr>   
        </tbody>
    </table>

</form>
<!--</div>
<div id="content_empresa_footer"></div>
        </div>-->
</div>
    </body>