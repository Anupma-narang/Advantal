<?php

/**
 * concurso actions.
 *
 * @package    auditoscopia
 * @subpackage concurso
 * @author     calambrenet <calambrenet@codefriends.es>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursoActions extends sfActions {

    public function executeViewEmpresas() {
        $this->forward404If('dev' != sfContext::getInstance()->getConfiguration()->getEnvironment());
        $this->empresas = Doctrine_Core::getTable('Empresa')->findAll();
    }

    public function executeViewProductos() {
        $this->forward404If('dev' != sfContext::getInstance()->getConfiguration()->getEnvironment());
        $this->productos = Doctrine_Core::getTable('Producto')->findAll();
    }

    public function executeViewEmpresaSectores() {
        $this->forward404If('dev' != sfContext::getInstance()->getConfiguration()->getEnvironment());
        $this->rows = array();
        $s1 = Doctrine_Core::getTable('EmpresaSectorUno')->findAll();
        foreach ($s1 as $e1) {
            $s2 = Doctrine_Core::getTable('EmpresaSectorDos')->findBy('empresa_sector_uno_id', $e1->getId());
            foreach ($s2 as $e2) {
                $s3 = Doctrine_Core::getTable('EmpresaSectorTres')->findBy('empresa_sector_dos_id', $e2->getId());
                if (count($s3) > 0) {
                    foreach ($s3 as $e3) {
                        $this->rows[] = array($e1->name, $e2->name, $e3->name);
                    }
                } else {
                    $this->rows[] = array($e1->name, $e2->name, '');
                }
            }
        }
    }

    public function executeComplete(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Producto')
                ->createQuery()
                ->where('marca like ?', '%' . $request['q'] . '%')
                ->orderBy('marca')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'marca');

        return $this->renderText(json_encode($result));
    }

    public function executeCompleteNombreProducto(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Producto')
                ->createQuery()
                ->where('name like ?', '%' . $request['q'] . '%')
                ->orderBy('name')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'name');

        return $this->renderText(json_encode($result));
    }

    public function executeAutocomplete(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Empresa')
                ->createQuery()
                ->where('name like ?', '%' . $request['q'] . '%')
                ->orderBy('name')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'name');

        return $this->renderText(json_encode($result));
    }

    public function executeAutocompleteproducto(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Producto')
                ->createQuery()
                ->where('name like ?', '%' . $request['q'] . '%')
                ->orderBy('name')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'name');

        return $this->renderText(json_encode($result));
    }

    public function executeAutocompletemodel(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Producto')
                ->createQuery()
                ->where('modelo like ?', '%' . $request['q'] . '%')
                ->orderBy('modelo')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'modelo');

        return $this->renderText(json_encode($result));
    }

    public function executeAutocompleteconcursoname(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Concurso')
                ->createQuery()
                ->where('name like ?', '%' . $request['q'] . '%')
                ->orderBy('name')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'name');

        return $this->renderText(json_encode($result));
    }

    public function executeAutocompleteconcursoaddress(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Concurso')
                ->createQuery()
                ->where('concurso_address like ?', '%' . $request['q'] . '%')
                ->orderBy('concurso_address')
                ->limit(10)
                ->execute()
                ->toKeyValueArray('id', 'concurso_address');

        return $this->renderText(json_encode($result));
    }

    public function executeAutocompletecity(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('City')
                ->findCityByNameState($request['q'], $this->getUser()->getAttribute("States", null, "concurso_filters"))
                ->toKeyValueArray('id', 'name');
        return $this->renderText(json_encode($result));
    }

    public function executePizarra(sfWebRequest $request) {

        $this->setLayout(false);

        $aux = explode(",", $_GET['ids']);

        $rank = $this->getUser()->isAuthenticated() ? $this->getUser()->getProfile()->rank + 2 : 1;
        $this->pizarra = Doctrine::getTable('pizarra')->createQuery('p')
                ->where('(desde<? and hasta>?) OR (desde IS NULL and hasta IS NULL) OR (desde IS NULL and hasta>?) OR (hasta IS NULL and desde<?)', array(date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), date('Y-m-d H:i:s')))
                ->andWhere('visibilidad<=?', $rank)
                ->andWhere('seccion=1')
                ->andWhereNotIn('p.id', $aux)
                ->fetchOne();

        $this->num = $_GET['num'];
    }

    public function executeAutocompleteuser(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('sfGuardUser')
                ->findUserByName($request['q'])
                ->toKeyValueArray('id', 'username');
        return $this->renderText(json_encode($result));
    }

    public function executeCompletecity(sfWebRequest $request) {
        $resultado = Doctrine_Core::getTable('Concurso')
                ->createQuery($request['q'])
                ->toKeyValueArray('concurso_city');
        return $this->renderText(json_encode($resultado));
    }

    public function executeConfirm(sfWebRequest $request) {
        
    }

    public function executeIndex(sfWebRequest $request) {
        $this->tipo = $request->getParameter('tipo', 'empresa') == 'empresa' ? 'empresa' : 'producto';
        $this->list = $request->getParameter('list', 'abiertos');
        $this->advanced = intval($request->getParameter('advanced', 0));

        if ($this->tipo == 'empresa') {
            $this->black_board_name = 'CE';
            $this->form = new ConcursoEmpresaSearchForm();
        } else {
            $this->black_board_name = 'CP';

            $this->form = new ConcursoProductoSearchForm();
        }

        $this->form->processForm($request);
        if ($request->getMethod() == sfWebRequest::GET && $this->getUser()->getAttribute('visit_count') == 1) {
            $userData = $request->getCookie($this->form->getName() . 'record', null);
            $userData = is_null($userData) ? null : unserialize(base64_decode($userData));
            $this->form->bind($userData);
        }
        $this->getUser()->setAttribute('visit_count', 1);
        $this->values = $this->form->getValues();
        if (!empty($this->values) and 'save' == $request->getParameter('extra', '')) {
            $this->getResponse()->setCookie($this->form->getName(), base64_encode(serialize($this->values)), time() + 31536000);  // expires -> 1 year
        }
        $this->getResponse()->setCookie($this->form->getName() . 'record', base64_encode(serialize($this->values)), time() + 31536000);  // expires -> 1 year
        $query = concursos_query::getConcursos($this->tipo, $this->values, $this->list);

        $this->pager = new sfDoctrinePager('Concurso', sfConfig::get('app_concursos_i_list', 10));
        $this->pager->setQuery($query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();

        //carga de la pizarra
        $this->pizarras = array();
        // Esto peta cuando el usuario no hay usuario logeado (ver frontend_dev.php/concurso?tipo=producto )
        //   $rank = 1 + $this->getUser()->getProfile()->rank + (($this->getUser()->isAuthenticated()) ? 1 : 0);
        // y se ha cambiado por lo siguiente
        $rank = $this->getUser()->isAuthenticated() ? $this->getUser()->getProfile()->rank + 2 : 1;
        $this->getResponse()->setTitle('Concursos para auditar empresas, entidades públicas y productos');
        $this->getResponse()->addMeta('description', 'Contribuye en concursos de ideas y audita empresas, entidades públicas y productos. ¡Mejora tus productos y servicios favoritos y gana dinero!');
        $this->getResponse()->addMeta('keywords', 'concursos, concurso activo, concursos activos, concurso destacado,  concursos destacados, concurso semana, concurso mes, concurso año, histórico concursos, ver concurso, buscar concurso, buscar concursos, categoría concurso, detalle concurso, incidencia, referéndum activo, referéndums activos, contribución destacada, contribuciones destacadas');
    }

    public function executeNew(sfWebRequest $request) {
        $this->tipo = $request->getParameter("tipo", 'empresa');
        $this->id = $request->getParameter('id', null);

        $this->form = new ConcursoFormFrontend(null, array('type' => $this->tipo));
        /* if($this->tipo == 'empresa'){
          $this->form->setWidget('empresa_nombre',new sfWidgetFormDoctrineChoice(array('model' => 'Empresa', 'add_empty' => "Seleccione ...")));
          }else{
          $this->form->setWidget('producto',new sfWidgetFormDoctrineChoice(array('model' => 'Producto', 'add_empty' => "Seleccione ...")));

          } */

        if ($request->isMethod('POST')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            $this->current_values = $this->form->getTaintedValues();
            if ($this->form->isValid()) {
                $concurso = $this->form->save();

                $this->getContext()->getConfiguration()->loadHelpers('Url');
                if ($this->form->isNew()) {
                    if ($concurso->getConcursoTipoId() == 1) {
                        $tipo = 'empresa';
                        $id = '&id=' . $concurso->getEmpresaId();
                    } else {
                        $tipo = 'producto';
                        $id = '&id=' . $concurso->getProductoId();
                    }

                    if ($this->form->getValue('borrador'))
                        $this->getUser()->setFlash('notice', 'Tu concurso se ha guardado correctamente en borradores.<br/>');
                    else
                        $this->getUser()->setFlash('notice', 'Has creado este concurso correctamente.<br/>
                        No lo podrás ver hasta que sea revisado por un moderador.<br/><br/>
                        <strong>Si quieres crear otro concurso para ' . ($concurso->getConcursoTipoId() == 1 ? 'esta empresa o entidad' : 'este producto') . '</strong>, <a href="' .
                                url_for("concurso/new?tipo=" . $tipo . $id) . '">haz clic aquí</a>.<br/><br/>
                        ¡Muchas gracias por crear un concurso!');
                } else {
                    if ($this->form->getValue('borrador'))
                        $this->getUser()->setFlash('notice', 'El concurso se ha modificado correctamente.');
                    else
                        $this->getUser()->setFlash('notice', 'Has creado este concurso correctamente.<br/>
                        No lo podrás ver hasta que sea revisado por un moderador.<br/><br/>
                        <strong>Si quieres crear otro concurso para ' . ($concurso->getConcursoTipoId() == 1 ? 'esta empresa o entidad' : 'este producto') . '</strong>, <a href="' .
                                url_for("concurso/new?tipo=" . $tipo . $id) . '">haz clic aquí</a>.<br/><br/>
                        ¡Muchas gracias por crear un concurso!');
                }
                $this->redirect('concurso/show?id=' . $concurso->id);
            }
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("id")));
        $this->id = $request->getParameter('id', null);
        $this->from = $request->getParameter('from', null);
        if ($this->concurso->getConcursoTipoId() == 1)
            $this->tipo = 'empresa';
        elseif ($this->concurso->getConcursoTipoId() == 2)
            $this->tipo = 'producto';

        $this->form = new ConcursoFormFrontend($this->concurso, array('type' => $this->tipo));

        if ($request->isMethod('PUT')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $concurso = $this->form->save();
                $this->redirect('concurso/show?id=' . $concurso->id);
            }
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeFilterCompanyIncidencia(sfWebRequest $request) {
        //fetch company contest
        $contest = $this->fetchCompanyContest($request);
        //if contest record exist
        if ($contest) {
            $request->setParameter('id', $contest->getId());
            $this->forward('concurso', 'showIncidencia');
        }
        //if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeFilterProductIncidencia(sfWebRequest $request) {

        //fetch company contest
        $contest = $this->fetchProductContest($request);
        //if contest record exist
        if ($contest) {
            $request->setParameter('id', $contest->getId());
            $this->forward('concurso', 'showIncidencia');
        }
        //if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    public function executeShowIncidencia(sfWebRequest $request) {
        if ($request->getParameter('id')) {
            $this->concurso = Doctrine::getTable('Concurso')->findOneById($request->getParameter('id'));
            $this->forward404Unless($this->concurso);
            $this->contribucion = $this->concurso->getContribucionEnesima($request->getParameter('contribution', 1));
            $this->forward404Unless($this->contribucion);
        }//if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeFilterCompanyActionPlan(sfWebRequest $request) {
        //fetch company contest
        $contest = $this->fetchCompanyContest($request);
        //if contest record exist
        if ($contest) {
            $request->setParameter('id', $contest->getId());
            $this->forward('concurso', 'showPlanDeAccion');
        }
        //if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeFilterProductActionPlan(sfWebRequest $request) {

        //fetch company contest
        $contest = $this->fetchProductContest($request);
        //if contest record exist
        if ($contest) {
            $request->setParameter('id', $contest->getId());
            $this->forward('concurso', 'showPlanDeAccion');
        }
        //if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    public function executeShowPlanDeAccion(sfWebRequest $request) {
        //get request parameters
        if ($request->getParameter('id')) {
            $this->concurso = Doctrine::getTable('Concurso')->findOneById($request->getParameter('id'));
            $this->forward404Unless($this->concurso);
            $this->contribucion = $this->concurso->getContribucionEnesima($request->getParameter('contribution', 1));
            $this->forward404Unless($this->contribucion);
        } else {
            $this->forward404Unless(false);
        }
    }

    public function executeUrlaliasshow(sfWebRequest $request) {
        $this->forward404Unless($nombre = $request->getParameter('nombre'), 'Tienes que indicar el nombre de la empresa o producto');
        $this->forward404Unless($slug = $request->getParameter('slug'), 'Tienes que indicar el slug');
        $this->forward404Unless($date = $request->getParameter('date'), 'Tienes que indicar la fecha');
        $this->forward404Unless($time = $request->getParameter('time'));

        $concurso_id = Doctrine::getTable("Concurso")->createQuery('c')
                ->leftJoin('c.Producto p')
                ->where('e.slug like ?', $request->getParameter('nombre'))
                ->orWhere('p.slug like ?', $nombre)
                ->where('slug = ?', $slug)
                ->andWhere('created_at = ?', DateTime::createFromFormat('d-m-Y H-i-s', $date . ' ' . $time)->format('Y-m-d H:i:s'))
                ->execute(NULL, DOCTRINE::HYDRATE_SINGLE_SCALAR);

        if ($concurso_id) {
            $request->setParameter('id', $concurso_id);
            $this->forward('concurso', 'show');
        } else {
            $this->forward404('URL faked');
        }
    }

    /**
     * filter contest show action by given parameters
     * method identify the company contest by given parameters
     * and forward it to show method with company id
     * otherwise forward it to 404
     * @param sfWebRequest $request
     */
    public function executeFilterCompanyContest(sfWebRequest $request) {
        //fetch company contest
        $contest = $this->fetchCompanyContest($request);
        //if contest record exist
        if ($contest) {
            $request->setParameter('id', $contest->getId());
            $this->forward('concurso', 'show');
        }
        //if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    /**
     * filter contest show action by given parameters
     * method identify the product contest by given parameters
     * and forward it to show method with company id
     * otherwise forward it to 404
     * @param sfWebRequest $request
     */
    public function executeFilterProductContest(sfWebRequest $request) {
        //fetch product contest
        $contest = $this->fetchProductContest($request);
        //if contest record exist
        if ($contest) {
            $request->setParameter('id', $contest->getId());
            $this->forward('concurso', 'show');
        }
        //if contest record does not exist then forward it to 404 error
        else {
            $this->forward404('URL not found');
        }
    }

    /**
     * Fetch company contest by given request parameters
     * @param sfWebRequest $request
     * @return Doctrine Result
     */
    private function fetchCompanyContest(sfWebRequest $request) {
        //get request parameters
        $company_slug = $request->getParameter('company');
        $location = str_replace('-', ' ', $request->getParameter('location'));
        $title_slug = $request->getParameter('title');

        $date = $request->getParameter('date');

        //fetch contest record
        $contest = Doctrine::getTable('Concurso')->getCompanyContestByParameters($company_slug, $location, $title_slug, $date);
        return $contest;
    }

    /**
     * Fetch product contest by given request parameters
     * @param sfWebRequest $request
     * @return Doctrine Result
     */
    private function fetchProductContest(sfWebRequest $request) {
        //get request parameters
        $product_slug = $request->getParameter('product');
        $brand = str_replace('-', ' ', $request->getParameter('brand'));
        $title_slug = $request->getParameter('title');

        $date = $request->getParameter('date');
        //fetch contest record
        $contest = Doctrine::getTable('Concurso')->getProductContestByParameters($product_slug, $brand, $title_slug, $date);
        return $contest;
    }

    public function executeShow(sfWebRequest $request) {

        $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter('id'));
        $this->forward404Unless($this->concurso);
        $this->cnt_id = $request->getParameter('cnt', null);
        $this->contribution_id = $request->getParameter('contribucion_id', null);
        $this->from = $request->getParameter('from', null);
        // Los concursos en estado revista sólo son accesibles por sus propietarios
        if (1 == $this->concurso->getConcursoEstadoId()) {
            if (!$this->getUser()->isAuthenticated() or $this->concurso->getUserId() != $this->getUser()->getGuardUser()->getId()) {
                $this->forward404('No tienes permisos para ver este concurso');
            }
        }

        //si el concurso está en referendum hay que ver si el usuario ya a consumido sus votos
        if ($this->getUser()->isAuthenticated()) {
            if ($this->concurso->getConcursoEstadoId() == 3) {
                $n_votos = Doctrine::getTable('ConcursoReferendum')->createQuery()->where('concurso_id = ?', $this->concurso->getId())->andWhere('user_id=?', $this->getUser()->getGuardUser()->getId())->execute();
                if (count($n_votos) >= 5) {
                    $this->getUser()->setFlash('notice', 'Ya has usado tus 5 votos.<br/>Gracias por votar.');
                }
            }
        }

        if (($this->concurso->getConcursoEstadoId() == 6) || ($this->concurso->getConcursoEstadoId() == 7) || ($this->concurso->getConcursoEstadoId() == 8))
            $request->setParameter('estado', 6);
        else
            $request->setParameter('estado', $this->concurso->getConcursoEstadoId());

        if ($request->hasParameter('contribucion_id')) {
            // Sólo queremos ver una contribución
            $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter('id'));

            $query = Doctrine::getTable('Contribucion')
                    ->createQuery()
                    ->where('id=?', $this->contribution_id)
                    ->andwhere('concurso_id=?', $this->concurso->id)
                    ->andWhere('principal=0');
        } else {
            // Se desean ver todas las contribuciones
            $query = Doctrine::getTable('Contribucion')
                    ->createQuery()
                    ->where('concurso_id=?', $this->concurso->id)
                    ->andWhere('contribucion_estado_id=2')
                    ->andWhere('principal=0')
                    ->orderBy('created_at desc');

            if ($this->concurso->getConcursoEstadoId() == 3) {
                $query->andWhere('destacado=0');
            }
        }

        $this->pager = new sfDoctrinePager('Contribucion', sfConfig::get('app_contribuciones_in_list'));
        $this->pager->setQuery($query);
        // Si nos viene el parametro contribucion, necesitamos hacer un scroll para visualizar directamente
        // esa contribución.  Como esto está paginado, hay que hacer un bucle guarro para determinar en qué
        // está la contribución que buscamos...
        $this->contribucion_to_scroll = null;
        if ($request->hasParameter('contribucion')) {
            $query_numeros = clone $query;
            $query_numeros->select('numero');
            $numeros = $query_numeros->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
            $position = 1;
            $found = false;
            $target = $request->getParameter('contribucion');
            foreach ($numeros as $numero) {
                if ($numero == $target) {
                    $found = true;
                    break;
                }
                $position = $position + 1;
            }
            if ($found) {
                $page = ceil($position / sfConfig::get('app_contribuciones_in_list'));
                $this->contribucion_to_scroll = $target;
            }
        }
        $this->pager->setPage(isset($page) ? $page : $request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeShowincidenciadescripcion(sfWebRequest $request) {
        $this->numero = intval($request->getParameter('number'));
        $this->concurso = Doctrine_Query::create()->from('Concurso c')->where('c.Slug=?', $request->getParameter('slug'))->fetchOne();

        $this->forward404Unless($this->concurso);
        if (1 != $request->getParameter('number')) {
            $this->contribucion = $this->concurso->getContribucionEnesima($this->numero);
            $this->forward404Unless($this->contribucion);
        } else {
            $this->contribucion = NULL;
        }

        $this->setLayout(false);
    }

    public function executeShowIncidenciaBocadillo(sfWebRequest $request) {
        $this->concurso = Doctrine_Query::create()->from('Concurso c')->where('c.Slug=?', $request->getParameter('slug'))->fetchOne();
        $this->numero = intval($request->getParameter('number'));

        $this->forward404Unless($this->concurso);
        if (1 != $request->getParameter('number')) {
            $this->contribucion = $this->concurso->getContribucionEnesima($this->numero);
            $this->forward404Unless($this->contribucion);
        } else {
            $this->contribucion = NULL;
        }

        $this->setLayout(false);
    }

    /**
     * add comapny to user's favourit records
     * @param sfWebRequest $request
     */
    public function executeAddToFavorite(sfWebRequest $request) {
        //fetch request parameters
        $contest_id = $request->getParameter('id');
        $type = $request->getParameter('type');
        //get user
        $user = $this->getUser()->getGuardUser();
        //fetch company favourit record
        if ($type == 'product') {
            $contest_favourite_record = Doctrine::getTable('ProductContestFavouriteList')->getRecordByUserAndId($user->getId(), $contest_id);
        } else {
            $contest_favourite_record = Doctrine::getTable('ComapnyContestFavouriteList')->getRecordByUserAndId($user->getId(), $contest_id);
        }


        //if exist then send exist message
        if ($contest_favourite_record) {
            return $this->renderText('Este concurso <strong>ya está</strong> en Tus favoritos.');
        }
        //if not then create new one
        else {
            if ($type == 'product') {
                $contest_favourite_record = new ProductContestFavouriteList();
            } else {
                $contest_favourite_record = new ComapnyContestFavouriteList();
            }

            $contest_favourite_record->create($user->getId(), $contest_id);
            return $this->renderText('Has añadido este <strong>concurso a Tus favoritos</strong>.');
        }

        $this->setLayout(false);
    }

    public function executeShowCaseStudySummery(sfWebRequest $request) {
        //get request parameters
        $this->request_category = $request->getParameter('category_type');
        $this->request_type = $request->getParameter('type');

        $request_id = $request->getParameter('id');

        //fetch download record
        $this->forward404Unless($this->case_study_record = Doctrine::getTable($this->request_category)->find($request_id));
    }

}
