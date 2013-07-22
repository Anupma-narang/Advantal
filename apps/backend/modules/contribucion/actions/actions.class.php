<?php

require_once dirname(__FILE__) . '/../lib/contribucionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contribucionGeneratorHelper.class.php';

/**
 * contribucion actions.
 *
 * @package    auditoscopia
 * @subpackage contribucion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribucionActions extends autoContribucionActions {

    public function executeShow(sfWebRequest $request) {
        $this->contribucion = $this->getRoute()->getObject();
        $this->helper = new contribucionGeneratorHelper();

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
//					->leftJoin('c.concur')
                ->where('c.concurso_id=?', $this->contribucion->getConcursoId())
                ->andWhere('c.destacado=1')
                ->count();

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();


        $query = Doctrine_Query::create()->from('ConcursoReferendum')->where('contribucion_id = ?', $this->contribucion->getId());

        $this->pager = new sfDoctrinePager('ConcursoReferendum',1);
        $this->pager->setQuery($query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();                        
    }

    public function executeListVolver(sfWebRequest $request) {
        $contribucion = $this->getRoute()->getObject();
        $this->redirect('concurso/show?id=' . $contribucion->getConcursoId());
    }

    public function executeShowIncidenciaDetail(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
        //$this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id'));
    }

    public function executeShowPlanAccionDetail(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowResumen(sfWebRequest $request) {
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
                $this->redirect("contribucion/show?id=" . $contribucion->id);
            else
                $this->redirect("@homepage");
        }
        else
            $this->redirect("contribucion/show?id=" . $this->contribucion->id);
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("id"));
        $this->form = new ContactContribucionSimpleForm(array(), array('subject' => "Tu contribución en auditoscopia ha sido rechazada. Necesitas corregirla.", "contribucion" => $this->contribucion));
    }

    public function executeContacted(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));

        $this->form = new ContactContribucionSimpleForm(array(), array('subject' => "Tu contribución no cumple con las condiciones de participación. Por favor ¡corrígela!", "contribucion" => $this->contribucion));
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->processContactForm($request, $this->form, $this->type);
        $this->setTemplate("rechazar");
    }

    protected function processContactForm(sfWebRequest $request, sfForm $form, $type) {
        //$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
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
            $this->redirect("contribucion/changeStatus?id=" . $contribucion->id . "&estado=3");
        }
    }

    public function sendMail($to, $from, $subject, $body, $consumer = null, $group = null) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body);
        $mensaje->setContentType('text/html');
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
        if ($request->hasParameter('plan_de_accion')) {
            $this->redirect("contribucion/show?id=" . $this->contribucion->id);
        } else {
            $this->redirect("concurso/show?id=" . $contribucion->getConcursoId());
        }
    }

    public function executeRetirar(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));
        $this->contribucion->destacado = 0;
        $this->contribucion->fecha_destacado = null;
        $this->contribucion->save();
        $this->redirect("contribucion/show?id=" . $this->contribucion->id);
    }

    protected function buildQuery() {
        $query = parent::buildQuery();

        $query->innerJoin('r.Concurso co');
        $query->andWhere('principal=false');

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('contribucion.sort', null, 'admin_module');

        $filter_column = $this->getUser()->getAttribute('contribucion.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

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

    public function executeDownload_pdfIncidencia(sfWebRequest $request) {
        $this->forward404Unless($contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, $contribucion->getName());
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($contribucion->getIncidencia()));


        $pdf->Output(sprintf($contribucion->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            $contribucion = $form->save();

            /* try {

              } catch (Doctrine_Validator_Exception $e) {

              $errorStack = $form->getObject()->getErrorStack();

              $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
              foreach ($errorStack as $field => $errors) {
              $message .= "$field (" . implode(", ", $errors) . "), ";
              }
              $message = trim($message, ', ');

              $this->getUser()->setFlash('error', $message);
              return sfView::SUCCESS;
              } */

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $contribucion)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@contribucion_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('contribucion/show?id=' . $contribucion->getId());
                //     $this->redirect('@contribucion');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}

