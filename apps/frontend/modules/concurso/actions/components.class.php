
<?php

class concursoComponents extends sfComponents {

    public function executeContribucionesdestacadas(sfWebRequest $request) {
        if ($id =  $request->getParameter('id')) {
            $this->contribucionesdestacadas = Doctrine::getTable("Contribucion")
                    ->createQuery()
                    ->where("concurso_id=?", $id)
                    ->addWhere("destacado=1")
//                    ->orderBy("fecha_destacado desc")
                    ->orderBy("created_at desc")
                    ->limit(sfConfig::get('app_contribuciones_destacadas'))
                    ->execute();
            
            $this->concurso = Doctrine::getTable("Concurso")->findOneById($id);
            
        } elseif (($date = $request->getParameter('date')) && ($slug = $request->getParameter('slug'))) {
            $date1 = DateTime::createFromFormat('d-m-Y H:i:s', $date . ' 00:00:00');
            $date2 = DateTime::createFromFormat('d-m-Y H:i:s', $date . ' 23:59:59');

            $this->contribucionesdestacadas = Doctrine::getTable("Contribucion")
                    ->createQuery('con')
                    ->leftJoin('con.Concurso c')
                    ->leftJoin('c.Empresa e')
                    ->where('e.slug like ?', $request->getParameter('nombre'))
                    ->leftJoin('c.Producto p')
                    ->orWhere('p.slug like ?', $request->getParameter('nombre'))
                    ->where('c.slug = ?', $slug)
                    ->andWhere('c.created_at >= ?', $date1->format('Y-m-d H:i:s'))
                    ->andWhere('c.created_at <= ?', $date2->format('Y-m-d H:i:s'))
                    ->addWhere("destacado=1")
                    ->orderBy("fecha_destacado desc")
                    ->limit(5)
                    ->execute();

            $this->concurso = Doctrine::getTable("Concurso")
                    ->createQuery('c')
                    ->leftJoin('c.Empresa e')
                    ->where('e.slug like ?', $request->getParameter('nombre'))
                    ->leftJoin('c.Producto p')
                    ->orWhere('p.slug like ?', $request->getParameter('nombre'))
                    ->where('slug = ?', $slug)
                    ->andWhere('created_at >= ?', $date1->format('Y-m-d H:i:s'))
                    ->andWhere('created_at <= ?', $date2->format('Y-m-d H:i:s'))
                    ->fetchOne();
        } else {
            $this->contribucionesdestacadas = null;
        }
    }

    public function executeDestacados(sfWebRequest $request) {
        $this->destacados = Doctrine::getTable("Concurso")->createQuery()
                ->where("destacado=1")
//                ->orderBy("fecha_destacado desc")
                ->orderBy("created_at desc")
                ->limit(sfConfig::get('app_destacados_in_menuside'))
                ->execute();
    }

    public function executeSemana() {

        if ($temp_concurso_semana = Doctrine::getTable("ConcursosDestacadosTemporales")
                ->createQuery()
                ->where("DATE_FORMAT(created_at,'%u')=?", Util::getFormat(date("Y-m-d"), "W"))
                ->andWhere("tipo_tiempo_id=?", 1)
                ->fetchOne())
            $this->concurso_semana = $temp_concurso_semana->getConcurso();
        else
            $this->concurso_semana = null;
        if ($temp_concurso_mes = Doctrine::getTable("ConcursosDestacadosTemporales")
                ->createQuery()
                ->where("DATE_FORMAT(created_at,'%c')=?", Util::getFormat(date("Y-m-d"), "n"))
                ->andWhere("tipo_tiempo_id=?", 2)
                ->fetchOne())
            $this->concurso_mes = $temp_concurso_mes->getConcurso();
        else
            $this->concurso_mes = null;
        if ($temp_concurso_anho = Doctrine::getTable("ConcursosDestacadosTemporales")
                ->createQuery()
                ->where("DATE_FORMAT(created_at,'%Y')=?", Util::getFormat(date("Y-m-d"), "Y"))
                ->andWhere("tipo_tiempo_id=?", 3)
                ->fetchOne())
            $this->concurso_anho = $temp_concurso_anho->getConcurso();
        else
            $this->concurso_anho = null;
    }

    /**
     * @param sfWebRequest $request
     * @param $this->contribucion Objecto Contribución sobre el cual se desea efectuar la votación
     */
    public function executeVotacion(sfWebRequest $request) {

        $args = array('contribucion_id'=>$this->contribucion->getId());
        if ($this->contribucion->getConcurso()->concurso_estado_id==3) {
            $this->puntos = null;
            $this->sobrepasa_limite_votos = false;
            if($this->getUser()->isAuthenticated())
            {
                $args['choices'] = $this->contribucion->getPuntuacionAsignable();
                $this->sobrepasa_limite_votos = $this->contribucion->getConcurso()->getNumeroVotacionesUsuario($this->getUser()->getProfile()->getId()) >= 5;
                if ($this->getUser()->hadVotedReferendum($this->contribucion))
                {
                    $this->puntos = $this->getUser()->getVoteContribution($this->contribucion)->getValue();
                }
            }

            $this->form = new ConcursoReferendumForm(array(), $args);
            //$this->numero_votantes = $this->contribucion->getVotosTotales();
            $this->numero_votantes = $this->contribucion->getConcurso()->getVotosTotales();
        }
        else
        {
             return sfView::NONE;
        }
    }

