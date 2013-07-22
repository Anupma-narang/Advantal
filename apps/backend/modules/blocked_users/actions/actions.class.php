<?php

require_once dirname(__FILE__) . '/../lib/blocked_usersGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/blocked_usersGeneratorHelper.class.php';

/**
 * blocked_users actions.
 *
 * @package    symfony
 * @subpackage blocked_users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blocked_usersActions extends autoBlocked_usersActions {

  /**
   * Build the query
   * @return Doctrine Query
   */
  protected function buildQuery() {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters) {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());
    $query->andWhere('is_blocked = true');
    
    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

  /**
   * Method un block the requested user
   * @param sfWebRequest $request
   */
  public function executeUnblock(sfWebRequest $request) {
    //fetch request parameters
    $user_profile_id = $request->getParameter('user_id');
    $user_profile_record = Doctrine::getTable('sfGuardUserProfile')->find($user_profile_id);

    if ($user_profile_record) {
      //un block user
      $user_profile_record->setIsBlocked(false);
      $user_profile_record->setBlockedLimit(0);
      $user_profile_record->save();

      //set flash message
      $this->getUser()->setFlash('notice', 'Usuario desbloqueado con éxito.');
    }
    $this->redirect('@sf_guard_user_profile_blocked_users');
  }

}
