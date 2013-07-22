<?php

/**
 * Contribucion form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContribucionAdminForm extends ContribucionForm {

    public function configure() {
        parent::configure();

        $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false));
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
        //$this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(
                array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));


        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->validatorSchema["resumen"] = new sfValidatorString(
                array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));

        $this->widgetSchema->setLabels(
                array(
                    'resumen' => 'Resumen del Plan de acción',
                    'plan_accion' => 'Plan de acción'
        ));
        $this->widgetSchema->setPositions(array('plan_accion', 'resumen', 'user_id', 'id', 'name', 'contribucion_estado_id'));
    }

}