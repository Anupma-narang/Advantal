<?php

require_once dirname(__FILE__) . '/../lib/cartas_pendientesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/cartas_pendientesGeneratorHelper.class.php';

/**
 * cartas_pendientes actions.
 *
 * @package    symfony
 * @subpackage cartas_pendientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cartas_pendientesActions extends autoCartas_pendientesActions {

    protected function buildQuery() {
        $query = parent::buildQuery();

        //Query customization
        $query->andWhereIn('profesional_letter_estado_id', array(1));

        return $query;
    }

    public function executeShow(sfWebRequest $request) {
        $this->cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id'));

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = true')->execute();
    }

    public function executeDelete(sfWebRequest $request) {
        $obj = Doctrine::getTable('ProfesionalLetter')->findOneById($request->getParameter('id'));
        if ($obj->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@profesional_letter');
    }

    public function executeListVolver(sfWebRequest $request) {
        $cartas = Doctrine::getTable('ProfesionalLetter')->find($request->getParameter('id'));
        $this->redirect('cartas_pendientes/show?id=' . $cartas->getId());
    }

    public function executeShowIncidencia(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->forward404Unless($this->cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id')));
        $this->professional_des = Doctrine::getTable('Profesional')->findOneBy('id', $this->cartas->getProfesionalId());
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($estado = $request->getParameter("estado", 2), 'Es necesario indicar el nuevo estado.');
        $this->forward404Unless($id = $request->getParameter("id"), 'Es necesario indicar el id del carta.');

        $this->cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id'));

        if ($this->cartas->profesional_letter_type_id == 1)
            $request->setParameter("recomend_profesional", true);
        else
            $request->setParameter("desaprob_profesional", true);

        $last = $this->cartas->getProfesionalLetterEstadoId();
        $this->cartas->setProfesionalLetterEstadoId($estado);

        if ($estado == 2) {
            $flag = Doctrine::getTable('UserNotification')->isActiveNotification('publica_recomend_disaprov_value', $this->cartas->getProfesional()->getUserId());
            if ($flag->count()) {
                cp::sendLetterActiveMail($this->cartas);
            }

            // Alert, if disaproval rate more than 25%
            //Doctrine::getTable('ProfesionalLetter')->makeAatioAlert($this->cartas->getProfesionalId());

            $this->cartas->setFechaActivacion(date('Y-m-d'));
            //los puntos
            $codigos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=true')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                    $this->cartas->getUser()->getProfile()->setPuntos($puntos);

                    ColaboradorPuntosHistoricoTable::new_log($this->cartas->getUserId(), $codigo->getDescripcion(), $puntos, 'carta', $this->cartas->getId());
                }
            }
            if (($otro_descripcion = $request->getParameter('otro_descripcion')) && ($otro_puntos = $request->getParameter('otro_puntos'))) {
                $this->cartas->getUser()->getProfile()->setPuntos($otro_puntos);
                ColaboradorPuntosHistoricoTable::new_log($this->cartas->getUserId(), $otro_descripcion, $otro_puntos, 'carta', $this->cartas->getId());
            }
        }

        $this->cartas->save();

        if ($estado == 2) {
            if ($this->cartas->profesional_letter_type_id == 1) {
                Doctrine::getTable('ProfesionalLetter')->recAlert($this->cartas->getProfesionalId());
            } else {
                Doctrine::getTable('ProfesionalLetter')->despAlert($this->cartas->getProfesionalId());
            }
        }

        // guardamos en el histórico cada cambio de estado
        $cartas_historico = new ProfesionalLetterHistorico();
        $cartas_historico->setProfesionalLetterId($this->cartas->getId());
        $cartas_historico->setDate(date('Y-m-d H:i:s'));
        $cartas_historico->setEstadoInicial($last);
        $cartas_historico->setEstadoFinal($estado);
        $cartas_historico->save();

        //$this->redirect("cartas_pendientes/show?id=".$this->cartas->id);
        /* if ($estado==2)
          {
          $this->redirect("cartas/show?id=".$this->cartas->id);
          } else {
          $this->redirect("cartas_pendientes/show?id=".$this->cartas->id);
          } */

        if ($request->getParameter('siguiente') == 1) {
            if ($profesionalData = Doctrine::getTable('ProfesionalLetter')->createQuery()->where("profesional_letter_estado_id=1")->orderBy("created_at desc")->fetchOne())
                $this->redirect("cartas_pendientes/show?id=" . $profesionalData->id);
            else
                $this->redirect("@homepage");
        }
        else {
            $this->redirect("@profesional_letter");
        }
    }

    public function executeRevertStatus(sfWebRequest $request) {
        $cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id'));

        if (!in_array($cartas->profesional_letter_estado_id, array(2))) {
            $this->forward404();
        }

        if ($cartas_historico = Doctrine::getTable('ProfesionalLetterHistorico')->createQuery()->where("profesional_letter_id=" . $cartas->getId())->orderBy("created_at desc")->fetchOne()) {
            $estado_anterior = $cartas_historico->getEstadoInicial();
            $estado_actual = $cartas_historico->getEstadoFinal();
            $cartas->setProfesionalLetterEstadoId($estado_anterior);

            if ($estado_actual == 2)
                $cartas->setFechaActivacion(null);
            /* if ($estado_actual==4) $cartas->setFechaDeliberacion(null);
              if ($estado_actual==5) $cartas->setFechaObservacion(null);
              if ($estado_actual==6) $cartas->setFechaCerrado(null);
              if ($estado_actual==7) $cartas->setFechaRechazado(null);
              if ($estado_actual==8) $cartas->setFechaNulo(null); */

            $cartas->save();

            $cartas_historico->delete();
        }

        $this->redirect("cartas_pendientes/show?id=" . $cartas->id);
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->cartas = Doctrine::getTable("ProfesionalLetter")->findOneById($request->getParameter("id"));
        $this->form = new ContactProfesionalLetterSimpleForm(array(), array('subject' => (($this->cartas->profesional_letter_type_id == '1') ? "Tu carta de recomendación en auditoscopia ha sido rechazada. Necesitas revisarla." : "Tu carta de desaprobación en auditoscopia ha sido rechazada. Necesitas revisarla."), "profesionalletter" => $this->cartas));
    }

    public function executeContacted(sfWebRequest $request) {
        $this->cartas = Doctrine::getTable("ProfesionalLetter")->findOneById($request->getParameter("profesional_letter_id"));

        $this->form = new ContactProfesionalLetterSimpleForm(array(), array('subject' => "Tu carta no cumple con las condiciones de participación. Por favor ¡corrígelo!", "profesionalletter" => $this->cartas));
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->processContactForm($request, $this->form, $this->type);
        $this->setTemplate("rechazar");
    }

    protected function processContactForm(sfWebRequest $request, sfForm $form, $type) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $user = Doctrine::getTable("sfGuardUser")->findOneById($this->form->getValue("user_id"));
            $cartas = Doctrine::getTable("ProfesionalLetter")->findOneById($this->form->getValue("profesional_id"));
            $to = array($user->email_address);
            $from = sfConfig::get('app_default_mailfrom');
            $subject = $this->form->getValue("subject");
            $body = $this->form->getValue("body");
            $this->sendMail($to, $from, $subject, $body);
            $this->getUser()->setFlash('notice', 'Se ha enviado el correo electrónico a la/el usuaria/o ' . $user->username);
            $this->redirect("cartas_pendientes/changeStatus?id=" . $cartas->id . "&estado=9");
        }
    }

    public function sendMail($to, $from, $subject, $body, $consumer = null, $group = null) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body, 'text/html');
        return $this->getMailer()->send($mensaje);
    }

    public function executeVolver(sfWebRequest $request) {
        $this->redirect('@cartas');
    }

    protected function addSortQuery($query) {
        $sort = isset($sort) ? $sort : array();

        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {

            case 'name':
                $sort[0] = 'r.name';
                break;

            case 'profesional_letter_type':
                $sort[0] = 'plt.name';
                break;

            case 'username':
                $sort[0] = 'sf.username';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        $extraColumn = array('profesional_letter_type', 'name', 'username', 'created_at');

        return in_array($column, $extraColumn);
    }

    public function executeDownload_r_pdf(sfWebRequest $request) {
        $this->forward404Unless($cartas_pendientes = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 30, 9, 60);
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/auditoscopia.png', 140, 20, 40);
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/audio-scopia-pdf-image.png', 25, 30, 230, 270);
        $pdf->Ln(25);
        $pdf->Cell(25);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(25, $cartas_pendientes->getName());
        $pdf->Ln(25);
        $pdf->Cell(25);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($cartas_pendientes->getDescription()));

        $pdf->Output(sprintf($cartas_pendientes->getName() . '.pdf'), 'D');
        unset($pdf);
        throw new sfStopException();
    }

    public function executeDownload_p_pdf(sfWebRequest $request) {
        $this->forward404Unless($cartas_pendientes = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 30, 9, 60);
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/auditoscopia.png', 140, 20, 40);
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/audio-scopia-pdf-image.png', 25, 30, 230, 270);
        $pdf->Ln(25);
        $pdf->Cell(25);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(25, $cartas_pendientes->getName());
        $pdf->Ln(25);
        $pdf->Cell(25);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($cartas_pendientes->getPlanAccion()));

        $pdf->Output(sprintf($cartas_pendientes->getName() . '.pdf'), 'D');
        unset($pdf);
        throw new sfStopException();
    }

    public function executeShowPlanAccion(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->forward404Unless($this->cartas_pendientes = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id')));
        $this->professional_des = Doctrine::getTable('Profesional')->findOneBy('id', $this->cartas_pendientes->getProfesionalId());
    }

    public function executeCartaPending(sfWebRequest $request) {
        $this->profesional_letter = Doctrine::getTable('Profesional')->find($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->profesional_letter);
        $this->processForm($request, $this->form);
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        if ($request->isMethod('post')) {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

                try {
                    $profesional_letter = $form->save();

                    $letterForm = $form->getEmbeddedForm('ProfesionalLetter');

                    if ($letterForm->getObject()->getProfesionalLetterTypeId() == 2) {
                        $upload = $request->getFiles($this->form->getName());
                        foreach ($upload['ProfesionalLetter'] as $formname => $ssFiles) {
                            if ($ssFiles['file']['size'] != 0) {
                                $pathInfo = pathinfo($ssFiles['file']['name']);
                                $extention = $pathInfo['extension'];
                                $filename = sha1($ssFiles['file']['name'] . microtime() . rand()) . "." . $extention;
                                move_uploaded_file($ssFiles['file']['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                                $archivoform = $letterForm->getEmbeddedForm($formname)->getObject();
                                $archivoform->setProfesionalLetterId(sfConfig::get('profesional_letter_id'));
                                $archivoform->setFile($filename);
                                $archivoform->save();
                                unset($archivoform);
                            }
                        }
                    }
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

                $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profesional_letter)));

                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                    $this->redirect('@profesional_carta_pendientes_create?id=' . $profesional_letter->getId());
                } else {
                    $this->getUser()->setFlash('notice', $notice);

                    $this->redirect('@profesional_letter');
                }
            } else {
                $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
        }
    }

    public function executeViewPage(sfWebRequest $request) {
        $this->setLayout('layout_popup');
        $this->forward404Unless($this->cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id')));
    }

}
