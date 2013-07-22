<?php use_helper("I18N", "jQuery") ?>
<div id="content_concursos_nuevo">
    <?php $tipo = sfContext::getInstance()->getRequest()->getParameter("tipo"); ?>
    <?php if (!$tipo) {
        $tipo = "empresa";
    } ?>

<?php if ($tipo == "empresa"): ?>
        <form action="<?php echo url_for('concurso/new?tipo=empresa') ?>" method="post">
            <table align="left">
                <tfoot>
                        <tr>
                            <td colspan="2">
                                <?php echo $form->renderHiddenFields() ?>
                                <input type="submit" value="<?php echo __("Enviar") ?>" />
                            </td>
                        </tr>
                    </tfoot>


                <tbody>
                    <tr>
                        <th><?php echo $form['empresa_id']->renderLabel() ?></th>
                        <td>
                              <?php echo $form['empresa_id']->renderError() ?>
                              <?php echo $form['empresa_id'] ?>
                        </td>
                    </tr>

                <span id="sugerencias_elemento"></span>
                <?php
                echo jq_observe_field('concurso_empresa_id', array(
                    'update' => 'sugerencias_elemento',
                    'url' => 'concurso/verempresa',
                    'with' => "'empresa_id='+$('#concurso_empresa_id').val()"))
                ?>
                </tbody>
            </table>
        </form>
        <?php
        echo "Si la empresa que buscas aparece puedes crearla aqui";
        echo link_to("Nueva Empresa", "empresa/new")
        ?>



        <?php elseif ($tipo == "producto"): ?>
        <form action="<?php echo url_for('concurso/new?tipo=producto') ?>" method="post">

            <?php echo $formp['producto_id']->renderLabel() ?>
    <?php echo $formp['producto_id']->renderError() ?>
    <?php echo $formp['producto_id'] ?>


            <span id="sugerencias_elemento"></span>
            <input type="submit" value="<?php echo __("Enviar") ?>" />
        </form>
        <?php
        echo "Si el producto que buscas no aparece puedes crearlo aqui";
        echo link_to("Nuevo Producto", "producto/new")
        ?>



<?php endif; ?>


</div>