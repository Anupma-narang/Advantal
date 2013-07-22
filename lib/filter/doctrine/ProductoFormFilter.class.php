<?php

/**
 * Producto filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoFormFilter extends BaseProductoFormFilter {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        unset($this["valida"], $this["lista_cuestionario_id"]);


        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate
                        (array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false, 'template' => 'Desde %from_date%<br />Hasta %to_date%'));
        $this->widgetSchema['created_at']->setLabel('Creado el');

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
        /* $this->widgetSchema['lista_cuestionario_id'] = new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('Cuestionario'),
          'add_empty' => true,
          'table_method' => 'getCuestionariosForProducto'
          )); */
        $this->widgetSchema['marca'] = new audWidgetFormJQueryAutocompleterInField(array(
                    'url' => url_for('@producto_autocomplete?field=marca')
                ));
        $this->widgetSchema['modelo'] = new audWidgetFormJQueryAutocompleterInField(array(
                    'url' => url_for('@producto_autocomplete?field=modelo')
                ));


        /* $validaChoices = array_merge(array('todas' => 'Todas'), Producto::$valida);
          $this->widgetSchema['valida'] = new sfWidgetFormChoice(
          array('choices' => $validaChoices)
          );
          $this->validatorSchema['valida'] = new sfValidatorChoice(
          array('choices' => array_keys($validaChoices))
          ); */

        $ma_medalla = array(null => 'Selecciona medalla', 'Oro' => 'Oro', 'Plata' => 'Plata', 'Bronce' => 'Bronce', 'ninguno' => 'Sin medalla');
        $this->widgetSchema['medalla'] = new sfWidgetFormChoice(array('choices' => $ma_medalla));
        $this->validatorSchema['medalla'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($ma_medalla)));

        $choices_lista = array('0' => __("Selecciona lista"), 'lb' => __("Blanca"), 'ln' => __("Negra"), 'null' => __("Ninguna"));
        $this->widgetSchema['lista'] = new sfWidgetFormChoice(array(
                    'choices' => $choices_lista,
                ));

        $this->widgetSchema->setLabels(array(
            'created_at' => 'Creado el',
            'name' => 'Producto',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'producto_tipo_uno_id' => 'Sector del producto',
            'producto_tipo_dos_id' => 'Subsector del producto',
            'producto_tipo_tres_id' => 'Tipo de producto',
            'medalla' => 'Medalla',
                /* 'lista_cuestionario_id' => 'Cuestionario asociado' */
        ));
        if (sfContext::getInstance()->getModuleName() == 'listaNegraProducto') {
            $this->widgetSchema['name']->setAttributes(array('maxlength' => 70, 'style' => 'width: 281px;'));
            $this->widgetSchema['marca']->setAttributes(array('maxlength' => 70, 'style' => 'width: 281px;'));
            $this->widgetSchema['modelo']->setAttributes(array('maxlength' => 20, 'style' => 'width: 141px;'));
        } else {
            $this->widgetSchema['name']->setAttributes(array('maxlength' => 70, 'style' => 'width:225px;'));
            $this->widgetSchema['marca']->setAttributes(array('maxlength' => 70, 'style' => 'width:225px;'));
            $this->widgetSchema['modelo']->setAttributes(array('maxlength' => 20, 'style' => 'width:141px;'));
        }


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', true);
    }

    public function addMedallaColumnQuery(Doctrine_Query $query, $field, $values) {
        $medalla_var_min_values = array();
        $medalla_var_max_values = array();
        if ($values == 'ninguno') {
            $values = 'Sin medalla';
        }
        $medalla_values = Doctrine::getTable('CategoriaExcelencia')->createQuery()
                ->select('valor_min', 'valor_max')
                ->Where('nombre=?', $values)
                ->execute();
        foreach ($medalla_values as $data):
            $medalla_var_min_values[$values] = $data->getValorMin();
            $medalla_var_max_values[$values] = $data->getValorMax();
        endforeach;
        if ($values != null) {
            $query->addWhere("(dividendo/divisor) > " . $medalla_var_min_values[$values] . " and (dividendo/divisor) < " . $medalla_var_max_values[$values]);
        }
    }

    public function addListaColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values == 'null') {
            $query->addWhere($query->getRootAlias() . '.lista IS NULL');
        } elseif ($values != '0') {
            $query->addWhere($query->getRootAlias() . '.lista = ?', $values);
        }
        
    }

    public function addMarcaColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere('marca LIKE ?', '%' . $values . '%');
        }
    }

    public function addModeloColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere('modelo LIKE ?', '%' . $values . '%');
        }
    }

    /* public function addValidaColumnQuery(Doctrine_Query $query, $field, $values) {
      if ($values != 'todas') {
      $query->addWhere('valida = ?', $values);
      }
      } */
}
