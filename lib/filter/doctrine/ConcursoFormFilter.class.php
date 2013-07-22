<?php

/**
 * Concurso filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursoFormFilter extends BaseConcursoFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['destacado'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        //$this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name','asc')), array('class' => 'tamano_60_c'));
        $this->widgetSchema['concurso_tipo_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('ConcursoTipo'), 'add_empty' => 'Selecciona tipo de concurso'));

        $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Categoría',
                    'model' => 'ConcursoCategoria',
                    'depends' => 'ConcursoTipo',
                    'add_empty' => 'Selecciona categoría',
                    'order_by' => array('orden', 'asc'),
                        //'ajax' => true,
                ));

        //$this->widgetSchema['empresa_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => 'Selecciona empresa/entidad'));
        $this->widgetSchema['empresa_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['producto_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('States'), 'add_empty' => 'Selecciona provincia', 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                        //'ajax' => true,
                ));
        // $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));

        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px !important;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['concurso_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoEstado'), 'add_empty' => 'Selecciona estado'));

        $this->widgetSchema['marca'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['modelo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 20, 'class' => 'tamano_20_c'));

        $this->validatorSchema['empresa_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['producto_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['marca'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['modelo'] = new sfValidatorPass(array('required' => false));
    }

    public function getFields() {
        $fields = parent::getFields();

        $fields['empresa_id'] = 'empresa_id';
        $fields['producto_id'] = 'producto_id';
        $fields['marca'] = 'marca';
        $fields['modelo'] = 'modelo';
        return $fields;
    }

    public function addEmpresaIdColumnQuery($query, $field, $value) {
        $query->leftJoin("r.Empresa e");
        $fieldName = "name";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'e', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'e', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addProductoIdColumnQuery($query, $field, $value) {
        $query->leftJoin("r.Producto pr");
        $fieldName = "name";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'pr', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'pr', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addMarcaColumnQuery($query, $field, $value) {
        $query->leftJoin("r.Producto bb");
        $fieldName = "marca";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'bb', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'bb', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addModeloColumnQuery($query, $field, $value) {
        $query->leftJoin("r.Producto dd");
        $fieldName = "modelo";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'dd', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'dd', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addUserIdColumnQuery($query, $field, $value) {
        $query->leftJoin("r.User gu");
        $fieldName = "username";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'gu', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'gu', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

}
