<?php

/**
 * RecomendedRegistration filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RecomendedRegistrationFormFilter extends BaseRecomendedRegistrationFormFilter {

  public function configure() {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));
    $this->widgetSchema['email'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
    $this->widgetSchema['registered_user'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
    $this->widgetSchema['recomended_user'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));


    $this->validatorSchema['registered_user_id'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['recomended_user'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['email'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['created_at'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));
  }

}
