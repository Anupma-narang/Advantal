<?php

require_once dirname(__FILE__) . '/../lib/contratanosGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contratanosGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * contratanos actions.
 *
 * @package    symfony
 * @subpackage contratanos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contratanosActions extends autoContratanosActions {

    public function executeShow(sfWebRequest $request) {
        $this->contratanos = $this->getRoute()->getObject();
    }

    public function executeIndex(sfWebRequest $request) {
        //set type parameters
        $this->type = $request->getParameter('type', 'company');
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

    protected function getPager() {
        $pager = $this->configuration->getPager('contratanos');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
        $query->andWhere('form_type = 1');

        $this->addSortQuery($query);

        $filter_column = $this->getUser()->getAttribute('contratanos.filters', null, 'admin_module');
        $this->filtershow = $filter_column;

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
        $this->forward404Unless($contactanos = Doctrine::getTable('Contratanos')->find($request_id));

        $contactanos->setStatus(2);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Solicitud tramitada.');
        $this->redirect('contratanos');
    }

    /**
     * change status to closed
     * @param sfWebRequest $request
     */
    public function executeClosed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('Contratanos')->find($request_id));

        $contactanos->setStatus(3);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Solicitud cerrada.');
        $this->redirect('contratanos');
    }

    /**
     * allow user to download the user comment in PDF format
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadCompanyPdf(sfWebRequest $request) {
        $this->forward404Unless($contratanos = Doctrine::getTable('Contratanos')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Nombre: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(255, 25, 25);
        $pdf->Write(5, $contratanos->getNombre());
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Apellido 1: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(255, 25, 25);
        $pdf->Write(5, $contratanos->getApellido1());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Apellido 2: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(255, 25, 25);
        $pdf->Write(5, $contratanos->getApellido2());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Localidad: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(66, 157, 141);
        $pdf->Write(5, $contratanos->getCpMunicipioProvincia());
        $pdf->Ln(6);

        if ($contratanos->getName()) {
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Empresa/Entidad: '));
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(22, 100, 148);
            $pdf->Write(5, $contratanos->getName());
            $pdf->Ln(6);
        }

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Actividad: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(246, 94, 19);
        $pdf->Write(5, $contratanos->getActividad());
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Correo electrónico: '));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $contratanos->getEmail());
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 75, 410);
        $pdf->Ln(14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, __('COMENTARIO'));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->WriteHTML(html_entity_decode($contratanos->getAyudar()));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Output(sprintf('audit_' . rand(1, 10000) . '.pdf'), 'D');
        throw new sfStopException();
    }

    /**
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowPlan(sfWebRequest $request) {
        //$this->setLayout(false);
        $this->forward404Unless($this->contractanos = Doctrine::getTable('Contratanos')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cargo', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));


        $this->contratanos = $this->form->getObject();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
        //$this->form->setValidator('cargo', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));


        $this->contratanos = $this->form->getObject();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->contratanos = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->contratanos);

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
        //$this->form->setValidator('cargo', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->contratanos = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->contratanos);

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cargo', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));


        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $created_at = "";
        if (!$form->getObject()->isNew()) {
            $admin_record = $form->getObject();
            $created_at = $admin_record->getCreatedAt();
        }

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $contratanos = $form->save();
                $contratanos->setFormType("1");
                if ($form->getObject()->isNew()) {
                    $contratanos->setCreatedAt(date('Y-m-d H:i:s'));
                } else {
                    $contratanos->setCreatedAt($created_at);
                }
                $contratanos->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $contratanos)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@contratanos_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'contratanos'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
