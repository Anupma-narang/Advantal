<?php

class concursos_query extends Doctrine_Query {

  public static function getConcursos($tipo, $filters, $list = 'abiertos') {
    $estados = array('abiertos' => '2,3,4,5,10', 'historico' => '6,7', 'referendum' => '3');
    $tipo_records = Doctrine::getTable('ConcursoTipo')->getTipoId();

    $q = Doctrine_Query::create(null, 'concursos_query')
            ->from('Concurso c')
            ->where('c.concurso_tipo_id=?', $tipo == 'empresa' ? $tipo_records['Empresa/Entidad'] : $tipo_records['Producto'] )
            ->leftJoin('c.States st')
            ->leftJoin('c.City ct')
            ->leftJoin('c.ConcursoCategoria cc');
    //if contest type is company
    if ($tipo == 'empresa') {
      $q->leftJoin('c.Empresa em')
              ->leftJoin('em.EmpresaSectorUno esu')
              ->leftJoin('em.EmpresaSectorDos esd');
    }
    //if contest type is product
    else {
      $q->leftJoin('c.Producto pd')
              ->leftJoin('pd.ProductoTipoUno psu')
              ->leftJoin('pd.ProductoTipoDos psd');
    }


    if (!isset($filters['estado_id']) or empty($filters['estado_id'])) {
      $q->andWhere('c.concurso_estado_id IN (' . $estados[$list] . ')');
    }
    return $q->processFilters($filters,$tipo);
  }

