<?php

/**
 * ColaboradorPuntosHistorico filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ColaboradorPuntosHistoricoFormFilter extends BaseColaboradorPuntosHistoricoFormFilter
{
  public function configure()
  {
    $i18n = sfContext::getInstance()->getI18N();
    
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
    
    $this->widgetSchema->setLabels(array('puntos'=>'Puntos concedidos'));
    
    $this->widgetSchema['descripcion'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 70, 'class' => 'tamano_40_c'));
    $this->widgetSchema['puntos'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 10, 'class' => 'tamano_10_c'));
    $this->widgetSchema['tipo_punto'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 40, 'class' => 'tamano_20_c'));

//    $test = sfGuardUserTable::getUserComboList()->fetchArray();

//    echo "<pre>";print_r($test);exit;
    
    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'=> 'sfGuardUser',
        'query' => sfGuardUserTable::getUserComboList(),
        'method'=> 'getUsername',
        'add_empty' => 'Selecciona Usuario',
    ));

    $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => 'colaboradorpuntoshistorico', 'required' => false), array('required' => $i18n->__('Necesitas seleccionar un Usuario.'), 'invalid'=> $i18n->__('Ese Usuario no es válido.')));
    
    $this->validatorSchema['puntos'] = new sfValidatorSchemaFilter('text', new sfValidatorString(array('required' => false)));
    


    
  }
}
