<?php

/**
 * Auditanos filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AuditanosFormFilter extends BaseAuditanosFormFilter {

    public function configure() {

        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate
                        (array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false, 'template' => 'Desde %from_date%<br />Hasta %to_date%'));

        $audit_status = array(
            '' => 'Selecciona estado',
            '1' => 'Revista ',
            '2' => 'Tramitado',
            '3' => 'Cerrado');

        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $audit_status));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'States', 'add_empty' => 'Selecciona provincia', 'order_by' => array('orden', 'asc')));
        //$this->widgetSchema['city_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => 'Selecciona localidad'));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                        //'ajax' => true,
                ));

        $this->widgetSchema['hierarchy'] = new sfWidgetFormDoctrineChoice(array('model' => 'Jerarquia', 'label' => 'Jerarquía', 'add_empty' => 'Selecciona Jerarquía'));
        $this->validatorSchema['hierarchy'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['states_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['city_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['status'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($audit_status)));
    }

    public function getFields() {
        $fields = parent::getFields();
        $fields['hierarchy'] = 'hierarchy';
        $fields['states_id'] = 'states_id';
        $fields['city_id'] = 'city_id';
        return $fields;
    }

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $rootAlias = $query->getRootAlias();
            $query->andWhere('r.status = ?', $values);
            //$query->addWhere($query->getRootAlias() . '.status = ?', $values);
        }
    }

    public function addUserIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin($rootAlias . '.sfGuardUser gu');
        $fieldName = "username";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'gu', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'gu', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addStatesIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();

        $query1 = Doctrine_Query::create()
                ->from('sfGuardUserProfile p')
                ->where('p.states_id = ?', $value)
                ->execute();

        $newvar = array();
        foreach ($query1 as $i => $query1_val) {
            $newvar[$i] = $query1_val->user_id;
        }
        if ($newvar) {
            $comma_separated = implode(",", $newvar);
            $query->andWhere('r.user_id IN (' . $comma_separated . ')');
        } else {
            $comma_separated = '';
            $query->andWhere('r.user_id IN ?', $comma_separated);
        }

        return $query;
    }

    public function addCityIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();

        $query1 = Doctrine_Query::create()
                ->from('sfGuardUserProfile p')
                ->where('p.city_id = ?', $value)
                ->execute();

        $newvar = array();
        foreach ($query1 as $i => $query1_val) {
            $newvar[$i] = $query1_val->user_id;
        }
        if ($newvar) {
            $comma_separated = implode(",", $newvar);
            $query->andWhere('r.user_id IN (' . $comma_separated . ')');
        } else {
            $comma_separated = '';
            $query->andWhere('r.user_id IN ?', $comma_separated);
        }

        return $query;
    }

    public function addHierarchyColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();

        $query1 = Doctrine_Query::create()
                ->from('sfGuardUserProfile p')
                ->where('p.hierarchy = ?', $value)
                ->execute();

        $newvar = array();
        foreach ($query1 as $i => $query1_val) {
            $newvar[$i] = $query1_val->user_id;
        }
        if ($newvar) {
            $comma_separated = implode(",", $newvar);
            $query->andWhere('r.user_id IN (' . $comma_separated . ')');
        } else {
            $comma_separated = '';
            $query->andWhere('r.user_id IN ?', $comma_separated);
        }
        return $query;
    }

}
