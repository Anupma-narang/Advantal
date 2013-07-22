<?php

require_once(dirname(__FILE__) . '/../lib/BasesfAdminDashActions.class.php');

/**
 * sfAdminDash actions.
 *
 * @package    plugins
 * @subpackage sfAdminDash
 * @author     kevin
 * @version    SVN: $Id: actions.class.php 25203 2009-12-10 16:50:26Z Crafty_Shadow $
 */
class sfAdminDashActions extends BasesfAdminDashActions {

  /**
   * Username List for autocomplete json formate
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeUsernameJsonList(sfWebRequest $request) {
    $q = strtolower($request->getParameter("q"));
    if (!$q)
      die();
    $sfGuardUsers = Doctrine_Query::create()
            ->select('*')
            ->from('sfGuardUser sfu')
            ->Where('sfu.username LIKE "%' . $q . '%"')
            ->execute();

    $usernames = array();
    foreach ($sfGuardUsers as $sfGuardUser) {
      $usernames[] = substr($sfGuardUser->getUsername(), 0, 25) . "|" . ($request->hasParameter("id") ? $sfGuardUser->getId() : $sfGuardUser->getUsername());
    }
    $json = implode("\n", $usernames);
    $this->getResponse()->setHttpHeader('Content-type', 'application/text');
    $this->renderText($json);
    return sfView::NONE;
  }

}
