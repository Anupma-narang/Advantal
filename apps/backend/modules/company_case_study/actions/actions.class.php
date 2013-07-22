<?php

require_once dirname(__FILE__) . '/../lib/company_case_studyGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/company_case_studyGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * company_case_study actions.
 *
 * @package    symfony
 * @subpackage company_case_study
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class company_case_studyActions extends autoCompany_case_studyActions {

    /**
     * change status to processed
     * @param sfWebRequest $request
     */
    public function executeProcessed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('CompanyCaseStudy')->find($request_id));

        $contactanos->setStatus(2);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Caso de éxito tramitado.');
        $this->redirect('company_case_study');
    }

    /**
     * change status to closed
     * @param sfWebRequest $request
     */
    public function executeClosed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('CompanyCaseStudy')->find($request_id));

        $contactanos->setStatus(3);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Caso de éxito cerrado.');
        $this->redirect('company_case_study');
    }

    public function executeShow(sfWebRequest $request) {
        $this->company = $this->getRoute()->getObject();
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('company_case_study.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

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
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowDescription(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->forward404Unless($this->company = Doctrine::getTable('CompanyCaseStudy')->findOneBy('id', $request->getParameter('id')));
    }

    /**
     * allow user to download the user comment in PDF format 
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadCompanyPdf(sfWebRequest $request) {
        $this->forward404Unless($company = Doctrine::getTable('CompanyCaseStudy')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Empresa/Entidad: '));
        $pdf->SetTextColor(22, 100, 148);
        $pdf->Write(5, $company->getName());
        $pdf->SetTextColor(0, 0, 0);
        if ($company->getRoadType()->getId()) :
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Write(5, __('Tipo de vía: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $company->getRoadType());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Dirección: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $company->getDireccion());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Nº: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $company->getNumero());
        if ($company->getPiso()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Piso: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $company->getPiso());
        endif;
        if ($company->getPuerta()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Puerta: '));
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $company->getPuerta());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        if ($company->getMunicipioProvincia()) :
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Localidad: '));
            $pdf->SetTextColor(66, 157, 41);
            $pdf->Write(5, $company->getMunicipioProvincia());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        if ($company->getEmpresaSectorTres()->getId()) :
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Actividad: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $company->getEmpresaSectorTres());
        else:
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Actividad: '));
            $pdf->SetTextColor(246, 94, 19);
            $pdf->Write(5, $company->getEmpresaSectorDos());
        endif;
        if ($company->getPiso() && $company->getPuerta()):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 81, 410);
            $pdf->Ln(14);
        elseif ((!$company->getPuerta() && $company->getPiso()) || ($company->getPuerta() && !$company->getPiso())):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 75, 410);
            $pdf->Ln(14);
        elseif (!$company->getPuerta() && !$company->getPiso()):
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 69, 410);
            $pdf->Ln(14);
        endif;

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, 'DESCRIPCIÓN DEL CASO DE ÉXITO');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($company->getDescription()));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Output(sprintf('compnay_' . rand(1, 10000) . '.pdf'), 'D');
        throw new sfStopException();
    }

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'Statesname':
                $sort[0] = 's.name';
                break;
            case 'CityName':
                $sort[0] = 'c.name';
                break;
            case 'SectorName':
                $sort[0] = 'esu.name';
                break;
            case 'SubSectorName':
                $sort[0] = 'esd.name';
                break;
            case 'ActividadName':
                $sort[0] = 'est.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('CompanyCaseStudy')->hasColumn($column) || $column == 'Statesname' || $column == 'CityName' || $column == 'SectorName' || $column == 'SubSectorName' || $column == 'ActividadName';
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $company_case_study = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $company_case_study)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@company_case_study_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect('@company_case_study');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
