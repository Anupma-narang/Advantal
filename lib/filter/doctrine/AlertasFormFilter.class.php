<?php

/**
 * Alertas filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AlertasFormFilter extends BaseAlertasFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $this->widgetSchema['type'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px;'));
        //$this->widgetSchema['user_related_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['user_related_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_related_id'] = new sfValidatorPass(array('required' => false));
        //$this->widgetSchema['type'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 40, 'class' => 'tamano_20_c'));
        //$this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));
        //set validator
        $this->validatorSchema['type'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['created_at'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));
    }

    public function addUserRelatedIdColumnQuery($query, $field, $value) {
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

}
