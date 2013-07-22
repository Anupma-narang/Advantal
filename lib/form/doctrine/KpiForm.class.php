<?php

/**
 * Kpi form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class KpiForm extends BaseKpiForm {

    public function configure() {

        $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
            'choices' => ListaCuestionarioTable::$tipos)
        );
        $this->validatorSchema['tipo'] = new sfValidatorChoice(array(
            'choices' => array_keys(ListaCuestionarioTable::$tipos)
        ));
        //$width = ($this->getObject()->isNew()) ? 'width:175px;' : 'width:280px;';
        $this->widgetSchema['nombre']->setAttributes(array('class' => 'tamano_16_c_1', 'maxlength' => 70, 'style' => 'width:175px;'));
        $this->validatorSchema['nombre'] = new sfValidatorString(
                array('required' => true), array('required' => 'Necesitas incluir un KPI.'));
    }

}
