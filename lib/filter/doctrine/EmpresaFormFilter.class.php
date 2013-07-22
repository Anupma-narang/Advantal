<?php

/**
 * Empresa filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpresaFormFilter extends BaseEmpresaFormFilter {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        $this->widgetSchema['empresa_sector_uno_id']->setLabel('Sector');

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate
                        (array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false, 'template' => 'Desde %from_date%<br />Hasta %to_date%'));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'add_empty' => __('Selecciona provincia'),
                    'label' => 'Provincia',
                    'order_by' => array('orden', 'asc')
            ),
                array("style"=>"width: 235px"));

        $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => __('Selecciona localidad'),
                    ),
                array("style"=>"width: 235px"));

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector',
                    'model' => 'EmpresaSectorUno',
                    'order_by' => 'orden',
                    'add_empty' => __('Selecciona sector')));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Subsector',
                    'model' => 'EmpresaSectorDos',
                    'order_by' => 'orden',
                    'depends' => 'EmpresaSectorUno',
                    'add_empty' => __('Selecciona subsector')));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Actividad',
                    'model' => 'EmpresaSectorTres',
                    'order_by' => 'orden',
                    'depends' => 'EmpresaSectorDos',
                    'add_empty' => __('Selecciona actividad')));

        $choices_lista = array('0' => __("Selecciona lista"), 'lb' => __("Blanca"), 'ln' => __("Negra"), 'null' => __("Ninguna"));
        $this->widgetSchema['lista'] = new sfWidgetFormChoice(array(
                    'choices' => $choices_lista,
                ));

        $this->widgetSchema['name']->setAttribute('maxlength', 70);
        $this->widgetSchema['name']->setAttribute('class', 'tamano_32_c');

        $categoria_excelencia_values = array(null => 'Selecciona medalla', 'Oro' => 'Oro', 'Plata' => 'Plata', 'Bronce' => 'Bronce', 'ninguno' => 'Sin medalla');
        $this->widgetSchema['categoria_excelencia'] = new sfWidgetFormChoice(array('choices' => $categoria_excelencia_values));
        $this->validatorSchema['categoria_excelencia'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($categoria_excelencia_values)));
    }

    public function addListaColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values == 'null') {
            $query->addWhere($query->getRootAlias() . '.lista IS NULL');
        } elseif ($values != '0') {
            $query->addWhere($query->getRootAlias() . '.lista = ?', $values);
        }
    }

    public function addCategoriaExcelenciaColumnQuery(Doctrine_Query $query, $field, $values) {
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

}
