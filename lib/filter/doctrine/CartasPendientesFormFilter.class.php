<?php

/**
 * CartasPendientesForm filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CartasPendientesFormFilter extends BaseProfesionalLetterFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:280px;'));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        //$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'add_empty' => 'Selecciona Usuario', 'label' => 'Usuario'));
        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false, 'label' => 'Usuario'), array('maxlength' => 25, 'style' => 'width:176px !important;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));
        $this->widgetSchema['profesional_letter_estado_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Estado',
                    'model' => 'ProfesionalLetterEstado',
                    'table_method' => 'getEstedioLetterNameRechazado',
                    'order_by' => 'orden'));

        $this->widgetSchema['profesional_letter_type_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Tipo de carta',
                    'model' => 'ProfesionalLetterType',
                    'order_by' => 'orden',
                    'add_empty' => 'Selecciona tipo de carta'));
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
