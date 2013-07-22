<?php

/**
 * listaBlancaProducto actions.
 *
 * @package    auditoscopia
 * @subpackage lista_blanca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaBlancaProductoActions extends sfActions {

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {
        $maxPerPage = sfConfig::get('app_listaBlanca_numero_empresas_listado', 10);
        $page = $this->getRequest()->getParameter('page', 0);
        $from = $this->getRequest()->getParameter('from', false);
        $filtrosDefault = array_merge(array(
            'name' => '',
            'marca' => '',
            'modelo' => '',
            'categoria_excelencia' => '',
            'order' => ''
                ), $request->getParameter('orderForm', array()));

        switch ($from) {
            case 'buscador':
                $filtrosActivos = $this->ms_values = array_merge($filtrosDefault, $request->getParameterHolder()->get('producto_filters'));
                break;

            case 'orden':
                $filtrosActivos = $this->ms_values = array_merge(array_merge($filtrosDefault, $request->getParameterHolder()->get('producto_filters')), $request->getParameterHolder()->get('orderForm'));
                //$filtrosActivos = $this->ms_values = array_merge($filtrosDefault, $request->getParameterHolder()->get('orderForm'));
                break;

            default:
                $filtrosActivos = $this->ms_values = $filtrosDefault;
                break;
        }


        //casos...
        // es la primera vez que se entra como usuario logueado. Se recupera la búsqueda guardada...
        if ($this->getUser()->hasAttribute('first_enter_lb_producto', myUser::ORDER_NS)) {
            $filtrosActivos = array_merge($filtrosActivos, $this->getUser()->getOrderPreferences('lb_productos'));
            $this->getUser()->getAttributeHolder()->remove('first_enter_lb_producto', null, myUser::ORDER_NS);
        }

        // si hay guardado un estado anterior de la lista y no hay filtrosActivos
        if ($this->getUser()->hasLastState('lb_productos') && false == $from) {
            $lastState = $this->getUser()->getLastState('lb_productos');
            $filtrosActivos = array_merge($filtrosActivos, $lastState['order']);
            $page = $lastState['page'];
        }

        /** @var $this->empresasQuery Doctrine_Query */
        $options = array_merge(
                array(
            'sector1' => $request->getParameter('sector1'),
            'sector2' => $request->getParameter('sector2'),
            'sector3' => $request->getParameter('sector3')), $filtrosActivos);

        $this->ms_values = $filtrosActivos;
        $this->getUser()->setLastState('lb_productos', $filtrosActivos, $page);


        if ($request->getParameter('sector1') && false == $from) {
            $this->buscandoPorSector = true;
        } else {
            $this->buscandoPorSector = false;
        }

        $this->productosDestacados = ProductoTable::getInstance()->getListaBlancaDestacados($options);
        $productosQuery = ProductoTable::getInstance()->getListaBlancaQuery(
                $request->getParameter('sector1'), $request->getParameter('sector2'), $request->getParameter('sector3'), $this->productosDestacados
        );

        //carga los filtros si hay...
        $this->form = new ListaBlancaProductoFormFilter();
        $producto_filters = $filtrosActivos;
        unset($producto_filters['order']);
        $this->form->bind($producto_filters);
        if ($this->form->isValid()) {
            // se monta la nueva query..
            $this->form->setOption('query', $productosQuery);
            $this->productosQuery = $this->form->buildQuery($producto_filters);
        }

        // carga el orden
        $producto_order = $filtrosActivos;
        unset($producto_order['categoria_excelencia']);
        $this->sortForm = new ProductoOrderForm();
        $this->sortForm->bind($producto_order);
        $this->processSort();

        // cargar los datos para la home de listado.
        $this->pager = new sfDoctrinePager('Producto', $maxPerPage);
        $this->pager->setQuery($this->productosQuery);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->sectoresActivos = $this->crearSectoresActivos($request);

        //si se envia por ajax, devuelve solo los datos...
        if ($this->getRequest()->isXmlHttpRequest()) {
            if (!$request->getParameter('static')) {
                return $this->renderPartial('resultadosProductos');
            }
        }
        $this->getResponse()->setTitle('Lista blanca de productos recomendados');
        $this->getResponse()->addMeta('description', 'Lista blanca de productos recomendados por los consumidores');
        $this->getResponse()->addMeta('keywords', 'audita producto, auditar productos, auditoría producto, indicadores excelencia producto');
    }

    public function processSort() {
        $alias = $this->productosQuery->getRootAlias();
        switch ($this->sortForm['order']->getValue()) {

            case 'producto':
                $this->productosQuery->addOrderBy($alias . '.name ASC');
                $this->productosQuery->addOrderBy($alias . '.marca ASC');
                $this->productosQuery->addOrderBy('IF(ISNULL(modelo),1,0),modelo ASC');

                break;
            case 'marca':
                $this->productosQuery->addOrderBy('marca');
                $this->productosQuery->addOrderBy($alias . '.name ASC');
                $this->productosQuery->addOrderBy('IF(ISNULL(modelo),1,0),modelo ASC');


                break;

            case 'modelo':
                $this->productosQuery->addOrderBy('IF(ISNULL(modelo),1,0),modelo ASC');
                $this->productosQuery->addOrderBy($alias . '.name ASC');

                break;
        }

        return null;
    }

    /**
     * Muestra el detalla de una empresa.
     */
    public function executeDetalle(sfWebRequest $request) {
        $this->getUser()->setRemember(true);

        $this->forward404Unless($this->producto = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Este producto no existe.');
        $this->form = new ListaBlancaProductoFormFilter();
        $this->sectoresActivos = $this->crearSectoresActivos($request);
        $this->sortForm = new ProductoOrderForm();
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
                //'texto' => EmpresaSectorUnoTable::getName($request->getParameter('sector1')));
                'texto' => ProductoTipoUnoTable::getInstance()->findOneBySlug($request->getParameter('sector1'))->getName());
        }
        if ($this->request->getParameter('sector2')) {
            $sectoresActivos['sector2'] = array(
                'slug' => $request->getParameter('sector2'),
                //'texto' => EmpresaSectorDosTable::getName($request->getParameter('sector2')));
                'texto' => ProductoTipoDosTable::getInstance()->findOneBySlug($request->getParameter('sector2'))->getName());
        }
        if ($this->request->getParameter('sector3')) {
            $sectoresActivos['sector3'] = array(
                'slug' => $request->getParameter('sector3'),
                //'texto' => EmpresaSectorTresTable::getName($request->getParameter('sector3')));
                'texto' => ProductoTipoTresTable::getInstance()->findOneBySlug($request->getParameter('sector3'))->getName());
        }

        return $sectoresActivos;
    }

    /**
     * Audita un producto
     *
     * @param sfWebRequest $request
     */
    public function executeAudita(sfWebRequest $request) {
        $this->getUser()->setRemember(true);

        $this->forward404Unless($producto = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Este producto no existe.');

        //Si no tiene cuestionario asociado no se permite realizar la acción
        $this->forward404if($producto->getCuestionario()->getId() == null, sprintf('El producto no tiene asociado ningún cuestionario'));

        $this->sectoresActivos = $this->crearSectoresActivos($request);
        $this->producto = $producto;

        $puedeAuditarHoy = UserAuditoriaTable::puedeAuditarHoy($this->getUser()->getGuardUser());
        if (!$puedeAuditarHoy) {
            $this->getUser()->setFlash('notice', $this->getPartial('listaBlanca/msg_auditoria_mismo_dia', array('producto' => $producto)));
            return $this->redirect('lista_blanca_productos');
        }

        $puedeAuditar = Doctrine::getTable('ListaCuestionarioUser')->puedeAuditarProducto($producto, $this->getUser()->getGuardUser());
        if (!$puedeAuditar) {
            $this->getUser()->setFlash('notice', $this->getPartial('listaBlanca/msg_auditoria_incorrecta', array('producto' => $producto)));
            return $this->redirect('lista_blanca_productos');
        }

        $cuestionarioRespuesta = new ListaCuestionarioUser();
        $cuestionarioRespuesta->setUserId($this->getUser()->getGuardUser());
        $cuestionarioRespuesta->setListaCuestionarioId($producto->getCuestionario());
        $cuestionarioRespuesta->setProducto($producto);

        $this->form = new ListaCuestionarioUserForm($cuestionarioRespuesta);
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {

                $oldAuditoria = ListaCuestionarioUserTable::getInstance()->findByUserAndProducto($this->getUser()->getGuardUser()->getId(), $producto->getId());
                $this->form->save();
                $respuestas = $this->form->getObject();
                //mira si hay comentario...
                if ($respuestas->hasComentario()) {
                    $respuestas->setAprobado(FALSE);
                } else {
                    $respuestas->setAprobado(TRUE);
                    if ($oldAuditoria) {
                        $producto->removeAuditoria($oldAuditoria);
                        $oldAuditoria->markAsDisabled();
                    }
                    //sumar valores en empresa
                    $producto->addAuditoria($respuestas);
                }
                $respuestas->save();
                UserAuditoriaTable::addAuditoria($this->getUser()->getGuarduser(), 'auditoria');
                sfGuardUserProfileTable::addPuntos();
                $this->getUser()->setFlash('notice', $this->getPartial('listaBlanca/msg_auditoria_correcta'));
                AlertasTable::nueva($respuestas, 'auditoria', sprintf('Nueva <a href="producto/%s">auditoría</a> de %s en la lista blanca de productos', $producto->getId(), $this->getUser()->getGuardUser()));
                $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('audit_lista_blanca');
                $codingo = Doctrine_Core::getTable('ColaboradorPuntoDefinicion')->findOneBy('codigo', 'audit_lista_blanca');
                ColaboradorPuntosHistoricoTable::new_log($respuestas->getUserId(), $codingo->getDescripcion(), $puntos, '', $respuestas->getId());

                return $this->redirect('lista_blanca_productos');
            }
        }

        $this->filter = new ListaBlancaProductoFormFilter();
        $this->sortForm = new ProductoOrderForm();
    }

    /**
     * autocompletado para los productos según el campo enviado en la query
     *
     * @param sfWebRequest $request
     */
    public function executeAutocomplete(sfWebRequest $request) {

        $sugerencias = Doctrine_Core::getTable('Producto')->getAutocomplete($request->getParameter('q'), $request->getParameter('field'), 10, $request->getParameter('lista', 'lb'));
        $html = array();
        foreach ($sugerencias as $result) {
            $html[] = $result[$request->getParameter('field')];
        }

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($html));
    }

    public function executeShowChart(sfWebRequest $request) {
        $this->setLayout(false);
        $evolucion = EmpresaProductoEvolucionTable::getEvolucionProductoAnualNormalizado($request->getParameter('id'));

        // X axis...
        $this->rows = array();
        sfApplicationConfiguration::getActive()->loadHelpers(array('Date'));
        foreach ($evolucion as $values) {
            $date = new DateTime($values['q_date']);
            $this->rows[] =
                    array_merge(array(ucfirst(format_date($values['q_date'], 'MMM-yy'))), $this->calculateRow($values));
        }
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

    public function executeRecordarOrden(sfWebRequest $request) {
        $this->getUser()->setOrderPreferences('lb_productos', $request->getParameterHolder()->get('orderForm'));
        return $this->renderText('');
    }

    public function executeVolverOrder(sfWebRequest $request) {
        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($this->getUser()->getOrderPreferences('lb_productos')));
    }

    public function executeResetFilter($request){
        if ($request->hasParameter('reset')) {
            if ($request->getParameter('reset') == "Reset") {
                $this->getUser()->getAttributeHolder()->remove('first_enter_lb_producto', null, myUser::ORDER_NS);
                $this->getUser()->setLastState('lb_productos', "", "");
            }
        }
        return $this->renderText('');
    }
}
