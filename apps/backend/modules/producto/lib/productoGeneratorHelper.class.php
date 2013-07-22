<?php

/**
 * producto module helper.
 *
 * @package    auditoscopia
 * @subpackage producto
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productoGeneratorHelper extends BaseProductoGeneratorHelper
{
    public function linkToList($params)
    {
        switch (sfContext::getInstance()->getActionName()) {
            case 'editListaBlanca':
                return '<li class="sf_admin_action_list">' . link_to('Lista blanca', 'producto_lista_blanca') . '</li>';
                break;

            default:
                return '<li class="sf_admin_action_list">' . link_to(__($params['label'], array(), 'sf_admin'), '@' . $this->getUrlForAction('list')) . '</li>';

                break;
        }
    }

    public function linkToEdit($object, $params)
    {
        switch (sfContext::getInstance()->getActionName()) {
            case 'listaBlanca':
                return '<li class="sf_admin_action_edit">' . link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit_lista_blanca'), $object) . '</li>';
                break;
            default:
                return '<li class="sf_admin_action_edit">' . link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object) . '</li>';
                break;
        }
    }

}
