<?php

/**
 * Contratanos filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

class ContratanosFormFilter extends BaseContratanosFormFilter {

    public function configure() {
        $status_array = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate
                (array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false, 'template' => 'Desde %from_date%<br />Hasta %to_date%'));
        //$this->widgetSchema['status'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array));
        $this->widgetSchema['road_type_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->widgetSchema['nombre']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['apellido1']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['apellido2']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['apellido2']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['name']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['actividad']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['actividad']->setAttributes(array('maxlength' => 70, 'style' => 'width:215px !important;'));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'States',
            'add_empty' => __('Selecciona provincia'),
            'label' => 'Provincia',
            'order_by' => array('orden', 'asc')), array("style" => "width: 225px"));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => __('Selecciona localidad'),
                ), array("style" => "width: 225px"));

        $this->setValidators(array(
            'status' => new sfValidatorChoice(array('choices' => array_keys($status_array), 'required' => false)),
            'name' => new sfValidatorPass(array('required' => false)),
            'road_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'cif' => new sfValidatorPass(array('required' => false)),
            'actividad' => new sfValidatorPass(array('required' => false)),
            'nombre' => new sfValidatorPass(array('required' => false)),
            'apellido1' => new sfValidatorPass(array('required' => false)),
            'apellido2' => new sfValidatorPass(array('required' => false)),
            'cargo' => new sfValidatorPass(array('required' => false)),
            'email' => new sfValidatorPass(array('required' => false)),
            'phone' => new sfValidatorPass(array('required' => false)),
            'direccion' => new sfValidatorPass(array('required' => false)),
            'num' => new sfValidatorPass(array('required' => false)),
            'piso' => new sfValidatorPass(array('required' => false)),
            'puerta' => new sfValidatorPass(array('required' => false)),
            'cp' => new sfValidatorPass(array('required' => false)),
            'states_id' => new sfValidatorPass(array('required' => false)),
            'city_id' => new sfValidatorPass(array('required' => false)),
            'ayudar' => new sfValidatorPass(array('required' => false)),
            'servicio' => new sfValidatorPass(array('required' => false)),
            'what' => new sfValidatorPass(array('required' => false)),
            'empresa' => new sfValidatorPass(array('required' => false)),
            'form_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        ));
    }

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $rootAlias = $query->getRootAlias();
            $query->andWhere('r.status = ?', $values);
            //$query->addWhere($query->getRootAlias() . '.status = ?', $values);
        }
    }
    
     public function addEmpresaColumnQuery(Doctrine_Query $query, $field, $values) {
         $fieldName = "empresa";
       if (is_array($values) && isset($values['is_empty']) && $values['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'r', $fieldName), array(''));
        } else if (is_array($values) && isset($values['text']) && '' != $values['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'r', $fieldName), '%' . $values['text'] . '%');
        }
          
        return $query;
    }

    public function addCityIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere($query->getRootAlias().".city_id='$value'");
        return $query;
    }

    public function addStatesIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere($query->getRootAlias() . ".states_id='$value'");
        return $query;
    }

}
