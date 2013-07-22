<?php

class concursos_query extends Doctrine_Query {

    public static function getConcursos($tipo, $filters, $list='abiertos')
    {
        $estados = array('abiertos'=>'2,3,4,5,10', 'historico'=>'6,7', 'referendum'=>'3');
        $tipo_records = Doctrine::getTable('ConcursoTipo')->getTipoId();
        
        $q = Doctrine_Query::create(null, 'concursos_query')
            ->from('Concurso c')
            ->where('c.concurso_tipo_id=?', $tipo=='empresa' ?  $tipo_records['Empresa/Entidad']: $tipo_records['Producto'] );

        if (!isset($filters['estado_id']) or empty($filters['estado_id']))
        {
            $q->andWhere('c.concurso_estado_id IN ('.$estados[$list].')');
        }
        return $q->processFilters($filters);
    }

    private function processFilters($filters)
    {
        foreach ($filters as $filter=>$value)
        {
            if ($filter == 'empresa' and $value != '')
            {
                $this->uniqueLeftJoin('c.Empresa e')->andwhere('e.name LIKE ?', "%$value%");
            }
            else if ($filter == 'states_id' and $value > 1)
            {
                $this->andWhere('c.states_id=?', $value);
            }
            else if ($filter == 'city_id' and !empty($value) and $value != 8113)
            {
                $this->andWhere('c.city_id=?', $value);
            }
            else if ($filter == 'concurso_categoria_id' and !empty($value))
            {
                $this->andWhere('c.concurso_categoria_id=?', $value);
            }
            else if ($filter == 'autor' and $value != '')
            {
                $this->uniqueLeftJoin('c.User u')->andwhere('u.username LIKE ?', "%$value%");
            }
            else if ($filter == 'n_participantes' and $value > 0)
            {
                if ($value < 6)
                {
                    $bounds = array(0,50,100,250,500,1000);
                    $this->uniqueLeftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=?) and (count(con.id) <=?)', array($bounds[$value-1]+1, $bounds[$value]));
                }
                else
                {
                    $this->uniqueLeftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >?)', 1000);
                }
            }
            else if ($filter == 'producto' and $value != '')
            {
                $this->uniqueLeftJoin('c.Producto p')->andwhere('p.name LIKE ?', "%$value%");
            }
            else if ($filter == 'marca' and $value != '')
            {
                $this->uniqueLeftJoin('c.Producto p')->andwhere('p.marca LIKE ?', "%$value%");
            }
            else if ($filter == 'modelo' and $value != '')
            {
                $this->uniqueLeftJoin('c.Producto p')->andwhere('p.modelo LIKE ?', "%$value%");
            }
        }

        // estado_id == 0  ->  Filtrado de concursos abiertos (en estado 2, 3, 4, 5 ó 10; activo, en referéndum,
        //  en deliberación, en observación o en revisión).
        //  No se permite filtrar por los estados 1,8 y 9, ni en Revista ni Nulo ni Borrador.
        if (!empty($filters['estado_id']))
        {
            $this->andWhere('c.concurso_estado_id=?', $filters['estado_id']);
        }

        // Filtros
        if (isset($filters['filter_option']))
        {
            if (1 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Empresa e')->orderBy('c.created_at DESC, e.name');
            }
            else if (2 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Empresa e')->orderBy('e.name, c.created_at DESC');
            }
            else if (3 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.ConcursoCategoria cc')->orderBy('cc.name, c.created_at DESC');
            }
            else if (4 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Empresa e')->uniqueLeftJoin('e.EmpresaSectorTres es3')->uniqueLeftJoin('e.EmpresaSectorDos es2')->orderBy('IF(es3.id IS NOT NULL , es3.name, es2.name), c.created_at DESC');
            }
            else if (5 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.States s')->orderBy('s.name, c.created_at DESC');
            }
            else if (6 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.City ci')->orderBy('ci.name, c.created_at DESC');
            }
            else if (11 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Producto p')->orderBy('c.created_at DESC, p.name');
            }
            else if (12 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Producto p')->orderBy('p.name, c.created_at DESC');
            }
            else if (13 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.ConcursoCategoria cc')->orderBy('cc.name, c.created_at DESC');
            }
            else if (14 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Producto p')->uniqueLeftJoin('p.ProductoTipoUno pt1')->orderBy('pt1.name, c.created_at DESC');
            }
            else if (15 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Producto p')->orderBy('p.marca, c.created_at DESC');
            }
            else if (16 == $filters['filter_option'])
            {
                $this->uniqueLeftJoin('c.Producto p')->orderBy('p.marca, p.modelo, c.created_at DESC');
            }
        }

        return $this;
    }

    protected function uniqueLeftJoin($join)
    {
        $join = 'LEFT JOIN ' . $join;
        return in_array($join, $this->_dqlParts['from']) ? $this : $this->_addDqlQueryPart('from', $join, true);
    }

    protected function _addDqlQueryPart($queryPartName, $queryPart, $append = false)
    {
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