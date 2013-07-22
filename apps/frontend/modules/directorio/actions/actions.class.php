<?php

/**
 * directorio actions.
 *
 * @package    auditoscopia
 * @subpackage directorio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class directorioActions extends sfActions {

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {
        // Page Title
        $profesional_order = array();
        $this->getResponse()->setTitle('Directorio de buenos profesionales recomendados');
        $this->getResponse()->addMeta('keywords', 'recomienda profesional, desaprueba profesional, recomendar profesional, desaprobar profesional, recomendar servicio profesional, desaprobar servicio profesional');
        $this->getResponse()->addMeta('description', 'Directorio de buenos profesionales recomendados por los consumidores');

        $maxPerPage = sfConfig::get('app_directorio_numero_profesional_listado', 10);
        $page = $this->getRequest()->getParameter('page', 0);

        $from = $this->getRequest()->getParameter('from', false);
        $filtrosDefault = array_merge(array(
            'states_id' => '',
            'localidad' => '',
            'city_id' => '',
            'categoria_excelencia' => '',
            'order' => '',
            'name' => '',
            'last_name_one' => '',
            'last_name_two' => '',
                ), $request->getParameterHolder()->get('orderForm', array()));

        switch ($from) {
            case 'buscador':
                $filtrosActivos = array_merge($filtrosDefault, $this->ms_values = $request->getParameterHolder()->get('profesional_filters'));
                break;

            case 'orden':
                $filtrosActivos = array_merge($filtrosDefault, $this->ms_values = $request->getParameterHolder()->get('profesional_filters'));
                $orderForm = $request->getParameterHolder()->get('orderForm', array());
                if (!empty($orderForm)) {
                    if (isset($orderForm['city_id'])) {
                        unset($filtrosActivos['city_id']);
                        $filtrosActivos['city_id'] = $orderForm['city_id'];
                    }
                }
                break;

            default:
                $filtrosActivos = $this->ms_values = $filtrosDefault;
                break;
        }

        $profesional_filters = $filtrosActivos;

        if (null != $request->getParameterHolder()->get('orderForm')) {
            $profesional_order = $request->getParameterHolder()->get('orderForm');
            $profesional_order['city_id'] = isset($profesional_order['city_id']) ? $profesional_order['city_id'] : '';
            $profesional_order['city_id'] = (isset($profesional_order['city_id']) && $profesional_order['city_id'] == '' && isset($profesional_filters['city_id']) && $profesional_filters['city_id'] != '') ? $profesional_filters['city_id'] : $profesional_order['city_id'];
        } elseif ($this->getUser()->hasToRemember()) {
            $profesional_order = $profesional_filters = $this->getUser()->getLastState('lb_profesional', 'order');

            unset($profesional_filters['order']);
            $page = $this->getUser()->getLastState('lb_profesional', 'page');
            $this->getUser()->setRemember(false);
        } else {
            $profesional_order = array();
            if ($this->getUser()->hasAttribute('first_enter_lb_profesional', myUser::ORDER_NS)) {
                $profesional_order = $profesional_filters = $this->getUser()->getOrderPreferences('lb_profesional');
                $this->getUser()->getAttributeHolder()->remove('first_enter_lb_profesional', null, myUser::ORDER_NS);
            } elseif ($this->getUser()->hasLastState('lb_profesional') && false == $from) {
                $lastState = $this->getUser()->getLastState('lb_profesional');
                $profesional_order = $profesional_filters = $lastState['order'];
                $page = $lastState['page'];
            } else {
                $profesional_order = array();
            }
            unset($profesional_filters['order']);
        }

        //unset($filtrosActivos['name'], $filtrosActivos['last_name_one'], $filtrosActivos['last_name_two']);
        $options = array_merge(
                array(
            'sector1' => $request->getParameter('sector1', null),
            'sector2' => $request->getParameter('sector2', null),
            'sector3' => $request->getParameter('sector3', null)
                ), $filtrosActivos);
        if (isset($profesional_order['city_id']) && $profesional_order['city_id'] != '') {
            $options['localidad'] = $profesional_order['city_id'];
        } elseif (isset($profesional_order['states_id']) && $profesional_order['states_id'] != '') {
            $options['provincia'] = $profesional_order['states_id'];
        }

        $options['name'] = (isset($profesional_filters['name']) && !empty($profesional_filters['name'])) ? $profesional_filters['name'] : "";
        $options['last_name_one'] = (isset($profesional_filters['last_name_one']) && !empty($profesional_filters['last_name_one'])) ? $profesional_filters['last_name_one'] : "";
        $options['last_name_two'] = (isset($profesional_filters['last_name_two']) && !empty($profesional_filters['last_name_two'])) ? $profesional_filters['last_name_two'] : "";

        $profesional_order = array_merge($profesional_order, $profesional_filters);
        $this->getUser()->setLastState('lb_profesional', $profesional_order, $page);
        $this->ms_values = array_merge($this->ms_values, $profesional_order);
        $this->profesionalDestacadas = ProfesionalTable::getInstance()->getListaDestacados($options);

        /** @var $this->empresasQuery Doctrine_Query */
        $this->profesionalQuery = ProfesionalTable::getInstance()->getListaProfesionalQuery(
                $request->getParameter('sector1'), $request->getParameter('sector2'), $request->getParameter('sector3'), $this->profesionalDestacadas
        );

        if ($request->getParameter('sector1') && false == $from) {
            $this->buscandoPorSector = true;
        } else {
            $this->buscandoPorSector = false;
        }

        $this->form = new ListaProfesionalFormFilter();
        unset($profesional_filters['order']);
        if (empty($profesional_filters) && count($profesional_filters) <= 0) {
            $profesional_filters['states_id'] = '';
            $profesional_filters['localidad_id'] = '';
            $profesional_filters['name'] = '';
            $profesional_filters['last_name_one'] = '';
            $profesional_filters['last_name_two'] = '';
            $profesional_filters['city_id'] = '';
        }

        //unset($profesional_filters['states_id']);
        if ($profesional_filters) {
            $this->form->bind($profesional_filters);
            if ($this->form->isValid()) {
                $this->form->setOption('query', $this->profesionalQuery);
                $this->profesionalQuery = $this->form->buildQuery($profesional_filters);
            }
        }


        //carga los filtros si hay...
        //unset($profesional_order['states_id']);
        $this->sort = array('orden' => $request->getParameter('orden', 'profesional'));
        $this->sortForm = new ProfesionalOrderForm();
        $this->sortForm->bind($profesional_order);
        $this->processSort();

        $this->order_type = "";
        if(isset($profesional_order['order']) && !empty($profesional_order['order'])){
            $this->order_type = $profesional_order['order'];
        }
        // cargar los datos para la home de listado.
        $this->pager = new sfDoctrinePager('Profesional', $maxPerPage);
        $this->pager->setQuery($this->profesionalQuery);
        $this->pager->setPage($page);
        $this->pager->init();
        $this->sectoresActivos = $this->crearSectoresActivos($request);

        //si se envia por ajax, devuelve solo los datos...
        if ($this->getRequest()->isXmlHttpRequest()) {
            if (!$request->getParameter('static')) {
                return $this->renderPartial('resultadosProfesional');
            }
        }
    }

    public function processSort() {

        $alias = $this->profesionalQuery->getRootAlias();
        switch ($this->sortForm['order']->getValue()) {
            case 'profesional':
                $this->profesionalQuery->leftJoin($alias . '.ProfesionalTipoTres pt');
                $this->profesionalQuery->leftJoin($alias . '.States s');
                $this->profesionalQuery->leftJoin($alias . '.City l');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_one ASC');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_two ASC');
                $this->profesionalQuery->addOrderBy($alias . '.first_name ASC');
                $this->profesionalQuery->addOrderBy('s.name ASC');
                $this->profesionalQuery->addOrderBy('l.name ASC');
                $this->profesionalQuery->addOrderBy('pt.name asc');
                break;

            case 'provincia':
                $this->profesionalQuery->leftJoin($alias . '.States s');
                $this->profesionalQuery->leftJoin($alias . '.City l');
                $this->profesionalQuery->leftJoin($alias . '.ProfesionalTipoTres pt');
                $this->profesionalQuery->orderBy('s.name asc');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_one ASC');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_two ASC');
                $this->profesionalQuery->addOrderBy($alias . '.first_name asc');
                $this->profesionalQuery->addOrderBy('l.name asc');
                $this->profesionalQuery->addOrderBy('pt.name asc');
                break;

            case 'localidad':
                $this->profesionalQuery->leftJoin($alias . '.City l');
                $this->profesionalQuery->leftJoin($alias . '.ProfesionalTipoTres pt');
                $this->profesionalQuery->orderBy('l.name asc');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_one ASC');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_two ASC');
                $this->profesionalQuery->addOrderBy($alias . '.first_name ASC');
                $this->profesionalQuery->addOrderBy('l.name asc');
                $this->profesionalQuery->addOrderBy('pt.name asc');
                break;

            default:
                $this->profesionalQuery->addOrderBy($alias . '.last_name_one ASC');
                $this->profesionalQuery->addOrderBy($alias . '.last_name_two ASC');
                $this->profesionalQuery->addOrderBy($alias . '.first_name ASC');
                $this->profesionalQuery->leftJoin($alias . '.States s');
                $this->profesionalQuery->leftJoin($alias . '.City l');
                $this->profesionalQuery->leftJoin($alias . '.ProfesionalTipoTres pt');
                $this->profesionalQuery->addOrderBy('s.name asc');
                $this->profesionalQuery->addOrderBy('l.name asc');
                break;
        }

        if ($this->sortForm['states_id']->getValue() && 1 != $this->sortForm['states_id']->getValue()) {
            $this->profesionalQuery->addWhere($alias . '.states_id = ?', $this->sortForm['states_id']->getValue());
        }

        if ($this->sortForm['city_id']->getValue() && 1 != $this->sortForm['city_id']->getValue()) {
            $this->profesionalQuery->addWhere($alias . '.city_id = ?', $this->sortForm['city_id']->getValue());
        }
