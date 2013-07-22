<?php

require_once dirname(__FILE__) . '/../lib/empresaListaBlancaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/empresaListaBlancaGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * empresaListaBlanca actions.
 *
 * @package    symfony
 * @subpackage empresaListaBlanca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empresaListaBlancaActions extends autoEmpresaListaBlancaActions {

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


        $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit('lb');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            //show company contest error message
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
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
            case 'states_name':
                $sort[0] = 's.name';
                break;
            case 'sector_name':
                $sort[0] = 'esu.name';
                break;
            case 'subsector_name':
                $sort[0] = 'esd.name';
                break;
            case 'tressector':
                $sort[0] = 'est.name';
                break;
            case 'localidad_name':
                $sort[0] = 'l.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Empresa')->hasColumn($column) || $column == 'states_name' || $column == 'sector_name' || $column == 'subsector_name' || $column == 'tressector' || $column == 'localidad_name';
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

        $filter_column = $this->getUser()->getAttribute('empresaListaBlanca.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $query->addWhere("lista = 'lb'");
        
        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }


//        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeAutocompleteDireccion(sfWebRequest $request) {
        $results = EmpresaTable::getInstance()->getAutocompleteDireccion($request->getParameter('q'));

        foreach ($results as $result) {
            $html[] = $result['direccion'];
        }

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($html));
    }

    public function executeAutocompleteName(sfWebRequest $request) {
        $results = EmpresaTable::getInstance()->getAutocompleteName($request->getParameter('q'));
        $html = array();
        foreach ($results as $result) {
            $html[] = $result['name'];
        }
        ProjectUtility::decorateJsonResponse($this->getResponse());

        return $this->renderText(json_encode($html));
    }

    /**
     * Muestra todos las respuestas a los cuestionarios
     *
     * @param sfWebRequest $request
     */
    public function executeListCuestionarios(sfWebRequest $request) {
        $empresa = Doctrine_Core::getTable('Empresa')->find($request->getParameter('id'));
        $this->respuestas = $empresa->getCuestionarios($request->getParameter('aprobados', 1));
    }

    /**
     *
     */
    public function executeShow(sfWebRequest $request) {
        $this->empresa = Doctrine_Core::getTable('Empresa')->find($request->getParameter('id'));

        // Pagination
        $q = Doctrine::getTable('ListaCuestionarioUser')->createQuery()->orderBy('id DESC')->where('aprobado = ?', true)
                ->andWhere('empresa_id =?', $request->getParameter('id'));

        $this->pager = new sfDoctrinePager('ListaCuestionarioUser', 25);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();

        // Pagination of pending comment
        $qp = Doctrine::getTable('ListaCuestionarioUser')->createQuery()->orderBy('id DESC')->where('aprobado = ?', false)
                ->andWhere('empresa_id =?', $request->getParameter('id'));

        $this->pager_pending = new sfDoctrinePager('ListaCuestionarioUser', 25);
        $this->pager_pending->setQuery($qp);
        $this->pager_pending->setPage($request->getParameter('pg', 1));
        $this->pager_pending->init();

        $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit('lb');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            //show company contest error message
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeDestacadoManager(sfWebRequest $request) {
        $this->empresa = Doctrine_Core::getTable('Empresa')->find($request->getParameter('id'));
    }

    /**
     * Añade o quita la empresa como destacada
     *
     * @param sfWebRequest $request
     */
    public function executeToggleDestacar(sfWebRequest $request) {

        $tipo = $request->getParameter('tipo');
        /** @var Empresa $empresa  */
        $empresa = Doctrine_Core::getTable('Empresa')->find($request->getParameter('id'));

        switch ($tipo) {
            case 'sector':
                if ($empresa->isDestacadaPorSector()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndSector($request->getParameter('id'));
                    $empresaDestacada->delete();
                    return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                } else {
                    //test if there're 5...
                    if (Doctrine_Core::getTable('EmpresaDestacada')->countEmpresaSector($empresa) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 empresas/entidades por actividad');
                        return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                    }
                    $empresaDestacada = $this->prepareEmpresaDestacada($request->getParameter('id'));
                    if (!$empresa->getEmpresaSectorTres()->isNew()) {
                        $empresaDestacada->setEmpresaSectorTresId($empresa->getEmpresaSectorTres()->getId());
                    } else {
                        $empresaDestacada->setEmpresaSectorDosId($empresa->getEmpresaSectorDos()->getId());
                    }
                }

                break;

            case 'provincia':
                if ($empresa->isDestacadaPorProvincia()) {

                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndProvincia($request->getParameter('id'));
                    $empresaDestacada->delete();

                    return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                } else {
                    //test if there're 5...
                    if (Doctrine_Core::getTable('EmpresaDestacada')->countEmpresaProvincia($empresa->getStatesId()) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 empresas/entidades por provincia');
                        return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                    }

                    $empresaDestacada = $this->prepareEmpresaDestacada($request->getParameter('id'));
                    $empresaDestacada->setStatesId($empresa->getStatesId());
                }

                break;

            case 'localidad':
                if ($empresa->isDestacadaPorLocalidad()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndLocalidad($request->getParameter('id'));
                    $empresaDestacada->delete();
                    return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                } else {
                    if (Doctrine_Core::getTable('EmpresaDestacada')->countEmpresaLocalidad($empresa->getLocalidadId()) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 empresas/entidades por localidad');
                        return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                    }
                    $empresaDestacada = $this->prepareEmpresaDestacada($request->getParameter('id'));
                    $empresaDestacada->setLocalidadId($empresa->getLocalidadId());
                    $empresaDestacada->setCombinado(Empresa::COMBINADO_NULO);
                }
                break;

            case 'sector_provincia':
                if ($empresa->isDestacadaPorSectorProvincia()) {
                    //borra destacado
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndSectorProvincia($request->getParameter('id'));
                    $empresaDestacada->delete();
                    return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                } else {
                    if (Doctrine_Core::getTable('EmpresaDestacada')->countEmpresaSectorProvincia($empresa) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 empresas/entidades por actividad y provincia');
                        return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                    }
                    $empresaDestacada = $this->prepareEmpresaDestacada($request->getParameter('id'));
                    $empresaDestacada->setStatesId($empresa->getStatesId());
                    $empresaDestacada->setCombinado(Empresa::COMBINADO_PROVINCIA);
                    if (!$empresa->getEmpresaSectorTres()->isNew()) {
                        $empresaDestacada->setEmpresaSectorTresId($empresa->getEmpresaSectorTres()->getId());
                    } else {
                        $empresaDestacada->setEmpresaSectorDosId($empresa->getEmpresaSectorDos()->getId());
                    }
                }
                break;

            case 'sector_localidad':
                if ($empresa->isDestacadaPorSectorLocalidad()) {
                    //borra destacado
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndSectorLocalidad($request->getParameter('id'));
                    $empresaDestacada->delete();
                    return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                } else {
                    if (Doctrine_Core::getTable('EmpresaDestacada')->countEmpresaSectorLocalidad($empresa) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 empresas/entidades por actividad y localidad');
                        return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
                    }
                    $empresaDestacada = $this->prepareEmpresaDestacada($request->getParameter('id'));
                    $empresaDestacada->setLocalidadId($empresa->getLocalidadId());
                    $empresaDestacada->setCombinado(Empresa::COMBINADO_LOCALIDAD);
                    if (!$empresa->getEmpresaSectorTres()->isNew()) {
                        $empresaDestacada->setEmpresaSectorTresId($empresa->getEmpresaSectorTres()->getId());
                    } else {
                        $empresaDestacada->setEmpresaSectorDosId($empresa->getEmpresaSectorDos()->getId());
                    }
                }
                break;
        }

        $empresaDestacada->setRank(EmpresaDestacadaTable::getLastRank($empresa, $tipo) + 1);
        $empresaDestacada->save();

        return $this->redirect('empresa_show_destacados', array('id' => $empresa->getId()));
    }

    private function populateDestacar($tipo, $id) {
        /** @var Empresa $empresa  */
        $empresa = Doctrine_Core::getTable('Empresa')->find($id);

        switch ($tipo) {
            case 'sector':
                if ($empresa->isDestacadaPorSector()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndSector($id);
                    $empresaDestacada = $empresaDestacada[0];
                } else {
                    $empresaDestacada = $this->prepareEmpresaDestacada($id);
                    if (!$empresa->getEmpresaSectorTres()->isNew()) {
                        $empresaDestacada->setEmpresaSectorTresId($empresa->getEmpresaSectorTres()->getId());
                    } else {
                        $empresaDestacada->setEmpresaSectorDosId($empresa->getEmpresaSectorDos()->getId());
                    }
                }
                break;

            case 'provincia':
                if ($empresa->isDestacadaPorProvincia()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndProvincia($id);
                    $empresaDestacada = $empresaDestacada[0];
                } else {
                    $empresaDestacada = $this->prepareEmpresaDestacada($id);
                    $empresaDestacada->setStatesId($empresa->getStatesId());
                }

                break;

            case 'localidad':
                if ($empresa->isDestacadaPorLocalidad()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndLocalidad($id);
                    $empresaDestacada = $empresaDestacada[0];
                } else {
                    $empresaDestacada = $this->prepareEmpresaDestacada($id);
                    $empresaDestacada->setLocalidadId($empresa->getLocalidadId());
                    $empresaDestacada->setCombinado(Empresa::COMBINADO_NULO);
                }
                break;

            case 'sector_provincia':
                if ($empresa->isDestacadaPorSectorProvincia()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndSectorProvincia($id);
                    $empresaDestacada = $empresaDestacada[0];
                } else {
                    $empresaDestacada = $this->prepareEmpresaDestacada($id);
                    $empresaDestacada->setStatesId($empresa->getStatesId());
                    $empresaDestacada->setCombinado(Empresa::COMBINADO_PROVINCIA);
                    if (!$empresa->getEmpresaSectorTres()->isNew()) {
                        $empresaDestacada->setEmpresaSectorTresId($empresa->getEmpresaSectorTres()->getId());
                    } else {
                        $empresaDestacada->setEmpresaSectorDosId($empresa->getEmpresaSectorDos()->getId());
                    }
                }
                break;
            case 'sector_localidad':
                if ($empresa->isDestacadaPorSectorLocalidad()) {
                    $empresaDestacada = Doctrine_Core::getTable('EmpresaDestacada')->findByEmpresaIdAndSectorLocalidad($id);
                    $empresaDestacada = $empresaDestacada[0];
                } else {
                    $empresaDestacada = $this->prepareEmpresaDestacada($id);
                    $empresaDestacada->setLocalidadId($empresa->getLocalidadId());
                    $empresaDestacada->setCombinado(Empresa::COMBINADO_LOCALIDAD);
                    if (!$empresa->getEmpresaSectorTres()->isNew()) {
                        $empresaDestacada->setEmpresaSectorTresId($empresa->getEmpresaSectorTres()->getId());
                    } else {
                        $empresaDestacada->setEmpresaSectorDosId($empresa->getEmpresaSectorDos()->getId());
                    }
                }
                break;
        }

        if (($empresaDestacada)) {
            $empresaDestacada->setRank(EmpresaDestacadaTable::getLastRank($empresa, $tipo) + 1);
            $empresaDestacada->save();
        }
    }

    public function executeShowListaNegraPor(sfWebRequest $request) {
        $this->forward404Unless($this->empresa = Doctrine::getTable('Empresa')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowComentarioInicial(sfWebRequest $request) {
        $this->forward404Unless($this->empresa = Doctrine::getTable('Empresa')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeDownload_pdf(sfWebRequest $request) {
        $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Empresa/Entidad: '));
        $pdf->SetTextColor(22, 100, 148);
        $pdf->Write(5, $empresa->getName());
        $pdf->SetTextColor(0, 0, 0);
        if ($empresa->getRoadType()->getId()) :
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Write(5, __('Tipo de vía: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $empresa->getRoadType());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Dirección: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $empresa->getDireccion());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Nº: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $empresa->getNumero());
        if ($empresa->getPiso()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Piso: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $empresa->getPiso());
        endif;
        if ($empresa->getPuerta()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Puerta: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $empresa->getPuerta());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        if ($empresa->getCpMunicipioProvincia()) :
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Localidad: '));
            $pdf->SetTextColor(66, 157, 41);
            $pdf->Write(5, $empresa->getCpMunicipioProvincia());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        if ($empresa->getEmpresaSectorTres()->getId()) :
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Actividad: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $empresa->getEmpresaSectorTres());
        else:
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Actividad: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $empresa->getEmpresaSectorDos());
        endif;
        if ($empresa->getPiso() && $empresa->getPuerta()):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 81, 410);
            $pdf->Ln(14);
        elseif ((!$empresa->getPuerta() && $empresa->getPiso()) || ($empresa->getPuerta() && !$empresa->getPiso())):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 75, 410);
            $pdf->Ln(14);
        elseif (!$empresa->getPuerta() && !$empresa->getPiso()):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 69, 410);
            $pdf->Ln(14);
        endif;

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, __('LISTA NEGRA: POR QUÉ APARECE AQUÍ'));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->WriteHTML(html_entity_decode($empresa->getTextoListaNegra()));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Output(sprintf($empresa->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    public function executeDownload_pdfComentario(sfWebRequest $request) {
        $this->forward404Unless($empresa = Doctrine::getTable('Empresa')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Empresa/Entidad: '));
        $pdf->SetTextColor(22, 100, 148);
        $pdf->Write(5, $empresa->getName());
        $pdf->SetTextColor(0, 0, 0);
        if ($empresa->getRoadType()->getId()) :
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Write(5, __('Tipo de vía: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $empresa->getRoadType());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Dirección: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $empresa->getDireccion());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Nº: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $empresa->getNumero());
        if ($empresa->getPiso()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Piso: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $empresa->getPiso());
        endif;
        if ($empresa->getPuerta()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Puerta: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $empresa->getPuerta());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        if ($empresa->getCpMunicipioProvincia()) :
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Localidad: '));
            $pdf->SetTextColor(66, 157, 41);
            $pdf->Write(5, $empresa->getCpMunicipioProvincia());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        if ($empresa->getEmpresaSectorTres()->getId()) :
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Actividad: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $empresa->getEmpresaSectorTres());
        else:
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Actividad: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $empresa->getEmpresaSectorDos());
        endif;
        if ($empresa->getPiso() && $empresa->getPuerta()):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 81, 410);
            $pdf->Ln(14);
        elseif ((!$empresa->getPuerta() && $empresa->getPiso()) || ($empresa->getPuerta() && !$empresa->getPiso())):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 75, 410);
            $pdf->Ln(14);
        elseif (!$empresa->getPuerta() && !$empresa->getPiso()):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 69, 410);
            $pdf->Ln(14);
        endif;

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, __('COMENTARIO INICIAL'));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->WriteHTML(html_entity_decode($empresa->getComentarioInicial()));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Output(sprintf($empresa->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    protected function prepareEmpresaDestacada($id) {
        $empresaDestacada = new EmpresaDestacada();
        $empresaDestacada->setEmpresaId($id);
        return $empresaDestacada;
    }

    public function executeSortDestacado(sfWebRequest $request) {
        $empresas = $request->getParameter('elements');
        $empresas = array_map(function ($value) {
                    return substr($value, 8);
                }, $empresas);
        $params = substr($request->getParameter('type'), 10);
        preg_match('#([A-Za-z_]+)_([0-9]+)#', $params, $type);
        EmpresaDestacadaTable::getInstance()->setOrder($type[1], $type[2], $empresas);

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText('');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            $values = $request->getParameter($form->getName());
            try {
                $empresa = $form->save();

                //Deven: 2.13) Add the field Destacada (“Highlighted”) 
                //$this->populateDestacar($values['destacada'], $empresa->getId());
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $empresa)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@empresa_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect(array('sf_route' => 'empresa_lista_blanca'));
            }
        } else {
            $gform = $form->getEmbeddedForm('googleMap');
            $gformValues = $form->getTaintedValues();
            $gform->setDefaults(array('address' => 'de'));
            $gform->bind($gformValues['googleMap'], array());
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        //test if there a product with this cuestionario
        $empresa = $this->getRoute()->getObject();
        try {
            $empresa->delete();
            $this->getUser()->setFlash('notice', 'Se ha borrado la empresa correctamente.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'No se puede borrar esta empresa/entidad porque tiene concursos, auditorías o comentarios asociados.');
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));


        $this->redirect('@empresa_lista_blanca');
    }

    /**
     * Set selected whitelist company as featured on homepage
     * @param sfWebRequest $request
     */
    public function executeSetFeatured(sfWebRequest $request) {
        //get company id
        $company_id = $request->getParameter('id');
        //get contest
        $company = Doctrine::getTable('Empresa')->find($company_id);
        //get featured limit
        $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit($company->getLista());

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            //show company contest error message
            $this->getUser()->setFlash('alert', 'No puedes destacar más de 10 empresas o entidades de la Lista blanca en la Home.');
            $this->redirect('empresa_lista_blanca');
        }

        //make contest as featured
        $company->setFeatured(true);
        $company->save();
        $this->getUser()->setFlash('notice', 'Empresa o Entidad añadida a la Home');
        $this->redirect('empresa_lista_blanca');
    }

    /**
     * Remove selected whitelist company from homepage
     * @param sfWebRequest $request
     */
    public function executeRemoveFeatured(sfWebRequest $request) {
        //get company id
        $company_id = $request->getParameter('id');
        //get contest
        $company = Doctrine::getTable('Empresa')->find($company_id);
        $company->setFeatured(false);
        $company->setFeaturedOrder(null);
        $company->save();
        $this->getUser()->setFlash('notice', 'Añadido ofrecido como en la página web');
        $this->redirect('empresa_lista_blanca');
    }

    /**
     * Set selected white list company as featured order for homepage
     * @param sfWebRequest $request
     */
    public function executeSetFeaturedOrder(sfWebRequest $request) {
        //get company id
        $this->company_id = $request->getParameter('id');
        //get contest
        $company = Doctrine::getTable('Empresa')->find($this->company_id);
        if ($company) {
            if ($company->getFeatured()) {
                $this->company_featured_order = $company->getFeaturedOrder() ? $company->getFeaturedOrder() : '';
                $this->error_message = null;
                //if form is submitted
                if ($request->getMethod() == sfWebRequest::POST) {
                    //get contest featured order value
                    $this->company_featured_order = intval($request->getParameter('featured_order'));

                    //validated value
                    if ($this->company_featured_order && $this->company_featured_order > 0 && $this->company_featured_order <= 10) {
                        //save contest
                        $company->setFeaturedOrder($this->company_featured_order);

                        $company->save();
                        $this->getUser()->setFlash('notice', 'Has asignado el orden número ' . $this->company_featured_order . ' a este elemento de la Home');
                        $this->redirect('empresa_lista_blanca');
                    } else {
                        $this->error_message = 'Sólo puedes introducir números.';
                    }
                }
            } else {
                $this->getUser()->setFlash('alert', 'Para asignar un orden a un elemento de la Home, necesitas primero destacarlo.');
                $this->redirect('empresa_lista_blanca');
            }
        }
    }

}
