<?php

/**
 * UserProductCaseStudyRequest filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserProductCaseStudyRequestFormFilter extends BaseUserProductCaseStudyRequestFormFilter {

    public function configure() {
        parent::configure();
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $status_array = array('1' => 'Revista ',
            '2' => 'Tramitado',
            '3' => 'Cerrado');
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array));
        $this->widgetSchema['user_name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('style' => 'width:176px;', 'maxlength' => 25));
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('style' => 'width:225px;', 'maxlength' => 70));
        $this->widgetSchema['homepage'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['marca'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('style' => 'width:225px;', 'maxlength' => 70));
        $this->widgetSchema['modelo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('style' => 'width:141px;', 'maxlength' => 20));
        $this->widgetSchema['description'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['summary'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoUno',
            'order_by' => array('orden', 'asc'),
            'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoDos',
            'depends' => 'ProductoTipoUno',
            'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoTres',
            'depends' => 'ProductoTipoDos',
            'add_empty' => 'Selecciona tipo de producto'));


        $this->setValidators(array(
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false)),
            'user_name' => new sfValidatorPass(array('required' => false)),
            'name' => new sfValidatorPass(array('required' => false)),
            'homepage' => new sfValidatorPass(array('required' => false)),
            'marca' => new sfValidatorPass(array('required' => false)),
            'modelo' => new sfValidatorPass(array('required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'summary' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            'producto_tipo_uno_id' => new sfValidatorPass(array('required' => false)),
            'producto_tipo_dos_id' => new sfValidatorPass(array('required' => false)),
            'producto_tipo_tres_id' => new sfValidatorPass(array('required' => false)),
        ));
    }

    /*  public function addProductoTipoUnoIdColumnQuery(Doctrine_Query $query, $field, $values) {
      if ($values != null) {
      $query->addWhere($query->getRootAlias() . '.producto_tipo_uno_id = ?', $values);
      }
      } */

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . '.status = ?', $values);
        }
    }

}