//echo "<pre>";print_r($this->profesionalQuery->fetchArray());exit;
        return null;
    }

    public function executeRecordarOrden(sfWebRequest $request) {
        $orderForm = $request->getParameterHolder()->get('orderForm');
        $this->getUser()->setOrderPreferences('lb_profesional', $orderForm);
        return $this->renderText('');
    }

    public function executeVolverOrder(sfWebRequest $request) {
        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($this->getUser()->getOrderPreferences('lb_profesional')));
    }

    /**
     * Muestra el detalla de una profesional.
     */
    public function executeDetalle(sfWebRequest $request) {
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->getUser()->setRemember(true);
        $this->forward404Unless($this->profesional = Doctrine::getTable('Profesional')->findOneBySlug($request->getParameter('slug')), 'Esta profesional no existe.');
        $this->isRecomendation = Doctrine::getTable('Profesional')->getLetters($this->profesional->getId(), 1);
        $this->isDescription = Doctrine::getTable('Profesional')->getLetters($this->profesional->getId(), 2);
        $this->chartData = Doctrine::getTable('ProfesionalLetter')->getProfesionalChartData($this->profesional->getId());
        //$this->form = new ProfesionalSearchForm();

        $from = $this->getRequest()->getParameter('from', false);
        $filtrosDefault = array_merge(array(
            'states_id' => '',
            'localidad' => '',
            'city_id' => '',
            'categoria_excelencia' => '',
            'order' => '',
            'name' => '',
            'last_name_one' => '',
            'last_name_two' => '',
                ), $request->getParameterHolder()->get('orderForm', array()));

        $filtrosActivos = $this->ms_values = $request->getParameterHolder()->get('profesional_filters');
        switch ($from) {
            case 'buscador':
                $filtrosActivos = array_merge($filtrosDefault, $this->ms_values = $request->getParameterHolder()->get('profesional_filters'));
                break;

            case 'orden':
                $filtrosActivos = array_merge($filtrosDefault, $this->ms_values = $request->getParameterHolder()->get('profesional_filters'));
                $orderForm = $request->getParameterHolder()->get('orderForm', array());
                if (!empty($orderForm)) {
                    if (isset($orderForm['city_id'])) {
                        unset($filtrosActivos['city_id']);
                        $filtrosActivos['city_id'] = $orderForm['city_id'];
                    }
                }
                break;

            default:
                $filtrosActivos = $this->ms_values = $filtrosDefault;
                break;
        }

        $profesional_filters = $filtrosActivos;
        if (null != $request->getParameterHolder()->get('orderForm')) {
            $profesional_order = $request->getParameterHolder()->get('orderForm');
            $profesional_order['city_id'] = isset($profesional_order['city_id']) ? $profesional_order['city_id'] : '';
            $profesional_order['city_id'] = (isset($profesional_order['city_id']) && $profesional_order['city_id'] == '' && isset($profesional_filters['city_id']) && $profesional_filters['city_id'] != '') ? $profesional_filters['city_id'] : $profesional_order['city_id'];
        } elseif ($this->getUser()->hasToRemember()) {
            $profesional_order = $profesional_filters = $this->getUser()->getLastState('lb_profesional', 'order');
            unset($profesional_filters['order']);
            $page = $this->getUser()->getLastState('lb_profesional', 'page');
            $this->getUser()->setRemember(false);
        } else {
            $profesional_order = array();
            if ($this->getUser()->hasAttribute('first_enter_lb_profesional', myUser::ORDER_NS)) {
                $profesional_order = $profesional_filters = $this->getUser()->getOrderPreferences('lb_profesional');
                $this->getUser()->getAttributeHolder()->remove('first_enter_lb_profesional', null, myUser::ORDER_NS);
            } elseif ($this->getUser()->hasLastState('lb_profesional') && false == $from) {
                $lastState = $this->getUser()->getLastState('lb_profesional');
                $profesional_order = $profesional_filters = $lastState['order'];
                $page = $lastState['page'];
            } else {
                $profesional_order = array();
            }
            unset($profesional_filters['order']);
        }

        //unset($filtrosActivos['name'], $filtrosActivos['last_name_one'], $filtrosActivos['last_name_two']);
        $options = array_merge(
                array(
            'sector1' => $request->getParameter('sector1', null),
            'sector2' => $request->getParameter('sector2', null),
            'sector3' => $request->getParameter('sector3', null)
                ), $filtrosActivos);
        if (isset($profesional_order['city_id']) && $profesional_order['city_id'] != '') {
            $options['localidad'] = $profesional_order['city_id'];
        } elseif (isset($profesional_order['states_id']) && $profesional_order['states_id'] != '') {
            $options['provincia'] = $profesional_order['states_id'];
        }

        //print_r($profesional_order);exit;
        $profesional_order = array_merge($profesional_order, $profesional_filters);
        $this->getUser()->setLastState('lb_profesional', $profesional_order, $page);
        $this->ms_values = array_merge($this->ms_values, $profesional_order);
        //$this->profesionalDestacadas = ProfesionalTable::getInstance()->getListaDestacados($options);

        /** @var $this->empresasQuery Doctrine_Query */
        $this->profesionalQuery = ProfesionalTable::getInstance()->getListaProfesionalQuery(
                $request->getParameter('sector1'), $request->getParameter('sector2'), $request->getParameter('sector3'), $this->profesionalDestacadas
        );

        if ($request->getParameter('sector1') && false == $from) {
            $this->buscandoPorSector = true;
        } else {
            $this->buscandoPorSector = false;
        }

        $this->form = new ListaProfesionalFormFilter();
        unset($profesional_filters['order']);
        if (empty($profesional_filters) && count($profesional_filters) <= 0) {
            $profesional_filters['states_id'] = '';
            $profesional_filters['localidad_id'] = '';
            $profesional_filters['name'] = '';
            $profesional_filters['last_name_one'] = '';
            $profesional_filters['last_name_two'] = '';
            $profesional_filters['city_id'] = '';
        }

        if ($profesional_filters) {
            $this->form->bind($profesional_filters);
            if ($this->form->isValid()) {
                $this->form->setOption('query', $this->profesionalQuery);
                $this->profesionalQuery = $this->form->buildQuery($profesional_filters);
            }
        }

        //carga los filtros si hay...
        $this->sort = array('orden' => $request->getParameter('orden', 'profesional'));
        $this->sortForm = new ProfesionalOrderForm();
        $this->sortForm->bind($profesional_order);
        $this->processSort();


        $this->sectoresActivos = $this->crearSectoresActivos($request);

        // cargar los datos para la home de listado.
        $this->getUser()->setAttribute("page", 0, "detalle");
        $maxPerPage = sfConfig::get('app_directorio_numero_profesional_listado', 25);
        $page = $this->getRequest()->getParameter('page', 0);
        if (!$this->getRequest()->hasParameter('page')) {
            if ($this->getUser()->hasAttribute("page", "detalle")) {
                $page = $this->getUser()->getAttribute("page", "0", "detalle");
                $this->getUser()->setAttribute("page", $page, "detalle");
            }
        }

        $letter_type_id = ($request->hasParameter("desaprobaciones")) ? 2 : 1;
        $this->letter_type_url = ($request->hasParameter("desaprobaciones")) ? "lista_profesional_detalle_des" : "lista_profesional_detalle";

        $this->pager = new sfDoctrinePager('Profesional', $maxPerPage);
        $this->pager->setQuery($this->profesional->getProfesionalRecommandLetterQuery($this->profesional->getId(), $letter_type_id, 25));
        $this->pager->setPage($page);
        $this->pager->init();

        if ($this->getRequest()->isXmlHttpRequest()) {
            return $this->renderPartial('profesionalcomment');
        }
    }

    /**
     * Método que devuelve un array con los sectores activos para rellenar el breadcrumb.
     *
     * @param sfWebRequest $request
     * @return array
     */
    protected function crearSectoresActivos(sfWebRequest $request) {
        $sectoresActivos = array();
        if ($request->getParameter('sector1')) {

            $sectoresActivos['sector1'] = array(
                'slug' => $request->getParameter('sector1'),
                'texto' => ProfesionalTipoUnoTable::getName($request->getParameter('sector1')));
        }
        if ($this->request->getParameter('sector2')) {
            $sectoresActivos['sector2'] = array(
                'slug' => $request->getParameter('sector2'),
                'texto' => ProfesionalTipoDosTable::getName($request->getParameter('sector2')));
        }
        if ($this->request->getParameter('sector3')) {
            $sectoresActivos['sector3'] = array(
                'slug' => $request->getParameter('sector3'),
                'texto' => ProfesionalTipoTresTable::getName($request->getParameter('sector3')));
        }

        return $sectoresActivos;
    }

    public function executeFilter(sfWebRequest $request) {
        //recogemos los datos del form...
        $this->form = new ListaProfesionalFormFilter();
        $this->form->bind($this->getRequest()->getParameter($this->form->getName()));

        if ($this->form->isValid()) {
            //se guardan en sesión...
            $this->getUser()->setAttribute('filters', $this->getRequest()->getParameter($this->form->getName()));
        }
    }

    public function __executeFilter(sfWebRequest $request) {
        $listado = $this->instanciaListado();
        $listado->setPage(1);

        if ($request->hasParameter('reset')) {
            $listado->setFilters(array());

            $this->redirect('@lista_profesional');
        }

        $this->form = new ListaProfesionalFormFilter($listado->getFilters());
        $this->form->bind($request->getParameter($this->form->getName()));
        if ($this->form->isValid()) {
            $listado->setFilters($this->form->getValues());
            $this->redirect('@lista_profesional');
        }

        $this->listado($request);

        $this->setTemplate('index');
    }

    protected function listado(sfWebRequest $request) {
        $listado = $this->instanciaListado();

        // guardamos el orden
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $listado->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // guardamos la página
        if ($request->getParameter('page')) {
            $listado->setPage($request->getParameter('page'));
        }

        if (null === $this->form) {
            $this->form = new ListaProfesionalFormFilter($listado->getFilters());
        }

        $query = $this->form->buildQuery($listado->getFilters());
        $this->pager = $listado->getPager($query);
        $this->sort = $listado->getSort();
    }

    protected function instanciaListado() {
        return $listado = new slxGestionListado(array(
                    'module' => 'directorio',
                    'model' => 'ListaProfesional',
                    'campo_orden_x_defecto' => 'l.id',
                    'sentido_orden_x_defecto' => 'asc',
                    'elem_x_pagina' => 1,
                ));
    }

    protected function isValidSortColumn($column) {
        return in_array($column, array('l.name', 'ca.name', 'last_name_one', 'last_name_two'));
    }

    /**
     * Audita una empresa dentro de fancybox
     *
     * @param sfWebRequest $request
     */
    public function executeAudita(sfWebRequest $request) {
        $this->getUser()->setRemember(true);
        $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');

        // TODO si empresa no tiene cuestionario no puede salir en la lista blanca... esto no tiene sentido pero está aquí para evitar error
        // en fixtures que no tienen cuestionario.
        //Si no tiene cuestionario asociado no se permite realizar la acción
        $this->forward404if($empresa->getCuestionario()->getId() == null, sprintf('La empresa no tiene asociado ningún cuestionario'));

        $this->sectoresActivos = $this->crearSectoresActivos($request);
        $this->empresa = $empresa;


        $puedeAuditarHoy = UserAuditoriaTable::puedeAuditarHoy($this->getUser()->getGuardUser());
        if (!$puedeAuditarHoy) {
            $this->getUser()->setFlash('notice', $this->getPartial('msg_auditoria_mismo_dia', array('empresa' => $empresa)));
            return $this->redirect('lista_blanca_empresa');
        }

        $puedeAuditar = Doctrine::getTable('ListaCuestionarioUser')->puedeAuditarEmpresa($empresa, $this->getUser()->getGuardUser());
        if (!$puedeAuditar) {
            $this->getUser()->setFlash('notice', $this->getPartial('msg_auditoria_incorrecta', array('empresa' => $empresa)));
            return $this->redirect('lista_blanca_empresa');
        }

        //mira si además ya ha hecho una auditoría...
        $cuestionarioRespuesta = new ListaCuestionarioUser();
        $cuestionarioRespuesta->setUserId($this->getUser()->getGuardUser());
        $cuestionarioRespuesta->setListaCuestionarioId($empresa->getCuestionario());
        $cuestionarioRespuesta->setEmpresa($empresa);

        $this->form = new ListaCuestionarioUserForm($cuestionarioRespuesta);
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {

                //recoge la auditoría si existe...
                $oldAuditoria = ListaCuestionarioUserTable::getInstance()->findByUserAndEmpresa($this->getUser()->getGuardUser()->getId(), $empresa->getId());
                if ($oldAuditoria) {
                    $empresa->removeAuditoria($oldAuditoria);
                    $oldAuditoria->markAsDisabled();
                }

                $this->form->save();
                $respuestas = $this->form->getObject();

                //mira si hay comentario...
                if ($respuestas->hasComentario()) {
                    $respuestas->setAprobado(FALSE);
                } else {
                    $respuestas->setAprobado(TRUE);
                    //sumar valores en empresa
                    $empresa->addAuditoria($respuestas);
                }
                $respuestas->save();
                UserAuditoriaTable::addAuditoria($this->getUser()->getGuarduser(), 'auditoria');
                $this->getUser()->setFlash('notice', $this->getPartial('msg_auditoria_correcta'));

                //crea la alerta...
                AlertasTable::nueva($respuestas, 'auditoria', sprintf('Nueva <a href="empresa/%s">auditoría</a> de %s en la lista blanca de empresas/entidades', $empresa->getId(), $this->getUser()->getGuardUser()));

                return $this->redirect('lista_blanca_empresa');
            }
        }

        $this->empresas_sector_uno = Doctrine::getTable('EmpresaSectorUno')->getEmpresasSectorUno();
        $listado = $this->instanciaListado();

        $this->filter = new ListaBlancaEmpresaFormFilter($listado->getFilters());
        $this->sortForm = new EmpresaOrderForm();
    }

    /**
     * Devuelve los 10 (o lo marcado en el app.yml)  últimos comentarios asociados a una empresa.
     *
     */
    public function executeComentarios(sfWebRequest $request) {
        if ($request->getParameter('tipo', 'empresa') == 'empresa') {

            $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
            $this->comentarios = $empresa->getLastComentarios(sfConfig::get('app_listaBlanca_ultimosComentarios', 25), 'DESC');

            if (count($this->comentarios) < 10) {
                $this->comentarios[] = array(
                    'username' => 'auditoscopia',
                    'updated_at' => $empresa->getCreatedAt(),
                    'respuesta' => $empresa->getComentarioInicial());

                $this->obj = $empresa;
                $this->url = 'lista_blanca_empresa_detalle';
            }
            $this->obj = $empresa;
            $this->url = 'lista_blanca_empresa_detalle';
        } elseif ($request->getParameter('tipo') == 'producto') {
            $this->forward404Unless($producto = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Esta producto no existe.');
            $this->comentarios = $producto->getLastComentarios(sfConfig::get('app_listaBlanca_ultimosComentarios', 25), 'DESC');

            if (count($this->comentarios) < 10) {
                $this->comentarios[] = array(
                    'username' => 'auditoscopia',
                    'updated_at' => $producto->getCreatedAt(),
                    'respuesta' => $producto->getComentarioInicial());
            }
            $this->obj = $producto;
            $this->url = 'lista_blanca_producto_detalle';
        }
    }

    /**
     * Devuelve el listado de Kpi con los valores medios.
     *
     *
     * @param sfWebRequest $request
     */
    public function executeCategoriaExcelencia(sfWebRequest $request) {
        $this->forward404Unless($profesionales = Doctrine::getTable('Profesional')->findOneBySlug($request->getParameter('slug')));
        $this->kpis = ($profesionales && $profesionales->getActiveReason() != '') ? $profesionales->getActiveReason() : '';

        return $this->renderPartial('directorio/categoriaExcelencia');
    }

    public function executeGenerateMap() {
        $profesional = Doctrine_Core::getTable('Profesional')->findOneBySlug($this->getRequest()->getParameter('slug'));
        $this->gmap = $profesional->getProfesionalGoogleMap();
        $this->setLayout(false);
    }

    public function executeShowChart(sfWebRequest $request) {
        $chartData = Doctrine::getTable('ProfesionalLetter')->getProfesionalChartData($request->getParameter('id'));

        $this->setLayout(false);
        $this->rows = array();
        $this->rows[] = array('Recomendaciones', ceil($chartData[0]['reco']), 'Recomendaciones', 0, '');
        $this->rows[] = array('Desaprobaciones', 0, '', ceil($chartData[0]['disp']), 'Desaprobaciones');
        $this->setTemplate('showChart');
    }

    public function executeLetters(sfWebRequest $request) {
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->profesional = Doctrine::getTable('Profesional')->findOneBySlug($request->getParameter('slug'));
        // echo $this->profesional->user_id; exit;
        // $this->profesionalLetters = Doctrine::getTable('ProfesionalLetter')->findByProfesionalIdAndProfesionalLetterTypeIdAndProfesionalLetterEstadoId($this->profesional->getId(), $request->getParameter('tipo'), 2);
        $this->profesionalLetters = $this->profesional->getLastLetters(sfConfig::get('app_listaBlanca_ultimosComentarios', 25), 'DESC');
    }

    public function executeShowPlanAccion(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id'));
        $this->professional_des = Doctrine::getTable('Profesional')->findOneBy('id', $this->cartas->getProfesionalId());
    }

    public function calculateRow($values) {
        $tooltipOro = 'Oro';
        $tooltipPlata = 'Plata';
        $tooltipBronze = 'Bronce';
        $tooltipSin = 'Sin medalla';
        switch ($values['q_puntuacion']) {
            case 1:
                $row = array($values['q_puntuacion'], "$tooltipSin", 0, '', 0, '', 0, '');
                break;
            case 2:
                $row = array(0, '', $values['q_puntuacion'], "$tooltipBronze", 0, '', 0, '');
                break;
            case 3:
                $row = array(0, '', 0, '', $values['q_puntuacion'], "$tooltipPlata", 0, '');
                break;
            case 4:
                $row = array(0, '', 0, '', 0, '', $values['q_puntuacion'], "$tooltipOro");
                break;
        }
        return $row;
    }

    public function executeResetFilter($request) {
        if ($request->hasParameter('reset')) {
            if ($request->getParameter('reset') == "Reset") {
                $this->getUser()->getAttributeHolder()->remove('first_enter_lb_profesional', null, myUser::ORDER_NS);
                $this->getUser()->setLastState('lb_profesional', "", "");
            }
        }
        return $this->renderText('');
    }

}
