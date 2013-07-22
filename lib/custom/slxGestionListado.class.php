<?php
//Version 1.1


class slxGestionListado
{
  public
    $module = '',
    $model = '',
    $campo_orden_x_defecto = '',
    $sentido_orden_x_defecto = '',
    $elem_x_pagina = 10,
    $prefijo_atributo = '',
    $session_variable = 'gestion_listados';
  
  public function __construct ($params)
  {    
    $this->module = $params['module'];
    $this->model = $params['model'];
    $this->campo_orden_x_defecto = $params['campo_orden_x_defecto'];
    $this->sentido_orden_x_defecto = $params['sentido_orden_x_defecto'];
    $this->elem_x_pagina = $params['elem_x_pagina'];
    
    if (!empty($params['session_variable']))
    {
      $this->session_variable = $params['session_variable'];
    }
    
    if (!empty($params['prefijo_atributo']))
    {
      $this->prefijo_atributo = $params['prefijo_atributo'];
    }
  }
  
  public function getPager($query = null)
  {
    $pager = new sfDoctrinePager($this->model, $this->elem_x_pagina);
    
    if (!$query)
    {
      $query = Doctrine::getTable($this->model)
        ->createQuery('a');
    }
    
    $this->addSortQuery($query);
    $pager->setQuery($query);
    $pager->setPage($this->getPage());
    $pager->init();
    return $pager;
  }
  
  //Esta función establece el orden de la consulta. Si para un campo necesitamos establecer el orden por más de un campo
  //podemos pasarle los campos a ordenar separados por ':', ejempo nombre:apellidos.
  public function addSortQuery($query)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    if (!in_array(strtolower($sort[1]), array('asc', 'desc')))
    {
      $sort[1] = $this->sentido_orden_x_defecto;
    }
    
    $arry_aux = explode(':',$sort[0]);
    $orden = '';
    
    foreach ($arry_aux as $values)
    {
      $orden.= $values.' '.$sort[1].',';
    }
    
    $orden = substr ($orden, 0, strlen($orden) - 1);
    $query->addOrderBy($orden);
  }
  
  public function setPage($page)
  {
    sfContext::getInstance()->getUser()->setAttribute($this->prefijo_atributo.$this->module . '.page', $page, $this->session_variable);
  }

  public function getPage()
  {
    return sfContext::getInstance()->getUser()->getAttribute($this->prefijo_atributo.$this->module . '.page', 1, $this->session_variable);
  }
  
  public function getSort()
  {
    if (null !== $sort = sfContext::getInstance()->getUser()->getAttribute($this->prefijo_atributo.$this->module . '.sort', null, $this->session_variable))
    {
      return $sort;
    }

    $this->setSort(array($this->campo_orden_x_defecto, $this->sentido_orden_x_defecto));

    return sfContext::getInstance()->getUser()->getAttribute($this->prefijo_atributo.$this->module . '.sort', null, $this->session_variable);
  }
  
  public function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = $this->sentido_orden_x_defecto;
    }

    sfContext::getInstance()->getUser()->setAttribute($this->prefijo_atributo.$this->module . '.sort', $sort, $this->session_variable);
  }

  public function getFilters()
  {
    return sfContext::getInstance()->getUser()->getAttribute($this->prefijo_atributo.$this->module . '.filters', array(), $this->session_variable);
  }
  
  public function setFilters(array $filters)
  {
    return sfContext::getInstance()->getUser()->setAttribute($this->prefijo_atributo.$this->module . '.filters', $filters, $this->session_variable);
  }
}