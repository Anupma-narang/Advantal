<?php

/**
 * ConcursoTipo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ConcursoTipo extends BaseConcursoTipo
{
  const CONTEST_TYPE_COMPANY = 'Empresa/Entidad';
  const CONTEST_TYPE_PRODUCT = 'Producto';
  
  public function getNameres()
  {
    return array(1,2);
  }
}
