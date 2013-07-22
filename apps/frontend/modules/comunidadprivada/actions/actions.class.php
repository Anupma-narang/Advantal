<?php

/**
 * comunidadprivada actions.
 *
 * @package    auditoscopia
 * @subpackage comunidadprivada
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comunidadprivadaActions extends sfActions 
{
	public function executeIndex(sfWebRequest $request) 
	{
		$this->advanced=$request->getParameter('advanced','falso');
		$this->estado=$request->getParameter("estado",2);
		$this->tipo = $request->getParameter("tipo");
		$this->order_type = $request->getParameter('order-type', 'asc');
		if (!$this->tipo) {
			$this->tipo = "empresa";
			$this->valor = 1;
		}
		
		if ($this->tipo == "empresa") {
			$this->valor = 1;
		} else if ($this->tipo == "producto") {
			$this->valor = 2;
		}
		
		$concursos_query = Doctrine::getTable('concursocp')->createQuery('c')->where("c.concurso_tipo_id=?", $this->valor);;
		
		$concursos_query->andWhere("(c.concurso_estado_id=? or c.concurso_estado_id=? or c.concurso_estado_id=? or c.concurso_estado_id=?)", array(2,3,4,5));
		
		//el formulario de busqueda
		if($this->tipo=='empresa'){
			if($this->advanced=='falso')
				$this->searchForm = new BasicEmpresaSearchForm();
			else
				$this->searchForm = new AdvancedEmpresaSearchForm();
				
			if($request->isMethod('POST')){				
				$this->searchForm->bind($request->getParameter($this->searchForm->getName()));
				if ($this->searchForm->isValid()) {
					$values = $this->searchForm->getValues();
					if((isset($values['empresa'])) && ($values['empresa']!=''))
						$concursos_query->leftJoin('c.Empresa e')->andwhere('e.name LIKE ?', '%'.$values['empresa'].'%');
					if((isset($values['states_id'])) && ($values['states_id'] != 53))
						$concursos_query->andWhere('c.states_id=?',$values['states_id']);
					if((isset($values['city_id'])) && ($values['city_id'] != 8113))
						$concursos_query->andWhere('c.city_id=?',$values['city_id']);
					if(isset($values['concurso_categoria_id']))
						$concursos_query->andWhere('c.concurso_categoria_id=?',$values['concurso_categoria_id']);

					//los valores del formulario avanzado
					if(isset($values['estado_id']))
						$concursos_query->andWhere('c.concurso_estado_id=?',$values['estado_id']);
					if((isset($values['autor'])) && ($values['autor']!=''))
						$concursos_query->leftJoin('c.User u')->andwhere('u.username LIKE ?', $values['autor']);					
				}
			}					
		}
		elseif($this->tipo=='producto'){
			if($this->advanced=='falso')
				$this->searchForm = new BasicProductoSearchForm();
			else
				$this->searchForm = new AdvancedProductoSearchForm();

			if($request->isMethod('POST')){
				$this->searchForm->bind($request->getParameter($this->searchForm->getName()));
				if ($this->searchForm->isValid()) {
					$values = $this->searchForm->getValues();
					if((isset($values['producto'])) && ($values['producto']!=''))
						$concursos_query->leftJoin('c.Producto p')->andwhere('p.name LIKE ?', $values['producto']);
					if((isset($values['marca'])) && ($values['marca']!=''))
						$concursos_query->leftJoin('c.Producto p2')->andwhere('p2.marca LIKE ?', $values['marca']);
						//$concursos_query->andwhere('p.marca LIKE ?', $values['marca']);
					if((isset($values['modelo'])) && ($values['modelo']!=''))
						$concursos_query->leftJoin('c.Producto p3')->andwhere('p3.modelo LIKE ?', $values['modelo']);
						//$concursos_query->andwhere('p.modelo LIKE ?', $values['modelo']);
					
					if(isset($values['estado_id']))
						$concursos_query->andWhere('c.concurso_estado_id=?',$values['estado_id']);
					if((isset($values['autor'])) && ($values['autor']!=''))
						$concursos_query->leftJoin('c.User u')->andwhere('u.username LIKE ?', $values['autor']);								
				}
			}			
		}	
		else{
			$this->forward404('El tipo de concurso no es válido: '.$this->tipo);
		}

		if(isset($values['n_participantes'])){
			switch ($values['n_participantes']){
				case '1':		//1-50
					$concursos_query->leftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=1) and (count(con.id) <=50)');
					break;
				case '2':		//51-100
					$concursos_query->leftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=51) and (count(con.id) <=100)');
					break;
				case '3':		//101-250
					$concursos_query->leftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=101) and (count(con.id) <=250)');
					break;
				case '4':		//251-500
					$concursos_query->leftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=251) and (count(con.id) <=500)');
					break;
				case '5':		//501-1000
					$concursos_query->leftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=501) and (count(con.id) <=1000)');
					break;
				case '6':		//+1000
					$concursos_query->leftJoin('c.Contribuciones con')->groupBy('c.id')->having('(count(con.id) >=1000 )');
					break;
			}
		}	
		if($this->tipo=='empresa'){
			if($orderby1 = $request->getPostParameter('SearchForm[orderby1]',1))
				switch($orderby1){
					case 1:
						$concursos_query->leftJoin('c.Empresa e1')->OrderBy('e1.name '.strtoupper($this->order_type));
						break;
					case 2:
						$concursos_query->leftJoin('c.ConcursoCategoria cat1')->orderBy('cat1.name '.strtoupper($this->order_type));
						break;
					case 3:
						$concursos_query->leftJoin('c.Empresa e1')->orderBy('e1.empresa_sector_uno_id '.strtoupper($this->order_type));
						break;
					case 4:
						$concursos_query->leftJoin('c.States es1')->orderBy('es1.name '.strtoupper($this->order_type));
						break;
					case 5:
						$concursos_query->leftJoin('c.City ci1')->orderBy('ci1.name '.strtoupper($this->order_type));
						break;
			}
			if($orderby2 = $request->getPostParameter('SearchForm[orderby2]',null))
				switch($orderby2){
					case 1:
						$concursos_query->leftJoin('c.Empresa e2')->addOrderBy('e2.name '.strtoupper($this->order_type));
						break;
					case 2:
						$concursos_query->leftJoin('c.ConcursoCategoria cat2')->orderBy('cat2.name '.strtoupper($this->order_type));
						break;
					case 3:
						$concursos_query->leftJoin('c.Empresa e2')->addOrderBy('e2.empresa_sector_uno_id '.strtoupper($this->order_type));
						break;
					case 4:
						$concursos_query->leftJoin('c.States es2')->AddOrderBy('es2.name '.strtoupper($this->order_type));
						break;
					case 5:
						$concursos_query->leftJoin('c.City ci2')->addOrderBy('ci2.name '.strtoupper($this->order_type));
						break;
			}
			if($orderby3 = $request->getPostParameter('SearchForm[orderby3]',null))
				switch($orderby3){
					case 1:
						$concursos_query->leftJoin('c.Empresa e3')->addOrderBy('e3.name '.strtoupper($this->order_type));
						break;
					case 2:
						$concursos_query->leftJoin('c.ConcursoCategoria cat3')->orderBy('cat3.name '.strtoupper($this->order_type));
						break;
					case 3:
						$concursos_query->leftJoin('c.Empresa e3')->addOrderBy('e3.empresa_sector_uno_id '.strtoupper($this->order_type));
						break;
					case 4:
						$concursos_query->leftJoin('c.States es3')->addOrderBy('es3.name '.strtoupper($this->order_type));
						break;
					case 5:
						$concursos_query->leftJoin('c.City ci3')->addOrderBy('ci3.name '.strtoupper($this->order_type));
						break;
			}
		}
		elseif($this->tipo=='producto'){
				
		}
		$concursos_query->addOrderBy('created_at desc');		
			
		$this->pager = new sfDoctrinePager(
				'ConcursoCp',
				sfConfig::get('app_concursos_in_list')
		);
		$this->pager->setQuery($concursos_query);
		$this->pager->setPage($request->getParameter('page', 1));
		$this->pager->init();
		
		$this->n_concursos = $this->pager->getNbResults();
	}
}
