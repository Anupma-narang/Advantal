<?php

/**
 * CompanyCaseStudy filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompanyCaseStudyFormFilter extends BaseCompanyCaseStudyFormFilter {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'add_empty' => 'Selecciona provincia',
                    'label' => 'Provincia',
                    'order_by' => array('orden', 'asc')));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad'));
        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector',
                    'model' => 'EmpresaSectorUno',
                    'order_by' => 'orden',
                    'add_empty' => 'Selecciona sector'));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Subsector',
                    'model' => 'EmpresaSectorDos',
                    'order_by' => 'orden',
                    'depends' => 'EmpresaSectorUno',
                    'add_empty' => 'Selecciona subsector'));
        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Actividad',
                    'model' => 'EmpresaSectorTres',
                    'order_by' => 'orden',
                    'depends' => 'EmpresaSectorDos',
                    'add_empty' => 'Selecciona actividad'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('label' => 'Estado', 'choices' => array('1' => 'Revista', '2' => 'Tramitado', '3' => 'Cerrado')));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));


        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),
            'states_id' => new sfValidatorPass(array('required' => false)),
            'city_id' => new sfValidatorPass(array('required' => false)),
            'empresa_sector_uno_id' => new sfValidatorPass(array('required' => false)),
            'empresa_sector_dos_id' => new sfValidatorPass(array('required' => false)),
            'empresa_sector_tres_id' => new sfValidatorPass(array('required' => false)),
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false)),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        ));
    }

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . '.status = ?', $values);
        }
    }

}

