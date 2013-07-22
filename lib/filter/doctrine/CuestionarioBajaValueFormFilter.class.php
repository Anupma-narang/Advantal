<?php

/**
 * CuestionarioBajaValue filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CuestionarioBajaValueFormFilter extends BaseCuestionarioBajaValueFormFilter {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => __('Desde %from_date%<br />Hasta %to_date%')));

        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px !important;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['surname_1'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px !important;'));
        $this->validatorSchema['surname_1'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['surname_2'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px !important;'));
        $this->validatorSchema['surname_2'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['nombre'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px !important;'));
        $this->validatorSchema['nombre'] = new sfValidatorPass(array('required' => false));

        /* $this->widgetSchema['hierarchy'] = new sfWidgetFormDoctrineChoice(array('model' => 'Jerarquia', 'label' => 'Jerarquía', 'add_empty' => 'Selecciona Jerarquía'));
          $this->validatorSchema['hierarchy'] = new sfValidatorPass(array('required' => false)); */
    }

    public function getFields() {
        $fields = parent::getFields();
        $fields['surname_1'] = 'surname_1';
        $fields['surname_2'] = 'surname_2';
        $fields['nombre'] = 'nombre';
        return $fields;
    }

    public function addUserIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin($rootAlias . '.User gu');
        $fieldName = "username";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'gu', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'gu', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addSurname1ColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('sfGuardUserProfile p')
                ->where("p.surname1 LIKE '%$value[text]%'")
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

    public function addSurname2ColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('sfGuardUserProfile p')
                ->where("p.surname2 LIKE '%$value[text]%'")
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

    public function addNombreColumnQuery($query, $field, $value) {
        //echo $value['text']; exit;
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('sfGuardUserProfile p')
                ->where("p.name LIKE '%$value[text]%'")
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

    /* public function addHierarchyColumnQuery($query, $field, $value) {
      $rootAlias = $query->getRootAlias();

      $query1 = Doctrine_Query::create()
      ->from('sfGuardUserProfile p')
      ->where('p.hierarchy = ?', $value)
      ->execute();

      $user_ids = array();
      foreach ($query1 as $i => $query1_val) {
      $user_ids[$i] = $query1_val->user_id;
      }
      $user_ids = implode(",", $user_ids);
      if (!empty($user_ids)) {
      $query->andWhere($rootAlias . '.user_id IN (' . $user_ids . ')');
      }
      } */
}
