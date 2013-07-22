<div id="content_titulo_seccion">
    <span class="txt_titulo_seccion">Adjuntar documentacion</span>
</div>
<div id="content_concursos">
<div id="content_fichero_nuevo">


    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php include_javascripts_for_form($form) ?>
    <?php use_helper("I18N") ?> 
    <!--    <div id="content_empresa">
      <div id="content_empresa_header"></div>-->

    <!--   <div id="content_empresa_body"> -->

    <form action="<?php echo url_for('fichero/' . ($form->getObject()->isNew() ? 'create' : 'update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                    <th><?php echo $form['file']->renderLabel() ?></th>
                    <td>
                        <?php echo $form['file']->renderError() ?>
                        <?php echo $form['file'] ?>
                    </td>
                </tr>

            </tbody>
        </table>

    </form>
</div>
</div>