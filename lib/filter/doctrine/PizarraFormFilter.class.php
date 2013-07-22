<?php

/**
 * Pizarra filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PizarraFormFilter extends BasePizarraFormFilter {

  public function configure() {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    $days_array = array(
        '' => __('Todos'),
        ',1' => __('Lunes'),
        ',2' => __('Martes'),
        ',3' => __('Miércoles'),
        ',4' => __('Jueves'),
        ',5' => __('Viernes'),
        ',6' => __('Sábado'),
        ',7' => __('Domingo'));
    $months_array = array(
        '' => __('Todos'),
        ',1' => __('Enero'),
        ',2' => __('Febrero'),
        ',3' => __('Marzo'),
        ',4' => __('Abril'),
        ',5' => __('Mayo'),
        ',6' => __('Junio'),
        ',7' => __('Julio'),
        ',8' => __('Agosto'),
        ',9' => __('Septiembre'),
        ',10' => __('Octubre'),
        ',11' => __('Noviembre'),
        ',12' => __('Diciembre')
    );
    $hierarch = array('' => 'Selecciona Jerarquía','1' => 'Público');
    

    $hierarch = array_merge($hierarch, Doctrine::getTable('Jerarquia')->getHierarchyList()); 
    
    $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 150, 'class' => 'tamano_40_c'));
    $this->widgetSchema['text'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->widgetSchema['seccion'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 32, 'class' => 'tamano_20_c'));
    $this->widgetSchema['visibilidad'] = new sfWidgetFormChoice(array('choices' => $hierarch));
    $this->widgetSchema['velocidad'] = new sfWidgetFormChoice(array('choices' => array('' => 'Todos',10000 => '10 segundos', 30000 => '30 segundos', 60000 => '60 segundos')));
    $this->widgetSchema['desde'] = new sfWidgetFormDateTime(array('format' => '%date% %time%'), array('disabled' => 'disabled'));
    $this->widgetSchema['hasta'] = new sfWidgetFormDateTime(array('format' => '%date% %time%'), array('disabled' => 'disabled'));
    $this->widgetSchema['days'] = new sfWidgetFormChoice(array('choices' => $days_array));
    $this->widgetSchema['months'] = new sfWidgetFormChoice(array('choices' => $months_array));
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));
    $this->widgetSchema['updated_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate()));


    $this->setValidators(array(
        'name' => new sfValidatorPass(array('required' => false)),
        'text' => new sfValidatorPass(array('required' => false)),
        'seccion' => new sfValidatorPass(array('required' => false)),
        'visibilidad' => new sfValidatorPass(array('required' => false)),
        'velocidad' => new sfValidatorPass(array('required' => false)),
        'desde' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        'hasta' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        'days' => new sfValidatorPass(array('required' => false)),
        'months' => new sfValidatorPass(array('required' => false)),
        'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    // $this->widgetSchema['visibilidad']->setOption('multiple', true);
  }

  public function getFields() {
    $fields = parent::getFields();
    //$fields['visibilidad']['text'] = 'visibilidad';
    return $fields;
  }
  
  

}
