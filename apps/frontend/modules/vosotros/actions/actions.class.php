<?php

/**
 * vosotros actions.
 *
 * @package    auditoscopia
 * @subpackage vosotros
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vosotrosActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeCambioaspecto(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeComoganarpuntos(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeMicuenta(sfWebRequest $request) {
        // Page Title
        $this->getResponse()->setTitle('Mi cuenta de colaborador');

        $profile = $this->getUser()->getProfile();
        $this->form = $this->newForm('sfApplyPerfilForm', $profile);
        $this->form1 = new MetodoBancoForm();
        $this->error = $this->getUser()->getProfile()->isCashUp();
        $this->caja_error = $this->getUser()->getProfile()->isCanjeable();
        //get caja parameter (get this parameter when user cashup)
        $this->is_caja = $request->getParameter('caja', null);
        $this->caja_amount = $request->getParameter('caja_amount', 0);
        $this->money = $this->getUser()->getProfile()->getMoney();
        //get user's last cash aded date
        $point_record = Doctrine::getTable('ColaboradorPuntosHistorico')->getCashUpdateDate($this->getUser()->getGuardUser()->getId());

        if ($point_record) {
            $users_last_cash_update_date = $point_record['created_at'];
            $point_record = Doctrine::getTable('ColaboradorPuntosHistorico')->find($point_record['id']);
        } else {
            $users_last_cash_update_date = null;
        }


        //get administration caja record
        $administration_caja = Doctrine::getTable('AdministrationCaja')->getAdministrationCaja();

        //if user has money and also has been assigned money by admin
        if ($users_last_cash_update_date && $profile->getMoney()) {
            //get dates
            $now_time = strtotime('now');
            $cashup_time = strtotime($users_last_cash_update_date);
            //if ready to automatic redeem point conversion
            if (floor(($now_time - $cashup_time) / 86400) > $administration_caja['expiry_date']) {
                //get money
                $user_cash = $profile->getMoney();
                //get user redeem points
                $redeem_point = $profile->getChangePoints();
                //set redeem point
                $profile->setChangePoints($redeem_point + ($user_cash * $administration_caja['points_per_cent']));
                //reset money
                $profile->setMoney(0);

                $profile->save();
                $point_record->setStatus(1);
                $point_record->save();
            }
        }
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $this->form->save();
                if (is_object($this->form->getValue('image')) and 'sfValidatedFile' == get_class($this->form->getValue('image')) and $this->form->getValue('image')->isSaved()) {
                    $file_src = '/' . sfConfig::get('sf_upload_dir_name') . '/users/' . basename($this->form->getValue('image')->getSavedName());
                    $this->form->getWidget('image')->setOption('file_src', $file_src);
                }

                $profile = $this->getUser()->getProfile();
                $this->form = $this->newForm('sfApplyPerfilForm', $profile);
            } else {
                /*  $form = $this->form ;
                  foreach ($form->getWidgetSchema()->getPositions() as $widgetName):
                  if ($form[$widgetName]->hasError()):
                  $str .= "<br />".$form[$widgetName]->renderLabelName() . ': ' . __($form[$widgetName]->getError()->getMessageFormat());
                  endif;
                  endforeach;

                  foreach ($this->form->getErrorSchema() as $e) {
                  //$str .= $e->__toString();
                  } */
                /* foreach ($this->form->getErrorSchema() as $k => $e) {                    
                  echo $e->__toString();exit;
                  } */
                if (!$request->isXmlHttpRequest())
                    $this->getUser()->setFlash('errormicuenta', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
        }
        if (($this->getUser()->getGuardUser()->getProfile()->getMoney() >= 30) && ($this->getUser()->getGuardUser()->getProfile()->getMetodoCobroId() == 1))
            $this->getUser()->setFlash('notice', 'Te recordamos que tienes que <strong>indicar y rellenar tu método de cobro</strong> de recompensas para poder recibir el dinero.');
    }

    public function executeUpdatesettings(sfRequest $request) {
        print_r($request->getParameterHolder());
        die;
        $profile = $this->getUser()->getProfile();
        $this->form = $this->newForm('sfApplyPerfilForm', $profile);
        $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
        //print_r($profile);exit;
        if ($this->form->isValid()) {
            $values = $this->form->getValues();
            $metodo = $values['metodo_cobro_id'];

            if ($metodo != 1) {  //si eleginos un método de pago y no lo tenemos guardado
                if ($metodo == 2) {
                    if (!$metodo = Doctrine::getTable('MetodoBanco')->createQuery()->where('user_id=?', $this->form->getObject()->getUserId())->fetchOne()) {
                        $this->getUser()->setFlash('error', '“Necesitas rellenar tu método de cobro de recompensas <strong>para hacer caja</strong>”.<br/><br/>Gracias por tu colaboración.');
                        return $this->setTemplate("micuenta");
                    }
                } elseif ($metodo == 3) {
                    if (!$metodo = Doctrine::getTable('MetodoPaypal')->createQuery()->where('user_id=?', $this->form->getObject()->getUserId())->fetchOne()) {
                        $this->getUser()->setFlash('error', '“Necesitas rellenar tu método de cobro de recompensas <strong>para hacer caja</strong>”.<br/><br/>Gracias por tu colaboración.');
                        return $this->setTemplate("micuenta");
                    }
                }
            }
            $this->form->save();
            $this->form->getObject()->setImage(basename($this->form->getObject()->getImage()));
            $this->form->getObject()->save();

            if ($this->form->getObject()->getMetodoCobroId() == 1) {
                //hay que borrar todos los metodos de este user
                Doctrine::getTable('MetodoPaypal')->createQuery()->delete()->where('user_id=?', $this->getUser()->getGuardUser()->getId())->execute();
                Doctrine::getTable('MetodoBanco')->createQuery()->delete()->where('user_id=?', $this->getUser()->getGuardUser()->getId())->execute();
            }
            return $this->redirect('vosotros/micuenta');
        }

        $this->setTemplate("micuenta");
    }

    public function executeDelete(sfRequest $request) {

        /*
          Doctrine::getTable('MetodoPaypal')->createQuery()->delete()->where('user_id=?', $this->getUser()->getGuardUser()->getId())->execute();
          Doctrine::getTable('MetodoBanco')->createQuery()->delete()->where('user_id=?', $this->getUser()->getGuardUser()->getId())->execute();
         */

        /*   $user =  $this->getUser()->getGuardUser()->getId();
          $query =  Doctrine_Query::create()
          ->update('sf_guard_user_profile u')
          ->set('u.metodo_cobro_id', '1')
          ->where('u.id = '.$user)
          ->execute();
          // $query->save();
          //  echo $query;exit;

          /* $id = Doctrine::getTable('sfGuardUserProfile')->findBy('acronym', 'PMM')->getFirst()->getId();
          $cobro_id = new sfGuardUserProfile();
          $cobro_id->setMetodoCorboId(1); */
        //sfApplyPerfil_metodo_cobro_id = 1;
        // }
        //  return $this->redirect('vosotros/micuenta');
        //}
        //      $this->setTemplate("micuenta");
    }

    public function executeCaja(sfWebRequest $request) {
        // check user is authenticated or not
        if ($this->getUser()->isAuthenticated()) {
            $user = $this->getUser();
            $profile = $this->getUser()->getGuardUser()->getProfile();
            $amount = $user->getGuardUser()->getProfile()->getMoney();

            $html = "<table cellspacing='0' cellpadding='0' style='font-family:Trebuchet MS; font-size:12px;'>
                  <tr>
                    <td>
                      El colaborador <strong style='color:#FF1919'>" . $this->getUser()->getGuardUser()->getUsername() . "</strong> ha solicitado  hacer caja por la cantidad de <b>" . $this->getUser()->getMoneyInFormat($amount) . "</b> €
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Por favor, comprueba que todos sus datos son correctos y procede.
                    </td>
                  </tr>
                  <tr>
                   <td> &nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      Muchas gracias por tu colaboración.</table>
                    </td>
                  </tr>";
            $admin_email_array = Doctrine::getTable('AdministrationEmails')->findAll();
            //send email to each admin
            foreach ($admin_email_array as $index => $admin_email) {
                $message = $this->getMailer()->compose();
                $message->setSubject('Solicitud de caja');
                $message->setTo($admin_email->getEmail());
                $message->setBody($html, 'text/html');
                $message->setFrom('info@auditoscopia.com');
                //enviar mail
                $this->getMailer()->send($message);
            }


            // create reward log
            $reward_log = new RewardLog();
            $reward_log->create($user->getGuardUser(), $user->getHierarchy(), $amount);

            alertasTable::nueva(2, 'Caja', 'Ha hecho caja', array('user_id' => $user->getGuardUser()->getId()));
            // create Alertas de caja model
            $alertas_de_caja_model = new AlertasDeCaja();
            // insert alertas de caja record
            $alertas_de_caja_model->create($user->getGuardUser()->getId(), $amount);

            //hacer caja
            $user_amount = $profile->getMoney();
            $profile->setMoney($user_amount - $amount);
            $profile->save();

            return $this->renderText($amount);
        } else {
            $this->status = 500;
        }
    }

    /**
     * display audit records created by logged-in user
     * @param sfWebRequest $request
     */
    public function executeMisauditorias(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameters

        $this->audit_type = $request->getParameter('type');
        if ($this->audit_type == ''):
            $this->getResponse()->setTitle('Mis auditorías en la lista blanca');
            $this->audit_type = $request->getParameter('type', 'empresa');
        elseif ($this->audit_type == 'empresa'):
            $this->getResponse()->setTitle('Mis auditorías de empresas y entidades');
        elseif ($this->audit_type == 'producto'):
            $this->getResponse()->setTitle('Mis auditorías de productos');
        endif;
        //if audit is for company
        if ($this->audit_type == 'empresa') {
            //set audti partial name
            $this->partial_name = 'audit_company';
            //set audit query for comapny
            $audit_query = Doctrine::getTable('Empresa')->getAuditQuery($this->user->getId());
        }
        //if audit is for product
        else {
            //set audti partial name
            $this->partial_name = 'audit_product';
            //set audit query for comapny
            $audit_query = Doctrine::getTable('Producto')->getAuditQuery($this->user->getId());
        }
        //create pager object
        $this->pager = new sfDoctrinePager('Empresa', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    /**
     * Fetch audit record for
     * @param sfWebRequest $request
     */
    public function executeMisAuditList(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameters
        $this->audit_type = $request->getParameter('type', 'empresa');
        $audit_id = $request->getParameter('id');
        $this->page = $request->getParameter('page');

        //if audit is for company
        if ($this->audit_type == 'empresa') {
            //fetch user audit records for given company
            $this->audit_records = Doctrine::getTable('Empresa')->getUserAuditRecords($this->user->getId(), $audit_id);
        } else {
            //fetch user audit records for given company
            $this->audit_records = Doctrine::getTable('Producto')->getUserAuditRecords($this->user->getId(), $audit_id);
        }
    }

    /**
     * display questionary records for given audit
     * @param sfWebRequest $request
     */
    public function executeMisAuditRecord(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameters
        $this->audit_type = $request->getParameter('type', 'empresa');
        $this->page = $request->getParameter('page');
        //fetch request parameters
        $object_id = $request->getParameter('object_id');
        $question_id = $request->getParameter('id');

        //if audit is for company
        if ($this->audit_type == 'empresa') {
            //get company record
            $this->audit_object = Doctrine::getTable('Empresa')->find($object_id);
        } else {
            //get company record
            $this->audit_object = Doctrine::getTable('Producto')->find($object_id);
        }
        //fetch question record
        $question_record = Doctrine::getTable('ListaCuestionarioUser')->find($question_id);
        //load question form
        if ($question_record) {
            $this->form = new ListaCuestionarioUserForm($question_record);
        } else {
            $this->form = new ListaCuestionarioUserForm();
        }
    }

    /**
     * display comments records created by logged-in user
     * @param sfWebRequest $request
     */
    public function executeMisComentarios(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameters

        $this->audit_type = $request->getParameter('type');
        if ($this->audit_type == ''):
            $this->getResponse()->setTitle('Mis comentarios en la lista negra');
            $this->audit_type = $request->getParameter('type', 'empresa');
        elseif ($this->audit_type == 'empresa'):
            $this->getResponse()->setTitle('Mis comentarios de empresas y entidades');
        elseif ($this->audit_type == 'producto'):
            $this->getResponse()->setTitle('Mis comentarios de productos');
        endif;
        //if audit is for company
        if ($this->audit_type == 'empresa') {
            //set audti partial name
            $this->partial_name = 'audit_company';
            //set audit query for comapny
            $audit_query = Doctrine::getTable('Empresa')->getCommentsQuery($this->user->getId());
        }
        //if audit is for product
        else {
            //set audti partial name
            $this->partial_name = 'audit_product';
            //set audit query for comapny
            $audit_query = Doctrine::getTable('Producto')->getCommentsQuery($this->user->getId());
        }
        //create pager object
        $this->pager = new sfDoctrinePager('Empresa', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    /**
     * Fetch comment list
     * @param sfWebRequest $request
     */
    public function executeMisCommentList(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameters
        $this->comment_type = $request->getParameter('type', 'empresa');
        $comment_id = $request->getParameter('id');
        $this->page = $request->getParameter('page');
        //fetch request parameters
        //if comment is for company
        if ($this->comment_type == 'empresa') {
            //fetch user comment records for given company
            $this->comment_records = Doctrine::getTable('Empresa')->getCommentsRecords($this->user->getId(), $comment_id);
        } else {
            //fetch user comment records for given company
            $this->comment_records = Doctrine::getTable('Producto')->getCommentsRecords($this->user->getId(), $comment_id);
        }
    }

    /**
     * Fetch comment record
     * @param sfWebRequest $request
     */
    public function executeMisCommentRecord(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameters
        $this->comment_type = $request->getParameter('type', 'empresa');
        $this->page = $request->getParameter('page');
        $object_id = $request->getParameter('object_id');
        $comment_id = $request->getParameter('id');

        //if audit is for company
        if ($this->comment_type == 'empresa') {
            //get comapny record
            $this->comment_object = Doctrine::getTable('Empresa')->find($object_id);
        }
        //if audit is for product
        else {
            //get product record
            $this->comment_object = Doctrine::getTable('Producto')->find($object_id);
        }

        //fetch comment record
        $comment_record = Doctrine::getTable('ComentarioListaNegra')->find($comment_id);
        if ($comment_record) {
            $this->form = new ComentarioListaNegraForm($comment_record);
        } else {
            $this->form = new ComentarioListaNegraForm();
        }
    }

    /**
     * display contest and contribution which are contributed by user
     * @param sfWebRequest $request
     */
    public function executeMiscontribuciones(sfWebRequest $request) {
        //get sf guard user
        $user = $this->getUser()->getGuardUser();
        //get request values

        $this->tipo = $request->getParameter('tipo');
        $this->list = $request->getParameter('list');

        if ($this->tipo == '' && $this->list == ''):
            $this->getResponse()->setTitle('Mis contribuciones');
            $this->tipo = $request->getParameter('tipo', 'empresa') == 'empresa' ? 'empresa' : 'producto';
            $this->list = $request->getParameter('list', 'active');
        elseif ($this->tipo == 'empresa' && $this->list == 'active'):
            $this->getResponse()->setTitle('Mis contribuciones activas de Empresa y Entidad');
        elseif ($this->tipo == 'empresa' && $this->list == 'history'):
            $this->getResponse()->setTitle('Histórico de mis contribuciones de Empresa y Entidad');
        elseif ($this->tipo == 'producto' && $this->list == 'active'):
            $this->getResponse()->setTitle('Mis contribuciones activas de Producto');
        elseif ($this->tipo == 'producto' && $this->list == 'history'):
            $this->getResponse()->setTitle('Histórico de mis contribuciones de Producto');
        endif;



        //set contest status array
        if ($this->list == 'active') {
            $conetst_status_array = array(
                Concurso::CONTEST_STATUS_ACTIVE,
                Concurso::CONTEST_STATUS_REFERENDUM,
                Concurso::CONTEST_STATUS_DELIBERATION,
                Concurso::CONTEST_STATUS_OBSERVATION,
                Concurso::CONTEST_STATUS_REVISED);
        } else {
            $conetst_status_array = array(
                Concurso::CONTEST_STATUS_CLOSDE,
                Concurso::CONTEST_STATUS_REJECTED);
        }
        if ($this->tipo == 'empresa') {
            $conetst_type_array = array(ConcursoTipo::CONTEST_TYPE_COMPANY);
        } else {
            $conetst_type_array = array(ConcursoTipo::CONTEST_TYPE_PRODUCT);
        }
        //set contribution status array
        $this->contribution_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_ACTIVE),
            'contribtion_flag' => true);
        //get contribution count
        $this->contribution_count = Doctrine::getTable('Concurso')->getContributionCountByContributor($user->getId(), $conetst_status_array, $conetst_type_array, array(Contribucion::CONTRIBUTION_STATUS_ACTIVE));
        //fetch consurso query
        $query = Doctrine::getTable('Concurso')->contributionByContributor($user->getId(), $conetst_status_array, $conetst_type_array, array(Contribucion::CONTRIBUTION_STATUS_ACTIVE));
        //create pager object
        $this->pager = new sfDoctrinePager('Concurso', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    /**
     * Display Referendum Contest records created or contributed by
     * logged-in user
     * @param sfWebRequest $request
     */
    public function executeMisreferendums(sfWebRequest $request) {
        //fetch user
        $user = $this->getUser()->getGuardUser();

        $this->tipo = $request->getParameter('tipo');
        $this->list = $request->getParameter('list');

        if ($this->tipo == '' && $this->list == ''):
            $this->getResponse()->setTitle('Mis Referéndums');
            $this->tipo = $request->getParameter('tipo', 'empresa') == 'empresa' ? 'empresa' : 'producto';
            $this->list = $request->getParameter('list', 'active');
        elseif ($this->tipo == 'empresa' && $this->list == 'active'):
            $this->getResponse()->setTitle('Mis referéndums activos de concursos de Empresa y Entidad');
        elseif ($this->tipo == 'empresa' && $this->list == 'history'):
            $this->getResponse()->setTitle('Histórico de mis Referéndums de concursos de Empresa y Entidad');
        elseif ($this->tipo == 'producto' && $this->list == 'active'):
            $this->getResponse()->setTitle('Mis referéndums activos de concursos de Producto');
        elseif ($this->tipo == 'producto' && $this->list == 'history'):
            $this->getResponse()->setTitle('Histórico de mis Referéndums de concursos de Producto');
        endif;

        //set contribution status array
        $this->contribution_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_ACTIVE));
        //set contest type array
        if ($this->tipo == 'empresa') {
            $conetst_type_array = array(ConcursoTipo::CONTEST_TYPE_COMPANY);
        } else {
            $conetst_type_array = array(ConcursoTipo::CONTEST_TYPE_PRODUCT);
        }
        //set contribution status record
        $contribution_status_array = array(Contribucion::CONTRIBUTION_STATUS_ACTIVE);
        //set contest status array
        if ($this->list == 'active') {
            $conetst_status_array = array(
                Concurso::CONTEST_STATUS_REFERENDUM,
            );
            //fetch contest query
            $contest_query = Doctrine::getTable('Concurso')->getReferendumContestByUser($user->getId(), $conetst_status_array, $conetst_type_array, $contribution_status_array);
        } else {
            $conetst_status_array = array(
                Concurso::CONTEST_STATUS_DELIBERATION,
                Concurso::CONTEST_STATUS_OBSERVATION,
                Concurso::CONTEST_STATUS_REVISED,
                Concurso::CONTEST_STATUS_CLOSDE,
                Concurso::CONTEST_STATUS_REJECTED);
            //fetch contest query
            $contest_query = Doctrine::getTable('Concurso')->getVotedContestByUser($user->getId(), $conetst_status_array, $conetst_type_array);
        }




        //setup pager for contest records
        $this->pager = new sfDoctrinePager('Concurso', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($contest_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    /**
     * Display professional records created by logged-in user
     * @param sfWebRequest $request
     */
    public function executeMisProfessionals(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        // Page Title
        $this->getResponse()->setTitle('Mis profesionales');
        //fetch user's created professionals
        $my_professional_list_query = Doctrine::getTable('Profesional')->getMyProfessionalListQuery($this->user->getId());
        //setup pager for prefessional records
        $this->pager = new sfDoctrinePager('Profesional', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($my_professional_list_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    /**
     * Fetch professional letter list as recommended or disaproved
     * @param sfWebRequest $request
     */
    public function executeMiscartas(sfWebRequest $request) {
        //get user
        $this->user = $this->getUser()->getGuardUser();
        //get request parameter
        $this->cart_type = $request->getParameter('type');
        if ($this->cart_type == ''):
            $this->getResponse()->setTitle('Mis cartas');
            $this->cart_type = $request->getParameter('type', 'recommended');
        elseif ($this->cart_type == 'recommended'):
            $this->getResponse()->setTitle('Mis cartas de recomendación');
        elseif ($this->cart_type == 'disaproved'):
            $this->getResponse()->setTitle('Mis cartas de desaprobación');
        endif;
        //this condition would not work beacuse value of letter type for professional
        //is hard coded as 1 or 2
        $letter_type_id = $this->cart_type == 'recommended' ? 1 : 2;
        $professional_letter_list_query = Doctrine::getTable('Profesional')->getProfessionalLettersQuery($this->user->getId(), $letter_type_id);

        //setup pager for prefessional letter records
        $this->pager = new sfDoctrinePager('Profesional', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($professional_letter_list_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    /**
     * display contest created by logge-in user
     * @param sfWebRequest $request
     */
    public function executeMisconcursos(sfWebRequest $request) {
        //fetch user
        $user = $this->getUser()->getGuardUser();
        //$this->concursos = Doctrine::getTable("Concurso")->createQuery()->where("user_id=?", $this->getUser()->getGuardUser()->id)->execute();
        $this->tipo = $request->getParameter('tipo');
        $this->list = $request->getParameter('list');

        if ($this->tipo == '' && $this->list == ''):
            $this->getResponse()->setTitle('Mis concursos');
            $this->tipo = $request->getParameter('tipo', 'empresa') == 'empresa' ? 'empresa' : 'producto';
            $this->list = $request->getParameter('list', 'active');
        elseif ($this->tipo == 'empresa' && $this->list == 'active'):
            $this->getResponse()->setTitle('Mis concursos activos de Empresa y Entidad');
        elseif ($this->tipo == 'empresa' && $this->list == 'history'):
            $this->getResponse()->setTitle('Histórico de mis concursos de Empresa y Entidad');
        elseif ($this->tipo == 'producto' && $this->list == 'active'):
            $this->getResponse()->setTitle('Mis concursos activos de Producto');
        elseif ($this->tipo == 'producto' && $this->list == 'history'):
            $this->getResponse()->setTitle('Histórico de mis concursos de Producto');
        endif;

//set contest status array
        if ($this->list == 'active') {
            $conetst_status_array = array(
                Concurso::CONTEST_STATUS_ACTIVE,
                Concurso::CONTEST_STATUS_REFERENDUM,
                Concurso::CONTEST_STATUS_DELIBERATION,
                Concurso::CONTEST_STATUS_OBSERVATION,
                Concurso::CONTEST_STATUS_REVISED);
        } else {
            $conetst_status_array = array(
                Concurso::CONTEST_STATUS_CLOSDE,
                Concurso::CONTEST_STATUS_REJECTED);
        }

        //set contribution status array
        $this->contribution_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_ACTIVE));
        //set contest type array
        if ($this->tipo == 'empresa') {
            $conetst_type_array = array(ConcursoTipo::CONTEST_TYPE_COMPANY);
        } else {
            $conetst_type_array = array(ConcursoTipo::CONTEST_TYPE_PRODUCT);
        }

        //fetch contest query
        $contest_query = Doctrine::getTable('Concurso')->getContestByUser($user->getId(), $conetst_status_array, $conetst_type_array);
        //setup pager for contest records
        $this->pager = new sfDoctrinePager('Concurso', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($contest_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeMisfavoritos(sfWebRequest $request) {
        //get user
        $user = $this->getUser()->getGuardUser();
        //get draft type
        $this->favourit_type = $request->getParameter('type');
        if ($this->favourit_type == ''):
            $this->getResponse()->setTitle('Mis favoritos');
            $this->favourit_type = trim($request->getParameter('type', 'company_contest'));
        elseif ($this->favourit_type == 'company_contest'):
            $this->getResponse()->setTitle('Mis concursos de Empresa y Entidad favoritos');
        elseif ($this->favourit_type == 'product_contest'):
            $this->getResponse()->setTitle('Mis concursos de Producto favoritos');
        elseif ($this->favourit_type == 'company'):
            $this->getResponse()->setTitle('Mis empresas y entidades recomendadas favoritas');
        elseif ($this->favourit_type == 'product'):
            $this->getResponse()->setTitle('Mis productos recomendados favoritos');
        elseif ($this->favourit_type == 'gift'):
            $this->getResponse()->setTitle('Mis regalos del Escaparate favoritos');
        endif;
        //create draft query
        $draft_query = '';
        switch ($this->favourit_type) {
            //if favourit list is for contest
            case 'company_contest':
                //create contest type array
                $conetst_status_array = array(
                    Concurso::CONTEST_STATUS_ACTIVE,
                    Concurso::CONTEST_STATUS_REFERENDUM,
                    Concurso::CONTEST_STATUS_DELIBERATION,
                    Concurso::CONTEST_STATUS_OBSERVATION,
                    Concurso::CONTEST_STATUS_REVISED);
                //fetch contest comapny query
                $draft_query = Doctrine::getTable('Concurso')->getFavouritContest($user->getId(), $conetst_status_array, 'company');
                //set draft type pratial
                $this->favourit_prtial = 'vosotros/concruso';
                //set draft type object
                $this->favourit_object = 'concurso';
                //set draft type option
                //set draft type option
                $this->favourit_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_ACTIVE));
                //set message
                $this->empty_message = 'No tienes ningún concurso de Empresa/Entidad favorito.';
                $this->header_message = 'concursos a favoritos';
                //set from rout
                $this->from = 'my_favoritos_company_contest';
                break;
            //if favourit list is for contribution
            case 'product_contest':
                //create contest type array
                $conetst_status_array = array(
                    Concurso::CONTEST_STATUS_ACTIVE,
                    Concurso::CONTEST_STATUS_REFERENDUM,
                    Concurso::CONTEST_STATUS_DELIBERATION,
                    Concurso::CONTEST_STATUS_OBSERVATION,
                    Concurso::CONTEST_STATUS_REVISED);

                //fetch contest product query
                $draft_query = Doctrine::getTable('Concurso')->getFavouritContest($user->getId(), $conetst_status_array, 'product');
                //set draft type pratial
                $this->favourit_prtial = 'vosotros/concruso';
                //set draft type object
                $this->favourit_object = 'concurso';
                //set draft type option
                $this->favourit_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_DRAFT));
                //set message
                $this->empty_message = 'No tienes ningún concurso de Empresa/Entidad favorito.';
                $this->header_message = 'concursos a favoritos';
                //set from rout
                $this->from = 'my_favoritos_product_contest';
                break;
            //if favourit list is for contribution
            case 'company':
                //fetch comapny query
                $draft_query = Doctrine::getTable('Empresa')->getFavouritCompany($user->getId());
                //set draft type pratial
                $this->favourit_prtial = 'vosotros/audit_company';
                //set draft type object
                $this->favourit_object = 'audit_record';
                //set draft type option
                $this->favourit_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_DRAFT));
                //set message
                $this->empty_message = 'No tienes ninguna Empresa/Entidad favorita.';
                $this->header_message = 'empresas o entidades a favoritos';
                //set from rout
                $this->from = 'my_favoritos_company_contest';
                break;
            case 'product':
                //fetch comapny query
                $draft_query = Doctrine::getTable('Producto')->getFavouritProduct($user->getId());
                //set draft type pratial
                $this->favourit_prtial = 'vosotros/audit_product';
                //set draft type object
                $this->favourit_object = 'audit_record';
                //set draft type option
                $this->favourit_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_DRAFT));
                //set message
                $this->empty_message = 'No tienes ningún producto favorito.';
                $this->header_message = 'productos a favoritos';
                //set from rout
                $this->from = 'my_favoritos_company_contest';
                break;
            case 'gift':
                //fetch comapny query
                $draft_query = Doctrine::getTable('Gift')->getFavouritGift($user->getId());
                //set draft type pratial
                $this->favourit_prtial = 'vosotros/gift_partial';
                //set draft type object
                $this->favourit_object = 'gift_record';
                //set draft type option
                $this->favourit_option = array('hierarchy_records' => array(Doctrine::getTable('Jerarquia')->getHierarchyList()));
                //set message
                $this->empty_message = 'No tienes ningún regalo favorito.';
                $this->header_message = 'regalos a favoritos';
                //set from rout
                $this->from = 'my_favoritos_company_contest';
                break;
        }

        $this->pager = new sfDoctrinePager('Concurso', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery($draft_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeMismesasredondas(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeMisponencias(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeMisrecompensas(sfWebRequest $request) {
        //get user
        $user = $this->getUser()->getGuardUser();
        // Page Title
        $this->getResponse()->setTitle('Cobros de caja');
        //create pager object
        $this->pager = new sfDoctrinePager('AlertasDeCaja', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery(Doctrine::getTable('AlertasDeCaja')->getCashUpRecords($user->getId()));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeMisrecompensasGift(sfWebRequest $request) {
        //get user
        $user = $this->getUser()->getGuardUser();
        // Page Title
        $this->getResponse()->setTitle('Canjes de regalos');
        //create pager object
        $this->pager = new sfDoctrinePager('GiftRedemption', sfConfig::get('app_concursos_in_list', 10));
        $this->pager->setQuery(Doctrine::getTable('GiftRedemption')->getRedeemGiftRecords($user->getId()));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeReferendums(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeBorradores(sfWebRequest $request) {
        //get user
        $user = $this->getUser()->getGuardUser();
        //get draft type

        $this->draft_type = trim($request->getParameter('type'));
        //Page Title
        if ($this->draft_type == ''):
            $this->getResponse()->setTitle('Mis borradores');
            $this->draft_type = trim($request->getParameter('type', 'contest'));
        elseif ($this->draft_type == 'contest'):
            $this->getResponse()->setTitle('Borradores de concursos');
        endif;

        //create draft query
        $draft_query = '';
        switch ($this->draft_type) {
            //if draft is for contest
            case 'contest':
                //create contest type array
                $contest_status_array = array(Concurso::CONTEST_STATUS_DRAFT, Concurso::CONTEST_STATUS_REJECTED);
                //fetch contest draft query
                $draft_query = Doctrine::getTable('Concurso')->getDraftContest($user->getId(), $contest_status_array);
                //set draft type pratial
                $this->draft_prtial = 'vosotros/concruso';
                //set draft type object
                $this->draft_object = 'concurso';
                //set draft type option
                //set draft type option
                $this->draft_option = array('contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_ACTIVE));
                //set message
                $this->empty_message = 'No tienes ningún concurso en borrador.';
                $this->record_count_message = 'concursos en borrador';
                break;
            //if draft is for contribution
            case 'contribution':
                // Page Title
                $this->getResponse()->setTitle('Borradores de contribuciones');
                //create contest type array
                $contest_status_array = array(Concurso::CONTEST_STATUS_ACTIVE);
                //create contribution status array
                $contribution_status_array = array(Contribucion::CONTRIBUTION_STATUS_DRAFT);
                //fetch contest draft query
                $draft_query = Doctrine::getTable('Concurso')->getDraftContributedContest($user->getId(), $contest_status_array, $contribution_status_array);
                //set draft type pratial
                $this->draft_prtial = 'vosotros/concruso';
                //set draft type object
                $this->draft_object = 'concurso';
                //set draft type option
                $this->draft_option = array('contribtion_flag' => true, 'contribution_status_array' => array(Contribucion::CONTRIBUTION_STATUS_DRAFT));
                //set message
                $this->empty_message = 'No tienes ninguna contribución en borrador.';
                $this->record_count_message = 'contribuciones en borrador';
                break;

            case 'profesional':
                // Page Title
                $this->getResponse()->setTitle('Borradores de profesionales');
                //create contribution status array
                $profesional_status_array = array(Profesional::PROFESIONAL_STATUS_DRAFT);
                //fetch contest draft query
                $draft_query = Doctrine::getTable('Profesional')->getDraftProfesional($user->getId(), $profesional_status_array);
                //set draft type pratial
                $this->draft_prtial = 'vosotros/profesional_record';
                //set draft type object
                $this->draft_object = 'profesional';
                //set draft type option
                $this->draft_option = array('profesional_status_array' => array(Profesional::PROFESIONAL_STATUS_DRAFT));
                $this->empty_message = 'No tienes ningún profesional en borrador.';
                $this->record_count_message = 'profesionales en borrador';

                break;

            case 'cartas':
                // Page Title
                $this->getResponse()->setTitle('Borradores de cartas');
                //create contribution status array
                $letter_status_array = array(ProfesionalLetter::PROFESIONALLETTER_STATUS_DRAFT);
                //fetch contest draft query
                $draft_query = Doctrine::getTable('ProfesionalLetter')->getDraftCartas($user->getId(), $letter_status_array);
                //set draft type pratial
                $this->draft_prtial = 'vosotros/profesional_letter';
                //set draft type object
                $this->draft_object = 'profesional';
                $this->user_id = $user->getId();
                //set draft type option
                $this->draft_option = array('letter_status_array' => array(ProfesionalLetter::PROFESIONALLETTER_STATUS_DRAFT));
                $this->empty_message = 'No tienes ninguna carta en borrador.';
                $this->record_count_message = 'cartas en borrador';
                break;
        }

        $this->pager = new sfDoctrinePager('Concurso', 10);
        $this->pager->setQuery($draft_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeBaja_colaborador(sfWebRequest $request) {
        
    }

    public function executeDo_baja_colaborador(sfWebRequest $request) {
        $this->preguntas = Doctrine::getTable("CuestionarioPregunta")->createQuery("p")->execute();
    }

    public function executeParse_baja_colaborador(sfWebRequest $request) {
        $this->preguntas = Doctrine::getTable("CuestionarioPregunta")->createQuery()->execute();
        $this->n_preguntas = $this->preguntas->count();
        $this->respuestas = array();

        $c = 0;
        $una_pregunta = false;
        do {
            if (($this->respuestas[$c] = $request->getParameter('pregunta_' . $c, null)) != null)
                $una_pregunta = true;
            $c++;
        }while ($c <= $this->n_preguntas);


        if ($una_pregunta) {
            foreach ($this->respuestas as $key => $r) {
                if ($key == 0)
                    continue;
                if (!$r)
                    $r = 'off';

                if (!$pregunta = Doctrine::getTable('CuestionarioBajaValue')
                        ->createQuery()
                        ->where('user_id=?', $this->getUser()->getGuardUser()->getId())
                        ->andWhere('pregunta_id=?', $key)
                        ->fetchOne()) {
                    $pregunta = new CuestionarioBajaValue();
                }
                $pregunta->setUserId($this->getUser()->getGuardUser()->getId());
                $pregunta->setPreguntaId($key);
                $pregunta->setValue($r);
                $pregunta->save();
            }
            $this->getUser()->setFlash('notice', 'Se ha procesado tu baja.');
            AlertasTable::nueva(2, 'Baja de colaborador', 'Se ha dado de baja.', array('user_id' => $this->getUser()->getGuardUser()->getId()));
            AlertasTable::nueva(900, 'Baja de colaborador', 'El colaborador <strong><a href="colaboradores/' . $this->getUser()->getGuardUser()->getId() . '/List_ver">' . ($this->getUser()->getGuardUser()->getUsername()) . '</a> </strong> se ha dado de baja.');

            $this->getUser()->getGuardUser()->setDisabled(true);
            $this->getUser()->getGuardUser()->save();
            $this->getUser()->signOut();
            $this->redirect('@homepage');
        } else {
            $this->getUser()->setFlash('error_form', 'No has incluido ningún motivo de baja.');
            $this->redirect('vosotros/do_baja_colaborador');
        }

        $this->redirect('@homepage');
    }

    protected function newForm($className, $object = null) {
        $key = "app_sfApplyPlugin_$className" . "_class";
        $class = sfConfig::get($key, $className);
        if ($object !== null) {
            return new $class($object);
        }
        return new $class;
    }

    /**
     * execute Reward Raking method
     * @param sfWebRequest $request
     */
    public function executeRewardRanking(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Ranking de recompensas de auditoscopia');
        $this->getResponse()->addMeta('description', 'Ranking de recompensas por contribuir en la comunidad de Experiencia de Cliente de auditoscopia. ¡Hazte colaborador y gana dinero!');

        // create ranking search form
        $this->reward_ranking_form = new RewardRankingForm();
        //set user money
        $this->money = 0;
        $this->uri = $request->getUri();
        $this->page = $request->getParameter('page', 1);
        $this->is_caja = $request->getParameter('caja', null);
        $this->caja_amount = $request->getParameter('caja_amount', 0);
        // get user records for reward ranking
        $reward_ranking_query = Doctrine::getTable('sfGuardUser')->getUsersForRewardRanking();

        $this->total_contributors = Doctrine::getTable('sfGuardUser')->getUsersForRewardRanking()->fetchArray();

        //get user error values
        if ($this->getUser()->isAuthenticated()) {
            //get user profile
            $this->profile = $this->getUser()->getProfile();
            //get user
            $this->user = $this->getUser()->getGuardUser();
            $this->error = $this->getUser()->getProfile()->isCashUp();
            $this->caja_error = $this->getUser()->getProfile()->isCanjeable();
            $this->money = $this->profile->getMoney();
            $this->contributor_position = $this->getContributorsPosition($this->total_contributors, $this->profile->getId());
        }

        //get request parameters
        if ($request->getMethod() == sfWebRequest::POST) {
            $reward_raking_parameters = $request->getParameter($this->reward_ranking_form->getName());

            //if user parameter present then add it to query
            if ($reward_raking_parameters['user']) {
                $reward_ranking_query->andWhere('sgu.username LIKE "%' . $reward_raking_parameters['user'] . '%"');
            }
            //if rank parameter present then add it to query
            if ($reward_raking_parameters['rank']) {
                $rank_less_limit = array(1 => 1, 2 => 31, 3 => 101, 4 => 301, 5 => 1001, 6 => 6000);
                $rank_max_limit = array(1 => 30, 2 => 100, 3 => 300, 4 => 1000, 5 => 6000, 6 => 10000000000);

                $reward_ranking_query->andWhere('sgup.money_sum  >=' . $rank_less_limit[$reward_raking_parameters['rank']] . ' AND ' . 'sgup.money_sum  <=' . $rank_max_limit[$reward_raking_parameters['rank']]);
            }
            if (!$request->getParameter('static')) {
                $this->setTemplate('rewardRankingAjax');
                $this->setLayout(false);
            }
        }

        $this->reward_ranking_pager = new sfDoctrinePager('sfGuardUser', sfConfig::get('app_max_reward_ranking_items', 20));
        $this->reward_ranking_pager->setQuery($reward_ranking_query);
        $this->reward_ranking_pager->setPage($request->getParameter('page'));
        $this->reward_ranking_pager->init();
    }

    /**
     * method show all contest for given user
     * @param sfWebRequest $request
     */
    public function executeGetUsersContestAndContribution(sfWebRequest $request) {
        $this->box_value = $request->getParameter('box', null);
        //get user id from request
        $this->user_id = $request->getParameter('user_id');
        $this->uri = $request->getUri();
        //set logged user flag
        $this->is_logged = false;
        $this->is_current_user = false;
        if ($this->getUser()->isAuthenticated()) {
            $this->is_logged = true;
            //if logged user and request user is same
            if ($this->getUser()->getGuardUser()->getId() == $this->user_id) {
                $this->is_current_user = true;
            }
        }
        $this->user = Doctrine::getTable('sfGuardUser')->find($this->user_id);
        //get user's contest records
        $this->contests = Doctrine::getTable('Concurso')->getAllContestByUser($this->user_id);
        //get user's contribution records
        $this->contributions = Doctrine::getTable('Contribucion')->getAllContributionByUser($this->user_id);
    }

    /**
     * execute contributors heirarchy raking method
     * @param sfWebRequest $request
     */
    public function executeHierarchyRanking(sfWebRequest $request) {
        $this->box_value = $request->getParameter('box', null);
        // create ranking search form
        $this->hierarchy_ranking_form = new HierarchyRankingForm();
        $this->uri = $request->getUri();
        $this->page = $request->getParameter('page', 1);

        //Page Title
        $this->getResponse()->setTitle('Ranking de colaboradores de auditoscopia');
        $this->getResponse()->addMeta('description', 'Ranking de colaboradores de la comunidad de Experiencia de Cliente de auditoscopia. ¡Contribuye y gana tu Jerarquía!');

        //get user profile
        $this->profile = $this->getUser()->getProfile();
        $this->total_contributors = Doctrine::getTable('sfGuardUser')->getUsersForHierarchyRanking()->fetchArray();

        if ($this->getUser()->isAuthenticated()) {
            //get user profile
            $this->profile = $this->getUser()->getProfile();
            //get user
            $this->user = $this->getUser()->getGuardUser();
            $this->error = $this->profile->isCanjeable();
            $this->points = $this->profile->getAccumulatedPoints();
            $this->contributor_position = $this->getContributorsPosition($this->total_contributors, $this->user->getId());
        }
        // get user records for heirarchy ranking
        $hierarchy_ranking_query = Doctrine::getTable('sfGuardUser')->getUsersForHierarchyRanking();

        //get request parameters
        if ($request->getMethod() == sfWebRequest::POST) {
            $hierarchy_raking_parameters = $request->getParameter($this->hierarchy_ranking_form->getName());
            $this->hierarchy_ranking_form->bind($hierarchy_raking_parameters);
            //if user parameter present then add it to query
            if ($hierarchy_raking_parameters['user']) {
                $hierarchy_ranking_query->andWhere('sgu.username LIKE "%' . $hierarchy_raking_parameters['user'] . '%"');
            }
            //if hierarchy parameter present then add it to query
            if ($hierarchy_raking_parameters['hierarchy']) {
                $hierarchy_ranking_query->andWhere('sgup.hierarchy =?', $hierarchy_raking_parameters['hierarchy']);
            }
            if (!$request->getParameter('static')) {
                $this->setTemplate('hierarchyRankingAjax');
                $this->setLayout(false);
            }
        }

        $this->hierarchy_list = Doctrine::getTable('Jerarquia')->getHierarchyList();
        $this->hierarchy_ranking_pager = new sfDoctrinePager('sfGuardUser', sfConfig::get('app_max_reward_ranking_items', 20));
        $this->hierarchy_ranking_pager->setQuery($hierarchy_ranking_query);
        $this->hierarchy_ranking_pager->setPage($request->getParameter('page', 1));
        $this->hierarchy_ranking_pager->init();
    }

    /**
     * method show all contest for given user
     * @param sfWebRequest $request
     */
    public function executeGetUsersHierarchyHistory(sfWebRequest $request) {
        //get user id from request
        $user_id = $request->getParameter('user_id');
        //set logged user flag
        $this->is_logged = false;
        $this->is_current_user = false;
        if ($this->getUser()->isAuthenticated()) {
            $this->is_logged = true;
            //if logged user and request user is same
            if ($this->getUser()->getGuardUser()->getId() == $user_id) {
                $this->is_current_user = true;
            }
        }
        $this->user = Doctrine::getTable('sfGuardUser')->find($user_id);
        //get user's contest records
        $this->contests = Doctrine::getTable('Concurso')->getAllContestByUser($user_id);
        //get user's contribution records
        $this->contributions = Doctrine::getTable('Contribucion')->getAllContributionByUser($user_id);
        //get user's referanda
        $this->referendas = Doctrine::getTable("ConcursoReferendum")->getAllReferendaByUser($user_id);
        //get audit records
        $this->audits = Doctrine::getTable('ListaCuestionarioUser')->getUserAuditRecords($user_id);
        //get recommendation letters
        $this->recommendation_letters = Doctrine::getTable('ProfesionalLetter')->getRecommendedLetters($user_id);
        //get disapproval letters
        $this->disapproval_letters = Doctrine::getTable('ProfesionalLetter')->getDisapprovalLetters($user_id);
        //get recommeneded registered users
        $this->recommended_registered_users = Doctrine::getTable('Recomienda')->getRegisteredUser($user_id);
        //get auditanos records
        $this->auditanos_records = Doctrine::getTable('Auditanos')->getAuditanosRecords($user_id);
        //get comment records
        $this->comment_records = Doctrine::getTable('ComentarioListaNegra')->getUserCommentRecords($user_id);
        //get user compnay case study
        $this->user_company_case_study_records = Doctrine::getTable('UserCompanyCaseStudy')->getCompanyCaseStudy($user_id);
        //get user product case study
        $this->user_product_case_study_records = Doctrine::getTable('UserProductCaseStudy')->getProductCaseStudy($user_id);
    }

    /**
     * return rank of the contributor
     * @param Array $contributor_records sfGuardUser records
     * @param String $contributor_id Contributor Id
     * @return String
     */
    private function getContributorsPosition($contributor_records, $contributor_id) {
        //iterate each user profile
        foreach ($contributor_records as $index => $contributor) {
            //if user id matched with iterated user id
            if ($contributor_id == $contributor['user_id']) {
                //return position
                return ($index + 1);
            }
        }
        //return null position
        return null;
    }

    /**
     * execute gift listing action
     * @param sfWebRequest $request
     */
    public function executeGiftList(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Escaparate de regalos de la comunidad de auditoscopia');
        $this->getResponse()->addMeta('description', 'Escaparate de regalos de la comunidad de Experiencia de Cliente de auditoscopia. ¡Contribuye y gana regalos!');

        //check if user is logged in or not
        if ($this->getUser()->isAuthenticated()) {
            $profile = $this->getUser()->getProfile();
            $this->redeem_points = $profile->getChangePoints();
            $this->user = $this->getUser();
        } else {
            $this->user = null;
            $this->redeem_points = 0;
        }
        $this->list_page = $request->getParameter('page', 1);
        $this->uri = $request->getUri();
        $this->message = $request->getParameter('message', null);

        //get hierarchy records
        $this->heirarchy_records = Doctrine::getTable('Jerarquia')->getHierarchyList();

        //get gift listing query
        $gift_query = Doctrine::getTable('Gift')->getGiftQuery();
        $this->gift_pager = new sfDoctrinePager('Gift', sfConfig::get('app_max_reward_ranking_items', 6));
        $this->gift_pager->setQuery($gift_query);

        $this->gift_pager->setPage($this->list_page);
        $this->gift_pager->init();
    }

    public function executeGiftRedemption(sfWebRequest $request) {
        //get gift id
        $this->gift_id = $request->getParameter('id');
        //fetch gift record
        $this->gift = Doctrine::getTable('Gift')->find($this->gift_id);
        $this->page = $request->getParameter('page', 1);
        //fetch user profile
        $user = $this->getUser();
        $profile = $user->getProfile();
        //set gift redemption object
        $this->gift_redemption_object = new GiftRedemption();
        $this->gift_redemption_object->setName($profile->getName());
        $this->gift_redemption_object->setSurname1($profile->getSurname1());
        $this->gift_redemption_object->setSurname2($profile->getSurname2());
        $this->gift_redemption_object->setNumber($profile->getNumero());
        $this->gift_redemption_object->setFloor($profile->getPiso());
        $this->gift_redemption_object->setDoor($profile->getPuerta());
        $this->gift_redemption_object->setStatesId($profile->getStatesId());
        $this->gift_redemption_object->setCityId($profile->getCityId());
        $this->gift_redemption_object->setRoadType($profile->getRoadTypeId());
        $this->gift_redemption_object->setAddress($profile->getDireccion());
        $this->gift_redemption_object->setCp($profile->getCp());

        //set gift redemption form
        $this->gift_redemption_form = new GiftRedemptionForm($this->gift_redemption_object);

        if ($request->getMethod() == sfWebRequest::POST) {
            //fetch request parameter
            $gift_redemption_parameter = $request->getParameter($this->gift_redemption_form->getName());
            $gift_redemption_parameter['user'] = $this->getUser()->getGuardUser()->getId();
            $gift_redemption_parameter['gift'] = $this->gift_id;
            $gift_redemption_parameter['created_at'] = date('Y-m-d H:i:s');

            $this->gift_redemption_form->bind($gift_redemption_parameter);

            if ($this->gift_redemption_form->isValid()) {
                $gift_redemption_object = $this->gift_redemption_form->save();
                $profile->setChangePoints($profile->getChangePoints() - $this->gift->getRequirePoints());
                $profile->save();

                $user_history = new ColaboradorPuntosHistorico();
                $user_history->setUserId($user->getGuardUser()->getId());
                $user_history->setTipoPunto('Canje');
                $user_history->setDescripcion('Canje de regalo');
                $user_history->setPuntos($this->gift->getRequirePoints());
                $user_history->save();

                alertasTable::nueva(800, 'Canje', 'ha <a href="/backend.php/gift_redemption/' . $gift_redemption_object->getId() . '/List_ver" >canjeado</a> un regalo', array('user_id' => $user->getGuardUser()->getId()));
                // create reward log
                $reward_log = new RewardLog();
                $reward_log->create($user->getGuardUser(), $user->getHierarchy(), null, $this->gift->getName());
                $this->redirect('/vosotros/giftList?page=' . $this->page . '&message=true');
            } else {
                $this->getUser()->setFlash('errorgift', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeHomePageGiftList(sfWebRequest $request) {
        if ($this->getUser()->isAuthenticated()) {
            $profile = $this->getUser()->getProfile();
            $this->redeem_points = $profile->getChangePoints();
            $this->user = $this->getUser();
        } else {
            $this->user = null;
            $this->redeem_points = 0;
        }
        //get hierarchy records
        $this->heirarchy_records = Doctrine::getTable('Jerarquia')->getHierarchyList();
        //get gift list
        $this->gift_list = Doctrine::getTable('gift')->getFeaturedGiftList();
        //set layout
        $this->setLayout(false);
    }

    /**
     * add comapny to user's favourit records
     * @param sfWebRequest $request
     */
    public function executeAddToFavorite(sfWebRequest $request) {
        //fetch request parameters
        $gift_id = $request->getParameter('gift_id');

        //get user
        $user = $this->getUser()->getGuardUser();
        //fetch company favourit record
        $gift_favourite_record = Doctrine::getTable('GiftFavouriteList')->getRecordByUserAndId($user->getId(), $gift_id);

        //if exist then send exist message
        if ($gift_favourite_record) {
            return $this->renderText('Este regalo <strong>ya está</strong> en Tus favoritos.');
        }
        //if not then create new one
        else {
            $gift_favourite_record = new GiftFavouriteList();
            $gift_favourite_record->create($user->getId(), $gift_id);
            return $this->renderText('Has añadido este <strong>regalo a Tus favoritos.</strong>');
        }

        $this->setLayout(false);
    }

    /**
     * fetch top reward and heirarchy ranking records for homepage
     * @param sfWebRequest $request
     */
    public function executeUserRewardAndHeirarchyRanking(sfWebRequest $request) {
        //fetch reward ranking query
        $reward_ranking_query = Doctrine::getTable('sfGuardUser')->getUsersForRewardRanking();
        $reward_ranking_query->limit(10);
        $this->reward_ranking_records = $reward_ranking_query->execute();

        //fetch heirarchy ranking query
        $hierarchy_ranking_query = Doctrine::getTable('sfGuardUser')->getUsersForHierarchyRanking();
        $hierarchy_ranking_query->limit(10);
        $this->hierarchy_ranking_records = $hierarchy_ranking_query->execute();
        //get hierarchy list
        $this->hierarchy_list = Doctrine::getTable('Jerarquia')->getHierarchyList();
    }

    /**
     * execute refere to firends action
     * @param sfWebRequest $request
     */
    public function executeRecomiendanos(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Recomiéndanos a un amigo');
        $this->getResponse()->addMeta('keywords', 'recomendar amigo, recomendarnos amigo, ayudar amigo, ayudar amigo de amigo');
        $this->getResponse()->addMeta('description', 'Recomienda auditoscopia a un amigo y dile cómo podemos ayudarle a mejorar sus productos y servicios favoritos y ganar dinero');

        //get user
        $usuario = $this->getUser();
        //create form
        $this->recomienda = new RecomiendaForm(null, array('usuario' => $usuario));

        if ($request->isMethod('post')) {
            //get user id
            $user_id = ($usuario->isAuthenticated()) ? $usuario->getGuardUser()->getId() : 0;
            //get and set form parameters
            $recomended_form_parameters = $request->getParameter($this->recomienda->getName());
            $recomended_form_parameters['user_id'] = $usuario->getGuardUser() ? $usuario->getGuardUser()->getId() : '';
            $recomended_form_parameters['created_at'] = date('Y-m-d H:i:s');

            $this->recomienda->bind($recomended_form_parameters);


            if ($this->recomienda->isValid()) {
                //get friends email and names
                $name = array();
                $email = array();
                //fetch usernames and emails
                for ($count = 1; $count <= 10; $count++) {
                    $name[] = $recomended_form_parameters['user_name_' . $count];
                    $email[] = $recomended_form_parameters['user_email_' . $count];
                }

                foreach ($name as $index => $mail) {
                    if ($email[$index]) {
                        $message = $this->getMailer()->compose();
                        $message->setSubject($name[$index] . ', te recomiendo esta web.');
                        //$message->setSubject('Invitación de Auditoscopia');
                        $message->setTo($email[$index]);
                        $html = '<table style=" font-family: \'Trebuchet MS\';font-size: 12px;">';
                        $html .= '<tr><td>¡Hola ' . $name[$index] . '!</tr></td>';
                        $html .= '<tr><td></tr></td><tr><td>¿Te gustaría <strong>mejorar tus productos y servicios favoritos</strong> y tener una experiencia de cliente memorable?</tr></td>';
                        $html .= '<tr><td>¿Quieres <strong>recomendar una empresa o profesional</strong>?</tr></td>';
                        $html .= '<tr><td>Visita <span style=" color: #B41B1D;font-family: \'Franklin\';font-weight: normal;">audit<span style="color:#000;font-size=13px">o</span>scopia</span> (<a href="www.auditoscopia.com" style="font-weight: bold;text-decoration: none;color=#060;">www.auditoscopia.com</a>) y contribuye en nuestra comunidad de Experiencia de Cliente. ¡Puedes ganar regalos y dinero!</tr></td>';
                        $html .= '<tr><td></tr></td><tr><td>' . $recomended_form_parameters['message'] . '</tr></td>';
                        $html .= '</table>';
                        //$html = 'Hola ' . $name[$index] . '<br>' . $recomended_form_parameters['nombre'] . ' ' . $recomended_form_parameters['apellido1'] . ' ' . $recomended_form_parameters['apellido2'] . ' te invita a registrarte en auditoscopia.com.<br><br>Recibe un cordial saludo de parte de todo el equipo.';
                        $message->setBody($html, 'text/html');
                        $message->setFrom($recomended_form_parameters['email']);

                        //create and save recomended model object
                        $recomended_model = new Recomienda();
                        $recomended_model->create($email[$index], $user_id);
                        //enviar mail
                        $this->getMailer()->send($message);
                    }
                }
                $this->getUser()->setFlash('recomienda', '<p>Tu <strong>recomendación a un amigo</strong> se ha enviado correctamente.</p><p>Tu contribución es muy importante para propagar nuestro mensaje.</p><p>¡Muchas gracias por recomendarnos a un amigo!</p>');
                $this->redirect('concurso_index');
                //end foreach
            } else {
                $this->getUser()->setFlash('errorInvite', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
            //end isvalid if
        }
        //end is post request if
    }

    /**
     * execute company case study
     * @param sfWebRequest $request
     */
    public function executeCompanyCaseStudy(sfWebRequest $request) {
        //Page Title
        //$this->getResponse()->setTitle('Casos de éxito de experiencias de cliente satisfactorias');
        $this->getResponse()->setTitle('Nuestros casos de éxito de Empresa y Entidad');
        $this->getResponse()->addMeta('keywords', 'caso éxito, casos éxito, nuestros éxitos, otros éxitos, descripción caso éxito, contar caso éxito, cuenta caso éxito');
        $this->getResponse()->addMeta('description', '¿Has tenido una experiencia de cliente satisfactoria de la que podamos aprender? ¡Cuéntanoslo y gana regalos!');

        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'company';
        $this->submenu_type = 'our_case_study';


        //create pager object
        $this->pager = new sfDoctrinePager('CompanyCaseStudy', sfConfig::get('app_company_case_study_list', 10));
        $this->pager->setQuery(Doctrine::getTable('CompanyCaseStudy')->fecthAll());
        if ($this->getUser()->hasAttribute('pagingNumberCompany')) {
            $this->pager->setPage($this->getUser()->getAttribute('pagingNumberCompany'));
        } else {
            $this->pager->setPage($request->getParameter('page', 1));
        }
        $this->pager->init();
        $this->section = 'Nuestros casos de éxito';
        $this->getUser()->setAttribute("menu", $this->getUser()->getAttribute("menu", 'Empresa/Entidad'));
        $this->getUser()->setAttribute("sub_menu", $this->getUser()->getAttribute("sub_menu", 'Nuestros'));
        $this->setTemplate('caseStudy');
    }

    /**
     * execute company case study Ajex
     * @param sfWebRequest $request
     */
    public function executeCompanyCaseStudyAjex(sfWebRequest $request) {
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'company';
        $this->submenu_type = 'our_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('CompanyCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        $this->pager->setQuery(Doctrine::getTable('CompanyCaseStudy')->fecthAll());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Nuestros casos de éxito';

        $this->getUser()->setAttribute("menu", 'Empresa/Entidad');
        $this->getUser()->setAttribute("sub_menu", $this->getUser()->getAttribute("sub_menu", 'Nuestros'));
    }

    /**
     * execute product case study
     * @param sfWebRequest $request
     */
    public function executeProductCaseStudy(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Nuestros casos de éxito de Producto');

        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'product';
        $this->submenu_type = 'our_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('ProductCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Nuestros casos de éxito';

        $this->setTemplate('caseStudy');

        $this->getUser()->setAttribute("menu", 'Producto');
        $this->getUser()->setAttribute("sub_menu", 'Nuestros');
    }

    /**
     * execute product case study Ajex
     * @param sfWebRequest $request
     */
    public function executeProductCaseStudyAjex(sfWebRequest $request) {
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'product';
        $this->submenu_type = 'our_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('ProductCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Nuestros casos de éxito';
        $this->setTemplate('companyCaseStudyAjex');

        $this->getUser()->setAttribute("menu", 'Producto');
        $this->getUser()->setAttribute("sub_menu", $this->getUser()->getAttribute("sub_menu", 'Nuestros'));
    }

    /**
     * execute product case study paging
     * @param sfWebRequest $request
     */
    public function executeProductCaseStudyPaging(sfWebRequest $request) {
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'product';
        $this->submenu_type = 'our_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('ProductCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Nuestros casos de éxito';
        $this->setTemplate('productCaseStudyPagination');
        $this->getUser()->setAttribute('pagingNumberProduct', $request->getParameter('page', 1));
        $this->getUser()->setAttribute("menu", 'Producto');
        $this->getUser()->setAttribute("sub_menu", 'Nuestros');
    }

    /**
     * execute user product case study paging
     * @param sfWebRequest $request
     */
    public function executeUserProductCaseStudyPaging(sfWebRequest $request) {
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'product';
        $this->submenu_type = 'user_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('UserProductCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        if ($this->getUser()->hasAttribute('pagingNumberProductUser')) {
            $this->pager->setPage($this->getUser()->getAttribute('pagingNumberProductUser'));
        } else {
            $this->pager->setPage($request->getParameter('page', 1));
        }
        $this->pager->init();
        $this->section = 'Otros casos de éxito ';
        $this->setTemplate('userProductCaseStudyPagination');
        $this->getUser()->setAttribute('pagingNumberProductUser', $request->getParameter('page', 1));
        $this->getUser()->setAttribute("menu", 'Producto');
        $this->getUser()->setAttribute("sub_menu", 'Otros');
    }

    /**
     * execute company case study paging
     * @param sfWebRequest $request
     */
    public function executeCompanyCaseStudyPaging(sfWebRequest $request) {
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'company';
        $this->submenu_type = 'our_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('CompanyCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        $this->pager->setQuery(Doctrine::getTable('CompanyCaseStudy')->fecthAll());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Nuestros casos de éxito';
        $this->getUser()->setAttribute("pagingNumberCompany", $request->getParameter('page', 1));
        $this->getUser()->setAttribute("menu", 'Empresa/Entidad');
        $this->getUser()->setAttribute("sub_menu", 'Nuestros');
        $this->setTemplate('companyCaseStudyPagination');
    }

    /**
     * execute user company case study paging
     * @param sfWebRequest $request
     */
    public function executeUserCompanyCaseStudyPaging(sfWebRequest $request) {
        //Page Title
        //$this->getResponse()->setTitle('Otros casos de éxito de Empresa y Entidad');
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'company';
        $this->submenu_type = 'user_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('UserCompanyCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Otros casos de éxito';
        $this->getUser()->setAttribute("pagingNumberCompanyUser", $request->getParameter('page', 1));
        $this->getUser()->setAttribute("menu", 'Empresa/Entidad');
        $this->getUser()->setAttribute("sub_menu", 'Otros');
        $this->setTemplate('userCompanyCaseStudyPagination');
    }

    /**
     * execute user company case study
     * @param sfWebRequest $request
     */
    public function executeUserCompanyCaseStudy(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Otros casos de éxito de Empresa y Entidad');
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'company';
        $this->submenu_type = 'user_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('UserCompanyCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Otros casos de éxito';
        $this->setTemplate('caseStudy');

        $this->getUser()->setAttribute("menu", 'Empresa/Entidad');
        $this->getUser()->setAttribute("sub_menu", 'Otros');
    }

    /**
     * execute user company case study ajex
     * @param sfWebRequest $request
     */
    public function executeUserCompanyCaseStudyAjex(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Otros casos de éxito de Empresa y Entidad');
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'company';
        $this->submenu_type = 'user_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('UserCompanyCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Otros casos de éxito';
        $this->setTemplate('companyProductSubAjex');
    }

    /**
     * execute user product case study
     * @param sfWebRequest $request
     */
    public function executeUserProductCaseStudy(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Otros casos de éxito de Producto');
        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'product';
        $this->submenu_type = 'user_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('UserProductCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Otros casos de éxito ';

        $this->setTemplate('caseStudy');

        $this->getUser()->setAttribute("menu", 'Producto');
        $this->getUser()->setAttribute("sub_menu", 'Otros');
    }

    /**
     * execute user product case study Ajex
     * @param sfWebRequest $request
     */
    public function executeUserProductCaseStudyAjex(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Otros casos de éxito de Producto');

        //get user authentication status
        $this->is_authenticated = $this->getUser()->isAuthenticated();
        $this->parent_menu_type = 'product';
        $this->submenu_type = 'user_case_study';
        //create pager object
        $this->pager = new sfDoctrinePager('UserProductCaseStudy', sfConfig::get('app_concursos_in_list', 6));
        //$this->pager->setQuery($audit_query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->section = 'Otros casos de éxito ';

        $this->setTemplate('companyProductSubAjex');
    }

    /**
     * execute user product case study request
     * @param sfWebRequest $request
     */
    public function executeUserCompanyCaseStudyRequest(sfWebRequest $request) {
        //create company request forrm
        $this->getUser()->setFlash('errorstudy', NULL);
        $usuario = $this->getUser();
        //set user id
        if ($usuario->isAuthenticated()) {
            $user_id = $this->getUser()->getGuardUser()->getId();
        } else {
            $user_id = null;
        }

        $this->company_request_form = new UserCompanyCaseStudyRequestForm(null, array('usuario' => $usuario));
        $this->company_request_form->setDefault('user_id', $user_id);
        $this->section = 'Otros casos de éxito ';

        //get user
        $user = $this->getUser();
        if ($user) {
            $username = $user->getGuardUser()->getUsername();
        } else {
            $username = '';
        }
        $this->company_request_form->getWidget('user_name')->setOption('default', $username);
        if ($request->getMethod() == sfWebRequest::POST) {
            $company_request_parameter = $request->getParameter($this->company_request_form->getName());
            $this->company_request_form->bind($company_request_parameter, $request->getFiles($this->company_request_form->getName()));

            if ($this->company_request_form->isValid()) {
                $company_record = $this->company_request_form->save();

                //get user
                $user = $this->getUser()->getGuardUser();
                AlertasTable::nueva(32, 'Caso de éxito', '<a href="/backend_dev.php/colaboradores/' . $user->getId() . '/List_ver">' . $user->getUserName() . '</a> ha informado sobre un <a href="/backend_dev.php/user_company_case_study_request/' . $company_record->getId() . '">caso de éxito</a>');
                AlertasTable::nueva(2, 'Caso de éxito', 'Ha reportado caso de éxito', array('user_id' => $user->getId()));
                //create contributor's history record
                $contributor_history = new ColaboradorPuntosHistorico();
                $contributor_history->create($user->getId(), 'ha reportado caso de éxito');

                $this->getUser()->setFlash('case_success', '<p>Nos has <strong>contado tu caso de éxito</strong> correctamente.</p><p>Vamos a estudiarlo para ver cómo puede ayudar a nuestra comunidad.</p><p>¡Muchas gracias por tu contribución!</p>');
                $this->redirect('vosotros/userCompanyCaseStudy');
            } else {
                $this->getUser()->setFlash('errorcompanystudy', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
        }
    }

    /**
     * execute user product case study request
     * @param sfWebRequest $request
     */
    public function executeUserProductCaseStudyRequest(sfWebRequest $request) {
        //create product request forrm
        //get user
        $usuario = $this->getUser();
        //set user id
        if ($usuario->isAuthenticated()) {
            $user_id = $this->getUser()->getGuardUser()->getId();
        } else {
            $user_id = null;
        }

        $this->product_request_form = new UserProductCaseStudyRequestForm(null, array('usuario' => $usuario));
        $this->product_request_form->setDefault('user_id', $user_id);
        $this->section = 'Otros casos de éxito ';

        //get user
        $user = $this->getUser();
        if ($user) {
            $username = $user->getGuardUser()->getUsername();
        } else {
            $username = '';
        }
        $this->product_request_form->getWidget('user_name')->setOption('default', $username);
        if ($request->getMethod() == sfWebRequest::POST) {
            $product_request_parameter = $request->getParameter($this->product_request_form->getName());
            $this->product_request_form->bind($product_request_parameter, $request->getFiles($this->product_request_form->getName()));
            if ($this->product_request_form->isValid()) {
                $product_record = $this->product_request_form->save();

                //get user
                $user = $this->getUser()->getGuardUser();
                AlertasTable::nueva(32, 'Caso de éxito', '<a href="/backend_dev.php/colaboradores/' . $user->getId() . '/List_ver">' . $user->getUserName() . '</a> ha informado sobre un <a href="/backend_dev.php/user_product_case_study_request/' . $product_record->getId() . '">caso de éxito</a>');
                AlertasTable::nueva(2, 'Caso de éxito', 'Ha reportado caso de éxito', array('user_id' => $user->getId()));
                //create contributor's history record
                $contributor_history = new ColaboradorPuntosHistorico();
                $contributor_history->create($user->getId(), 'ha reportado caso de éxito');

                $this->getUser()->setFlash('case_success', '<p>Nos has <strong>contado tu caso de éxito</strong> correctamente.</p><p>Vamos a estudiarlo para ver cómo puede ayudar a nuestra comunidad.</p><p>¡Muchas gracias por tu contribución!</p>');
                $this->redirect('vosotros/userProductCaseStudy');
            } else {
                $this->getUser()->setFlash('errorproductstudy', 'El formulario no se ha guardado porque se ha producido algún error.');
            }
        }
    }

    public function executeBaja_notificaciones(sfWebRequest $request) {
        $this->forward404Unless($user_notification = Doctrine::getTable("UserNotification")->findOneByHash($request->getParameter("hash")));
        $this->forward404Unless($tipo = $request->getParameter("tipo"));

        switch ($tipo) {
            case 'colaborador_contribuye_value':
                $user_notification->setColaboradorContribuyeValue(0);
                break;

            case 'concurso_empresa_value':
                $user_notification->setConcursoEmpresaValue(0);
                break;

            case 'concurso_producto_value':
                $user_notification->setConcursoProductoValue(0);
                break;

            case 'lista_blanca_value':
                $user_notification->setListaBlancaValue(0);
                break;

            case 'lista_negra_value':
                $user_notification->setListaNegraValue(0);
                break;

            case 'publica_profesional_value':
                $user_notification->setPublicaProfesionalValue(0);
                break;

            case 'publica_recomend_disaprov_value':
                $user_notification->setPublicaRecomendDisaprovValue(0);
                break;

            default:
                die;
        }

        $user_notification->save();
    }

    /**
     * output the pdf file for given request (comapny or product case study)
     * @param sfWebRequest $request
     * @throws sfStopException
     */
    public function executeDownloadPdf(sfWebRequest $request) {
        //get request parameters
        $request_category = $request->getParameter('category');
        $request_id = $request->getParameter('id');

        //fetch download record
        $this->forward404Unless($download_record = Doctrine::getTable($request_category)->findOneBy($request_id));
        //create pdf file
        $pdf = new PDFClass();
        $pdf->AddPage();
        //add logo
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, $download_record->getName());
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        //add content
        $pdf->WriteHTML(html_entity_decode($download_record->getPlanAccion()));
        //output pdf file
        $pdf->Output(sprintf($download_record->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    public function executeGetCashUpdates(sfWebRequest $request) {
        $this->is_points = $request->getParameter('points');
        //get user
        $this->profile = $this->getUser()->getProfile();
    }

    /**
     * set home page list session
     * @param sfWebRequest $request
     */
    public function executeListSession(sfWebRequest $request) {
        //set session
        $this->getUser()->setAttribute($request->getParameter('session_name'), $request->getParameter('session_data'));
        //set layout

        $this->setLayout(false);
        return sfView::NONE;
    }

    public function executeShowProductCaseStudyDetail(sfWebRequest $request) {
        if ($request->getParameter('type') == "productcase") {
            $this->forward404Unless($this->product = Doctrine::getTable('ProductCaseStudy')->findOneBy('id', $request->getParameter('id')));
        } else if ($request->getParameter('type') == "userproductcase") {
            $this->forward404Unless($this->product = Doctrine::getTable('UserProductCaseStudy')->findOneBy('id', $request->getParameter('id')));
        }
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowCompanyCaseStudyDetail(sfWebRequest $request) {
        if ($request->getParameter('type') == "companycase") {
            $this->forward404Unless($this->company = Doctrine::getTable('CompanyCaseStudy')->findOneBy('id', $request->getParameter('id')));
        } else if ($request->getParameter('type') == "usercompanycase") {
            $this->forward404Unless($this->company = Doctrine::getTable('UserCompanyCaseStudy')->findOneBy('id', $request->getParameter('id')));
        }
        $this->setLayout('layout_emergente_new');
    }

}
