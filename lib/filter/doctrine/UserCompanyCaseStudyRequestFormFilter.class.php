<?php

/**
 * UserCompanyCaseStudyRequest filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

class UserCompanyCaseStudyRequestFormFilter extends BaseUserCompanyCaseStudyRequestFormFilter {

    public function configure() {
        $status_array = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');
        $this->setWidgets(array(
            'status' => new sfWidgetFormChoice(array(
                'choices' => $status_array)),
            'name' => new sfWidgetFormFilterInput(array(
                'with_empty' => false), array('style' => 'width:225px',
                'maxlength' => 70)),
            'homepage' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array(
                'model' => $this->getRelatedModelName('RoadType'),
                'add_empty' => true)),
            'direccion' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'numero' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'piso' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'puerta' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'states_id' => new sfWidgetFormDoctrineDependentSelect(array(
                'model' => $this->getRelatedModelName('States'),
                'add_empty' => __('Selecciona provincia'),
                'order_by' => array('orden', 'asc'))),
            'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                'model' => $this->getRelatedModelName('Localidad'),
                'add_empty' => __('Selecciona localidad'),
                'depends' => 'States')),
            'cp' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'description' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
            'summary' => new sfWidgetFormFilterInput(array(
                'with_empty' => false)),
        ));
        $this->widgetSchema['user_name'] = new sfWidgetFormFilterInput(array(
                    'with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px;'));
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
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array(
                    'from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));
        $this->widgetSchema->setNameFormat('user_company_case_study_request_filters[%s]');


        $this->setValidators(array(
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false)),
            'user_name' => new sfValidatorPass(array('required' => false)),
            'name' => new sfValidatorPass(array('required' => false)),
            'homepage' => new sfValidatorPass(array('required' => false)),
            'road_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoadType'), 'column' => 'id')),
            'direccion' => new sfValidatorPass(array('required' => false)),
            'numero' => new sfValidatorPass(array('required' => false)),
            'piso' => new sfValidatorPass(array('required' => false)),
            'puerta' => new sfValidatorPass(array('required' => false)),
            'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorUno'), 'column' => 'id')),
            'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorDos'), 'column' => 'id')),
            'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorTres'), 'column' => 'id')),
            'states_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
            'city_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id')),
            'cp' => new sfValidatorPass(array('required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'summary' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        ));
    }

}
