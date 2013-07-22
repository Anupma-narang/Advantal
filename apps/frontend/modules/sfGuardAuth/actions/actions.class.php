<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(sfConfig::get('sf_plugins_dir') . '/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions {

    public function executeSignin($request) {
        if ($request->getParameter('redirect') == 'profesionalindex')
            $this->redirect_url = 'profesional/index';
        else
            $this->redirect_url = $request->getParameter('redirect', '');
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            return $this->redirect('@homepage');
        }

        $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
        $this->form = new $class();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('signin'));
            if ($this->form->isValid()) {

                // guarda en session que el user se ha logueado. Necesario por si entra en alguna lista...
                $this->getUser()->setAttribute('first_enter_lb_empresa', true, myUser::ORDER_NS);
                $this->getUser()->setAttribute('first_enter_ln_empresa', true, myUser::ORDER_NS);
                $this->getUser()->setAttribute('first_enter_lb_producto', true, myUser::ORDER_NS);
                $this->getUser()->setAttribute('first_enter_ln_producto', true, myUser::ORDER_NS);
                $this->getUser()->setAttribute('first_enter_lb_profesional', true, myUser::ORDER_NS);
                $this->getUser()->setAttribute('first_enter_ln_profesional', true, myUser::ORDER_NS);

                $values = $this->form->getValues();
                $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

                //get user's last cash aded date
                $point_record = Doctrine::getTable('ColaboradorPuntosHistorico')->getCashUpdateDate($this->getUser()->getGuardUser()->getId());
                $profile = $this->getUser()->getProfile();
                if ($point_record) {
                    $users_last_cash_update_date = $point_record['created_at'];
                    $point_record = Doctrine::getTable('ColaboradorPuntosHistorico')->find($point_record['id']);
                } else {
                    $users_last_cash_update_date = null;
                }
                //get administration caja record
                $administration_caja = Doctrine::getTable('AdministrationCaja')->getAdministrationCaja();

                //if user has money and also has been assigned money by admin
                if ($users_last_cash_update_date && $profile->getMoney()) {
                    //get dates
                    $now_time = strtotime('now');
                    $cashup_time = strtotime($users_last_cash_update_date);

                    //if ready to automatic redeem point conversion
                    if (floor(($now_time - $cashup_time) / 86400) > $administration_caja['expiry_date']) {
                        //get money
                        $user_cash = $profile->getMoney();
                        //get user redeem points
                        $redeem_point = $profile->getChangePoints();
                        //set redeem point
                        $profile->setChangePoints($redeem_point + ($user_cash * $administration_caja['points_per_cent']));
                        //reset money
                        $profile->setMoney(0);

                        $profile->save();
                        $point_record->setStatus(1);
                        $point_record->save();
                    }
                }
                if (!empty($this->redirect_url)) {
                    $signinUrl = $this->redirect_url;
                } else {
                    // always redirect to a URL set in app.yml
                    // or to the referer
                    // or to the homepage
                    $redirectTo = array('audita', 'comenta');
                    $match = false;
                    foreach ($redirectTo as $str) {
                        if (strstr($user->getReferer($request->getReferer()), $str)) {
                            $signinUrl = $user->getReferer($request->getReferer());
                            $match = true;
                        } else {
                            $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));
                        }

                        if ($match) {
                            return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
                        }
                    }
                }
                return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
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
        //borrar el ns last_state para borrar las últimas búsquedas
        $this->getUser()->removeLastState();
        $this->getUser()->setAttribute('visit_count', null);

        $this->getUser()->signOut();

        $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

        $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
    }

}
