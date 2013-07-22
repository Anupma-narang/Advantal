<?php

    /**
     * cuestionario module helper.
     *
     * @package    auditoscopia
     * @subpackage cuestionario
     * @author     Your name here
     * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
     */
class cuestionarioGeneratorHelper extends BaseCuestionarioGeneratorHelper
{

    public function linkToSave($object, $params)
    {
        return '<li class="sf_admin_action_save"><input type="submit" value="' . __($params['label'], array(), 'sf_admin') . '" /></li>';
    }

    public function linkToNew($params)
    {
        switch (sfContext::getInstance()->getActionName()) {
            case 'indexProducto':
                return '<li class="sf_admin_action_new">' . link_to(__($params['label'], array(), 'sf_admin'), '@' . $this->getUrlForAction('newProducto')) . '</li>';
                break;

            default:
                return '<li class="sf_admin_action_new">' . link_to(__($params['label'], array(), 'sf_admin'), '@' . $this->getUrlForAction('new')) . '</li>';

                break;
        }
    }

    public function linkToList($params)
    {
        return '<li class="sf_admin_action_list">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list')).'</li>';
    }

    public function linkToClose($params)
    {
        return '<li class="sf_admin_action_close">'.link_to(__('Cerrar'), '@'.$this->getUrlForAction('list')).'</li>';
    }



}
