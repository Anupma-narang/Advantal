<?php

/**
 * empresa module helper.
 *
 * @package    auditoscopia
 * @subpackage empresa
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empresaGeneratorHelper extends BaseEmpresaGeneratorHelper
{
    public function getUrlForAction($action)
    {
        return 'list' == $action ? 'empresa_lista_blanca' : 'empresa_'.$action;
    }
}
