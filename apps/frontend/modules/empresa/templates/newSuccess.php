<!--<div id="content_breadcroum">
    <?php //echo link_to("Inicio", "home/index") ?> >> Nueva empresa
</div>
<div id="content_concursos_arriba">BUSCAR UN CONCURSO</div>
<div id="content_concursos_buscador">
    <div id="boton_activo"><span class="concurso_link"><a href="#">Empresa / Entidad</a></span></div>
    <div id="boton_no_activo"><span class="concurso_link"><a href="#"> Producto</a></span></div>
</div>-->


<div id="content_titulo_seccion">
    <span class="txt_titulo_seccion">Alta nueva entidad</span>
</div>


<!--<div id="botones_cambio_concurso">
    <span class="concurso_link">
        <?php // echo link_to("Entidades", "empresa/new?tipo=empresa") ?>
    </span>
    <span class="concurso_link">
        <?php // echo link_to("Productos", "empresa/new?tipo=producto") ?>
    </span>
</div>-->

<div id="content_empresa_nuevo">


    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php include_javascripts_for_form($form) ?>
    <?php use_helper("I18N") ?> 
    <!--    <div id="content_empresa">
      <div id="content_empresa_header"></div>-->

    <!--   <div id="content_empresa_body"> -->

    <form action="<?php echo url_for('empresa/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
        <table>
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
                    <th><?php echo $form['road_type_id']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['road_type_id']->renderError() ?>
                        <?php echo $form['road_type_id'] ?>
                    </td>
                </tr>




                <tr align="left">
                    <th><?php echo $form['direccion']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['direccion']->renderError() ?>
                        <?php echo $form['direccion'] ?>
                    </td>
                </tr>
                <tr align="left">
                    <th><?php echo $form['localidad']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['localidad']->renderError() ?>
                        <?php echo $form['localidad'] ?>
                    </td>
                </tr>
                <tr align="left">
                    <th><?php echo $form['codigopostal']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['codigopostal']->renderError() ?>
                        <?php echo $form['codigopostal'] ?>
                    </td>
                </tr>
                <tr align="left">
                    <th><?php echo $form['empresa_sector_uno_id']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['empresa_sector_uno_id']->renderError() ?>
                        <?php echo $form['empresa_sector_uno_id'] ?>
                    </td>
                </tr>

                <tr align="left">
                    <th><?php echo $form['empresa_sector_dos_id']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['empresa_sector_dos_id']->renderError() ?>
                        <?php echo $form['empresa_sector_dos_id'] ?>
                    </td>
                </tr>
                <tr align="left">
                    <th><?php echo $form['empresa_sector_tres_id']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['empresa_sector_tres_id']->renderError() ?>
                        <?php echo $form['empresa_sector_tres_id'] ?>
                    </td>
                </tr>



            </tbody>
        </table>

    </form>
</div>

