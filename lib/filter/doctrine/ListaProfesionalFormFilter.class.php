<?php

/**
 * Profesional filter form.
 *
 * @package    auditoscopia
 * @subpackage filter
 * @author     Slx
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaProfesionalFormFilter extends BaseProfesionalFormFilter {

    public function configure() {
        $this->widgetSchema['name'] = new sfWidgetFormInput(array('label' => '<strong>Nombre</strong>'), array('maxlength' => 70));
        $this->validatorSchema['name'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['last_name_one'] = new sfWidgetFormInput(array('label' => '<strong>Apellido 1</strong>'), array('maxlength' => 70));
        $this->validatorSchema['last_name_one'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['last_name_two'] = new sfWidgetFormInput(array('label' => '<strong>Apellido 2</strong>'), array('maxlength' => 70));
        $this->validatorSchema['last_name_two'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['estado_id'] = new sfWidgetFormInput(array('label' => 'Apellidos'), array('maxlength' => 70));
        $this->validatorSchema['estado_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => '<strong>Provincia</strong>',
                    'model' => 'States',
                    'add_empty' => 'Selecciona provincia',
                    'order_by' => array('orden', 'asc')
                ));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => '<strong>Localidad</strong>',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true,
                    'order_by' => array('name', 'asc'),
                ));

        //búsqueda avanzada
        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector nivel 1',
                    'model' => 'ProfesionalTipoUno',
                    'table_method' => 'getTipoUnoOrderByOrden',
                ));

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector nivel 2',
                    'model' => 'ProfesionalTipoDos',
                    'depends' => 'ProfesionalTipoUno',
                    'ajax' => true,
                    'table_method' => 'getTipoDosOrderByOrden',
                ));

        //TODO esconder el nivel 3 si no hay nada a seleccionar.
        $this->widgetSchema['profesionl_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector nivel 3',
                    'model' => 'ProfesionalTipoTres',
                    'depends' => 'ProfesionalTipoDos',
                    'ajax' => true,
                    'add_empty' => 'Todas...',
                    'table_method' => 'getTipoTresOrderByOrden',
                ));


        $this->useFields(array('name', 'last_name_one', 'last_name_two', 'states_id', 'city_id', 'profesional_tipo_uno_id', 'profesional_tipo_dos_id',
            'profesional_tipo_tres_id', 'estado_id'));

        $this->disableLocalCSRFProtection();
        $this->validatorSchema->setOption('allow_extra_fields', true);
        //$this->widgetSchema->setNameFormat('profesional[%s]');
    }

    public function getFields() {
        $fields = parent::getFields();
        $fields['profesional_tipo_uno_id'] = 'profesional_tipo_uno_id';
        $fields['profesional_tipo_dos_id'] = 'profesional_tipo_dos_id';
        $fields['profesional_tipo_tres_id'] = 'profesional_tipo_tres_id';

        return $fields;
    }

    public function addCategoriaExcelenciaColumnQuery(Doctrine_Query $query, $field, $values) {
        if (!empty($values)) {
            $alias = $query->getRootAlias();
            $rango = CategoriaExcelenciaTable::getRango($values);
            $query->andWhere('FLOOR(' . $alias . '.dividendo' . ' / ' . $alias . '.divisor' . ') >= ?', $rango['valor_min'])
                    ->andWhere('FLOOR(' . $alias . '.dividendo' . ' / ' . $alias . '.divisor' . ') <= ?', $rango['valor_max']);
        }
    }

    /* public function addNameColumnQuery(Doctrine_Query $query, $field, $values) {
      if ($values != null) {
      $valuesArray = array_filter(explode(" ", trim($values)));
      $searchString = '';
      $searchFields = array($query->getRootAlias() . '.first_name', $query->getRootAlias() . '.last_name_one', $query->getRootAlias() . '.last_name_two');

      foreach ($valuesArray as $value) {
      foreach ($searchFields as $searchfield) {
      $searchString .= $searchfield . ' LIKE "%' . $value . '%" OR ';
      }
      }
      $searchString = substr($searchString, 0, -4);

      $query->addWhere('(' . $searchString . ')');
      }
      } */

    public function addNameColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $searchString = '';
            $ma_values = explode(' ', trim($values));
            foreach ($ma_values as $value) {
                $searchString .= $query->getRootAlias() . '.first_name' . ' LIKE "%' . $value . '%" OR ';
            }
            $searchString = substr($searchString, 0, -4);
            $query->addWhere('(' . $searchString . ')');
        }
    }

    public function addLastNameOneColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $searchString = '';
            $ma_values = explode(' ', trim($values));
            foreach ($ma_values as $value) {
                $searchString .= $query->getRootAlias() . '.last_name_one' . ' LIKE "%' . $value . '%" OR ';
            }
            $searchString = substr($searchString, 0, -4);
            $query->addWhere('(' . $searchString . ')');
        }
    }

    public function addLastNameTwoColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $searchString = '';
            $ma_values = explode(' ', trim($values));
            foreach ($ma_values as $value) {
                $searchString .= $query->getRootAlias() . '.last_name_two' . ' LIKE "%' . $value . '%" OR ';
            }
            $searchString = substr($searchString, 0, -4);
            $query->addWhere('(' . $searchString . ')');
        }
    }

    public function addLocalidadColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.localidad = ?', $values);
        }
    }

    public function addProfesionalTipoUnoIdColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.profesional_tipo_uno_id = ?', $values);
    }

    public function addProfesionalTipoDosIdColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.profesional_tipo_dos_id = ?', $values);
    }

    public function addProfesionalTipoTresIdColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.profesional_tipo_tres_id = ?', $values);
    }

    public function buildQuery(array $values) {
        $alias = 'q';
        $query = parent::buildQuery($values);
        $query->addSelect('q.*, s.*, l.*, CONCAT(q.first_name, " ", q.last_name_one) as mid_name');
        $query->andWhere('q.profesional_estado_id = 2');
        //echo $query->getSqlQuery();
        return $query;
    }

}
