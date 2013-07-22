<?php

/**
 * sfGuardAuth actions.
 *
 * @package    didom
 * @subpackage sfGuardAuth
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
require_once(sfConfig::get("sf_plugins_dir") . '/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

class sfGuardAuthActions extends BasesfGuardAuthActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeSignin($request) {
    $user = $this->getUser();
    if ($user->isAuthenticated()) {
      return $this->redirect('@homepage');
    }

    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');    
    $this->form = new $class();
    $this->user_block_limit = 0;

    if ($request->isMethod('post')) {
      $signin_parameter = $request->getParameter('signin');
      $this->form->bind($signin_parameter);
      if ($this->form->isValid()) {
        //fetch user profile record
        $sf_user = Doctrine::getTable('sfGuardUser')->findOneBy('email_address', $signin_parameter['username']);

        //if user is blocked then redirect him to homepage
        if ($sf_user) {
          $user_profile = $sf_user->getProfile();
          if ($user_profile->getIsBlocked()) {
            $this->user_block_limit = 5;
          } else {
            $values = $this->form->getValues();
            $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

            sfGuardUserProfileTable::addMetaDataOnLogin();
            // always redirect to a URL set in app.yml
            // or to the referer
            // or to the homepage
            $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

            return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
          }
        }
      } else {
        //fetch user profile record
        $sf_user = Doctrine::getTable('sfGuardUser')->findOneBy('email_address', $signin_parameter['username']);
        if ($sf_user) {
          $user_profile = $sf_user->getProfile();
          if ($user_profile) {
            //set block limit
            $this->user_block_limit = $user_profile->getBlockedLimit() + 1;
            $user_profile->setBlockedLimit($this->user_block_limit);
            if ($user_profile->getBlockedLimit() >= 5) {
              $user_profile->setIsBlocked(true);
            }
            $user_profile->save();
          }
        }
      }
    } else {
      if ($request->isXmlHttpRequest()) {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module) {
        return $this->redirect($module . '/' . sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
  }

  public function executeSignout($request) {
    sfGuardUserProfileTable::addMetaDataOnLogout();

    $this->getUser()->signOut();

    $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

    $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
  }

  public function executeNocredential() {
    //$this->getUser()->signOut();
   // $this->getUser()->setFlash('error', 'No tienes las credenciales necesarias para acceder a la administración.');
    //$this->redirect("sfGuardAuth/signin");
    
  }

}
