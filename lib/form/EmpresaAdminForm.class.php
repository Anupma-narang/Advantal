<?php

/**
 * Empresa form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpresaAdminForm extends EmpresaForm {

    public function configure() {
        parent::configure();

        unset($this['dividendo'], $this['divisor'], $this['lista_cuestionario_id']);

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => $this->getRelatedModelName('States'),
                    'table_method' => 'getWithTodas',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona provincia'));

        $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true));
        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'class' => 'tamano_8_c_1'));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
                    'pattern' => '#^(\d{9})$#',
                    'required' => false
                        ),
                        array('invalid' => 'Ese teléfono no es válido.')
        );

        //$this->widgetSchema->setLabel('slug','Url-alias');

        $this->widgetSchema->setLabels(
                array(
                    'name' => 'Empresa/Entidad',
                    'direccion' => 'Dirección',
                    'numero' => 'Nº',
                    'codigopostal' => 'C.P.',
                    'states_id' => 'Provincias',
                    'empresa_sector_dos_id' => 'Subsector',
                    'email' => 'Correo electrónico',
                    'telefono' => 'Teléfono',
                    'googleMap' => 'Ubicación asociada'
        ));
    }

}
