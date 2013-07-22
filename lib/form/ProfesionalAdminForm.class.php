<?php

/**
 * Profesional form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalAdminForm extends ProfesionalForm {

    public function configure() {
        parent::configure();

        //unset ($this['dividendo'], $this['divisor'],$this['lista_cuestionario_id']);

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => $this->getRelatedModelName('States'),
                    'table_method' => 'getWithTodas',
                    'add_empty' => 'Selecciona provincia',
                    'order_by' => array('orden', 'asc')));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true));

        //$this->widgetSchema->setLabel('slug','Url-alias');

        $this->widgetSchema->setLabels(
                array(
                    'name' => 'Profesionales',
                    'direccion' => 'Dirección',
                    'numero' => 'Nº',
                    'states_id' => 'Provincia',
                    'city_id' => 'Localidad',
                    'profesional_tipo_uno_id' => 'Sector profesional',
                    'profesional_tipo_dos_id' => 'Subsector profesional',
                    'email' => 'Correo electrónico',
                    'telefono' => 'Teléfono',
                    'googleMap' => 'Ubicación asociada',
                    'incidencia' => '<strong>' . __('TU RECOMENDACIÓN*') . '</strong>'
        ));
    }

}
