<?php

require_once dirname(__FILE__) . '/../lib/contratanos_professionalGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contratanos_professionalGeneratorHelper.class.php';

/**
 * contratanos_professional actions.
 *
 * @package    symfony
 * @subpackage contratanos_professional
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contratanos_professionalActions extends autoContratanos_professionalActions {

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
        $query->andWhere('form_type = 2');
        
        $this->addSortQuery($query);
        
        
        $filter_column = $this->getUser()->getAttribute('contratanos_professional.filters', null, 'admin_module');

        $this->filtershow = $filter_column;
        
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
        $this->forward404Unless($contactanos = Doctrine::getTable('Contratanos')->find($request_id));

        $contactanos->setStatus(2);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Solicitud tramitada.');
        $this->redirect('contratanos_contratanos_professional');
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
        $this->redirect('contratanos_contratanos_professional');
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
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, 'Contratanos');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($contratanos->getAyudar()));


        $pdf->Output(sprintf('audit_' . rand(1, 10000) . '.pdf'), 'D');
        throw new sfStopException();
    }

    /**
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowPlan(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->forward404Unless($this->contractanos = Doctrine::getTable('Contratanos')->findOneBy('id', $request->getParameter('id')));
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
      //  $this->form->setValidator('cargo', new sfValidatorString(array('required' => true), array('required' => __('No has incluido tu cargo.'))));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));


        $this->contratanos = $this->form->getObject();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
      //  $this->form->setValidator('cargo', new sfValidatorString(array('required' => true), array('required' => __('No has incluido tu cargo.'))));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));

        $parameters = $request->getParameter($this->form->getName());

        if ($parameters['eres'] == 2) {
            $this->form->setValidator('empresa', new sfValidatorString(array('required' => true), array('required' => __('No has incluido una empresa o entidad.'))));
        }
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
    //    $this->form->setValidator('cargo', new sfValidatorString(array('required' => true), array('required' => __('No has incluido tu cargo.'))));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));

        $parameters = $request->getParameter($this->form->getName());

        if ($parameters['eres'] == 2) {
           $this->form->setValidator('empresa', new sfValidatorString(array('required' => true), array('required' => __('No has incluido una empresa o entidad.'))));
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->contratanos = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->contratanos);

        $this->form->setValidator('eres', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        $this->form->setValidator('cif', new sfValidatorString(array('required' => false), array()));
    //    $this->form->setValidator('cargo', new sfValidatorString(array('required' => true), array('required' => __('No has incluido tu cargo.'))));
        $this->form->setValidator('ayudar', new sfValidatorString(array('required' => false), array()));

        $parameters = $request->getParameter($this->form->getName());

        if ($parameters['eres'] == 2) {
            $this->form->setValidator('empresa', new sfValidatorString(array('required' => true), array('required' => __('No has incluido una empresa o entidad.'))));
        }
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
                $contratanos->setFormType("2");
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

                $this->redirect('@contratanos_contratanos_professional_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'contratanos_contratanos_professional'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
