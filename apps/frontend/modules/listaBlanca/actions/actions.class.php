<?php

/**
 * listaBlanca actions.
 *
 * @package    auditoscopia
 * @subpackage lista_blanca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaBlancaActions extends sfActions {

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {
        $maxPerPage = sfConfig::get('app_listaBlanca_numero_empresas_listado', 10);
        $page = $this->getRequest()->getParameter('page', 0);

        /*if ($request->hasParameter('reset')) {
            if ($request->getParameter('reset') == "Reset") {
                $listado = $this->instanciaListado();
                $listado->setFilters(array());
                $this->redirect('lista_blanca_empresa');
            }
        }*/

        //Primero hemos de saber que boton ha pulsado el usuario...
        $from = $this->getRequest()->getParameter('from', false);
        $filtrosDefault = array_merge(
                array(
            'states_id' => '',
            'localidad_id' => '',
            'categoria_excelencia' => '',
            'order' => '',
            'name' => ''), $request->getParameterHolder()->get('orderForm', array()));

        switch ($from) {
            case 'buscador':
                $filtrosActivos = array_merge($filtrosDefault, $this->ms_values = $request->getParameterHolder()->get('empresa_filters'));
                break;

            case 'orden':
                $filtrosActivos = array_merge($filtrosDefault, $this->ms_values = $request->getParameterHolder()->get('empresa_filters'));
                $orderForm = $request->getParameterHolder()->get('orderForm', array());
                if (!empty($orderForm)) {
                    if (isset($orderForm['localidad_id'])) {
                        unset($filtrosActivos['localidad_id']);
                        $filtrosActivos['localidad_id'] = $orderForm['localidad_id'];
                    }
                }
                break;

            default:
                $filtrosActivos = $this->ms_values = $filtrosDefault;
                break;
        }

        //casos...
        // es la primera vez que se entra como usuario logueado. Se recupera la búsqueda guardada...
        if ($this->getUser()->hasAttribute('first_enter_lb_empresa', myUser::ORDER_NS)) {
            $filtrosActivos = array_merge($filtrosActivos, $this->getUser()->getOrderPreferences('lb_empresas'));
            $this->getUser()->getAttributeHolder()->remove('first_enter_lb_empresa', null, myUser::ORDER_NS);
        }

        // si hay guardado un estado anterior de la lista y no hay filtrosActivos
        if ($this->getUser()->hasLastState('lb_empresas') && false == $from) {
            $lastState = $this->getUser()->getLastState('lb_empresas');
            $filtrosActivos = array_merge($filtrosActivos, $lastState['order']);
            $page = $lastState['page'];
        }

        $options = array_merge(
                array(
            'sector1' => $request->getParameter('sector1', null),
            'sector2' => $request->getParameter('sector2', null),
            'sector3' => $request->getParameter('sector3', null)
                ), $filtrosActivos);
        // guarda el estado de la página vista
        
        $this->getUser()->setLastState('lb_empresas', $filtrosActivos, $page);
        $this->ms_values = $filtrosActivos;
        $this->empresasDestacadas = EmpresaTable::getInstance()->getListaBlancaDestacados($options);
        /** @var $this->empresasQuery Doctrine_Query */
        $this->empresasQuery = EmpresaTable::getInstance()->getListaBlancaQuery(
                $request->getParameter('sector1'), $request->getParameter('sector2'), $request->getParameter('sector3'), $this->empresasDestacadas
        );

        //ni idea de porqué esto...
        if ($request->getParameter('sector1') && false == $from) {
            $this->buscandoPorSector = true;
        } else {
            $this->buscandoPorSector = false;
        }

        // filtros...

        $this->form = new ListaBlancaEmpresaFormFilter();
        $empresa_filters = $filtrosActivos;
        unset($empresa_filters['order']);
        $this->form->bind($empresa_filters);
        if ($this->form->isValid()) {
            $this->form->setOption('query', $this->empresasQuery);
            $this->empresasQuery = $this->form->buildQuery($empresa_filters);
        }

        // orden ...
        $empresa_order = $filtrosActivos;
        unset($empresa_order['categoria_excelencia']);
        $this->sortForm = new EmpresaOrderForm();
        $this->sortForm->bind($empresa_order);
        $this->processSort();

        // cargar los datos para la home de listado.
        //echo $this->empresasQuery;exit;
        $this->pager = new sfDoctrinePager('Empresa', $maxPerPage);
        $this->pager->setQuery($this->empresasQuery);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->sectoresActivos = $this->crearSectoresActivos($request);

        //si se envia por ajax, devuelve solo los datos...
        if ($this->getRequest()->isXmlHttpRequest()) {
            if (!$request->getParameter('static')) {
                return $this->renderPartial('resultadosEmpresa');
            }
        }
        $this->getResponse()->setTitle('Lista blanca de empresas y entidades recomendadas');
        $this->getResponse()->addMeta('description', 'Lista blanca de empresas y entidades recomendadas por los consumidores');
        $this->getResponse()->addMeta('keywords', 'audita, auditar, auditoría, indicadores excelencia, medalla oro, medalla plata, medalla bronce, evolución excelencia');
    }

    public function processSort() {

        $alias = $this->empresasQuery->getRootAlias();

        switch ($this->sortForm['order']->getValue()) {
            case 'empresa':
                $this->empresasQuery->addOrderBy($alias . '.name ASC');
                $this->empresasQuery->leftJoin($alias . '.States s');
                $this->empresasQuery->addOrderBy('s.name', 'asc');
                $this->empresasQuery->leftJoin($alias . '.Localidad l');
                $this->empresasQuery->addOrderBy('l.name', 'asc');
                return null;
                break;

            case 'provincia':
                $this->empresasQuery->leftJoin($alias . '.States s');
                $this->empresasQuery->orderBy('s.name', 'asc');
                $this->empresasQuery->addOrderBy($alias . '.name', 'asc');
                $this->empresasQuery->leftJoin($alias . '.Localidad l');
                $this->empresasQuery->addOrderBy('l.name', 'asc');
                break;

            case 'localidad':
                $this->empresasQuery->leftJoin($alias . '.Localidad l');
                $this->empresasQuery->orderBy('l.name', 'asc');
                $this->empresasQuery->addOrderBy($alias . '.name', 'asc');
                break;

            default:
                $this->empresasQuery->orderBy($alias . '.name', 'asc');
                break;
        }

        if ($this->sortForm['states_id']->getValue() && 1 != $this->sortForm['states_id']->getValue()) {
            $this->empresasQuery->addWhere($alias . '.states_id = ?', $this->sortForm['states_id']->getValue());
        }

        if ($this->sortForm['localidad_id']->getValue() && 1 != $this->sortForm['localidad_id']->getValue()) {
            $this->empresasQuery->addWhere($alias . '.localidad_id = ?', $this->sortForm['localidad_id']->getValue());
        }


        return null;
    }

    public function executeRecordarOrden(sfWebRequest $request) {
        $orderForm = $request->getParameterHolder()->get('orderForm');
        $this->getUser()->setOrderPreferences('lb_empresas', $orderForm);
        return $this->renderText('');
    }

    public function executeVolverOrder(sfWebRequest $request) {
        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($this->getUser()->getOrderPreferences('lb_empresas')));
    }

    /**
     * Muestra el detalla de una empresa.
     */
    public function executeDetalle(sfWebRequest $request) {
        $this->getUser()->setRemember(true);
        $this->forward404Unless($this->empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
        $this->form = new ListaBlancaEmpresaFormFilter();
        $this->sectoresActivos = $this->crearSectoresActivos($request);
        $this->sortForm = new EmpresaOrderForm();
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
                'texto' => EmpresaSectorUnoTable::getName($request->getParameter('sector1')));
        }
        if ($this->request->getParameter('sector2')) {
            $sectoresActivos['sector2'] = array(
                'slug' => $request->getParameter('sector2'),
                'texto' => EmpresaSectorDosTable::getName($request->getParameter('sector2')));
        }
        if ($this->request->getParameter('sector3')) {
            $sectoresActivos['sector3'] = array(
                'slug' => $request->getParameter('sector3'),
                'texto' => EmpresaSectorTresTable::getName($request->getParameter('sector3')));
        }

        return $sectoresActivos;
    }

    public function executeFilter(sfWebRequest $request) {
        //recogemos los datos del form...
        $this->form = new ListaBlancaEmpresaFormFilter();
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

            $this->redirect('@lista_blanca_empresa');
        }

        $this->form = new ListaBlancaEmpresaFormFilter($listado->getFilters());
        $this->form->bind($request->getParameter($this->form->getName()));
        if ($this->form->isValid()) {
            $listado->setFilters($this->form->getValues());
            $this->redirect('@lista_blanca_empresa');
        }

        $this->listado($request);

        $this->setTemplate('index');
    }

    protected function listado(sfWebRequest $request) {
        $listado = $this->instanciaListado();

        //Descomentar e indicar un campo para inicializar el filtro para que al entrar la primera vez al listado se muestren unos resultados filtrados
        //    if ($listado->getFilters() == null)
        //    {
        //      $this->firstCall = true;
        //    }
        // guardamos el orden
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $listado->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // guardamos la página
        if ($request->getParameter('page')) {
            $listado->setPage($request->getParameter('page'));
        }

        if (null === $this->form) {
            $this->form = new ListaBlancaEmpresaFormFilter($listado->getFilters());
        }

        $query = $this->form->buildQuery($listado->getFilters());
        $this->pager = $listado->getPager($query);
        $this->sort = $listado->getSort();
    }

    protected function instanciaListado() {
        return $listado = new slxGestionListado(array(
                    'module' => 'lista_blanca',
                    'model' => 'ListaEmpresa',
                    'campo_orden_x_defecto' => 'l.id',
                    'sentido_orden_x_defecto' => 'asc',
                    'elem_x_pagina' => 1,
                ));
    }

    protected function isValidSortColumn($column) {
        return in_array($column, array('l.name', 'ca.name'));
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

        //mira si además ya ha hecho una auditoría a esta empresa ...
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

                $this->form->save();
                $respuestas = $this->form->getObject();

                //mira si hay comentario...
                if ($respuestas->hasComentario()) {
                    $respuestas->setAprobado(FALSE);
                } else {
                    $respuestas->setAprobado(TRUE);
                    if ($oldAuditoria) {
                        $empresa->removeAuditoria($oldAuditoria);
                        $oldAuditoria->markAsDisabled();
                    }
                    //sumar valores en empresa
                    $empresa->addAuditoria($respuestas);
                }
                $respuestas->save();
                UserAuditoriaTable::addAuditoria($this->getUser()->getGuarduser(), 'auditoria');
                sfGuardUserProfileTable::addPuntos();
                $this->getUser()->setFlash('notice', $this->getPartial('msg_auditoria_correcta'));

                //crea la alerta...
                AlertasTable::nueva($respuestas, 'auditoria', sprintf('Nueva <a href="empresa/%s">auditoría</a> de %s en la lista blanca de empresas/entidades', $empresa->getId(), $this->getUser()->getGuardUser()));
                $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('audit_lista_blanca');
                $codingo = Doctrine_Core::getTable('ColaboradorPuntoDefinicion')->findOneBy('codigo', 'audit_lista_blanca');
                ColaboradorPuntosHistoricoTable::new_log($respuestas->getUserId(), $codingo->getDescripcion(), $puntos, '', $respuestas->getId());
                return $this->redirect('lista_blanca_empresa');
            }
        }

        $this->empresas_sector_uno = Doctrine::getTable('EmpresaSectorUno')->getEmpresasSectorUno();
        $listado = $this->instanciaListado();

        $this->filter = new ListaBlancaEmpresaFormFilter($listado->getFilters());
        $this->sortForm = new EmpresaOrderForm();

