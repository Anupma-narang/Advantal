<?php

require_once dirname(__FILE__) . '/../lib/product_case_studyGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/product_case_studyGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * product_case_study actions.
 *
 * @package    symfony
 * @subpackage product_case_study
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class product_case_studyActions extends autoProduct_case_studyActions {

    public function executeShow(sfWebRequest $request) {
        $this->product = $this->getRoute()->getObject();
    }

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'sector':
                $sort[0] = 'esu.name';
                break;
            case 'sub_sector':
                $sort[0] = 'esd.name';
                break;
            case 'tipo':
                $sort[0] = 'est.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('ProductCaseStudy')->hasColumn($column) || $column == 'sector' || $column == 'sub_sector' || $column == 'tipo';
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('product_case_study.filters', null, 'admin_module');

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
     * change status to processed
     * @param sfWebRequest $request
     */
    public function executeProcessed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($product = Doctrine::getTable('ProductCaseStudy')->find($request_id));

        $product->setStatus(2);
        $product->save();

        $this->getUser()->setFlash('notice', 'Caso de éxito tramitado.');
        $this->redirect('product_case_study');
    }

    /**
     * change status to closed
     * @param sfWebRequest $request
     */
    public function executeClosed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($product = Doctrine::getTable('ProductCaseStudy')->find($request_id));

        $product->setStatus(3);
        $product->save();

        $this->getUser()->setFlash('notice', 'Caso de éxito cerrado.');
        $this->redirect('product_case_study');
    }

    /**
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowDescription(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->forward404Unless($this->product = Doctrine::getTable('ProductCaseStudy')->findOneBy('id', $request->getParameter('id')));
    }

    /**
     * allow user to download the user comment in PDF format 
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadCompanyPdf(sfWebRequest $request) {
        $this->forward404Unless($product = Doctrine::getTable('ProductCaseStudy')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Producto: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(22, 100, 148);
        $pdf->Write(5, $product->getName());
        $pdf->SetTextColor(0, 0, 0);
        if ($product->getMarca()) :
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Write(5, __('Marca: '));
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(22, 100, 148);
            $pdf->Write(5, $product->getMarca());
        endif;
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Modelo: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $product->getModelo());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Tipo de producto: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(246, 94, 19);
        $pdf->Write(5, $product->getTipo());
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 55, 410);
        $pdf->Ln(14);


        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, 'DESCRIPCIÓN DEL CASO DE ÉXITO');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($product->getDescription()));


        $pdf->Output(sprintf('product_' . rand(1, 10000) . '.pdf'), 'D');
        throw new sfStopException();
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $product_case_study = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $product_case_study)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@product_case_study_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect('@product_case_study');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}