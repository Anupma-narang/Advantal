<?php

require_once dirname(__FILE__).'/../lib/categoria_excelenciaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoria_excelenciaGeneratorHelper.class.php';

/**
 * categoria_excelencia actions.
 *
 * @package    symfony
 * @subpackage categoria_excelencia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoria_excelenciaActions extends autoCategoria_excelenciaActions
{

    public function executeShow(sfWebRequest $request) {
        $this->categoria_excelencia = $this->getRoute()->getObject();
    }

}
