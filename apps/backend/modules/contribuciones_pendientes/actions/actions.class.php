<?php

require_once dirname(__FILE__) . '/../lib/contribuciones_pendientesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contribuciones_pendientesGeneratorHelper.class.php';

/**
 * contribuciones_pendientes actions.
 *
 * @package    symfony
 * @subpackage contribuciones_pendientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribuciones_pendientesActions extends autoContribuciones_pendientesActions {

    public function executeShow(sfWebRequest $request) {
        $this->contribucion = $this->getRoute()->getObject();
        $this->helper = new contribuciones_pendientesGeneratorHelper();

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
                ->leftJoin('c.Concurso con')
                ->where('con.id=?', $this->contribucion->getConcursoId())
                ->andWhere('c.destacado=1')
                ->count();

        $this->puntos = doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
    }

    public function executeListVolver(sfWebRequest $request) {
        $contribucion = $this->getRoute()->getObject();
        $this->redirect('concurso/show?id=' . $contribucion->getConcursoId());
    }

    public function executeShowIncidencia(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowPlanAccion(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowResumenPlanAccion(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($new_status = $request->getParameter("estado"));

        $this->contribucion = $this->getRoute()->getObject();
        $this->contribucion->setContribucionEstadoId($new_status);
        $point_type = $request->getParameter('point_type');
        //notificamos, si procede, al autor del concurso al activarse
        if ($new_status == 2) {
            $autor = $this->contribucion->getConcurso()->getUser();
            $autor->sendNotification_NewContribucionConcurso($this->contribucion);

            //los puntos
            $codigos = doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=false')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                    $this->contribucion->getUser()->getProfile()->setPuntos($puntos, $point_type);
                    ColaboradorPuntosHistoricoTable::new_log($this->contribucion->getUserId(), $codigo->getDescripcion(), $puntos, 'contribucion', $this->contribucion->getId());
                }
            }
            if (($otro_descripcion = $request->getParameter('otro_descripcion')) && ($otro_puntos = $request->getParameter('otro_puntos'))) {
                $puntos_otro = str_replace('.', '', $otro_puntos);
                $this->contribucion->getUser()->getProfile()->setPuntos($puntos_otro, $point_type);
                ColaboradorPuntosHistoricoTable::new_log($this->contribucion->getUserId(), $otro_descripcion, $puntos_otro, 'contribucion', $this->contribucion->getId());
            }
        }

        $this->contribucion->save();

        if ($request->getParameter('siguiente') == 1) {
            if ($contribucion = Doctrine::getTable('Contribucion')->createQuery()->where("contribucion_estado_id=1")->orderBy("created_at desc")->fetchOne())
                $this->redirect("contribuciones_pendientes/show?id=" . $contribucion->id);
            else
                $this->redirect("@homepage");
        }
        else
            $this->redirect("contribuciones_pendientes/show?id=" . $this->contribucion->id);
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("id"));
        $this->form = new ContactContribucionSimpleForm(array(), array('subject' => "Tu contribucion ha sido rechazada. Debes corregirla", "contribucion" => $this->contribucion));
    }

    public function executeContacted(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));

        $this->form = new ContactContribucionSimpleForm(array(), array('subject' => "Tu contribucion ha sido rechazada. Debes corregirla", "contribucion" => $this->contribucion));
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->processContactForm($request, $this->form, $this->type);
        $this->setTemplate("rechazar");
    }

    protected function processContactForm(sfWebRequest $request, sfForm $form, $type) {

        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $user = Doctrine::getTable("sfGuardUser")->findOneById($this->form->getValue("user_id"));
            $contribucion = Doctrine::getTable("Contribucion")->findOneById($this->form->getValue("contribucion_id"));
            $to = array($user->email_address);

            $from = sfConfig::get('app_default_mailfrom');
            $subject = $this->form->getValue("subject");
            $body = $this->form->getValue("body");
            $this->sendMail($to, $from, $subject, $body);
            $this->getUser()->setFlash('notice', 'Se ha enviado el correo electrónico a la/el usuaria/o ' . $user->username);
            $this->redirect("contribuciones_pendientes/changeStatus?id=" . $contribucion->id . "&estado=3");
        }
    }

    public function sendMail($to, $from, $subject, $body, $consumer = null, $group = null) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body);
        $mensaje->setContentType('text/html');
        $mensaje->setBody($body);

        $this->getMailer()->send($mensaje);
    }

    public function executeDestacar(sfWebRequest $request) {
        $contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));

        $n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
                ->leftJoin('c.Concurso con')
                ->where('con.id=?', $contribucion->getConcursoId())
                ->andWhere('c.destacado=1')
                ->count();
        if ($n_contribuciones_destacados >= 10)
            $this->forward404('No puedes destacar más contribuciones, max: 10');

        $this->contribucion = $contribucion;
        $this->contribucion->destacado = 1;
        $this->contribucion->fecha_destacado = date("Y-m-d H:i:s");
        $this->contribucion->save();
        $this->redirect("contribuciones_pendientes/show?id=" . $this->contribucion->id);
    }

    public function executeRetirar(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));
        $this->contribucion->destacado = 0;
        $this->contribucion->fecha_destacado = null;
        $this->contribucion->save();
        $this->redirect("contribuciones_pendientes/show?id=" . $this->contribucion->id);
    }

    protected function buildQuery() {
        $query = parent::buildQuery();

        $query->innerJoin('r.Concurso co');
        $query->andWhere('principal=false')->andWhere('contribucion_estado_id=1');

        $filter_column = $this->getUser()->getAttribute('contribuciones_pendientes.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('contribuciones_pendientes.sort', null, 'admin_module');
        if ($sort_column[0] == 'concurso_id') {
            $query->leftJoin('r.Concurso esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'contribucion_estado_id') {
            $query->leftJoin('r.Concurso esu');
            $query->orderBy('esu.concurso_tipo_id' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'user_id') {
            $query->leftJoin('r.User esu');
            $query->orderBy('esu.username' . ' ' . $sort[1]);
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            }
        }

        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

        return $query;
    }

    protected function only_estado() {
        $query = parent::buildQuery();

        $query->andWhere('principal=false');
        $query->addWhere('contribucion_estado_id=?', 1);

        return $query;
    }

    public function executeDownload_pdf(sfWebRequest $request) {
        $this->forward404Unless($contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));
        /* if($this->getUser()->getGuardUser()->getId()!=$contribucion->getUserId())
          $this->forward404('No eres el autor de esta contribución.'); */

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, $contribucion->getName());
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($contribucion->getPlanAccion()));


        $pdf->Output(sprintf($contribucion->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    public function executeVolver(sfWebRequest $request) {
        $this->redirect('@contribucion');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->contribucion = $this->form->getObject();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->contribucion = $this->form->getObject();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->contribucion = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->contribucion);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->contribucion = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->contribucion);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $contribucion = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $contribucion)));
            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                $this->redirect('@contribuciones_pendientes_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('contribuciones_pendientes/show?id=' . $contribucion->getId());
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
