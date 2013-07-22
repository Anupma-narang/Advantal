<?php

class ContratanosFrontForm extends sfForm {

    public function configure() {

        $op = $this->getOption('select');

        $this->setWidgets(array(
            'name' => new sfWidgetFormInput(),
            'cif' => new sfWidgetFormInput(),
            'actividad' => new sfWidgetFormInput(),
            'nombre' => new sfWidgetFormInput(),
            'apellido1' => new sfWidgetFormInput(),
            'apellido2' => new sfWidgetFormInput(),
            'cargo' => new sfWidgetFormInput(),
            'email' => new sfWidgetFormInput(),
            'phone' => new sfWidgetFormInput(),
            'via' => new sfWidgetFormInput(),
            'direccion' => new sfWidgetFormInput(),
            'num' => new sfWidgetFormInput(),
            'piso' => new sfWidgetFormInput(),
            'cp' => new sfWidgetFormInput(),
            'provincia' => new sfWidgetFormInput(),
            'localidad' => new sfWidgetFormInput(),
            'ayudar' => new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'max_length' => 3000)),
            'servicio' => new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'max_length' => 1000)),
            'antes' => new sfWidgetFormChoice(array('choices' => array('NO', 'SI'))),
            'eres' => new sfWidgetFormChoice(array('choices' => array('Trabajador por cuenta ajena', 'Autónomo', 'Tengo una empresa', 'Otro')))
        ));

        $this->widgetSchema->setNameFormat('contratanos[%s]');

        $this->setValidators(array(
            'name' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido una empresa o entidad.')),
            'cif' => new sfValidatorString(array('required' => true)),
            'actividad' => new sfValidatorString(array('required' => false), array('required' => 'No has incluido la actividad a la que te dedicas')),
            'nombre' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu nombre')),
            'apellido1' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu primer apellido')),
            'apellido2' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu segundo apellido')),
            'cargo' => new sfValidatorString(array('required' => false), array('required' => 'No has incluido el cargo que ocupas')),
            'email' => new sfValidatorEmail(array('required' => false,), array('required' => 'No has incluido tu correo electrónico', 'invalid' => 'Ese correo electrónico no es válido')),
            'phone' => new sfValidatorString(array('required' => false)),
            'via' => new sfValidatorString(array('required' => false)),
            'eres' => new sfValidatorString(array('required' => false)),
            'direccion' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido la dirección de tu empresa o entidad')),
            'num' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido el nº de la dirección de tu empresa o entidad.')),
            'piso' => new sfValidatorString(array('required' => false)),
            'cp' => new sfValidatorString(array('required' => false)),
            'provincia' => new sfValidatorString(array('required' => true), array('required' => 'No has seleccionado la provincia de tu empresa o entidad')),
            'localidad' => new sfValidatorString(array('required' => true), array('required' => 'No has seleccionado la localidad de tu empresa o entidad')),
            'ayudar' => new sfValidatorString(array('required' => true), array('required' => 'No has incluido en qué te podemos ayudar')),
            'servicio' => new sfValidatorString(array('required' => false)),
            'antes' => new sfValidatorString(array('required' => false)),
            'eres' => new sfValidatorString(array('required' => true), array('required' => 'No has seleccionado tu régimen laboral.')),
        ));



        $this->widgetSchema->setLabels(array(
            'name' => 'Nombre de tu empresa/entidad',
            'cif' => ($op == 1) ? 'CIF' : 'NIF/NIE/CIF',
            'actividad' => 'Actividad a la que se dedicas',
            'nombre' => 'Tu nombre',
            'apellido1' => 'Tu apellido 1',
            'apellido2' => 'Tu apellido 2',
            'cargo' => 'Cargo que ocupas',
            'email' => 'Correo electrónico',
            'eres' => 'Selecciona  régimen laboral',
            'phone' => 'Tu teléfono',
            'via' => 'Tipo de vía',
            'direccion' => ($op == 1) ? 'Dirección de la empresa/entidad' : 'Dirección',
            'num' => 'Numero',
            'piso' => 'Piso/puerta',
            'cp' => 'Cp',
            'provincia' => 'Provincia',
            'localidad' => 'Localidad',
            'ayudar' => '¿En qué crees que te podemos ayudar?',
            'servicio' => '¿Qué servicio deseas contratar?',
            'antes' => '¿Has sido antes objeto de un Análisis de Experiencia de Cliente o de una auditoría de calidad?',
        ));
    }

}
