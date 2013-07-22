<!--New comunidad privada-->
    <?php include_javascripts_for_form($form)  ?>
    <?php use_helper("I18N", "jQuery") ?>
<?php //public function dato(){ return "Dato"; }  ?>
<div id="content_concursos_nuevo">
    <div id="concurso_crear">
        <div id="concurso_crear_texto"> Crea comunidad</div>
    </div>
    <div id="content_concurso_activos_boton">
        <div id="boton_noactivo"> <span class="concurso_link_no"> <?php echo link_to("Empresa / Entidad", "comunidadprivada/new?tipo=empresa") ?> </span> </div>
        <div id="boton_noactivo"> <span class="concurso_link_no"> <?php echo link_to("Productos", "comunidadprivada/new?tipo=producto") ?> </span> </div>
    </div>
    <?php $tipo = sfContext::getInstance()->getRequest()->getParameter("tipo"); ?>
    <?php
    if (!$tipo) {
        $tipo = "empresa";
    }
    ?>
    <form action="<?php echo url_for('comunidadprivada/' . ($form->getObject()->isNew() ? 'create?tipo=' . $tipo : 'update?tipo=' . $tipo) . (!$form->getObject()->isNew() ? '&id=' . $form->getObject()->getId() : '')) ?>"
          method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
              <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
        <!--    <div id="formulario">-->
        <table align="left" border="0">
            <tfoot>
                <tr>
                    <td colspan="2"><?php echo $form->renderHiddenFields() ?>
                        <input type="submit" value="<?php echo __("Enviar") ?>" /></td>
                </tr>
            </tfoot>
            <tbody>
                <?php echo $form->renderGlobalErrors() ?>
                <?php if ($tipo == "empresa"): ?>
                    <tr> <th colspan="2" align="left">Empresa</th> </tr>

                    <tr> 

                        <td colspan="2"><span class="rojo"><?php echo $form['empresa_id']->renderError() ?></span> <?php echo $form['empresa_id'] ?> <span id="sugerencias_elemento"></span>
                            <?php

                            ?></td>
                    </tr> 
                    <!--      </div>-->
<?php elseif ($tipo == "producto"): ?>
                    <tr>
                        <th colspan="2" align="left">Producto</th>
                    </tr>
                    <tr> 

                        <td><?php echo $form['producto_id']->renderError() ?>
                            <?php echo $form['producto_id'] ?> <span id="sugerencias_elemento"></span>
                            <?php ?>
                        </td>
                    </tr>
<?php endif; ?>
<?php if ($tipo == "empresa"): ?>
                    <tr>
                        <th colspan="2" align="left">Dirección</th>
                    </tr>
                    <tr>
                        <td colspan="2">
    <?php //echo $form['concurso_addres']->renderError() ?> 
                                <?php //echo $form['concurso_addres'] ?>
                        </td>
                    </tr>
                    <tr>  <th align="left">Provincia </th>
                        <th colspan="2" align="left">Localidad</th>
                    </tr>
                    <tr> 
                <td><?php echo $form['states_id']->renderError() ?> <?php //echo $form['states_id'] ?></td>
                        <td><?php echo $form['city_id']->renderError() ?><?php //echo $form['city_id'] ?></td>
                    </tr>
                    <tr>
                        <th colspan="2" align="left">Código postal  <span class="rojo">
                               <?php if ($form['name']->renderError()): {echo "Cód. postal incorrecto"; } endif; ?>
                               
                            </span>
                        </th>
                      
                    </tr>
                    <tr> 
                        <td colspan="2"><?php //echo $form['concurso_code']->renderError()  ?> 
                        <?php //echo $form['concurso_code'] ?></td>
                       
                    </tr>
<!--                    <tr></tr>-->
<!--                    <tr>  </tr>-->
                    <tr>
                        <th align="left">Telefono</th><th align="left">Correo electrónico</th>
                    </tr>
                    <tr> 
                        <td><?php //echo $form['concurso_otra']->renderError() ?> <?php //echo $form['concurso_otra'] ?></td>
                        <td><?php //echo $form['concurso_otra']->renderError() ?> <?php //echo $form['concurso_otra'] ?></td>
                    </tr>
<?php elseif ($tipo == "producto"): ?>
                    <tr>
                        <th align="left">Marca</th><th align="left">Modelo</th>
                    </tr>
                    <tr> 
                    <!--                        <th align="left">--> 
                        <!--                            Código Postal<?php // echo $form['concurso_addres']->renderLabel()
//          ?></th>-->
                        <td><?php echo $form['marca']->renderError() ?> <?php echo $form['marca'] ?></td>
                        <td><?php echo $form['modelo']->renderError() ?> <?php echo $form['modelo'] ?></td>
                    </tr>

        <?php endif; ?>
                <tr>
                    <th colspan="3" align="left">Título * <span class="rojo">

        <?php if ($form['name']->renderError()): {echo "Contenido obligatorio";} endif; ?>

                        </span>
                    </th>
                </tr>
                <tr> 
                    <td colspan="2" height="10">

<?php echo $form['name'] ?> </td>
                </tr>
                <tr>
                    <th colspan="2" align="left">Incidencia *              <span class="rojo">

<?php if ($form['incidencia']->renderError()): {echo "Contenido obligatorio";  } endif; ?>

                        </span></th>
                </tr>
                <tr> 
                    <td colspan="2"><?php //echo $form['incidencia']->renderError()  ?> 
<?php echo $form['incidencia'] ?></td>
                </tr>
                <tr>
                    <th colspan="2" align="left">Categoria de concurso</th>
                </tr>
                <tr> 
                    <td colspan="2"><?php echo $form['concurso_categoria_id']->renderError() ?> <?php echo $form['concurso_categoria_id'] ?></td>
                </tr>
                <tr>
                    <th colspan="2" align="left">Plan de acción *
                        <span class="rojo">

<?php //if ($form['contribucion']['plan_accion']->renderError()): {echo "Contenido obligatorio";} endif; ?>

                        </span>
                    </th>
                </tr>
                <tr> 
                    <td colspan="2"><?php //echo $form['contribucion']['plan_accion']->renderError()  ?>
 <?php //echo $form['contribucion']['plan_accion'] ?></td>
                </tr>
                <tr>
                    <th colspan="2" align="left" >Resumen del Plan de acción *
                        <span class="rojo">

<?php //if ($form['contribucion']['resumen']->renderError()): { echo "Contenido obligatorio";} endif; ?>

                        </span>
                    </th>
                </tr>
                <tr> 
                    <td colspan="2"><?php //echo $form['contribucion']['resumen']->renderError()  ?>
<?php //echo $form['contribucion']['resumen'] ?></td>
                </tr>
                <tr>
                    <td colspan="2">(*) Datos obligatorios </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
