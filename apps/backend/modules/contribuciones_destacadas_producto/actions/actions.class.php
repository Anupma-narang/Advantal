<?php

require_once dirname(__FILE__) . '/../lib/contribuciones_destacadas_productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contribuciones_destacadas_productoGeneratorHelper.class.php';

/**
 * contribuciones_destacadas_producto actions.
 *
 * @package    symfony
 * @subpackage contribuciones_destacadas_producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribuciones_destacadas_productoActions extends autoContribuciones_destacadas_productoActions {

    public function executeShow(sfWebRequest $request) {
        $this->contribucion = $this->getRoute()->getObject();
        $this->helper = new contribuciones_destacadas_productoGeneratorHelper();

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
//					->leftJoin('c.concur')
                ->where('c.concurso_id=?', $this->contribucion->getConcursoId())
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
        $this->forward404Unless($this->concurso = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowPlanAccion(sfWebRequest $request) {
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

        //notificamos, si procede, al autor del concurso al activarse
        if ($new_status == 2) {
            $autor = $this->contribucion->getConcurso()->getUser();
            $autor->sendNotification_NewContribucionConcurso($this->contribucion);

            //los puntos
            $codigos = doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=false')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                    $this->contribucion->getUser()->getProfile()->setPuntos($puntos);
                    ColaboradorPuntosHistoricoTable::new_log($this->contribucion->getUserId(), $codigo->getDescripcion(), $puntos, 'contribucion', $this->contribucion->getId());
                }
            }
            if (($otro_descripcion = $request->getParameter('otro_descripcion')) && ($otro_puntos = $request->getParameter('otro_puntos'))) {
                $puntos_otro = str_replace('.', '', $otro_puntos);
                $this->contribucion->getUser()->getProfile()->setPuntos($puntos_otro);
                ColaboradorPuntosHistoricoTable::new_log($this->contribucion->getUserId(), $otro_descripcion, $puntos_otro, 'contribucion', $this->contribucion->getId());
            }
        }
        $this->contribucion->save();

        if ($request->getParameter('siguiente') == 1) {
            if ($contribucion = Doctrine::getTable('Contribucion')->createQuery()->where("contribucion_estado_id=1")->orderBy("created_at desc")->fetchOne())
                $this->redirect("contribuciones_destacadas/show?id=" . $contribucion->id);
            else
                $this->redirect("@homepage");
        }
        else
            $this->redirect("contribuciones_destacadas/show?id=" . $this->contribucion->id);
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("id"));
        $this->form = new ContactContribucionSimpleForm(array(), array('subject' => "Tu contribución no cumple con las condiciones de participación. Por favor ¡corrígela!", "contribucion" => $this->contribucion));
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
            $this->redirect("contribuciones_destacadas/changeStatus?id=" . $contribucion->id . "&estado=4");
        }
    }

    public function sendMail($to, $from, $subject, $body, $consumer = null, $group = null) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body);

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
        $this->redirect("contribuciones_destacadas/show?id=" . $this->contribucion->id);
    }

    public function executeRetirar(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));
        $this->contribucion->destacado = 0;
        $this->contribucion->fecha_destacado = null;
        $this->contribucion->save();
        $this->redirect("contribuciones_destacadas/show?id=" . $this->contribucion->id);
    }

    protected function buildQuery() {
        $filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module');
        $query = parent::buildQuery();

        $query->innerJoin('r.Concurso co');
        $query->andWhere('principal=false');
        $query->andWhere('co.concurso_tipo_id=2');
        $query->andWhere('destacado=true');

        $filter_column = $this->getUser()->getAttribute('contribuciones_destacadas_producto.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('contribuciones_destacadas_producto.sort', null, 'admin_module');

        if ($sort_column[0] == 'concurso_id') {
            if (array_key_exists('columname', $_GET)) {
                if ($_GET['columname'] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'producto') {
                    $query->leftJoin('co.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'marca') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.marca' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'modelo') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.modelo' . ' ' . $sort[1]);
                }
            } elseif (isset($sort_column[2]) && !empty($sort_column[0])) {
                if ($sort_column[2] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'producto') {
                    $query->leftJoin('co.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'marca') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.marca' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'modelo') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.modelo' . ' ' . $sort[1]);
                }
            }
        } elseif ($sort_column[0] == 'contribucion_estado_id') {
            //$query->leftJoin('co.Concurso esu');
            $query->orderBy('r.ContribucionEstado.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'user_id') {
            $query->leftJoin('r.User esu');
            $query->orderBy('esu.username' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'created_at') {
            $query->orderBy('r.created_at' . ' ' . $sort[1]);
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            }
        }

        return $query;
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            if ($request->hasParameter("columname")) {
                $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type'), $request->getParameter('columname')));
            } else {
                $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
            }
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
                $this->redirect('@contribuciones_destacadas_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('contribuciones_destacadas_producto/show?id=' . $contribucion->getId());
                // $this->redirect('@contribuciones_destacadas');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
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

    public function executeQuitarDestacado(sfWebRequest $request) {
        // si hay destacado
        $contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("id"));
        $contribucion->destacado = 0;
        $contribucion->fecha_destacado = null;
        $contribucion->save();

        $this->redirect("@contribucion_contribuciones_destacadas_producto");
    }

    /*  public function executeFilter(sfWebRequest $request) {
      $filter_parts = $this->getUser()->getAttribute('contribuciones_destacadas.filtering_estados_tipos', null, 'admin_module');
      if ($filter_parts) {
      $val = $filter_parts;
      echo $val;
      switch ($val) {
      case 'empresa_entidad': $active_filters = array('concurso_tipo_id' => 1);
      break;
      case 'producto': $active_filters = array('concurso_tipo_id' => 2);
      break;
      default: $active_filters = array();
      break;
      }
      $this->getUser()->setAttribute('contribuciones_destacadas.filtering_estados_tipos', $val, 'admin_module');
      } else {
      $this->getUser()->setAttribute('contribuciones_destacadas.filtering_estados_tipos', null, 'admin_module');
      }
      parent::executeFilter($request);
      }

      public function executeFiltering(sfWebRequest $request) {
      $val = $request->getParameter('val');

      switch ($val) {
      case 'empresa_entidad': $active_filters = array('concurso_tipo_id' => 1);
      break;
      case 'producto': $active_filters = array('concurso_tipo_id' => 2);
      break;
      default: $active_filters = array();
      break;
      }

      $this->getUser()->setAttribute('contribuciones_destacadas.filters', $active_filters, 'admin_module');
      $this->getUser()->setAttribute('contribuciones_destacadas.filtering_estados_tipos', $val, 'admin_module');
      $this->redirect('@contribuciones_destacadas');
      } */
}