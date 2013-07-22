<?php

/**
 * cuestionario module configuration.
 *
 * @package    auditoscopia
 * @subpackage cuestionario
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuestionarioGeneratorConfiguration extends BaseCuestionarioGeneratorConfiguration
{
    public function getFormClass()
    {

        $request = sfContext::getInstance()->getRequest();
        if ($request->getParameter('lista') == 'ln') {

            return 'ListaCuestionarioNegraForm';
        } else {
            return 'ListaCuestionarioForm';
        }
    }



    public function getTableMethod()
    {
        switch (sfContext::getInstance()->getActionName()) {
            case 'indexProducto':
                $tableMethod = 'getCuestionariosForProducto';
                break;

            default:
                $tableMethod = parent::getTableMethod();
                break;
        }
        return $tableMethod;
    }
}