  private function processFilters($filters,$tipo) {
    foreach ($filters as $filter => $value) {
      if ($filter == 'empresa' and $value != '') {
        $this->uniqueLeftJoin('c.Empresa e')->andwhere('e.name LIKE ?', "%$value%");
      } else if ($filter == 'states_id' and $value > 1) {
        $this->andWhere('c.states_id=?', $value);
      } else if ($filter == 'city_id' and !empty($value) and $value != 8113) {
        $this->andWhere('c.city_id=?', $value);
      } else if ($filter == 'concurso_categoria_id' and !empty($value)) {
        $this->andWhere('c.concurso_categoria_id=?', $value);
      } else if ($filter == 'autor' and $value != '') {
        $this->uniqueLeftJoin('c.User u')->andwhere('u.username LIKE ?', "%$value%");
        if ($tipo == 'empresa') {
          $this->uniqueLeftJoin('c.Empresa e')->orderBy('c.created_at DESC, e.name ASC,st.name ASC, ct.name ASC,esu.name ASC,esd.name ASC , cc.name ASC ');
        } else {
          $this->orderBy('c.created_at DESC, pd.name ASC, pd.marca, pd.modelo,  psu.name ASC, psd.name ASC , cc.name ASC ');
        }
      } else if ($filter == 'n_participantes' and $value > 0) {
        if ($value < 6) {
          $bounds = array(0, 50, 100, 250, 500, 1000);
          $this->uniqueLeftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=?) and (count(con.id) <=?)', array($bounds[$value - 1] + 1, $bounds[$value]));
        } else {
          $this->uniqueLeftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >?)', 1000);
        }
        if ($tipo == 'empresa') {
          $this->uniqueLeftJoin('c.Empresa e')->orderBy('c.created_at DESC, e.name ASC,st.name ASC, ct.name ASC,esu.name ASC,esd.name ASC , cc.name ASC ');
        } else {
          $this->orderBy('c.created_at DESC, pd.name ASC, pd.marca, pd.modelo,  psu.name ASC, psd.name ASC , cc.name ASC ');
        }
      } else if ($filter == 'producto' and $value != '') {
        $this->uniqueLeftJoin('c.Producto p')->andwhere('p.name LIKE ?', "%$value%");
      } else if ($filter == 'marca' and $value != '') {
        $this->uniqueLeftJoin('c.Producto p')->andwhere('p.marca LIKE ?', "%$value%");
      } else if ($filter == 'modelo' and $value != '') {
        $this->uniqueLeftJoin('c.Producto p')->andwhere('p.modelo LIKE ?', "%$value%");
      }
    }

    // estado_id == 0  ->  Filtrado de concursos abiertos (en estado 2, 3, 4, 5 ó 10; activo, en referéndum,
    //  en deliberación, en observación o en revisión).
    //  No se permite filtrar por los estados 1,8 y 9, ni en Revista ni Nulo ni Borrador.
    if (!empty($filters['estado_id'])) {
      $this->andWhere('c.concurso_estado_id=?', $filters['estado_id']);
      if ($tipo == 'empresa') {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('c.created_at DESC, e.name ASC,st.name ASC, ct.name ASC,esu.name ASC,esd.name ASC , cc.name ASC ');
      } else {
        $this->orderBy('c.created_at DESC, pd.name ASC, pd.marca, pd.modelo,  psu.name ASC, psd.name ASC , cc.name ASC ');
      }
    }

    // Filtros
    if (isset($filters['filter_option'])) {
      if (1 == $filters['filter_option']) {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('c.created_at DESC, e.name ASC,st.name ASC, ct.name ASC,esu.name ASC,esd.name ASC , cc.name ASC ');
      } else if (2 == $filters['filter_option']) {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('e.name ASC, c.created_at DESC, st.name ASC, ct.name ASC,esu.name ASC,esd.name ASC , cc.name ASC ');
      } else if (3 == $filters['filter_option']) {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('cc.name ASC, c.created_at DESC, e.name ASC,st.name ASC, ct.name ASC,esu.name ASC,esd.name ASC  ');
      } else if (4 == $filters['filter_option']) {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('esu.name ASC,esd.name ASC ,c.created_at DESC, e.name ASC,st.name ASC, ct.name ASC, cc.name ASC ');
      } else if (5 == $filters['filter_option']) {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('st.name ASC, c.created_at DESC, e.name ASC, ct.name ASC,esu.name ASC,esd.name ASC , cc.name ASC ');
      } else if (6 == $filters['filter_option']) {
        $this->uniqueLeftJoin('c.Empresa e')->orderBy('ct.name ASC,c.created_at DESC, e.name ASC,st.name ASC, esu.name ASC,esd.name ASC , cc.name ASC ');
      } else if (11 == $filters['filter_option']) {
        $this->orderBy('c.created_at DESC, pd.name ASC, pd.marca, pd.modelo,  psu.name ASC, psd.name ASC , cc.name ASC ');
      } else if (12 == $filters['filter_option']) {
        $this->orderBy('pd.name ASC, c.created_at DESC, pd.marca, pd.modelo,  psu.name ASC, psd.name ASC , cc.name ASC ');
      } else if (13 == $filters['filter_option']) {
        $this->orderBy('cc.name ASC, c.created_at DESC, pd.name ASC, pd.marca, pd.modelo,  psu.name ASC, psd.name ASC  ');
      } else if (14 == $filters['filter_option']) {
        $this->orderBy('psu.name ASC, psd.name ASC , c.created_at DESC, pd.name ASC, pd.marca, pd.modelo,  cc.name ASC ');
      } else if (15 == $filters['filter_option']) {
        $this->orderBy('pd.marca, c.created_at DESC, pd.name ASC, pd.modelo,  psu.name ASC, psd.name ASC , cc.name ASC ');
      } else if (16 == $filters['filter_option']) {
        $this->orderBy(' pd.modelo, c.created_at DESC, pd.name ASC, pd.marca, psu.name ASC, psd.name ASC , cc.name ASC ');
      }
    }

    return $this;
  }

  protected function uniqueLeftJoin($join) {
    $join = 'LEFT JOIN ' . $join;
    return in_array($join, $this->_dqlParts['from']) ? $this : $this->_addDqlQueryPart('from', $join, true);
  }

  protected function _addDqlQueryPart($queryPartName, $queryPart, $append = false) {
    // We should prevent nullable query parts
    if ($queryPart === null) {
      throw new Doctrine_Query_Exception('Cannot define NULL as part of query when defining \'' . $queryPartName . '\'.');
    }

    if ($append) {
      $this->_dqlParts[$queryPartName][] = $queryPart;
    } else {
      $this->_dqlParts[$queryPartName] = array($queryPart);
    }

    $this->_state = Doctrine_Query::STATE_DIRTY;
    return $this;
  }

}