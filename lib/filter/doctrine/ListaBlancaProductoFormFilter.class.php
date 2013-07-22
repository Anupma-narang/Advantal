<?php

/**
 * Producto filter form.
 *
 * @package    auditoscopia
 * @subpackage filter
 * @author     Slx
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaBlancaProductoFormFilter extends BaseProductoFormFilter {

    public function configure() {
        $categoria_excelencia_values = array(null => 'Todas', 'Oro' => 'Medalla de oro', 'Plata' => 'Medalla de plata', 'Bronce' => 'Medalla de bronce', 'ninguno' => 'Sin medalla');
        $this->widgetSchema['categoria_excelencia'] = new sfWidgetFormChoice(array('choices' => $categoria_excelencia_values));
        $this->validatorSchema['categoria_excelencia'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($categoria_excelencia_values)));

        sfApplicationConfiguration::getActive()->loadHelpers(array('Url'));

        $this->widgetSchema['name'] = new audWidgetFormJQueryAutocompleterInField(array(
                    'url' => url_for('@producto_autocomplete?field=name&lista=lb')
                ));
        $this->widgetSchema['marca'] = new audWidgetFormJQueryAutocompleterInField(array(
                    'url' => url_for('@producto_autocomplete?field=marca&lista=lb')
                ));
        $this->widgetSchema['modelo'] = new audWidgetFormJQueryAutocompleterInField(array(
                    'url' => url_for('@producto_autocomplete?field=modelo&lista=lb')
                ));


        $this->widgetSchema->setLabels(array(
            'name' => 'Producto',
        ));
//        $this->useFields(array('name', 'marca', 'modelo'));
        $this->disableLocalCSRFProtection();
    }

    public function addNameColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.name LIKE ?', '%' . $values . '%');
        }
    }

    public function addModeloColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.modelo LIKE ?', '%' . $values . '%');
        }
    }

    public function addMarcaColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.marca LIKE ? ', '%' . $values . '%');
        }
    }

    public function addCategoriaExcelenciaColumnQuery(Doctrine_Query $query, $field, $values) {
        if (!empty($values)) {
            $alias = $query->getRootAlias();
            if ($values == 'ninguno'):
                $values = 'Sin medalla';
            endif;
            $rango = CategoriaExcelenciaTable::getRango($values);
            $query->andWhere('(' . $alias . '.dividendo' . ' / ' . $alias . '.divisor' . ') > ?', $rango['valor_min'])
                    ->andWhere('(' . $alias . '.dividendo' . ' / ' . $alias . '.divisor' . ') < ?', $rango['valor_max']);
        }
    }

}