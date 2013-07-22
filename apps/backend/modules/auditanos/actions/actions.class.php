<?php

require_once dirname(__FILE__) . '/../lib/auditanosGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/auditanosGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * auditanos actions.
 *
 * @package    symfony
 * @subpackage auditanos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class auditanosActions extends autoAuditanosActions {

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'username':
                $sort[0] = 'sgu.username';
                break;
            case 'state':
                $sort[0] = 's.name';
                break;
            case 'location':
                $sort[0] = 'l.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Auditanos')->hasColumn($column) || $column == 'username' || $column == 'state' || $column == 'location';
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('auditanos.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
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
                $admin_record = $form->getObject();
                if ($form->getObject()->isNew()) {
                    $admin_record->setCreatedAt(date('Y-m-d H:i:s'));
                } else {
                    $admin_record->setCreatedAt($created_at);
                }
                $auditanos = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $auditanos)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@auditanos_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect(array('sf_route' => 'auditanos'));
                //     $this->redirect(array('sf_route' => 'auditanos', 'sf_subject' => $auditanos));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->auditanos = $this->getRoute()->getObject();
        $this->user_profiles = Doctrine::getTable('sfGuardUserProfile')->findOneBy('user_id', $this->getUser()->getGuardUser()->getId());
    }

    /**
     * allow user to download the audit plan in PDF format
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadAuditPdf(sfWebRequest $request) {
        $this->forward404Unless($audit = Doctrine::getTable('Auditanos')->findOneBy('id', $request->getParameter('id')));
        $this->user_pro = Doctrine::getTable('sfGuardUserProfile')->findOneBy('id', $this->getUser()->getGuardUser()->getId());

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Usuario: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(255, 25, 25);
        $user_id = $audit->getUserId();
        $pdf->Write(5, $audit->getUserName($user_id));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Localidad: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(66, 157, 41);
        $pdf->Write(5, $audit->getCpMunicipioProvincia($user_id));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(5, __('Correo electrónico: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(125, 120, 115);
        $pdf->Write(5, $audit->getEmail());
        if ($audit->getPhone()):
            $pdf->Ln(6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Write(5, __('Teléfono: '));
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetTextColor(125, 120, 115);
            $pdf->Write(5, $audit->getPhone());
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 57, 410);
        else:
            $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/img/fondo1.png', -55, 51, 410);
        endif;
        $pdf->Ln(14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, __('PLAN DE ACCIÓN'));
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->WriteHTML(strip_tags($audit->getPlan(), "<p><a><b><strong><i><u><span><font><br><br/>"));

        $pdf->Output(sprintf('audit_' . rand(1, 10000) . '.pdf'), 'D');
        throw new sfStopException();
    }

    /**
     * show audit plan in new window
     * @param sfWebRequest $request
     */
    public function executeShowPlan(sfWebRequest $request) {
        $this->user_pro = Doctrine::getTable('sfGuardUserProfile')->findOneBy('user_id', $this->getUser()->getGuardUser()->getId());
        $this->forward404Unless($this->audit = Doctrine::getTable('Auditanos')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    /**
     * return default value from given use id
     * @param sfWebRequest $request
     */
    public function executeGetDefaults(sfWebRequest $request) {
        $user_profile = Doctrine::getTable('sfGuardUserProfile')->findOneBy('id', $request->getParameter('id'));
        $this->forward404Unless($user_profile);
        $user_profile_array = array('email' => $user_profile->getEmail());
        return $this->renderText(json_encode($user_profile_array));
    }

    /**
     * change status to processed
     * @param sfWebRequest $request
     */
    public function executeProcessed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($auditanos = Doctrine::getTable('Auditanos')->find($request_id));

        $auditanos->setStatus(2);
        $auditanos->save();

        $this->getUser()->setFlash('notice', 'Correo tramitado.');
        $this->redirect('auditanos');
    }

    /**
     * change status to closed
     * @param sfWebRequest $request
     */
    public function executeClosed(sfWebRequest $request) {

        $request_id = $request->getParameter('id');
        $this->forward404Unless($auditanos = Doctrine::getTable('Auditanos')->find($request_id));

        $auditanos->setStatus(3);
        $auditanos->save();

        $this->getUser()->setFlash('notice', 'Correo cerrado.');
        $this->redirect('auditanos');
    }

}
