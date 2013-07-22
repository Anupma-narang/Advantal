<?php

/**
 * sfGuardUser filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserFormFilter extends PluginsfGuardUserFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $this->widgetSchema['last_login'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $this->widgetSchema['is_active'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
        $this->widgetSchema['is_disabled'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
        $this->widgetSchema['is_super_admin'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
        $this->widgetSchema['email_address'] = new sfWidgetFormInputText(array(), array('maxlength' => 72, 'class' => 'tamano_32_c'));
        $this->widgetSchema['username'] = new sfWidgetFormInputText(array(), array('maxlength' => 25, 'style' => 'width: 176px;'));

        $this->widgetSchema['hierarchy'] = new sfWidgetFormDoctrineChoice(array('model' => 'Jerarquia', 'add_empty' => 'Selecciona Jerarquía'));
        $this->validatorSchema['hierarchy'] = new sfValidatorPass(array('required' => false));
    }

    public function getFields() {
        $fields = parent::getFields();
        $fields['username'] = 'username';
        $fields['hierarchy'] = 'hierarchy';
        return $fields;
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
            $query->andWhere('r.id IN (' . $comma_separated . ')');
        } else {
            $comma_separated = '';
            $query->andWhere('r.id IN ?', $comma_separated);
        }
        return $query;
    }

    public function addUsernameColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("username LIKE '%$value%'");
    }

}
