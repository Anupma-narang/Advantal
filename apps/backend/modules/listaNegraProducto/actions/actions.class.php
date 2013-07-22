<?php

require_once dirname(__FILE__) . '/../lib/listaNegraProductoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/listaNegraProductoGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * listaNegraProducto actions.
 *
 * @package    symfony
 * @subpackage listaNegraProducto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaNegraProductoActions extends autoListaNegraProductoActions {

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $featured_limit = Doctrine::getTable('Producto')->getFeatreudLimit('ln');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['product_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
    }

    /**
     * Detalle del producto
     */
    public function executeShow(sfWebRequest $request) {
        $this->producto = Doctrine_Core::getTable('Producto')->find($request->getParameter('id'));
        $featured_limit = Doctrine::getTable('Producto')->getFeatreudLimit('ln');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['product_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }

        // Pagination
        $q = Doctrine_Query::create()->from('ComentarioListaNegra r')
                ->select('r.id, r.comentario, r.updated_at, u.username')
                ->leftJoin('r.User u')
                ->where('r.producto_id = ?', $request->getParameter('id'))
                ->andWhere('r.aprobado = ?', 1)
                ->orderBy('r.id ' . 'DESC');

        $this->pager = new sfDoctrinePager('ComentarioListaNegra', 25);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();

        $qp = Doctrine_Query::create()->from('ComentarioListaNegra r')
                ->select('r.id, r.comentario, r.updated_at, u.username')
                ->leftJoin('r.User u')
                ->where('r.producto_id = ?', $request->getParameter('id'))
                ->andWhere('r.aprobado = ?', 0)
                ->orderBy('r.id ' . 'DESC');

        $this->pager_pending = new sfDoctrinePager('ComentarioListaNegra', 25);
        $this->pager_pending->setQuery($qp);
        $this->pager_pending->setPage($request->getParameter('pg', 1));
        $this->pager_pending->init();
    }

    /**
     * Muestra todos las respuestas a los cuestionarios
     *
     * @param sfWebRequest $request
     */
    public function executeListCuestionarios(sfWebRequest $request) {
        $producto = Doctrine_Core::getTable('Producto')->find($request->getParameter('id'));
        $this->respuestas = $producto->getCuestionarioRespuestas();
    }

    public function executeListaBlanca(sfWebRequest $request) {
        $this->setTemplate('index');
        $this->executeIndex($request);
    }

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'sector_name':
                $sort[0] = 'psu.name';
                break;
            case 'subsector_name':
                $sort[0] = 'psd.name';
                break;
            case 'tipo':
                $sort[0] = 'pst.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Producto')->hasColumn($column) || $column == 'sector_name' || $column == 'subsector_name' || $column == 'tipo';
    }

    protected function buildQuery() {

        switch ($this->getActionName()) {
            case 'listaBlanca':
                $tableMethod = 'getListaBlancaQuery';
                break;

            default:
                $tableMethod = $this->configuration->getTableMethod();
                break;
        }
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('listaNegraProducto.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $query->addWhere("lista = 'ln'");

        $this->addSortQuery($query);
        
        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

        

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    /**
     * tontería solo útil para enganyar al generator y usar helper propios en el caso de editar producto en lista blanca.
     * Quizá hay mejor opción... :(
     *
     * @param sfWebRequest $request
     */
    public function executeEditListaBlanca(sfWebRequest $request) {
        $this->setTemplate('edit');
        $this->executeEdit($request);
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $producto = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $producto)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                $this->redirect('@producto_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                if ($producto->getLista() == 'lb') {
                    $this->redirect(array('sf_route' => 'producto_lista_blanca'));
                } elseif ($producto->getLista() == 'ln') {
                    $this->redirect(array('sf_route' => 'producto_listaNegraProducto'));
                } else {
                    $this->redirect(array('sf_route' => 'producto'));
                }
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeDestacadoManager(sfWebRequest $request) {
        $this->producto = Doctrine_Core::getTable('Producto')->find($request->getParameter('id'));
    }

    /**
     * Añade o quita la empresa como destacada
     *
     * @param sfWebRequest $request
     */
    public function executeToggleDestacar(sfWebRequest $request) {
        $tipo = $request->getParameter('tipo');
        /** @var Producto $producto  */
        $producto = Doctrine_Core::getTable('Producto')->find($request->getParameter('id'));

        switch ($tipo) {
            case 'tipo':
                if ($producto->isDestacadoPorTipo()) {
                    $productoDestacado = Doctrine_Core::getTable('ProductoDestacado')->findByProductoIdAndTipo($request->getParameter('id'));
                    $productoDestacado->delete();
                    return $this->redirect('producto_show_destacados', array('id' => $producto->getId()));
                } else {
                    if (Doctrine_Core::getTable('ProductoDestacado')->countTipo($producto) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 productos por actividad');
                        return $this->redirect('producto_show_destacados', array('id' => $producto->getId()));
                    }

                    $productoDestacado = $this->prepareProductoDestacado($request->getParameter('id'));
                    if ($producto->getProductoTipoTres()) {
                        $productoDestacado->setProductoTipoTresId($producto->getProductoTipoTres()->getId());
                    } else {
                        $productoDestacado->setProductoTipoDosId($producto->setProductoTipoDos()->getId());
                    }
                }

                break;

            case 'marca':
                if ($producto->isDestacadoPorMarca()) {
                    $productoDestacado = Doctrine_Core::getTable('ProductoDestacado')->findByProductoIdAndMarca($request->getParameter('id'));
                    $productoDestacado->delete();
                    return $this->redirect('producto_show_destacados', array('id' => $producto->getId()));
                } else {
                    if (Doctrine_Core::getTable('ProductoDestacado')->countMarca($producto->getMarca()) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 productos por marca');
                        return $this->redirect('producto_show_destacados', array('id' => $producto->getId()));
                    }
                    $productoDestacado = $this->prepareProductoDestacado($request->getParameter('id'));
                    $productoDestacado->setMarca($producto->getMarca());
                }
                break;
        }
        $productoDestacado->setRank(ProductoDestacadoTable::getLastRank($producto, $tipo) + 1);
        $productoDestacado->save();
        return $this->redirect('producto_show_destacados', array('id' => $producto->getId()));
    }

    public function executeShowListaNegraPor(sfWebRequest $request) {
        $this->forward404Unless($this->producto = Doctrine::getTable('Producto')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeDownload_pdf(sfWebRequest $request) {
        $this->forward404Unless($producto = Doctrine::getTable('Producto')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Producto: '));
        $pdf->SetTextColor(180, 27, 29);
        $pdf->Write(5, $producto->getName());

        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Marca: '));
        $pdf->SetTextColor(22, 100, 148);
        $pdf->Write(5, $producto->getMarca());

        if ($producto->getModelo()) :
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Modelo: '));
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $producto->getModelo());
        endif;
        $pdf->Ln(6);
        if ($producto->getProductoTipoTres()->getId()) {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Tipo de producto: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $producto->getTipo());
        } else {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Tipo de producto: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $producto->getProductoTipoDos());
        }
        if ($producto->getProductoTipoTres()->getId() && $producto->getModelo()) {
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 57, 410);
        } elseif ((!$producto->getProductoTipoTres()->getId() && $producto->getModelo()) || ($producto->getProductoTipoTres()->getId() && !$producto->getModelo())) {
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 51, 410);
        } elseif (!$producto->getProductoTipoTres()->getId() && !$producto->getModelo()) {
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 45, 410);
        }
        $pdf->Ln(14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, __('LISTA NEGRA: POR QUÉ APARECE AQUÍ'));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 8);
        
        $str = $this->strip_tags_content($producto->getTextoListaNegra(), "<p><a><b><strong><i><u><span><font><br>");

        $pdf->WriteHTML(html_entity_decode($producto->getTextoListaNegra()));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Output(sprintf($producto->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    public function strip_tags_content($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>') {
        mb_regex_encoding('UTF-8');
        //replace MS special characters first
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u', '/&nbsp;/u');
        $replace = array('\'', '\'', '"', '"', '-', ' ');
        $text = preg_replace($search, $replace, $text);
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
        //in some MS headers, some html entities are encoded and some aren't
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        //try to strip out any C style comments first, since these, embedded in html comments, seem to
        //prevent strip_tags from removing html comments (MS Word introduced combination)
        if (mb_stripos($text, '/*') !== FALSE) {
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
        }
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
        //'<1' becomes '< 1'(note: somewhat application specific)
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
        $text = strip_tags($text, $allowed_tags);
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
        //strip out inline css and simplify style tags
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
        $text = preg_replace($search, $replace, $text);
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
        //some MS Style Definitions - this last bit gets rid of any leftover comments */
        $num_matches = preg_match_all("/\<!--/u", $text, $matches);
        if ($num_matches) {
            $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
        }
        return $text;
    }

    /**
     * autocompletado para los productos según el campo enviado en la query
     *
     * @param sfWebRequest $request
     */
    public function executeAutocomplete(sfWebRequest $request) {
        $sugerencias = Doctrine_Core::getTable('Producto')->getAutocomplete($request->getParameter('q'), $request->getParameter('field'));
        $html = array();
        foreach ($sugerencias as $result) {
            $html[] = $result[$request->getParameter('field')];
        }

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($html));
    }

    protected function prepareProductoDestacado($id) {
        $productoDestacado = new ProductoDestacado();
        $productoDestacado->setProductoId($id);
        return $productoDestacado;
    }

    public function executeSortDestacado(sfWebRequest $request) {
        $productos = $request->getParameter('elements');
        $productos = array_map(function($value) {
                    return substr($value, 9);
                }, $productos);

        $params = substr($request->getParameter('type'), 10);

        if (strstr($params, 'marca')) {
            preg_match('#%([A-Za-z ]+)%#', $params, $type);
            $type[2] = 'marca';
        } else {
            preg_match('#([A-Za-z_]+)_([0-9]+)#', $params, $type);
        }
        ProductoDestacadoTable::getInstance()->setOrder($type[2], $type[1], $productos);

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText('');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        //test if there a product with this cuestionario
        $empresa = $this->getRoute()->getObject();
        try {
            $empresa->delete();
            $this->getUser()->setFlash('notice', 'Se ha borrado el producto correctamente.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'No se puede borrar este producto porque tiene concursos, auditorías o comentarios asociados.');
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));


        $this->redirect('@producto_listaNegraProducto');
    }

    /* Set selected balcklist product as featured on homepage
     * @param sfWebRequest $request
     */

    public function executeSetFeatured(sfWebRequest $request) {
        //get product id
        $product_id = $request->getParameter('id');
        //get contest
        $product = Doctrine::getTable('Producto')->find($product_id);
        //get featured limit
        $featured_limit = Doctrine::getTable('Producto')->getFeatreudLimit($product->getLista());

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['product_limit'] >= 10) {
            //show product contest error message
            $this->getUser()->setFlash('alert', 'No puedes destacar más de 10 productos de la Lista negra en la Home.');
            $this->redirect('@producto_listaNegraProducto');
        }

        //make contest as featured
        $product->setFeatured(true);
        $product->save();
        $this->getUser()->setFlash('notice', 'Producto añadido a la Home');
        $this->redirect('@producto_listaNegraProducto');
    }

    /**
     * Remove selected balcklist product from homepage
     * @param sfWebRequest $request
     */
    public function executeRemoveFeatured(sfWebRequest $request) {
        //get product id
        $product_id = $request->getParameter('id');
        //get contest
        $product = Doctrine::getTable('Producto')->find($product_id);

        $product->setFeatured(false);
        $product->setFeaturedOrder(null);
        $product->save();
        $this->redirect('producto_listaNegraProducto');
    }

    /**
     * Set selected balcklist product as featured order for homepage
     * @param sfWebRequest $request
     */
    public function executeSetFeaturedOrder(sfWebRequest $request) {
        //get product id
        $this->product_id = $request->getParameter('id');
        //get contest
        $product = Doctrine::getTable('Producto')->find($this->product_id);
        if ($product) {
            if ($product->getFeatured()) {
                $this->product_featured_order = $product->getFeaturedOrder() ? $product->getFeaturedOrder() : '';
                $this->error_message = null;
                //if form is submitted
                if ($request->getMethod() == sfWebRequest::POST) {
                    //get contest featured order value
                    $this->product_featured_order = intval($request->getParameter('featured_order'));
                    //validated value
                    if ($this->product_featured_order && $this->product_featured_order > 0 && $this->product_featured_order <= 10) {
                        //save contest
                        $product->setFeaturedOrder($this->product_featured_order);
                        $product->save();
                        $this->getUser()->setFlash('notice', 'Has asignado el orden número ' . $this->product_featured_order . ' a este elemento de la Home');
                        $this->redirect('producto_listaNegraProducto');
                    } else {
                        $this->error_message = 'Sólo puedes introducir números.';
                    }
                }
            } else {
                $this->getUser()->setFlash('alert', 'Para asignar un orden a un elemento de la Home, necesitas primero destacarlo.');
                $this->redirect('producto_listaNegraProducto');
            }
        }
    }

}
