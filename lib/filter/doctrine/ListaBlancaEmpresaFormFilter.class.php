<?php

/**
 * Empresa filter form.
 *
 * @package    auditoscopia
 * @subpackage filter
 * @author     Slx
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaBlancaEmpresaFormFilter extends BaseEmpresaFormFilter {

    public function configure() {
        $this->widgetSchema['name'] = new sfWidgetFormInput(array('label' => 'Empresa/Entidad'));
        $this->validatorSchema['name'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Provincia',
                    'model' => 'States',
                    'add_empty' => 'Selecciona provincia',
                    'order_by' => array('orden', 'asc')
                ));

        $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true,
                    'order_by' => array('name', 'asc'),
                ));

        //búsqueda avanzada
        $categoria_excelencia_values = array(null => 'Todas', 'Oro' => 'Medalla de oro', 'Plata' => 'Medalla de plata', 'Bronce' => 'Medalla de bronce', 'ninguno' => 'Sin medalla');
        $this->widgetSchema['categoria_excelencia'] = new sfWidgetFormChoice(array('choices' => $categoria_excelencia_values));
        $this->validatorSchema['categoria_excelencia'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($categoria_excelencia_values)));

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector nivel 1',
                    'model' => 'EmpresaSectorUno',
                    'table_method' => 'getSectoresUnoOrderByOrden',
                ));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector nivel 2',
                    'model' => 'EmpresaSectorDos',
                    'depends' => 'EmpresaSectorUno',
                    'ajax' => true,
                    'table_method' => 'getSectoresDosOrderByOrden',
                ));

        //TODO esconder el nivel 3 si no hay nada a seleccionar.
        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector nivel 3',
                    'model' => 'EmpresaSectorTres',
                    'depends' => 'EmpresaSectorDos',
                    'ajax' => true,
                    'add_empty' => 'Todas...',
                    'table_method' => 'getSectoresTresOrderByOrden',
                ));


        $this->useFields(array('name', 'states_id', 'localidad_id', 'categoria_excelencia', 'empresa_sector_uno_id', 'empresa_sector_dos_id',
            'empresa_sector_tres_id'));

        $this->disableLocalCSRFProtection();
    }

    public function getFields() {
        $fields = parent::getFields();
        $fields['categoria_excelencia'] = 'categoria_excelencia';
        $fields['empresa_sector_uno_id'] = 'empresa_sector_uno_id';
        $fields['empresa_sector_dos_id'] = 'empresa_sector_dos_id';
        $fields['empresa_sector_tres_id'] = 'empresa_sector_tres_id';

        return $fields;
    }

    public function addCategoriaExcelenciaColumnQuery(Doctrine_Query $query, $field, $values) {
        if (!empty($values)) {
            $alias = $query->getRootAlias();
            if($values == 'ninguno'):
              $values = 'Sin medalla';  
            endif;
            $rango = CategoriaExcelenciaTable::getRango($values);
            $query->andWhere('(' . $alias . '.dividendo' . ' / ' . $alias . '.divisor' . ') > ?', $rango['valor_min'])
                    ->andWhere('(' . $alias . '.dividendo' . ' / ' . $alias . '.divisor' . ') < ?', $rango['valor_max']);
        }
    }

    public function addNameColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.name LIKE ?', '%' . $values . '%');
        }
    }

    public function addLocalidadColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.localidad = ?', $values);
        }
    }

    public function addEmpresaSectorUnoIdColumnQuery(Doctrine_Query $query, $field, $values) {

        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.empresa_sector_uno_id = ?', $values);
    }

    public function addEmpresaSectorDosIdColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.empresa_sector_dos_id = ?', $values);
    }

    public function addEmpresaSectorTresIdColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.empresa_sector_tres_id = ?', $values);
    }
    
    public function buildQuery(array $values) {
        $query = parent::buildQuery($values);
        return $query;
    }

}
