<?php

/**
 * cuestionario_baja actions.
 *
 * @package    symfony
 * @subpackage cuestionario_baja
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuestionario_bajaActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $this->usuarios_cuestionario = Doctrine::getTable('CuestionarioBajaValue')
            ->createQuery()
            ->where('pregunta_id=1')
            ->execute();
  }

  public function executeShow(sfWebRequest $request) {
    $this->forward404Unless($user_id = $request->getParameter('id'));
    $this->forward404Unless($this->cuestionario = Doctrine::getTable('CuestionarioBajaValue')
            ->createQuery()
            ->where('user_id=?', $user_id)
            ->execute());
  }

}
