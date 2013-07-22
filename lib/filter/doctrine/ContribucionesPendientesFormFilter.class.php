<?php

/**
 * Contribucion filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContribucionesPendientesFormFilter extends BaseContribucionFormFilter
{
  public function configure()
  {
    $i18n = sfContext::getInstance()->getI18N();

    $this->widgetSchema['concurso_tipo_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ConcursoTipo', 'add_empty' => 'Selecciona tipo de concurso'));
    
    
    //$this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => 'Selecciona concurso', 'order_by' => array('name','asc')));
    
    $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                                'model' => $this->getRelatedModelName('Concurso'),
                                'depends' => 'ConcursoTipo',
                                'add_empty' => 'Selecciona concurso', 
                                'order_by' => array('name','asc'),
                                'ajax' => true,
                ));
    
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
    $this->widgetSchema['name']= new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 70, 'class' => 'tamano_40_c'));
    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
		
		$this->validatorSchema['concurso_tipo_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ConcursoTipo', 'column' => 'id'));
  }
  
  public function getFields()
  {
    $fields = parent::getFields();
    
    //the right 'virtual_column_name' is the method to filter
    $fields['concurso_tipo_id'] = 'concurso_tipo_id';
    
    return $fields;
  }
  
  public function addConcursoTipoIdColumnQuery($query, $field, $value)
  {
    $rootAlias = $query->getRootAlias();
    $query->andWhere("co.concurso_tipo_id='$value'");

    return $query;
  }
}
