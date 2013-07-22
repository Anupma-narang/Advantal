<?php //include_stylesheets()  ?>
<?php //include_javascripts()  ?>
<?php include_javascripts_for_form($form) ?>
<?php use_helper("I18N") ?> 
<div id="titulo_mr_activa">Ponencia nueva</div>
<div id="concurso_mesa_nuevaponencia">
    

    <form action="<?php echo url_for('mesa_redonda/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                <tr>
                    <th align="left" width="140">
                        <?php echo $form['name']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['name']->renderError() ?>
                        <?php echo $form['name'] ?>
                    </td>
                </tr> 

                <tr >
                    <th align="left" width="140">Plan de acción
                        <?php //echo $form['plan_accion']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['plan_accion']->renderError() ?>
                        <?php echo $form['plan_accion'] ?>
                    </td>
                </tr>
                <tr >
                    <th align="left" width="140">
                        <?php echo $form['resumen']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['resumen']->renderError() ?>
                        <?php echo $form['resumen'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
    <!--</div>
    <div id="content_empresa_footer"></div>
            </div>-->
</div>