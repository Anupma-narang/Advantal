<?php

/**
 * listaNegra actions.
 *
 * @package    auditoscopia
 * @subpackage listaNegra
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaNegraActions extends sfActions {

  /**
   *
   * @param sfWebRequest $request
   */
  public function executeIndexEmpresas(sfWebRequest $request) {

    $maxPerPage = sfConfig::get('app_listaNegra_listado', 10);
    $page = $this->getRequest()->getParameter('page', 0);

    $from = $this->getRequest()->getParameter('from', false);
    $filtrosDefault = array_merge(
            array(
        'states_id' => '',
        'localidad_id' => '',
        'order' => '',
        'name' => ''), $request->getParameterHolder()->get('orderForm', array()));
    switch ($from) {
      case 'buscador':
        $filtrosActivos = $this->ms_values = array_merge($filtrosDefault, $request->getParameterHolder()->get('empresa_filters'));
        break;

      case 'orden':
        $filtrosActivos = $this->ms_values = array_merge($filtrosDefault, $request->getParameterHolder()->get('empresa_filters'));
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
    if ($this->getUser()->hasAttribute('first_enter_ln_empresa', myUser::ORDER_NS)) {
      $filtrosActivos = array_merge($filtrosActivos, $this->getUser()->getOrderPreferences('ln_empresas'));
      $this->getUser()->getAttributeHolder()->remove('first_enter_ln_empresa', null, myUser::ORDER_NS);
    }

    // si hay guardado un estado anterior de la lista y no hay filtrosActivos
    if ($this->getUser()->hasLastState('ln_empresas') && false == $from) {
      $lastState = $this->getUser()->getLastState('ln_empresas');
      $filtrosActivos = array_merge($filtrosActivos, $lastState['order']);
      $page = $lastState['page'];
    }

    /** @var $this->empresasQuery Doctrine_Query */
    $this->empresasQuery = EmpresaTable::getInstance()->getListaNegraQuery(
            $request->getParameter('sector1'), $request->getParameter('sector2'), $request->getParameter('sector3')
    );

    $this->getUser()->setLastState('ln_empresas', $filtrosActivos, $page);

    // carga los filtros ...
    $this->form = new ListaNegraEmpresaFormFilter();
    $empresa_filters = $filtrosActivos;
    unset($empresa_filters['order']);
    $this->form->bind($empresa_filters);
    if ($this->form->isValid()) {
      $this->form->setOption('query', $this->empresasQuery);
      $this->empresasQuery = $this->form->buildQuery($empresa_filters);
    }

    //carga el orden...
    $empresa_order = $filtrosActivos;

    $this->sort = array('orden' => $request->getParameter('orden', 'empresa'));
    $this->sortForm = new EmpresaOrderForm();
    $this->sortForm->bind($empresa_order);
    $this->processSort();
    $this->ms_values = $filtrosActivos;

    // cargar los datos para la home de listado.
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
    $this->getResponse()->setTitle('Lista negra de empresas y entidades no recomendadas');
    $this->getResponse()->addMeta('description', 'Lista negra de empresas y entidades no recomendadas por los consumidores');
    $this->getResponse()->addMeta('keywords', 'comenta empresa, comenta entidad, comentario empresa, comentario entidad, por qué aparece aquí esta empresa, por qué aparece aquí esta entidad');
  }

  public function executeIndexProductos(sfWebRequest $request) {
    $maxPerPage = sfConfig::get('app_listaBlanca_numero_empresas_listado', 10);
    $page = $this->getRequest()->getParameter('page', 0);
    $from = $this->getRequest()->getParameter('from', false);

    $filtrosDefault = array_merge(array(
        'name' => '',
        'marca' => '',
        'modelo' => '',
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
    if ($this->getUser()->hasAttribute('first_enter_ln_producto', myUser::ORDER_NS)) {
      $filtrosActivos = array_merge($filtrosActivos, $this->getUser()->getOrderPreferences('ln_productos'));
      $this->getUser()->getAttributeHolder()->remove('first_enter_ln_producto', null, myUser::ORDER_NS);
    }

    // si hay guardado un estado anterior de la lista y no hay filtrosActivos
    if ($this->getUser()->hasLastState('ln_productos') && false == $from) {
      $lastState = $this->getUser()->getLastState('ln_productos');
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
    $this->getUser()->setLastState('ln_productos', $filtrosActivos, $page);
    if ($request->getParameter('sector1')) {
      $this->buscandoPorSector = true;
    } else {
      $this->buscandoPorSector = false;
    }


    /** @var $this->empresasQuery Doctrine_Query */
    $this->productosQuery = ProductoTable::getInstance()
            ->getListaNegraQuery(
            $request->getParameter('sector1'), $request->getParameter('sector2'), $request->getParameter('sector3')
    );

    //carga los filtros si hay...
    $this->form = new ListaNegraProductoFormFilter();
    $producto_filters = $filtrosActivos;
    unset($producto_filters['order']);
    $this->form->bind($producto_filters);

    if ($this->form->isValid()) {
      // se monta la nueva query..
      $this->form->setOption('query', $this->productosQuery);
      $this->productosQuery = $this->form->buildQuery($producto_filters);
    }


    $this->sortForm = new ProductoOrderListaNegraForm();
    $this->sortForm->setDefault('order', 'nombre');
    $this->sortForm->bind($filtrosActivos);
    $this->processSortProductos();

    // cargar los datos para la home de listado.
    $this->pager = new sfDoctrinePager('Producto', $maxPerPage);
    $this->pager->setQuery($this->productosQuery);
    $this->pager->setPage($page);
    $this->pager->init();

    $this->sectoresActivos = $this->crearSectoresActivosProduct($request);

    //si se envia por ajax, devuelve solo los datos...
    if ($this->getRequest()->isXmlHttpRequest()) {
      if (!$request->getParameter('static')) {
        return $this->renderPartial('resultadosProducto');
      }
    }
    $this->getResponse()->setTitle('Lista negra de productos no recomendados');
    $this->getResponse()->addMeta('description', 'Lista negra de productos no recomendados por los consumidores');
    $this->getResponse()->addMeta('keywords', 'comenta,por qué aparece aquí');
  }

  /**
   * Devuelve los 10 (o lo marcado en el app.yml)  últimos comentarios asociados a una empresa.
   *
   */
  public function executeComentarios(sfWebRequest $request) {
    if ($request->getParameter('tipo', 'empresa') == 'empresa') {
      $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
      $this->comentarios = $empresa->getLastComentariosListaNegra(sfConfig::get('app_listaNegra_ultimosComentarios', 25), true, true, 'DESC');
      $this->obj = $empresa;
      $this->url = 'lista_negra_detalle_empresa';
      $this->empresas = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug'));
    } elseif ($request->getParameter('tipo') == 'producto') {
      $this->forward404Unless($producto = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Esta producto no existe.');
      $this->comentarios = $producto->getLastComentariosListaNegra(sfConfig::get('app_listaNegra_ultimosComentarios', 25), true, true, 'DESC');
      $this->obj = $producto;
      $this->url = 'lista_negra_detalle_producto';
      $this->productos = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug'));
    }
  }

  public function executeAddComentario(sfWebRequest $request) {
    $this->getUser()->setRemember(true);

    $type = $request->getParameter('type');
    switch ($type) {
      case 'empresa':
        $this->forward404Unless($object = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
        $this->searchForm = new ListaBlancaEmpresaFormFilter();

        break;

      case 'producto':
        $this->forward404Unless($object = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Este producto no existe.');
        $this->searchForm = new ListaBlancaProductoFormFilter();

        break;
    }
    if ($object->getLista() !== 'ln') {
      return $this->redirect404();
    }

    $this->object = $object;
    $this->sectoresActivos = $this->crearSectoresActivos($request);

    $puedeAuditarHoy = UserAuditoriaTable::puedeComentarHoy($this->getUser()->getGuardUser());

    if (!$puedeAuditarHoy) {
      $this->getUser()->setFlash('notice', $this->getPartial('listaNegra/error', array('object' => $object, 'type' => $type)));
      return $this->redirect('lista_negra_' . $type);
    }

    if (ComentarioListaNegraTable::userHasComment($this->getUser()->getGuardUser(), $object)) {
      $this->getUser()->setFlash('notice', $this->getPartial('error_30_dias', array('type' => $type, 'object' => $object)));
      return $this->redirect('lista_negra_' . $type);
    }
    $comentario = new ComentarioListaNegra();
    $comentario->setUser($this->getUser()->getGuardUser());
    switch ($type) {
      case 'empresa':
        $comentario->setEmpresa($object);
        break;

      case 'producto':
        $comentario->setProducto($object);
        break;
    }
    $this->form = new ComentarioListaNegraForm($comentario);
    $this->type = $type;
    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
        $respuestas = $this->form->getObject();
        $this->form->save();
        UserAuditoriaTable::addAuditoria($this->getUser()->getGuarduser(), 'comentario');
        sfGuardUserProfileTable::addPuntosCommenta();
        AlertasTable::nueva('ComentarioListaNegra', 'comentario', sprintf('Nuevo <a href="listaNegra%s/%s">comentario</a> de %s en la lista negra de %s', ucfirst($type), $object->getId(), $this->getUser()->getGuardUser(), $type . 's'));
        $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('Coment_lista_negra');
        $codingo = Doctrine_Core::getTable('ColaboradorPuntoDefinicion')->findOneBy('codigo', 'Coment_lista_negra');
        ColaboradorPuntosHistoricoTable::new_log($respuestas->getSfGuardUserId(), $codingo->getDescripcion(), $puntos, '', $respuestas->getId());
        $this->getUser()->setFlash('notice', $this->getPartial('msg_comentario_ok'));


        return $this->redirect('lista_negra_' . $type);
      }
    }
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
        $this->empresasQuery->orderBy('l.name asc');
        $this->empresasQuery->addOrderBy($alias . '.name asc');
        break;

      default:
        $this->empresasQuery->addOrderBy($alias . '.name', 'asc');
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

  public function processSortProductos() {
    $alias = $this->productosQuery->getRootAlias();
    switch ($this->sortForm['order']->getValue()) {
      case 'producto':
        $this->productosQuery->addOrderBy($alias . '.name asc');
        $this->productosQuery->addOrderBy($alias . '.marca asc');
        $this->productosQuery->addOrderBy('IF(ISNULL(modelo),1,0),modelo ASC');
        break;

      case 'marca':
        $this->productosQuery->orderBy($alias . '.marca', 'asc');
        $this->productosQuery->addOrderBy($alias . '.name ASC');

        $this->productosQuery->addOrderBy('IF(ISNULL(modelo),1,0),modelo ASC');

        break;

      case 'modelo':
        $this->productosQuery->addOrderBy('IF(ISNULL(modelo),1,0),modelo ASC');
        $this->productosQuery->addOrderBy($alias . '.name ASC');

        break;

      default:
        $this->productosQuery->addOrderBy($alias . '.name', 'asc');
        break;
    }

    return null;
  }

  /**
   * Muestra el detalla de una empresa.
   */
  public function executeDetalle(sfWebRequest $request) {
    switch ($request->getParameter('tipo')) {
      case 'empresa':
        $this->empresa = Doctrine::getTable('Empresa')->findOneBySlug($request->getParameter('slug'));
        $this->forward404Unless($this->empresa, 'Esta empresa no existe.');
        $this->form = new ListaBlancaEmpresaFormFilter();
        $this->sectoresActivos = $this->crearSectoresActivos($request);
        $this->sortForm = new EmpresaOrderForm();
        $this->setTemplate('detalleEmpresa');
        break;

      case 'producto':
        $this->forward404Unless($this->producto = Doctrine::getTable('Producto')->findOneBySlug($request->getParameter('slug')), 'Esta empresa no existe.');
        $this->form = new ListaBlancaProductoFormFilter();
        $this->sectoresActivos = $this->crearSectoresActivos($request);
        $this->sortForm = new EmpresaOrderForm();
        $this->setTemplate('detalleProducto');
        break;
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

  public function executeTmp(sfWebRequest $request) {
    
  }

  /**
   * Método que devuelve un array con los sectores activos para rellenar el breadcrumb.
   *
   * @param sfWebRequest $request
   * @return array
   */
  protected function crearSectoresActivosProduct(sfWebRequest $request) {
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

  public function executeRecordarOrden(sfWebRequest $request) {
    $lista = '';
    switch ($request->getParameter('tipo')) {
      case 'empresa':
        $lista = 'ln_empresas';
        break;

      case 'producto':
        $lista = 'ln_productos';
        break;
    }

    $orderForm = $request->getParameterHolder()->get('orderForm');
    $this->getUser()->setOrderPreferences($lista, $orderForm);
    return $this->renderText('');
  }

  public function executeVolverOrden(sfWebRequest $request) {
    $lista = '';
    switch ($request->getParameter('tipo')) {
      case 'empresa':
        $lista = 'ln_empresas';
        break;

      case 'producto':
        $lista = 'ln_productos';
        break;
    }
    ProjectUtility::decorateJsonResponse($this->getResponse());
    return $this->renderText(json_encode($this->getUser()->getOrderPreferences($lista)));
  }

  public function executeResetFilter($request) {
    if ($request->hasParameter('reset')) {
      if ($request->getParameter('reset') == "Reset") {
        $this->getUser()->getAttributeHolder()->remove('first_enter_ln_empresa', null, myUser::ORDER_NS);
        $this->getUser()->getAttributeHolder()->remove('first_enter_ln_producto', null, myUser::ORDER_NS);
        $this->getUser()->setLastState('ln_empresas', "", "");
        $this->getUser()->setLastState('ln_productos', "", "");
      }
    }
    return $this->renderText('');
  }

}
