<form method="POST" id="ver-form" action="<?php echo url_for('colaboradores_list', array('id' => $user->getId())) ?>">
    <div id="sf_admin_container">
        <h1>Detalle del colaborador</h1>
        <?php include_partial('flashes'); ?>
        <div style="margin: 10px; float: left; padding: 5px; border: medium double #DDDDDD;text-align: center;">
            <?php echo image_tag('/images/uploads/users/' . ($user->getProfile()->getImage() ? $user->getProfile()->getImage() : 'default.png')) ?><br/>
        </div>
        <div style="clear:both">
            <table><tbody>
                    <tr>
                        <th>Fecha de alta:</th>
                        <td><?php echo date('d/m/Y', strtotime($user->getCreatedAt())) ?></td>
                    </tr>
                    <tr>
                        <th>¿Activado?:</th>
                        <td><?php echo $user->getIsActive() ? 'Si' : 'No' ?></td>
                    </tr>
                    <tr>
                        <th>Usuario:</th>
                        <td><?php echo $user->getUsername() ?></td>
                    </tr>
                    <tr>
                        <th>Jerarquía:</th>
                        <td><?php $heirarchy_list = Doctrine::getTable('Jerarquia')->getHierarchyList(); ?>
                            <?php echo $heirarchy_list[$user->getProfile()->getHierarchy()]; ?></td>
                    </tr>
                    <tr>
                        <th>Correo electrónico:</th>
                        <td><?php echo $user->getProfile()->getEmail() ?></td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><?php echo $user->getProfile()->getName() ?></td>		
                    </tr>
                    <tr>
                        <th>Apellido 1:</th>
                        <td><?php echo $user->getProfile()->getSurname1() ?></td>
                    </tr>		
                    <tr>
                        <th>Apellido 2:</th>
                        <td><?php echo $user->getProfile()->getSurname2() ?></td>
                    </tr>
                    <tr>
                        <th>Sexo:</th>
                        <td><?php echo ucfirst(strtolower($user->getProfile()->getSex())) ?></td>
                    </tr>		
                    <tr>
                        <th>Fecha de nacimiento:</th>
                        <td><?php echo format_datetime($user->getProfile()->getFechaNac(), "p", "es_ES") ?></td>
                    </tr>
                    <tr>
                        <th>Formación académica:</th>
                        <td><?php echo $user->getProfile()->getFormacionAcademica() ?></td>
                    </tr>
                    <tr>
                        <th>Sector profesional:</th>
                        <td><?php echo $user->getProfile()->getColaboradorNivelUno() ?></td>
                    </tr>	
                    <tr>
                        <th>Actividad profesional:</th>
                        <td><?php echo $user->getProfile()->getColaboradorNivelDos() ?></td>
                    </tr>
                    <tr>
                        <th>Dirección:</th>
                        <td><?php echo $user->getProfile()->getDireccion() ?></td>
                    </tr>
                    <tr>
                        <th>Nº:</th>
                        <td><?php echo $user->getProfile()->getNumero() ?></td>
                    </tr>
                    <tr>
                        <th>Piso:</th>
                        <td><?php echo $user->getProfile()->getPiso() ?></td>
                    </tr>	
                    <tr>
                        <th>Puerta:</th>
                        <td><?php echo $user->getProfile()->getPuerta() ?></td>
                    </tr>
                    <tr>
                        <th>C.P.:</th>
                        <td><?php echo $user->getProfile()->getCp() ?></td>
                    </tr>
                    <tr>
                        <th>Provincia:</th>
                        <td><?php echo $user->getProfile()->getStates() ?></td>
                    </tr>
                    <tr>
                        <th>Localidad:</th>
                        <td><?php echo $user->getProfile()->getCity() ?></td>
                    </tr>			
                    <tr>
                        <th>Método de cobro elegido:</th>
                        <td><?php echo $user->getProfile()->getMetodoCobro() ?></td>
                    </tr>
                    <tr>
                        <th>Caja:</th>
                        <td><?php echo $sf_user->getMoneyInFormat($user->getProfile()->getMoney()) . ' €' ?></td>
                    </tr>
                    <tr>
                        <th><?php echo __('Caja acumulada') ?>:</th>
                        <td ><span class="float-left non-edit"><?php echo $sf_user->getMoneyInFormat($user->getProfile()->getMoneySum()) . ' €' ?></span>
                            <input type="button" id="ca-cmd" class="float-right non-edit" value="<?php echo __('Editar') ?>"/>
                            <?php echo $form['cantidad']->render(array('class' => 'edit float-left tamano_10_c', 'maxlength' => '10')); ?>
                            <input type="submit" id="submit" class="float-right edit" value="<?php echo __('Guardar') ?>"/>
                            <input type="button" id="ca-cancel" class="float-right edit" value="<?php echo __('Cancelar') ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <th>Puntos acumulados:</th>
                        <td>
                            <?php echo $user->getProfile()->getAccumulatedPoints() ?>

                        </td>
                    </tr>
                    <tr>
                        <th>Puntos canjeables:</th>
                        <td><?php echo $user->getProfile()->getChangePoints() ?></td>
                    </tr>
                    <tr>
                        <th>Privilegios:</th>
                        <td>
                            <?php foreach ($user->getPermissions() as $v): ?>
                                <?php echo $v->getName() . ' ' ?>
                            <?php endforeach ?>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="volver_al_listado1">
                            <div style="clear: both; height: 21px;"></div>
                            <?php echo link_to('Volver al Listado', '@sfguarduser') ?></td>
                    </tr>
                    <?php echo $form->renderHiddenFields(); ?>
                </tfoot>
            </table>
        </div>
    </div>

</form>	
<?php if (isset($caja_error)): ?>
    <script type="text/javascript">
        alert("<?php echo __('Necesitas incluir una caja acumulada.') ?>");
    </script>

<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function(){
        if(<?php echo isset($caja_error) ? 1 : 0 ?>){
            $('.non-edit').hide();
            $('.edit').show();
        }else{
            $('.non-edit').show();
            $('.edit').hide();
        }
        $('#ca-cmd').bind('click', function(){
            $('.non-edit').hide();
            $('.edit').show();
        });
        $('#ca-cancel').bind('click', function(){
            $('.non-edit').show();
            $('.edit').hide();
        });
      
      
    });
</script>
