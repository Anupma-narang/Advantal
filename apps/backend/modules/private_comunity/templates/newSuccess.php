 <form action="<?php echo url_for('private_comunity/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '&id=' . $form->getObject()->getId() : '')) ?>"
          method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
              <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
        <!--    <div id="formulario">-->
        <table align="left" border="0">
            <tfoot>
                <tr>
                    <td colspan="2"><?php echo $form->renderHiddenFields() ?>
                        <input type="submit" value="<?php echo "Enviar" ?>" /></td>
                </tr>
            </tfoot>
            <tbody>
            <?php echo $form?>
            </tbody>
        </table>
       </form>
           
