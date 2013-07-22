<?php use_helper("I18N", "jQuery") ?> 
    <div id="content_laslistas_lista">
        <div id="content_laslistas_lista_uno">Empresas/Entidades </div>
        <div id="content_laslistas_lista_dos">Productos</div>
        <!--<div id="content_laslistas_lista_tres"></div>-->

        <!--lateral-->
        <div id="content_laslistas_left"></div>
        <div id="content_laslistas_right_top"></div>
        <div id="content_laslistas_right">
            <!--  NUEVO PROFESIONAL -->
            <p align="center">Recomendar a un profesional</p>
            <form action="<?php echo url_for('listas/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                            <th><?php echo $form['pd_id']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['pd_id']->renderError() ?>
                                <?php echo $form['pd_id'] ?>
                                 <span id="sugerencias_elemento"></span>
                            <?php
                            echo jq_observe_field('pd_carta_pd_id', array(
                                'update' => 'sugerencias_elemento',
                                'url' => 'listas/verpd',
                                'with' => "'pd_id='+$('#pd_carta_pd_id').val()"))
                            ?>
                            </td>
                        </tr>
                        
                        
                        
                        
                        <tr align="left">
                            <th><?php echo $form['name']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['name']->renderError() ?>
                                <?php echo $form['name'] ?>
                            </td>
                        </tr> 
                        <tr align="left">
                            <th><?php echo $form['description']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['description']->renderError() ?>
                                <?php echo $form['description'] ?>
                            </td>
                        </tr>
                            <tr align="left">
                            <th><?php echo $form['plan_accion']->renderLabel() ?></th>
                            <td>
                                <?php echo $form['plan_accion']->renderError() ?>
                                <?php echo $form['plan_accion'] ?>
                            </td>
                        </tr>






                    </tbody>
                </table>

            </form>
        </div>
    </div>
<!--</div>-->
<!--fin content_laslistas--> 

