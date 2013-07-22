<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));  //para las traduciones del formulario

        unset($this['id'], $this['user_id'], $this['active'], $this['validate'], $this['image'], $this['change_points'], $this['money']);

        $sexs = array(null => __('Selecciona tu sexo'), 'hombre' => __('Hombre'), 'mujer' => __('Mujer'));
        $this->widgetSchema['sex'] = new sfWidgetFormChoice(array('choices' => $sexs));
        $this->validatorSchema['sex'] = new sfValidatorChoice(array('choices' => array_keys($sexs), 'required' => true), array('required' => __('No has seleccionado tu sexo.')));
        $this->widgetSchema['fecha_nac'] = new sfWidgetFormDate(array('format' => '%day% / %month% / %year%'));
        $this->widgetSchema['hierarchy'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('Jerarquia')->getHierarchyList()));
        $this->widgetSchema->setLabels(array(
            'name' => __('Tu nombre'),
            'surname1' => __('Tu apellido 1'),
            'surname2' => __('Tu apellido 2'),
            'sex' => __('Eres'),
            'fecha_nac' => __('Tu fecha de nacimiento'),
            'formacion_academica_id' => __('Tu formación académica'),
            'colaborador_nivel_uno_id' => __('Tu sector profesional'),
            'colaborador_nivel_dos_id' => __('Tu actividad profesional'),
            'road_type_id' => __('Tu tipo de vía'),
            'direccion' => __('Tu dirección'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'cp' => __('Tu C.P.'),
            'states_id' => __('Tu provincia'),
            'city_id' => __('Tu localidad'),
            'image' => __('Tu imagen')
        ));


        $this->useFields(array('name', 'surname1', 'surname2', 'sex', 'fecha_nac', 'formacion_academica_id',
            'colaborador_nivel_uno_id', 'colaborador_nivel_dos_id', 'direccion', 'numero', 'piso', 'puerta', 'cp',
            'city_id', 'states_id', 'telefono', 'hierarchy'));
    }

}
