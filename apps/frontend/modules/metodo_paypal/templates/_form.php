<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="form_paypal"
      <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
          <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php echo $form->renderHiddenFields(false) ?>
                    <?php
                    echo jq_submit_to_remote('micuenta_ajax_submit', 'Guardar', array(
                        'url' => url_for('metodo_paypal/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')),
                        'loading' => '$("#Error").hide(); $("#Ok").hide(); $("#Preload").show()',
                        'complete' => '$("#Preload").hide(); $("#Ok").show()',
                        'update' => array('success' => 'Metodo_form')
                    ))
                    ?>
                    <input type="hidden" id="Guardar" value="<?php echo $guardado ?>"/>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br/><strong><?php echo __('* Datos requeridos') ?></strong></td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['usuario']->renderLabel() ?></th>
                <td><input type="hidden" id="Guardar" /> <?php echo $form['usuario']->renderError() ?>
                    <?php
                    $usuarioError = '';
                    if ($form['usuario']->hasError()) {
                        $usuarioError = 'errorInviteFrm';
                    }
                    ?>

                    <?php echo $form['usuario']->render(array('class' => 'tamano_32_c ' . $usuarioError)) ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['tipo_documento_id']->renderLabel() ?></th>
                <td><?php if ($form['tipo_documento_id']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['tipo_documento_id']->getError() ?></li>
                        </ul> <?php endif; ?>

                    <?php
                    $tipo_documento_idError = '';
                    if ($form['tipo_documento_id']->hasError()) {
                        $tipo_documento_idError = 'errorInviteFrm';
                    }
                    ?>

                    <?php echo $form['tipo_documento_id']->render(array('class' => $tipo_documento_idError)) ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['nifnie']->renderLabel() ?></th>
                <td><?php if ($form['nifnie']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['nifnie']->getError() ?></li>
                        </ul> <?php endif; ?>

                    <?php
                    $nifnieError = '';
                    if ($form['nifnie']->hasError()) {
                        $nifnieError = 'errorInviteFrm';
                    }
                    ?>
                    <?php echo $form['nifnie']->render(array('class' => 'tamano_9_c ' . $nifnieError)) ?>
                </td>
            </tr>
            <tr>

        </tbody>
    </table>
</form>

<script>
    /*$(document).ready(function() {
     if($('#metodo_paypal_usuario').val()!='')
     $('#Guardar').val('true');
     });*/
</script>
<?php if (!$form->hasErrors() && ($sf_request->getMethod() == sfWebRequest::POST || $sf_request->getMethod() == sfWebRequest::PUT)): ?>
    <script type="text/javascript">
        //$('#formulario').submit();
    </script>
<?php endif; ?>

<style type="text/css">
    select.errorInviteFrm,
    input.errorInviteFrm{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>