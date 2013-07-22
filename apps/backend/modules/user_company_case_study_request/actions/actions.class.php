<?php

require_once dirname(__FILE__) . '/../lib/user_company_case_study_requestGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/user_company_case_study_requestGeneratorHelper.class.php';

/**
 * user_company_case_study_request actions.
 *
 * @package    symfony
 * @subpackage user_company_case_study_request
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class user_company_case_study_requestActions extends autoUser_company_case_study_requestActions {

    protected function buildQuery()
    {
      $tableMethod = $this->configuration->getTableMethod();
      if (null === $this->filters)
      {
        $this->filters = $this->configuration->getFilterForm($this->getFilters());
      }

      $this->filters->setTableMethod($tableMethod);
      
      $filter_column = $this->getUser()->getAttribute('user_company_case_study_request.filters', null, 'admin_module');
      $this->filtershow = $filter_column;

      $query = $this->filters->buildQuery($this->getFilters());
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


    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'States':
                $sort[0] = 's.name';
                break;
            case 'city_id':
                $sort[0] = 'c.name';
                break;
            case 'empresa_sector_uno_id':
                $sort[0] = 'esu.name';
                break;
            case 'empresa_sector_dos_id':
                $sort[0] = 'esd.name';
                break;
            case 'empresa_sector_tres_id':
                $sort[0] = 'est.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('UserCompanyCaseStudy')->hasColumn($column) || $column == 'States' || $column == 'city_id' || $column == 'empresa_sector_uno_id' || $column == 'empresa_sector_dos_id' || $column == 'empresa_sector_tres_id';
    }

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
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $user_company_case_study_request = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $user_company_case_study_request)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@user_company_case_study_request_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'user_company_case_study_request'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    /**
     * change status to processed
     * @param sfWebRequest $request
     */
    public function executeProcessed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('UserCompanyCaseStudyRequest')->find($request_id));

        $contactanos->setStatus(2);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Caso de éxito tramitado.');
        $this->redirect('user_company_case_study_request');
    }

    /**
     * change status to closed
     * @param sfWebRequest $request
     */
    public function executeClosed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('UserCompanyCaseStudyRequest')->find($request_id));

        $contactanos->setStatus(3);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Caso de éxito cerrado.');
        $this->redirect('user_company_case_study_request');
    }

    public function executeShow(sfWebRequest $request) {
        $this->company = $this->getRoute()->getObject();
    }

    /**
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowDescription(sfWebRequest $request) {
        $this->forward404Unless($this->company = Doctrine::getTable('UserCompanyCaseStudyRequest')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    /**
     * allow user to download the user comment in PDF format
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadCompanyPdf(sfWebRequest $request) {
        $this->forward404Unless($company = Doctrine::getTable('UserCompanyCaseStudyRequest')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, 'Detalle del caso de éxito de Empresa/Entidad');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($company->getDescription()));


        $pdf->Output(sprintf('compnay_request_' . rand(1, 10000) . '.pdf'), 'D');
        throw new sfStopException();
    }

}