//        $this->categorias = $this->categoriaActiva();
    }

    /**
     * Devuelve los 10 (o lo marcado en el app.yml)  últimos comentarios asociados a una empresa.
     *
     */
    public function executeComentarios(sfWebRequest $request) {
        if ($request->getParameter('tipo', 'empresa') == 'empresa') {

            $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
            $this->comentarios = $empresa->getLastComentarios(sfConfig::get('app_listaBlanca_ultimosComentarios', 25), 'DESC');
            if (count($this->comentarios) < 25) {
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

            if (count($this->comentarios) < 25) {
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
        if ($request->getParameter('tipo', 'empresa') == 'empresa') {
            $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
            $this->kpis = $empresa->getKpis();
        } elseif ($request->getParameter('tipo') == 'producto') {
            $this->forward404Unless($producto = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Este producto no existe.');
            $this->kpis = $producto->getKpis();
        }

        return $this->renderPartial('listaBlanca/categoriaExcelencia');
    }

//
//    public
//    function executeNoaudita(sfWebRequest $request)
//    {
//        $this->empresas_sector_uno = Doctrine::getTable('EmpresaSectorUno')->getEmpresasSectorUno();
//        $listado = $this->instanciaListado();
//        $this->form = new ListaCuestionarioUserForm($cuestionarioRespuesta);
//
//        $this->categorias = $this->categoriaActiva();
//    }
//
//
//    private
//    function generateMedalla($dividendo, $divisor, $valor, $num_cuestionarios)
//    {
//        $valor = ($dividendo + $valor) / ($divisor + $num_cuestionarios);
//        if (!$medallero = Doctrine::getTable("Medallero")->find(1))
//            return 0;
//        else {
//            if ($valor <= $medallero->getBronceFin() && $valor >= $medallero->getBronceInicio())
//                return 33;
//            elseif ($valor <= $medallero->getPlataFin() && $valor >= $medallero->getPlataInicio())
//                return 66;
//            elseif ($valor <= $medallero->getOroFin() && $valor >= $medallero->getOroInicio())
//                return 100;
//        }
//
//        return 0;
//    }
//    public function executeGraficaAuditorias(sfWebRequest $request)
//    {
//        $this->forward404Unless($concurso = Doctrine::getTable('Concurso')->find(array($request->getParameter('concurso_id'))), sprintf('El objeto no existe (%s).', $request->getParameter('id')));
//        $cuestionario = $concurso->getCuestionario();
//        $array_valores = $cuestionario->getMedallasLastThreeMonths();
//
//        //Actualizamos el array incorporando el factor y la división por el número de cuestiones
//
//        $array_valores[0]['valor'] = $this->generateMedalla($concurso->getDividendo(),
//            $concurso->getDivisor(),
//            $array_valores[0]['valor'],
//            $concurso->getCuestionarioRespuestaConcurso()->count());
//        $array_valores[1]['valor'] = $this->generateMedalla($concurso->getDividendo(),
//            $concurso->getDivisor(),
//            $array_valores[1]['valor'],
//            $concurso->getCuestionarioRespuestaConcurso()->count());
//        $array_valores[2]['valor'] = $this->generateMedalla($concurso->getDividendo(),
//            $concurso->getDivisor(),
//            $array_valores[2]['valor'],
//            $concurso->getCuestionarioRespuestaConcurso()->count());
//
//        $this->cadena_meses = '';
//        $this->cadena_valores = '';
//        for ($i = 0; $i < 2; $i++) {
//            $this->cadena_meses .= $array_valores[$i]['mes'] . "|";
//            $this->cadena_valores .= $array_valores[$i]['valor'] . ",";
//        }
//        $this->cadena_meses .= $array_valores[$i]['mes'];
//        $this->cadena_valores .= $array_valores[$i]['valor'];
//
//        $this->setLayout(false);
//    }

    public function executeGenerateMap() {
        $empresa = Doctrine_Core::getTable('Empresa')->findOneBySlug($this->getRequest()->getParameter('slug'));
        $this->gmap = $empresa->getGoogleMap();
        $this->setLayout(false);
    }

    public function executeShowChart(sfWebRequest $request) {
        $this->setLayout(false);
        $evolucion = EmpresaProductoEvolucionTable::getEvolucionEmpresaAnualNormalizado($request->getParameter('id'));
        $this->rows = array();
        sfApplicationConfiguration::getActive()->loadHelpers(array('Date'));
        foreach ($evolucion as $values) {
            $date = new DateTime($values['q_date']);
            $this->rows[] =
                    array_merge(array(ucfirst(format_date($values['q_date'], 'MMM-yy'))), $this->calculateRow($values));
        }

        $this->setTemplate('showChart', 'listaBlancaProducto');
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

    public function executeResetFilter($request){
        if ($request->hasParameter('reset')) {
            if ($request->getParameter('reset') == "Reset") {
                $this->getUser()->getAttributeHolder()->remove('first_enter_lb_empresa', null, myUser::ORDER_NS);
                $this->getUser()->setLastState('lb_empresas', "", "");
            }
        }
        return $this->renderText('');
    }
}
