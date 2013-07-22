<!--<div id="content_breadcroum">
    <?php //echo link_to("Inicio", "home/index") ?> >> Nueva empresa
</div>
<div id="content_concursos_arriba">BUSCAR UN CONCURSO</div>
<div id="content_concursos_buscador">
    <div id="boton_activo"><span class="concurso_link"><a href="#">Empresa / Entidad</a></span></div>
    <div id="boton_no_activo"><span class="concurso_link"><a href="#"> Producto</a></span></div>
</div>-->
<div id="content_titulo_seccion">
    <span class="txt_titulo_seccion">Alta nuevo producto</span>
</div>
<div id="content_producto_nuevo">
    


<?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php include_javascripts_for_form($form)  ?>
<?php use_helper("I18N") ?> 

<form action="<?php echo url_for('producto/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
      <?php if (!$form->getObject()->isNew()): ?>
          <input type="hidden" name="sf_method" value="put" />
          <?php endif; ?>
    <table width="500">
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
            <tr align="left">
                <th><?php echo $form['name']->renderLabel() ?></th>
                <td>
                    <?php echo $form['name']->renderError() ?>
                    <?php echo $form['name'] ?>
                </td>
            </tr> 
            <tr align="left">
                <th><?php echo $form['Marca']->renderLabel() ?></th>
                <td>
                    <?php echo $form['Marca']->renderError() ?>
                    <?php echo $form['Marca'] ?>
                </td>
            </tr>
            <tr align="left">
                <th><?php echo $form['Modelo']->renderLabel() ?></th>
                <td>
                    <?php echo $form['Modelo']->renderError() ?>
                    <?php echo $form['Modelo'] ?>
                </td>
            </tr>
             <tr align="left">
                <th><?php  echo $form['producto_tipo_uno_id']->renderLabel() ?></th>
                <td>
                    <?php  echo $form['producto_tipo_uno_id']->renderError() ?>
                    <?php  echo $form['producto_tipo_uno_id'] ?>
                </td>
            </tr>
            
            <tr align="left">
                <th><?php  echo $form['producto_tipo_dos_id']->renderLabel() ?></th>
                <td>
                    <?php  echo $form['producto_tipo_dos_id']->renderError() ?>
                    <?php  echo $form['producto_tipo_dos_id'] ?>
                </td>
            </tr>
            <tr align="left">
                <th><?php  echo $form['producto_tipo_tres_id']->renderLabel() ?></th>
                <td>
                    <?php  echo $form['producto_tipo_tres_id']->renderError() ?>
                    <?php  echo $form['producto_tipo_tres_id'] ?>
                </td>
            </tr>
        </tbody>
    </table>

</form>
    </div>