    public function executeBuscador(sfWebRequest $request) {
        $this->advanced = $request->getParameter('advanced', 'falso');
        $this->tipo = $request->getParameter('tipo', 'empresa');

        if ($this->tipo == 'empresa') {
            if ($this->advanced == 'falso') {
                $this->searchForm = new BasicEmpresaSearchForm();
            } else {
                $this->searchForm = new AdvancedEmpresaSearchForm();
            }

            /* 	if($request->isMethod('POST')){
              $this->searchForm->bind($request->getParameter($this->searchForm->getName()));
              if ($this->searchForm->isValid()) {
              echo 'válido';
              }
              } */
        }
    }

    public function executeFilter(sfWebRequest $request) {
        $this->filters = array("ConcursoCategoria" => "Categoría del concurso",
        );


        if ($request->getParameter("advanced") == "verdadero") {
            $this->filters = array_merge($this->filters, array("ConcursoEstado" => "Estado",
                "sfGuardUser" => "Creador",
                "sfGuardUser_p" => "Participante"));
        }

        $this->advanced = $request->getParameter("advanced", "falso");


        $this->tipo = $request->getParameter("tipo");
        if (!$this->tipo) {
            $this->tipo = "empresa";
            $this->valor = 1;
            $this->filters = array_merge($this->filters, array("Empresa" => "Entidad/Empresa", "States" => "Provincia"));
        }

        if ($this->tipo == "empresa") {
            $this->filters = array_merge($this->filters, array("Empresa" => "Entidad/Empresa", "States" => "Provincia"));
            $this->valor = 1;
        } else if ($this->tipo == "producto") {
            $this->filters = array_merge($this->filters, array("Producto" => "Producto"));
            $this->valor = 2;
        }

        if ($this->getUser()->hasAttribute("States", 'concurso_filters')) {
            $this->filters = array_merge($this->filters, array("City" => "Localidad"));
        }

        if ($this->getUser()->hasAttribute("collection", 'concurso_filters')) {
            $this->filters = array_merge($this->filters, array("publication" => "Publicación", "year" => "Año"));
        }

        foreach ($this->filters as $filter => $label) {
            if ($filter == "Empresa" || $filter == "Producto") {
                $this->form = new AutocompleteFilterForm(array(), array('filter' => $filter));
            } else if ($filter == "sfGuardUser") {
                $this->form_user = new AutocompleteFilterUserForm(array(), array('filter' => $filter));
            } else if ($filter == "sfGuardUser_p") {
                $this->form_user_p = new AutocompleteFilterUserParticipantForm(array(), array('filter' => $filter));
            } else if ($filter == "City") {
                $this->form_user_c = new AutocompleteFilterCityForm(array(), array('filter' => $filter));
            } else {
                $this->{$filter} = new sfWidgetFormDoctrineChoice(array('model' => ucfirst($filter),
                            "add_empty" => "Selecciona $label ..."), array("class" => "filter_select"));

                if ($filter == "ConcursoCategoria") {
                    if ($this->valor == 1) {
                        $this->{$filter}->addOption("table_method", "getListTypeEmpresa");
                    } else if ($this->valor == 2) {
                        $this->{$filter}->addOption("table_method", "getListTypeProducto");
                    }
                }

                $this->{$filter}->setLabel($label);
            }
        }

        if (count($this->getUser()->getAttributeHolder()->getAll("concurso_filters"))) {

            foreach ($this->filters as $filter => $label) {
                if ($this->getUser()->hasAttribute($filter, 'concurso_filters')) {
                    if ($filter == "sfGuardUser") {
                        $this->{"selected_$filter"} = Doctrine::getTable(($filter))
                                ->findOneById($this->getUser()
                                ->getAttribute($filter, null, "concurso_filters"));
                    } else if ($filter == "sfGuardUser_p") {
                        $this->{"selected_$filter"} = Doctrine::getTable(("sfGuardUser"))
                                ->findOneById($this->getUser()
                                ->getAttribute($filter, null, "concurso_filters"));
                    } else {
                        $this->{"selected_$filter"} = Doctrine::getTable(ucfirst($filter))
                                ->findOneById($this->getUser()
                                ->getAttribute($filter, null, "concurso_filters"));
                    }
                }
            }
        }
    }
    
    public function executeFeaturedContestList(sfWebRequest $request){
      //set contest type
      $contest_type_name = $this->contest_type == 'company'? ConcursoTipo::CONTEST_TYPE_COMPANY : ConcursoTipo::CONTEST_TYPE_PRODUCT;
      //fetch freatured contest records by type
      $this->contest_records = Doctrine::getTable('Concurso')->getFeatureContestRecords($contest_type_name);
      
    }

}