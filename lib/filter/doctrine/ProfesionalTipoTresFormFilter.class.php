<?php

/**
 * ProfesionalTipoTres filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalTipoTresFormFilter extends BaseProfesionalTipoTresFormFilter {

    public function configure() {
        $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 3, 'style' => "width: 22px;"));
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => "width: 281px;"));

        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector',
                    'model' => 'ProfesionalTipoUno',
                    'order_by' => 'orden',
                    'add_empty' => 'Selecciona sector'));

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Subsector',
                    'model' => 'ProfesionalTipoDos',
                    'order_by' => 'orden',
                    'depends' => 'ProfesionalTipoUno',
                    'add_empty' => 'Selecciona subsector'));
    }

}
