<?php

/**
 * blackboard actions.
 *
 * @package    symfony
 * @subpackage blackboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blackboardActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     //get parameters
    $rank = $request->getParameter('rank', 0);
    $section = $request->getParameter('section');
    $this->blackboard_list = Doctrine::getTable('Pizarra')->getBlackBoardRecords($rank, $section);
    
    //set layout to false
    $this->setLayout(false);
  }
  
  
}
