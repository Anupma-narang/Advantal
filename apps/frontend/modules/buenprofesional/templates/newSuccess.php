<?php use_helper("I18N") ?>
    <div id="content_laslistas_lista">
        <div id="content_laslistas_lista_uno">Empresas/Entidades </div>
        <div id="content_laslistas_lista_dos">Productos</div>
        <!--<div id="content_laslistas_lista_tres"></div>-->

        <!--lateral-->
        <div id="content_laslistas_left"></div>
        <div id="content_laslistas_right_top"></div>
        <div id="content_laslistas_right">
            <!--  NUEVO PROFESIONAL --> <p align="center">Registro de un nuevo profesional</p>
            <form action="<?php echo url_for('buenprofesional/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                        <tr align="left">
                            <th>  <?php echo $form['name']->renderLabel() ?></th>
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
                            <th><?php echo $form['profesional_tipo_uno_id']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['profesional_tipo_uno_id']->renderError() ?>
                                <?php echo $form['profesional_tipo_uno_id'] ?>
                            </td>
                        </tr>

                        <tr align="left">
                            <th><?php echo $form['profesional_tipo_dos_id']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['profesional_tipo_dos_id']->renderError() ?>
                                <?php echo $form['profesional_tipo_dos_id'] ?>
                            </td>
                        </tr>
                        <tr align="left">
                            <th><?php echo $form['profesional_tipo_tres_id']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['profesional_tipo_tres_id']->renderError() ?>
                                <?php echo $form['profesional_tipo_tres_id'] ?>
                            </td>
                        </tr>



                    </tbody>
                </table>

            </form>
        </div>
    </div>
<!--</div>-->
<!--fin content_laslistas--> 

