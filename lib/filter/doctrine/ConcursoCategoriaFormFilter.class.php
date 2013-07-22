<?php

/**
 * ConcursoCategoria filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursoCategoriaFormFilter extends BaseConcursoCategoriaFormFilter
{
  public function configure()
  {
      $this->widgetSchema['concurso_tipo_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoTipo'), 'add_empty' => 'Selecciona tipo de concurso'));
      $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 3, 'class' => 'tamano_3_c'));
      $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 70, 'class' => 'tamano_50_c'));
  }
}
