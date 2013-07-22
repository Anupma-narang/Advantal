<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id="Form">
    <form id="form_banco"
        <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
        <table>
            <tbody>
            <thead>
                <tr>
                    <th style="background-color: grey; border-radius: 5px 5px 5px 5px; padding-left: 5px;">
                        Titular de la cuenta
                    </th>
                </tr>
            </thead>
            <?php //echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['titular_name']->renderLabel() ?></th>
                <td>
                    <?php $titular_nameError = (($form['titular_name']->hasError()) ? 'errorcuenta' : ''); ?>
                    <?php if ($form['titular_name']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['titular_name']->getError() ?></li>
                        </ul>
                    <?php endif; ?>
                    <?php echo $form['titular_name']->render(array('class' => 'tamano_32_c ' . $titular_nameError)) ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['surname1']->renderLabel() ?></th>
                <td>
                    <?php $surname1Error = (($form['surname1']->hasError()) ? 'errorcuenta' : ''); ?>
                    <?php if ($form['surname1']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['surname1']->getError() ?></li>
                        </ul>
                    <?php endif; ?>
                    <?php echo $form['surname1']->render(array('class' => 'tamano_32_c ' . $surname1Error)) ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['surname2']->renderLabel() ?></th>
                <td>
                    <?php $surname2Error = (($form['surname2']->hasError()) ? 'errorcuenta' : ''); ?>
                    <?php if ($form['surname2']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['surname2']->getError() ?></li>
                        </ul>
                    <?php endif; ?>
                    <?php echo $form['surname2']->render(array('class' => 'tamano_32_c ' . $surname2Error)) ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['tipo_documento_id']->renderLabel() ?></th>
                <td>
                    <?php $tipo_documento_idError = (($form['tipo_documento_id']->hasError()) ? 'errorcuenta' : ''); ?>
                    <?php if ($form['tipo_documento_id']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['tipo_documento_id']->getError() ?></li>
                        </ul>
                    <?php endif; ?>
                    <?php echo $form['tipo_documento_id']->render(array('class' => 'tamano_32_c ' . $tipo_documento_idError)) ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['nifnie']->renderLabel() ?></th>
                <td>
                    <?php $nifnieError = (($form['nifnie']->hasError()) ? 'errorcuenta' : ''); ?>
                    <?php if ($form['nifnie']->getError()): ?>
                        <ul class="error_list barra_corta">
                            <li><?php echo $form['nifnie']->getError() ?></li>
                        </ul>
                    <?php endif; ?>
                    <?php echo $form['nifnie']->render(array('class' => 'tamano_9_c ' . $nifnieError)) ?>
                </td>
            </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td colspan="4"><?php echo $form->renderGlobalErrors()//echo $form['cuenta_entidad']->renderError()      ?></td>
                </tr>
                <tr>
                    <th width="149"><?php echo $form['cuenta_entidad']->renderLabel() ?></th>
                    <th width="149"><?php echo $form['cuenta_oficina']->renderLabel() ?></th>
                    <th width="149"><?php echo $form['cuenta_dc']->renderLabel() ?></th>
                    <th width="149"><?php echo $form['cuenta_numero']->renderLabel() ?></th>
                </tr>
                <tr>
                    <td><?php echo $form['cuenta_entidad']->renderError() ?> </td>
                    <td><?php echo $form['cuenta_oficina']->renderError() ?></td>
                    <td><?php echo $form['cuenta_dc']->renderError() ?></td>
                    <td><?php echo $form['cuenta_numero']->renderError() ?>	</td>
                </tr>
                <tr>
                    <?php $cuenta_entidadError = (($form['cuenta_entidad']->hasError()) ? 'errorcuenta' : ''); ?>
                    <td><?php echo $form['cuenta_entidad']->render(array('class' => 'tamano_4_c ' . $cuenta_entidadError)) ?></td>

                    <?php $cuenta_oficinaError = (($form['cuenta_oficina']->hasError()) ? 'errorcuenta' : ''); ?>
                    <td><?php echo $form['cuenta_oficina']->render(array('class' => 'tamano_4_c ' . $cuenta_oficinaError)) ?></td>

                    <?php $cuenta_dcError = (($form['cuenta_dc']->hasError()) ? 'errorcuenta' : ''); ?>
                    <td><?php echo $form['cuenta_dc']->render(array('class' => 'tamano_2_c ' . $cuenta_dcError)) ?></td>

                    <?php $cuenta_numeroError = (($form['cuenta_numero']->hasError()) ? 'errorcuenta' : ''); ?>
                    <td><?php echo $form['cuenta_numero']->render(array('class' => 'tamano_10_c ' . $cuenta_numeroError)) ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields(false); ?>
                        <?php
                        echo jq_submit_to_remote('micuenta_ajax_submit', 'guarda', array(
                            'url' => url_for('metodo_banco/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')),
                            'loading' => '$("#Error").hide(); $("#Ok").hide(); $("#Preload").show()',
                            'complete' => '$("#Preload").hide(); $("#Ok").show(); $(".err_req").parent().parent().hide();',
                            'update' => array('success' => 'Metodo_form'),
                            'id' => 'methodo_banco'
                        ))
                        ?> <input type="hidden" id="Guardar" value="<?php echo $guardado ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><br/><strong><?php echo __('* Datos requeridos') ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>

<style type="text/css">
    select.errorcuenta,
    input.errorcuenta{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
</style>
<?php if (!$form->hasErrors() && ($sf_request->getMethod() == sfWebRequest::POST || $sf_request->getMethod() == sfWebRequest::PUT)): ?>
    <script type="text/javascript">
         //$('#formulario').submit();
    </script>
<?php endif; ?>