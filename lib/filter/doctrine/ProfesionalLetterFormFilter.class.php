<?php

/**
 * ProfesionalLetter filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalLetterFormFilter extends BaseProfesionalLetterFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        //$this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => true, 'order_by' => array('name','asc')));
        //$this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('desde %from_date%<br />hasta %to_date%')));
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:280px;'));
        $this->widgetSchema['last_name_one'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['last_name_two'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['first_name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta  %to_date%')));
        //$this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'ProfesionalTipoTres', 'add_empty' => true));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'States', 'add_empty' => 'Selecciona provincia', 'order_by' => array('orden', 'asc')));
        //$this->widgetSchema['city_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => 'Selecciona localidad'));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                        //'ajax' => true,
                ));
        //$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector',
                    'model' => 'ProfesionalTipoUno',
                    'order_by' => 'orden',
                    'add_empty' => 'Selecciona sector'));

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Subsector',
                    'model' => 'ProfesionalTipoDos',
                    'order_by' => 'orden',
                    'depends' => 'ProfesionalTipoUno',
                    'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Actividad',
                    'model' => 'ProfesionalTipoTres',
                    'order_by' => 'orden',
                    'depends' => 'ProfesionalTipoDos',
                    'add_empty' => 'Selecciona actividad'));
        $this->widgetSchema['profesional_letter_estado_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Estado',
                    'model' => 'ProfesionalLetterEstado',
                    'table_method' => 'getEstedioLetterName',
                    'order_by' => 'orden',
                    'add_empty' => 'Selecciona estado'));

        $this->widgetSchema['profesional_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => true, 'order_by' => array('first_name', 'asc')));
        //$this->validatorSchema['concurso_tipo_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ConcursoTipo', 'column' => 'id'));

        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px !important;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['profesional_tipo_uno_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['profesional_tipo_tres_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['profesional_tipo_dos_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['last_name_one'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['last_name_two'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['first_name'] = new sfValidatorPass(array('required' => false));
    }

    public function getFields() {
        $fields = parent::getFields();

        //the right 'virtual_column_name' is the method to filter
        $fields['profesional_tipo_tres_id'] = 'profesional_tipo_tres_id';
        $fields['profesional_tipo_uno_id'] = 'profesional_tipo_uno_id';
        $fields['profesional_tipo_dos_id'] = 'profesional_tipo_dos_id';

        return $fields;
    }

    public function addProfesionalTipoTresIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("p.profesional_tipo_tres_id = ?", $value);

        return $query;
    }

    public function addFirstNameColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $fieldName = "first_name";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'p', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'p', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addLastNameOneColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $fieldName = "last_name_one";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'p', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'p', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addLastNameTwoColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $fieldName = "last_name_two";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'p', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'p', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addProfesionalTipoUnoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("p.profesional_tipo_uno_id = ?", $value);

        return $query;
    }

    public function addProfesionalTipoDosIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("p.profesional_tipo_dos_id = ?", $value);

        return $query;
    }

    public function addUserIdColumnQuery($query, $field, $value) {
        $fieldName = "username";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'sf', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'sf', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

}
