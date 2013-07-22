<?php

/**
 * Profesional filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalesPendientesFormFilter extends BaseProfesionalFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['profesional_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalEstado'), 'table_method' => 'getEstedioName', 'add_empty' => 'Selecciona estado'));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $this->setValidators['profesional_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalEstado'), 'column' => 'id'));
        $this->setDefault('profesional_estado_id', 1);

        //$this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => true, 'label' => $i18n->__('Categoría')));
        //unset ($this->widgetSchema['destacado']);
        //$this->setLabel('aaaa');
        $this->widgetSchema['last_name_one'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['last_name_two'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['first_name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        //$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'add_empty' => 'Selecciona Usuario', 'label' => 'Usuario'));

        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector',
                    'model' => 'ProfesionalTipoUno',
                    'order_by' => array('orden', 'asc'),
                    // 'order_by' => 'orden',
                    'add_empty' => 'Selecciona sector'));

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Subsector',
                    'model' => 'ProfesionalTipoDos',
                    //'order_by' => 'orden',
                    'order_by' => array('orden', 'asc'),
                    'depends' => 'ProfesionalTipoUno',
                    'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona provincia',
                    'label' => 'Provincia' //'order_by' => array('name','asc')
                ));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad'));

        $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Actividad',
                    'model' => 'ProfesionalTipoTres',
                    'depends' => 'ProfesionalTipoDos',
                    'order_by' => array('name', 'asc'),
                    'add_empty' => 'Selecciona actividad'));

        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px !important;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));
    }

    public function addUserIdColumnQuery($query, $field, $value) {
       /* $query->andWhere('sf.username LIKE "%' . $value['text'] . '%"');
        return $query; */
        
        $fieldName = "username";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'sf', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'sf', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

}
