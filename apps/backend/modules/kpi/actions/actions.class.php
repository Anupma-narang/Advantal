<?php

require_once dirname(__FILE__) . '/../lib/kpiGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/kpiGeneratorHelper.class.php';

/**
 * kpi actions.
 *
 * @package    symfony
 * @subpackage kpi
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class kpiActions extends autoKpiActions {

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $obj = $this->getRoute()->getObject();
        try {
            $obj->delete();
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'El Kpi no se puede borrar porqué está en uso en alguna empresa o producto');
        }

        $this->redirect('@kpi');
    }

    /**
     * KPIs Detail
     */
    public function executeShow(sfWebRequest $request) {
        $this->kpi = Doctrine_Core::getTable('kpi')->find($request->getParameter('id'));
    }

}
