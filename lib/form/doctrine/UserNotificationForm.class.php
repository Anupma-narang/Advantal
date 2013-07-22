<?php

/**
 * UserNotification form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserNotificationForm extends BaseUserNotificationForm {

    public function configure() {
        parent::configure();

        unset(
                $this['user_id']
        );

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));  //para las traduciones del formulario

        $this->widgetSchema['colaborador_contribuye_value'] = new sfWidgetFormInputCheckbox(array(), array('value' => 1));
        $this->validatorSchema['colaborador_contribuye_value'] = new sfValidatorBoolean();

        $this->widgetSchema['concurso_empresa_value'] = new sfWidgetFormInputCheckbox(array());
        $this->validatorSchema['concurso_empresa_value'] = new sfValidatorBoolean();

        $this->widgetSchema['concurso_empresa_nombre'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 70));
        $this->widgetSchema['concurso_producto_nombre'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 70));
        $this->widgetSchema['concurso_producto_marca'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 70));

        $this->widgetSchema['concurso_empresa_provincia_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'table_method' => 'getWithTodas',
            'model' => 'States',
            'add_empty' => __('Selecciona  provincia')));

        $this->widgetSchema['concurso_empresa_ciudad_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'concurso_empresa_provincia_id',
            'ref_method' => 'getStatesId',
            'ajax' => true,
            'add_empty' => __('Selecciona localidad'),
                ), array());


        $this->widgetSchema->setLabels(array(
            'colaborador_contribuye_value' => __('Un colaborador contribuye en un concurso creado por mí.'),
            'concurso_empresa_value' => __('Se crea un nuevo concurso para la empresa/entidad '),
            'concurso_producto_value' => __('Se crea un nuevo concurso para el producto '),
            'lista_blanca_value' => __('Se publica en la lista blanca una empresa, entidad o producto en cuyo concurso he contribuido.'),
            'lista_negra_value' => __('Se publica en la lista negra una empresa, entidad o producto en cuyo concurso he contribuido.'),
            'publica_profesional_value' => __('Se publica en el Directorio de buenos profesionales un profesional recomendado por mí.'),
            'publica_recomend_disaprov_value' => __('Se recomienda o desaprueba a un profesional dado de alta por mí.')
        ));
    }

}
