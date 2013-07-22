<?php
/**
 * MetodoBanco form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MetodoBancoForm extends BaseMetodoBancoForm {

    public function configure() {
        unset($this['user_id']);

        $this->widgetSchema['tipo_documento_id'] = new sfWidgetFormDoctrineChoice(
                array(
            'model' => $this->getRelatedModelName('TipoDocumento'),
            'add_empty' => 'Selecciona tu documento'));
        $this->validatorSchema['tipo_documento_id'] = new sfValidatorDoctrineChoice(
                array(
            'model' => $this->getRelatedModelName('TipoDocumento'),
            'required' => true), array('required' => 'Necesitas seleccionar tu tipo de
documento.'));

        $this->widgetSchema['nifnie'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_9_c', 'maxlength' => 9));

        $caracteres_no_validos_nombre = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '{', '}', ';', ':', '_', 'ª', 'º', '"', '>', '<', '¬', '·', '¿');
        $this->validatorSchema['nifnie'] = new sfValidatorAnd(array(
            new sfValidatorString(
                    array(
                'max_length' => 12,
                'required' => true), array()),
            new sfValidatorRegex(array('pattern' => "/^((([A-Z]|[a-z])\d{8})|(\d{8}([A-Z]|[a-z])))$/"))
        ));
        $this->validatorSchema['nifnie']->setMessages(array('required' => 'Necesitas introducir tu NIF ó NIE.',
            'invalid' => 'Ese NIF o NIE no es válido.'));

        $this->widgetSchema['titular_name'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->validatorSchema['titular_name'] = new sfValidatorAnd(array(
            new sfValidatorString(
                    array(
                'max_length' => 80,
                'min_length' => 2,
                'required' => true), array()),
            //new sfValidatorRegex(array('pattern' =>"/^[a-z\s\_áéíóúAÉÍÓÚÑñ\']+$/i"),array())
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
        ));
        $this->validatorSchema['titular_name']->setMessages(array('required' => 'Necesitas incluir el nombre del titular de la
cuenta.', 'invalid' => 'Ese nombre no es válido'));

        $this->widgetSchema['surname1'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->validatorSchema['surname1'] = new sfValidatorAnd(array(
            new sfValidatorString(
                    array(
                'max_length' => 80,
                'min_length' => 2,
                'required' => true), array()),
//  			new sfValidatorRegex(array('pattern' =>"/^[a-z\s\_áéíóúAÉÍÓÚÑñ\']+$/i"),array())
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
        ));
        $this->validatorSchema['surname1']->setMessages(array('required' => 'Necesitas incluir el primer apellido del
titular de la cuenta.', 'invalid' => 'Ese apellido no es válido'));

        $this->widgetSchema['surname2'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->validatorSchema['surname2'] = new sfValidatorAnd(array(
            new sfValidatorString(
                    array(
                'max_length' => 80,
                'min_length' => 2,
                'required' => true), array()),
//  			new sfValidatorRegex(array('pattern' =>"/^[a-z\s\_áéíóúAÉÍÓÚÑñ\']+$/i"),array())
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
        ));
        $this->validatorSchema['surname2']->setMessages(array('required' => 'Necesitas incluir el segundo apellido del
titular de la cuenta.', 'invalid' => 'Ese apellido no es válido'));


        $this->widgetSchema ['cuenta_entidad'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_4_c', 'maxlength' => 4, 'minlength' => 4));
        //$this->validatorSchema['cuenta_entidad'] = new sfValidatorString(array('required' => false));//sfValidatorInteger(array('required' => false),array('required' => 'No has incluido todos los datos bancarios.', 'invalid' => 'Sólo puedes introducir números.'));
        /* $this->validatorSchema['cuenta_entidad'] = new sfValidatorAnd(array(
          new sfValidatorString(
          array(
          'min_length' => 4,
          'required' => false), array()),
          new sfValidatorRegex(array('pattern' => "/^\d{4}$/"))
          )); */
        // $this->validatorSchema['cuenta_entidad']->setOption("required", true);
        // $this->validatorSchema['cuenta_entidad']->setMessages(array('required' => '<div class="err_req">&nbsp;</div>', 'invalid' => 'Sólo puedes introducir números.'));

        $this->setValidator('cuenta_entidad', new sfValidatorAnd(array(
            new sfValidatorRegex(array('pattern' => "/^\d{4}$/", 'min_length' => 4), array('invalid' => 'Sólo puedes introducir números.', 'min_length' => 'Esa Entidad no es válida.'))
                ), array(), array('required' => '<div class="err_req">&nbsp;</div>')));

        $this->widgetSchema ['cuenta_oficina'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_4_c', 'maxlength' => 4));
        /*  $this->validatorSchema['cuenta_oficina'] = new sfValidatorAnd(array(
          new sfValidatorString(
          array(
          'min_length' => 4,
          'required' => false), array()),
          new sfValidatorRegex(array('pattern' => "/^\d{4}$/"))
          ));
          $this->validatorSchema['cuenta_oficina']->setOption("required", true);
          $this->validatorSchema['cuenta_oficina']->setMessages(array('required' => '<div class="err_req">&nbsp;</div>', 'invalid' => 'Sólo puedes introducir números.'));
         */
        $this->setValidator('cuenta_oficina', new sfValidatorAnd(array(
            new sfValidatorRegex(array('pattern' => "/^\d{4}$/", 'min_length' => 4), array('invalid' => 'Sólo puedes introducir números.', 'min_length' => 'Esa oficina no es válida.'))
                ), array(), array('required' => '<div class="err_req">&nbsp;</div>')));

        $this->widgetSchema ['cuenta_dc'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_2_c', 'maxlength' => 2));
        /*   $this->validatorSchema['cuenta_dc'] = new sfValidatorAnd(array(
          new sfValidatorString(
          array(
          'min_length' => 2,
          'required' => false), array()),
          new sfValidatorRegex(array('pattern' => "/^\d{2}$/"))
          ));
          $this->validatorSchema['cuenta_dc']->setOption("required", true);
          $this->validatorSchema['cuenta_dc']->setMessages(array('required' => '<div class="err_req">&nbsp;</div>', 'invalid' => 'Sólo puedes introducir números.'));
          // $this->validatorSchema['cuenta_dc']->setMessages(array('required' => 'Ese DC no es válido.', 'invalid' => 'Sólo puedes introducir números.'));
         */
        $this->setValidator('cuenta_dc', new sfValidatorAnd(array(
            new sfValidatorRegex(array('pattern' => "/^\d{2}$/", 'min_length' => 2), array('invalid' => 'Sólo puedes introducir números.', 'min_length' => 'Ese DC no es válido.'))
                ), array(), array('required' => '<div class="err_req">&nbsp;</div>')));

        $this->widgetSchema ['cuenta_numero'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_10_c', 'maxlength' => 10));
        //$this->validatorSchema['cuenta_numero'] = new sfValidatorString(array('required' => false));//sfValidatorInteger(array('required' => false),array('required' => 'No has incluido todos los datos bancarios.', 'invalid' => 'Sólo puedes introducir números.'));
        /* $this->validatorSchema['cuenta_numero'] = new sfValidatorAnd(array(
          new sfValidatorString(
          array(
          'min_length' => 10,
          'required' => false), array()),
          new sfValidatorRegex(array('pattern' => "/^\d{10}$/"))
          ));
          $this->validatorSchema['cuenta_numero']->setOption("required", true);
          $this->validatorSchema['cuenta_numero']->setMessages(array('required' => '<div class="err_req">&nbsp;</div>', 'invalid' => 'Sólo puedes introducir números.'));
          //   $this->validatorSchema['cuenta_numero']->setMessages(array('required' => 'Ese Nº de cuenta no es válido', 'invalid' => 'Sólo puedes introducir números.'));
         */
        $this->setValidator('cuenta_numero', new sfValidatorAnd(array(
            new sfValidatorRegex(array('pattern' => "/^\d{10}$/", 'min_length' => 10), array('invalid' => 'Sólo puedes introducir números.', 'min_length' => 'Ese nº de cuenta no es válido.'))
                ), array(), array('required' => '<div class="err_req">&nbsp;</div>')));

        $ma_micuenta = sfContext::getInstance()->getRequest()->getParameter("metodo_banco");
        if ($ma_micuenta['cuenta_entidad'] == '') {
            $this->widgetSchema ['cuenta_entidad']->setAttribute('class', 'error');
        }



        $this->widgetSchema->setLabels(array(
            'tipo_documento_id' => 'Tipo de documento*',
            'nifnie' => 'Nº de documento*',
            'titular_name' => 'Nombre*',
            'surname1' => 'Apellido 1*',
            'surname2' => 'Apellido 2*',
            'cuenta_titular' => 'Titular',
            'cuenta_entidad' => 'Entidad',
            'cuenta_oficina' => 'Oficina',
            'cuenta_dc' => 'DC',
            'cuenta_numero' => 'Nº de cuenta'
        ));

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
    }

    public function preValidate($validator, $values) {
        if ((($values['cuenta_entidad'] != '') && (strval(intval($values['cuenta_entidad'])) != $values['cuenta_entidad']))) {
            //$invalid = new sfValidatorError($validator, 'Esa Entidad no es válida.');
            //throw new sfValidatorErrorSchema($validator, array('cuenta_entidad' => $invalid));
        } else if ((($values['cuenta_oficina'] != '') && (strval(intval($values['cuenta_oficina'])) != $values['cuenta_oficina']))) {
            //$invalid = new sfValidatorError($validator, 'Sólo puedes introducir números.');
            //throw new sfValidatorErrorSchema($validator, array('cuenta_oficina' => $invalid));
        } else if ((($values['cuenta_dc'] != '') && (strval(intval($values['cuenta_dc'])) != $values['cuenta_dc']))) {
            //$invalid = new sfValidatorError($validator, 'Sólo puedes introducir números.');
            //throw new sfValidatorErrorSchema($validator, array('cuenta_dc' => $invalid));
        } else if ((($values['cuenta_numero'] != '') && (strval(intval($values['cuenta_numero'])) != $values['cuenta_numero']))) {
            //$invalid = new sfValidatorError($validator, 'Sólo puedes introducir números.');
            //throw new sfValidatorErrorSchema($validator, array('cuenta_numero' => $invalid));
        }
        if (($values['cuenta_entidad'] == '') || ($values['cuenta_oficina'] == '') || ($values['cuenta_dc'] == '') || ($values['cuenta_numero'] == '')) {
            $required = new sfValidatorError($validator, "No has incluido todos los datos bancarios");
            throw new sfValidatorError($validator, 'Necesitas incluir todos los datos bancarios.');
        }
    }

}