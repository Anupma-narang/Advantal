<?php

/**
 * ProfesionalLetter form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalLetterDisapprovalForm extends BaseProfesionalLetterForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        /* $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
          $this->setValidators['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
          $this->validatorSchema["user_id"]->setMessage("required", 'Necesitas seleccionar un Usuario.'); */

        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array(), array('id' => 'profesional_ProfesionalLetter_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->setDefault('user_name', $this->getObject()->getUser()->getUsername());
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width: 491px;'));
        $this->validatorSchema['name']->setMessage("required", 'No has incluido el título de tu carta.');

        $this->widgetSchema['profesional_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['profesional_id'] = new sfValidatorString(array('required' => false));

        $this->widgetSchema['profesional_letter_type_id'] = new sfWidgetFormInputHidden(array(), array('value' => 2));
        $this->validatorSchema['profesional_letter_type_id'] = new sfValidatorString(array('required' => false));

        $this->setDefault("profesional_letter_type_list", 2);

        $this->widgetSchema['profesional_letter_type_list'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterType'), 'add_empty' => false), array('disabled' => 'disabled'));
        $this->setValidators['profesional_letter_type_list'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterType')), array('required' => false));

        //$this->widgetSchema['profesional_letter_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'table_method' => 'getEstedioLetterName','add_empty' => true,'label'=>'Estado'));
        //$this->setValidators['profesional_letter_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'column' => 'id'));

        $this->widgetSchema["profesional_letter_estado_id"] = new sfWidgetFormInputHidden();
        $this->validatorSchema['profesional_letter_estado_id'] = new sfValidatorString(array('required' => false));

        if ($this->isNew())
            $this->setDefault("profesional_letter_estado_id", 1);

        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema['description'] = new mySfValidatorString(array('required' => true), array('max_length' => __('Has superado el espacio permitido para tu desaprobación.')));
        $this->validatorSchema["description"]->setMessage("required", 'No has incluido tu desaprobación.');
        $this->widgetSchema["profesional_apro_despro_id"] = new sfWidgetFormInputHidden(array(), array('value' => 1));

        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->validatorSchema['plan_accion'] = new mySfValidatorString(array('required' => true), array('max_length' => __('Has superado el espacio permitido para la Plan de acción.')));
        $this->validatorSchema["plan_accion"]->setMessage("required", 'No has incluido tu Plan de acción.');




        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'incidencia' => __('Tu desaprobación'),
            'first_name' => __('Nombre'),
            'user_name' => __('Usuario'),
            'last_name_one' => __('Apellido 1'),
            'last_name_two' => __('Apellido 2'),
            'address' => __('Dirección'),
            'email' => __('Correo electrónico'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'telefono' => __('Teléfono'),
            'profesional_tipo_uno_id' => __('Sector profesional'),
            'profesional_tipo_dos_id' => __('Subsector profesional'),
            'profesional_tipo_tres_id' => __('Actividad profesional'),
            'description' => '<strong>' . __('DESAPROBACIÓN') . '</strong>',
            'profesional_letter_type_list' => 'Tipo de carta',
            'plan_accion' => '<strong>' . __('PLAN DE ACCIÓN') . '</strong>',
            'user_id' => 'Usuario'
        ));

        //$archivos = Doctrine::getTable("ProfesionalLetterArchivo")->createQuery()->where("profesional_letter_id=" . $this->getObject()->getId())->execute();
        $archivos = Doctrine_Query::create()
                        ->select('a.*')
                        ->from('ProfesionalLetterArchivo a')
                        ->where('profesional_letter_id = ?', $this->getObject()->getId())->fetchArray();
        $archivo_1 = $archivo_2 = $archivo_3 = $archivo_4 = $archivo_5 = '';
        if (count($archivos) > 0) {
            $archivo_1 = Doctrine::getTable('ProfesionalLetterArchivo')->find($archivos[0]['id']);
            if (isset($archivos[1]))
                $archivo_2 = Doctrine::getTable('ProfesionalLetterArchivo')->find($archivos[1]['id']);
            if (isset($archivos[2]))
                $archivo_3 = Doctrine::getTable('ProfesionalLetterArchivo')->find($archivos[2]['id']);
            if (isset($archivos[3]))
                $archivo_4 = Doctrine::getTable('ProfesionalLetterArchivo')->find($archivos[3]['id']);
            if (isset($archivos[4]))
                $archivo_5 = Doctrine::getTable('ProfesionalLetterArchivo')->find($archivos[4]['id']);
        }

        $archivo_1 = ($archivo_1) ? $archivo_1 : new ProfesionalLetterArchivo();
        $archivo_1->ProfesionalLetter = $this->getObject();
        $formulario_1 = new ProfesionalLetterArchivoFormBackend($archivo_1);
        $this->embedForm("archivo_1", $formulario_1);

        $archivo_2 = ($archivo_2) ? $archivo_2 : new ProfesionalLetterArchivo();
        $archivo_2->ProfesionalLetter = $this->getObject();
        $formulario_2 = new ProfesionalLetterArchivoFormBackend($archivo_2);
        $this->embedForm("archivo_2", $formulario_2);

        $archivo_3 = ($archivo_3) ? $archivo_3 : new ProfesionalLetterArchivo();
        $archivo_3->ProfesionalLetter = $this->getObject();
        $formulario_3 = new ProfesionalLetterArchivoFormBackend($archivo_3);
        $this->embedForm("archivo_3", $formulario_3);

        $archivo_4 = ($archivo_4) ? $archivo_4 : new ProfesionalLetterArchivo();
        $archivo_4->ProfesionalLetter = $this->getObject();
        $formulario_4 = new ProfesionalLetterArchivoFormBackend($archivo_4);
        $this->embedForm("archivo_4", $formulario_4);

        $archivo_5 = ($archivo_5) ? $archivo_5 : new ProfesionalLetterArchivo();
        $archivo_5->ProfesionalLetter = $this->getObject();
        $formulario_5 = new ProfesionalLetterArchivoFormBackend($archivo_5);
        $this->embedForm("archivo_5", $formulario_5);

        unset(
                $this["created_at"], $this["updated_at"], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_destacado'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_rechazado'], $this['fecha_cerrado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this['states_id'], $this['city_id'], $this['profesional_activa_desa_id'], $this['fecha_observacion'], $this['id'], $this['is_first']
        );
        $this->widgetSchema->setPositions(
                array(
                    'profesional_id', 'profesional_letter_type_list', 'name', 'user_id', 'user_name', 'profesional_letter_type_id', 'description', 'plan_accion', 'profesional_letter_estado_id', 'profesional_apro_despro_id',
                    'archivo_1', 'archivo_2', 'archivo_3', 'archivo_4', 'archivo_5'
                )
        );

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
    }

}
