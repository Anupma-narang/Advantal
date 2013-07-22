<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin {

    /**
     * @see sfForm
     */
    public function configure() {
        parent::configure();

        $this->widgetSchema['username'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_25_c'));
        $this->setWidget('password', new sfWidgetFormInputPassword(
                        array(), array('maxlength' => 16, 'class' => 'tamano_25_c')
        ));

        $this->validatorSchema['username'] = new sfValidatorString(array('required' => true), array("required" => "Necesitas introducir tu correo electrónico."));
        $this->validatorSchema['password'] = new sfValidatorString(array('required' => true), array("required" => "Necesitas introducir tu contraseña."));

        $this->validatorSchema->setPostValidator(
                new sfGuardValidatorUser()
        );

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));

        /* $this->validatorSchema["username"]->setMessage("required","Debes introducir un correo electrónico");
          $this->validatorSchema["username"]->setMessage("invalid","Este valor no es válido");
          $this->validatorSchema["password"]->setMessage("required","Debes introducir una contraseña"); */
    }

    public function preValidate($validator, $values) {
        if (isset($values['username'])) {
            if ($values['username'] != '')
                $this->getValidator('password')->setOption('required', false);
            $user = Doctrine::getTable('sfGuardUser')->retrieveByEmailAddress($values['username']);
            if (isset($user) && $user != '') {
                $this->getValidator('password')->setOption('required', false);
                /* if ($user->getIsActive() && $user->checkPassword($values['password']))
                  {
                  return array_merge($values, array('user' => $user));
                  } */
            }
//			else
            //			$this->getValidator('password')->setOption('required', false);
        }
    }

}
