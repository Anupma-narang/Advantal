<?php

/**
 * GiftRedemption form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GiftRedemptionForm extends BaseGiftRedemptionForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $status_array = array('1' => 'Revista', '2' => 'Enviado', '3' => 'Entregado');
        parent::configure();
        $road_type = array('-Seleccionar-', 'callejón', 'vial Arterial', 'avenida', 'Backroad', 'bulevar', 'terraza', 'camino apartado',
            'Collector carretera',
            'tribunal',
            'Calle sin salida',
            'camino de tierra',
            'Frente a Calle',
            'carretera',
            'carril',
            'carretera',
            'ruta',
            'sola calzada',
            'calle',
            'invierno carretera');
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => '32', 'class' => 'tamano_32_c'));
        $this->widgetSchema['surname1'] = new sfWidgetFormInputText(array(), array('maxlength' => '32', 'class' => 'tamano_32_c'));
        $this->widgetSchema['surname2'] = new sfWidgetFormInputText(array(), array('maxlength' => '32', 'class' => 'tamano_32_c'));
        $this->widgetSchema['road_type'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'RoadType', 'order_by' => array('orden', 'asc'), 'add_empty' => __('Selecciona tipo de vía')), array('class' => 'select_pequeño'));
        $this->widgetSchema['address'] = new sfWidgetFormInputText(array(), array('maxlength' => '70', 'class' => 'tamano_32_c'));
        $this->widgetSchema['number'] = new sfWidgetFormInputText(array(), array('maxlength' => '6', 'class' => 'tamano_4_c'));
        $this->widgetSchema['floor'] = new sfWidgetFormInputText(array(), array('maxlength' => '3', 'class' => 'tamano_3_c'));
        $this->widgetSchema['door'] = new sfWidgetFormInputText(array(), array('maxlength' => '6', 'class' => 'tamano_4_c'));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'States',
            'add_empty' => 'Selecciona provincia',
            'order_by' => array('orden', 'ASC')));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => 'Selecciona  localidad',
            'ajax' => true));
        $this->widgetSchema['cp'] = new sfWidgetFormInput(array(), array('maxlength' => 5, 'class' => 'tamano_6_c'));
        $this->widgetSchema['user'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['gift'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gift'), 'add_empty' => 'Selecciona regalo'));
        $this->widgetSchema['contact_number'] = new sfWidgetFormInputText(array(), array('maxlength' => '9', 'class' => 'tamano_9_c'));
        $this->widgetSchema['delivery_time'] = new sfWidgetFormChoice(array('choices' => array('Mañana: 8-14', 'Tarde: 14-20')), array('class' => 'tamano_32_c'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array));
        $this->widgetSchema['created_at'] = new sfWidgetFormDateTime();
        $this->widgetSchema->setLabels(array(
            'name' => __('Tu nombre'),
            'surname1' => __('Tu apellido 1'),
            'surname2' => __('Tu apellido 2'),
            'road_type' => __('Tipo de vía*'),
            'address' => __('Dirección de entrega*'),
            'number' => __('Nº*'),
            'floor' => __('Piso'),
            'door' => __('Puerta'),
            'states_id' => __('Provincia*'),
            'city_id' => __('Localidad*'),
            'contact_number' => __('Teléfono de contacto'),
            'delivery_time' => __('Horario de entrega preferido'),
            'status' => __('Estado'),
            'cp' => __('C.P.')
        ));
        //set validations
        $this->validatorSchema['cp'] = new sfValidatorPass();
        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array('required' => false));
        $this->validatorSchema['address'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')), array('invalid' => __('Esa dirección de entrega no es válida.')))
                ), array('required' => true), array('invalid' => __('Esa dirección no es válida.'), 'required' => __('Necesitas incluir una dirección de
entrega.')));

        $this->validatorSchema['road_type'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => 'RoadType'), array('required' => 'Necesitas seleccionar un tipo de vía.'));
        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->validatorSchema['number'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => true)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('invalid' => __('Ese Nº no es válido.'), 'required' => __('Necesitas incluir un Nº.'))
        );
        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['floor'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 3, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['door'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );


        $this->widgetSchema['user'] = new sfWidgetFormDoctrineChoice(array(
            'model'=> 'sfGuardUser',
            'query' => sfGuardUserTable::getUserComboList(),
            'method'=> 'getUsername',
            'add_empty' => 'Selecciona Usuario',
        ));
        
        $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => 'States'), array('required' => 'Necesitas seleccionar una provincia.'));
        $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => 'City'), array('required' => 'Necesitas seleccionar una localidad.'));
        //$this->validatorSchema['status'] = new sfValidatorChoice(array('required'=> false,'choices' => $status_array));
        $this->validatorSchema['user'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => true), array('required' => __('Necesitas seleccionar un Usuario.')));
        $this->validatorSchema['gift'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gift'), 'required' => true), array('required' => __('Necesitas seleccionar un regalo.')));
        $this->validatorSchema['contact_number'] = new sfValidatorRegex(array(
            'pattern' => '#^(\d{9})$#',
            'required' => false
                ), array('invalid' => 'Necesitas introducir 9 números sin espacios.')
        );

        //user_id
        $this->widgetSchema['user'] = new sfWidgetFormInputHidden(array(), array('id' => 'concurso_user_id'));
        $this->validatorSchema['user'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array('label' => 'Usuario/Alias'), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));


        if(! $this->isNew())
        {
          $this->setDefault('user_name', $this->getObject()->getSfGuardUser()->getUsername());
        }


        $this->validatorSchema['user']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));
        
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
    }

    public function postValidate($validator, $values) {
        if ((!empty($values['states_id'])) and (!empty($values['cp']))) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['cp'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('cp' => $invalid));
            }
        }

        return $values;
    }

}
