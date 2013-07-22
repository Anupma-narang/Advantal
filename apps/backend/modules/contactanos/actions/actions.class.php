<?php

require_once dirname(__FILE__) . '/../lib/contactanosGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contactanosGeneratorHelper.class.php';

/**
 * contactanos actions.
 *
 * @package    symfony
 * @subpackage contactanos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactanosActions extends autoContactanosActions {

    public function executeShow(sfWebRequest $request) {
        $this->contactanos = $this->getRoute()->getObject();
    }

    /**
     * change status to processed
     * @param sfWebRequest $request
     */
    public function executeProcessed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('Contactanos')->find($request_id));

        $contactanos->setStatus(2);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Correo procesado.');
        $this->redirect('contactanos');
    }

    /**
     * change status to closed
     * @param sfWebRequest $request
     */
    public function executeClosed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($contactanos = Doctrine::getTable('Contactanos')->find($request_id));

        $contactanos->setStatus(3);
        $contactanos->save();

        $this->getUser()->setFlash('notice', 'Correo procesado.');
        $this->redirect('contactanos');
    }

    /**
     * allow user to download the user comment in PDF format
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadAuditPdf(sfWebRequest $request) {
        $this->forward404Unless($audit = Doctrine::getTable('Contactanos')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, 'Contactanos');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($audit->getComentario()));
        $pdf->Output(sprintf('audit.pdf'), 'D');
        throw new sfStopException();
    }

    /**
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowPlan(sfWebRequest $request) {
        $this->forward404Unless($this->contactanos = Doctrine::getTable('Contactanos')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
            $contactanos = $form->save();
                if ($form->getObject()->isNew()) {
            $contactanos->setCreatedAt(date('Y-m-d H:i:s'));
                } else {
                $contactanos->setCreatedAt(date('Y-m-d H:i:s'));
                }
                $contactanos->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $contactanos)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@contactanos_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect('@contactanos');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    /**
     * return default value from given use id
     * @param sfWebRequest $request
     */
    public function executeGetDefaults(sfWebRequest $request) {
        $user_profile = Doctrine::getTable('sfGuardUserProfile')->findOneBy('id', $request->getParameter('id'));
        $this->forward404Unless($user_profile);
        $user_profile_array = array('name' => $user_profile->getName(),
            'surname1' => $user_profile->getSurname1(),
            'surname2' => $user_profile->getSurname2(),
            'email' => $user_profile->getEmail(),
            'phone' => $user_profile->getTelefono()
        );
        return $this->renderText(json_encode($user_profile_array));
    }

    /* public function executeFilter(sfWebRequest $request)
      {
      $this->setPage(1);

      if ($request->hasParameter('_reset'))
      {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@contactanos');
      }

      $this->filters = $this->configuration->getFilterForm($this->getFilters());

      $this->filters->bind($request->getParameter($this->filters->getName()));
      if ($this->filters->isValid())
      {
      $this->setFilters($this->filters->getValues());
      $request_paramters = $this->filters->getValues();

      $this->filter_records = array();
      $this->filter_records['status'] = $request_paramters['status'];
      $this->setFilterRecord($this->filter_records);
      $this->redirect('@contactanos');
      }

      $this->pager = $this->getPager();
      $this->sort = $this->getSort();

      $this->setTemplate('index');
      } */

    protected function getFilterRecord() {
        return $this->getUser()->getAttribute('contactanos.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    }

    protected function setFilterRecord(array $filters) {
        return $this->getUser()->setAttribute('contactanos.filters', $filters, 'admin_module');
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
        $filter_parameters = $this->getFilters();
        if (!empty($filter_parameters['status'])) {
            $query->andWhere('status =?', $filter_parameters['status']);
        }

        $filter_column = $this->getUser()->getAttribute('contactanos.filters', null, 'admin_module');

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

}
