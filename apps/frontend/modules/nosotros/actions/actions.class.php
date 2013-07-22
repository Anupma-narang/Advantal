<?php

/**
 * nosotros actions.
 *
 * @package    auditoscopia
 * @subpackage nosotros
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactoForm extends sfForm {

    protected static $elegir = array("¿Cómo aseguramos la Excelencia en el tiempo?",
        "¿Cómo se entra en la lista blanca?",
        "¿Hay otras maneras de entrar en la lista blanca?",
        "Condiciones para permanecer en la lista blanca",
        "Condiciones para la retirada de la lista blanca");

    public function configure() {
        $this->setWidgets(array(
            "elige" => new sfWidgetFormSelect(array("choices" => self::$elegir)),
        ));
    }

}

class formularioContacto extends sfForm {

//    protected static $elegir = array("¿Cómo aseguramos la Excelencia en el tiempo?",
//        "¿Cómo se entra en la lista blanca?",
//        "¿Hay otras maneras de entrar en la lista blanca?",
//        "Condiciones para permanecer en la lista blanca",
//        "Condiciones para la retirada de la lista blanca");

    public function configure() {
        $this->setWidgets(array(
            'nombre' => new sfWidgetFormInput(),
            'email' => new sfWidgetFormInput(),
            'mensaje' => new sfWidgetFormTextarea(),
        ));
//        $this->widgetSchema->setLabels(array(
//            'nombre' =>  'Tu nombre',
//            'email' =>   'Tu mail',
//            'mensaje' => 'Tu consulta',
//        ));
    }

}

class nosotrosActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeQuienes(sfWebRequest $request) {
        //$this->forward('default', 'module');
        //Page Title
        /*  $this->getResponse()->setTitle('Recomiéndanos a un amigo');
          $this->getResponse()->addMeta('keywords', 'recomendar amigo, recomendarnos amigo, ayudar amigo, ayudar amigo de amigo');
          $this->getResponse()->addMeta('description', 'Recomienda auditoscopia a un amigo y dile cómo podemos ayudarle a mejorar sus productos y servicios favoritos y ganar dinero'); */
    }

    public function executeComo(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executePorque(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeSistema(sfWebRequest $request) {

    }

    public function executeCanjeregalos(sfWebRequest $request) {

    }

    public function executeParticipacionbeneficio(sfWebRequest $request) {

    }

    public function executeCondicionescaja(sfWebRequest $request) {

    }

    public function executeCobrarcaja(sfWebRequest $request) {

    }

    public function executeJerarquias(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeNuestros(sfWebRequest $request) {
        $this->page = $request->getParameter("page");
        if (!$this->page):
            $this->page = 1;
        endif;
    }

    public function executeColabora(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeTrabaja(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeEmpresa(sfWebRequest $request) {
        //$this->forward('default', 'module');
        //$this->formulario = new formularioContacto();
    }

    public function executeListablanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeListanegra(sfWebRequest $request) {

        $this->page = $request->getParameter("page");
        if (!$this->page):
            $this->page = 1;
        endif;
    }

    public function executeDirectorio(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeDecalogo(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeDecalogolistablanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeDecalogolistanegra(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeAvisolegal(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeTerminosycondiciones(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeCondicionesparticipacion(sfWebRequest $request) {
        /*
          $this->page = $request->getParameter("page");
          if (!$this->page):
          $this->page = 1;
          endif; */
    }

    public function executePoliticadeanonimato(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeGlosarioterminos(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executePreciospormodalidad(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComofuncionaenvioregalos(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeAntespublicarcontribucion(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeQuese(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeAudita(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeContratanos(sfWebRequest $request) {

        $usuario = $this->getUser();
        //set user id
        if ($usuario->isAuthenticated()) {
            $user_id = $this->getUser()->getGuardUser()->getId();
        } else {
            $user_id = null;
        }

        $this->contratanosForm = new ContratanosForm(array(), array('select' => 2));
        $this->eres = 0;
        $this->op = $request->getParameter('select');

        $schema = $this->contratanosForm->getValidatorSchema();
        if ($this->op == 1) {
            $this->contratanosForm->setValidator('eres', new sfValidatorString(array('required' => false), array()));
            $this->contratanosForm->setValidator('empresa', new sfValidatorString(array('required' => false), array()));
        } else {
            $this->contratanosForm->setValidator('name', new sfValidatorString(array('required' => false), array()));
        }

        if ($request->isMethod('post') && $request->getParameter('envia')) {
            $hier_us_parameter = $request->getParameter($this->contratanosForm->getName());
            $hier_us_parameter['form_type'] = $this->op;
            $hier_us_parameter['created_at'] = date('Y-m-d H:i:s');
            if ($this->op == 2) {
                $this->eres = $hier_us_parameter['eres'];
            }
            $this->contratanosForm->bind($hier_us_parameter);
            if ($this->contratanosForm->isValid()) {
                $obj = $this->contratanosForm->save();
                $obj->setFormType($this->op);
                $obj->save();

                $this->getUser()->setFlash('contratanos', 'Has enviado el <strong>formulario de contratación</strong> correctamente.<br>En breve nos podremos en contacto contigo.');
                //alertasTable::nueva('Nueva Contratanos', 'Hay un formulario nuevo de Contratanos <a href="contratanos/'.$obj->getId().'/edit">Ver</a>');
                if ($this->op == 1) {
                    alertasTable::nueva(32, 'Nueva Contratanos', 'Un colaborador nos ha <a href="contratanos/' . $obj->getId() . '" >contratado</a>.', array('user_id' => $user_id));
                } else if ($this->op == 2) {
                    alertasTable::nueva(32, 'Nueva Professional', 'Un colaborador nos ha <a href="contratanos_professional/' . $obj->getId() . '" >contratado</a>.', array('user_id' => $user_id));
                }
                $this->redirect('nosotros/empresa');
            } else {
                $this->getUser()->setFlash('errorContra', 'El formulario no se ha guardado porque se ha producido algún error.
');
            }
        }
    }

    /**
     * execute contact us action
     * @param sfWebRequest $request
     */
    public function executeContactanos(sfWebRequest $request) {
        //get user
        $this->getUser()->setFlash('errorContact', NULL);
        $usuario = $this->getUser();
        if ($usuario) {
            $this->profile = $usuario->getProfile();
        } else {
            $this->profile = null;
        }

        //setup contact us form
        $this->contactanosForm = new ContactanosFrontendForm(null, array('usuario' => $usuario));
        // if request is POST
        if ($request->isMethod('post')) {
            //fetch contact us form parameters
            $contact_parameters = $request->getParameter($this->contactanosForm->getName());
            $contact_parameters['created_at'] = date('Y-m-d H:i:s');

            $this->contactanosForm->bind($contact_parameters, $request->getFiles($this->contactanosForm->getName()));
            if ($this->contactanosForm->isValid()) {
                $contact_us_record = $this->contactanosForm->save();
                //set flash message and alerts
                $this->getUser()->setFlash('contactanos', '<p>Has <strong>contactado con nosotros</strong> correctamente.</p><p>En breve nos podremos en contacto contigo.</p>');
                alertasTable::nueva(32, 'Nueva Contáctanos', 'Un colaborador nos ha <a href="contactanos/' . $contact_us_record->getId() . '">contactado</a>');
                //redirect to contest page
                $this->redirect('concurso/index');
            } else {
                $this->getUser()->setFlash('errorContact', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
        }
    }

    /**
     * execute Auditanos action
     * @param sfWebRequest $request
     */
    public function executeAuditanos(sfWebRequest $request) {
        //get user
        $usuario = $this->getUser();
        //set user id
        if ($usuario->isAuthenticated()) {
            $user_id = $this->getUser()->getGuardUser()->getId();
        } else {
            $user_id = null;
        }
        //create auditanos form
        $this->auditanosForm = new AuditanosFrontendForm(null, array('usuario' => $usuario));

        if ($request->isMethod('post')) {
            //fetch form parameters
            $auditnos_form_parameters = $request->getParameter($this->auditanosForm->getName());
            //set user id
            $auditnos_form_parameters['user_id'] = $user_id;
            $auditnos_form_parameters['created_at'] = date('Y-m-d H:i:s');
            $this->auditanosForm->bind($auditnos_form_parameters, $request->getFiles($this->auditanosForm->getName()));

            if ($this->auditanosForm->isValid()) {

                //$this->getUser()->setFlash('auditanos', 'Nos has auditado correctamente.');
                $obj = $this->auditanosForm->save();
                //set alert messages
                alertasTable::nueva(2, 'Audítanos', 'Nos ha auditado', array('user_id' => $user_id));
                alertasTable::nueva(32, 'Audítanos', 'Nos ha <a href="auditanos/' . $obj->getId() . '" >auditado</a>', array('user_id' => $user_id));

                //asignar puntos
                $usuario->getProfile()->setPuntos(ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('auditarnos'));
                //  ColaboradorPuntosHistoricoTable::new_log($user_id, ColaboradorPuntoDefinicionTable::getDescripcionbyCodigo('auditarnos'), ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('auditarnos'));
                $this->getUser()->setFlash('audit', 'Nos <strong>has auditado</strong> correctamente.');
                $this->redirect($this->generateUrl('nosotros_audita'));
            } else {
                $this->getUser()->setFlash('errorAuditanos', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
        }
    }

    public function executeComoganarpuntos(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComoganarpuntos2(sfWebRequest $request) {
        // Page Title
        $this->getResponse()->setTitle('Cómo ganar puntos en la comunidad de auditoscopia');
        $this->getResponse()->addMeta('description', '¿Quieres saber cómo ganar puntos en la Comunidad de Experiencia de Cliente de auditoscopia? ¡Hazte colaborador ya y contribuye!');
        $this->getResponse()->addMeta('keywords', 'crear concurso, votar referéndum, añadir documentación apoyo, concurso semana, concurso mes, concurso año, idea genial, contribución gran valor, ganador concurso, segundo concurso, tercero concurso');
        //$this->forward('default', 'module');
    }

    public function executePorquecrearunacuenta(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComoformarblanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComopermanecerblanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeOtrasmanerasblanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComosalirlistablanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComosalirlistanegra(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComoformarnegra(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComonoformarnegra(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeProyectos(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    //hasta  aqui____________________________________________________________________________



    public function executeConcurso(sfWebRequest $request) {
        $this->page = $request->getParameter("page");
        if (!$this->page):
            $this->page = 1;
        endif;
    }

    public function executeConsejos(sfWebRequest $request) {
        $this->page = $request->getParameter("page");
        if (!$this->page):
            $this->page = 1;
        endif;
    }

    public function executeAntescrearconcurso(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeDesapruebaunprofesional(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeEmpresaformulario(sfWebRequest $request) {
        //$this->forward('default', 'module');
        $this->formulario = new formularioContacto();
    }

    public function executeComunidadprivada(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeCuenta(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executePartepublicaparteprivada(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeRecomiendaunprofesional(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeVentajascolaborador(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComosalirblanca(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executePruebas(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    /* comentadas por no usarse
     *

      public function executeAntespublicarponencia(sfWebRequest $request) {
      //$this->forward('default', 'module');
      }
      public function executeAntescrearmesaredonda(sfWebRequest $request) {
      //$this->forward('default', 'module');
      }
      public function executeIndex(sfWebRequest $request) {
      //$this->forward('default', 'module');
      }

      public function executeDirectoriobuenosprofesionales(sfWebRequest $request) {
      $this->page = $request->getParameter("page");
      if (!$this->page):
      $this->page = 1;
      endif;
      } */
}
