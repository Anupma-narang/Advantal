<?php

require_once dirname(__FILE__) . '/../lib/listaNegraEmpresaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/listaNegraEmpresaGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * listaNegraEmpresa actions.
 *
 * @package    symfony
 * @subpackage listaNegraEmpresa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaNegraEmpresaActions extends autoListaNegraEmpresaActions {

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

        $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit('ln');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
    }

    public function executeComentariosPendientes(sfWebRequest $request) {
        $this->comentarios = ComentarioListaNegraTable::getInstance()->findByAprobado(false);
        if ($this->comentarios->count() == 0) {
            return $this->renderText('<ul><li>No existen datos.</li></ul>');
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->empresa = Doctrine_Core::getTable('Empresa')->find($request->getParameter('id'));
        $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit('ln');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }

        // Pagination
        $q = Doctrine_Query::create()->from('ComentarioListaNegra r')
                ->select('r.id, r.comentario, r.updated_at, u.username')
                ->leftJoin('r.User u')
                ->where('r.empresa_id = ?', $request->getParameter('id'))
                ->andWhere('r.aprobado = ?', 1)
                ->orderBy('r.id ' . 'DESC');

        $this->pager = new sfDoctrinePager('ComentarioListaNegra', 25);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();

        $qp = Doctrine_Query::create()->from('ComentarioListaNegra r')
                ->select('r.id, r.comentario, r.updated_at, u.username')
                ->leftJoin('r.User u')
                ->where('r.empresa_id = ?', $request->getParameter('id'))
                ->andWhere('r.aprobado = ?', 0)
                ->orderBy('r.id ' . 'DESC');

        $this->pager_pending = new sfDoctrinePager('ComentarioListaNegra', 25);
        $this->pager_pending->setQuery($qp);
        $this->pager_pending->setPage($request->getParameter('pg', 1));
        $this->pager_pending->init();
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
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('listaNegraEmpresa.filters', null, 'admin_module');

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

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $empresa = $form->save();
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

                $this->redirect('@lista_negra_empresa_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                if ($empresa->getLista() == 'lb') {
                    $this->redirect(array('sf_route' => 'empresa_lista_blanca'));
                } elseif ($empresa->getLista() == 'ln') {
                    $this->redirect(array('sf_route' => 'lista_negra_empresa'));
                } else {
                    $this->redirect(array('sf_route' => 'empresa'));
                }
            }
        } else {
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


        $this->redirect('@lista_negra_empresa');
    }

    /**
     * remove selected whitelist company from homepage
     * @param sfWebRequest $request
     */
    public function executeRemoveFeatured(sfWebRequest $request) {
        //get company id
        $company_id = $request->getParameter('id');
        //get contest
        $company = Doctrine::getTable('Empresa')->find($company_id);
        //get featured limit
        $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit($company->getLista());

        $company->setFeatured(false);
        $company->setFeaturedOrder(null);
        $company->save();
        $this->redirect('lista_negra_empresa');
    }

    public function executeShowListaNegraPor(sfWebRequest $request) {
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
                        $this->redirect('lista_negra_empresa');
                    } else {
                        $this->error_message = 'Sólo puedes introducir números.';
                    }
                }
            } else {
                $this->getUser()->setFlash('alert', 'Para asignar un orden a un elemento de la Home, necesitas primero destacarlo.');
                $this->redirect('lista_negra_empresa');
            }
        }
    }

}
