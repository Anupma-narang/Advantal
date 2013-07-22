<?php

require_once dirname(__FILE__) . '/../lib/sfguarduserGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/sfguarduserGeneratorHelper.class.php';

/**
 * sfguarduser actions.
 *
 * @package    symfony
 * @subpackage sfguarduser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfguarduserActions extends autoSfguarduserActions {

    public function executeNew(sfWebRequest $request) {
        $this->form = new sfGuardUserBackendForm();
        $pemission = Doctrine::getTable('sfGuardPermission')->findOneBy('name', 'Colaborador', Doctrine::HYDRATE_ARRAY);

        $this->form->setDefault('permissions_list', $pemission['id']);
        $this->add_more = false;
        if ($request->getParameter('addmore')) {
            $this->add_more = true;
        }


        if ($request->isMethod('post')) {
            $request_parameters = $request->getParameter('sf_guard_user');
            if (($this->getUser()->hasCredential('Superadministrador')) && ($request_parameters['permissions_list'] == 1 )) {
                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            } elseif (($this->getUser()->hasCredential('Administrador') || $this->getUser()->hasCredential('Editor')) && ($request_parameters['permissions_list'] == 2 || $request_parameters['permissions_list'] == 1 )) {
                $this->form->bind($request->getParameter('sf_guard_user'), $request->getFiles('sf_guard_user'));
                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            } elseif ($this->getUser()->hasCredential('Editor') && $request_parameters['permissions_list'] == 4) {
                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
                $this->redirect('sfguarduser');
            } elseif ($this->getUser()->hasCredential('Editor') && $request_parameters['permissions_list'] == 3) {
                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
                $this->redirect('sfguarduser');
            } else {
                $this->form->bind($request->getParameter('sf_guard_user'), $request->getFiles('sf_guard_user'));
                if ($this->form->isValid()) {

                    $permission_id = $request_parameters['permissions_list'];
                    $id = $this->form->save();
                    //get user permission record
                    $user_permission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $id);
                    if ($user_permission == null) {
                        //create sfguard user permission model object
                        $user_permission = new sfGuardUserPermission();
                    }
                    $user_permission->create($id, $permission_id);

                    if (isset($_POST['add_more'])) {
                        $this->redirect('@sfguarduser_action_new?addmore=true');
                    } else {
                        $this->redirect('@sfguarduser');
                    }
                }
            }
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $sfGuardUser = Doctrine::getTable('sfGuardUser')->findOneBy('id', $this->id);
        $this->form = new sfGuardUserBackendForm($sfGuardUser);
        $this->form->getDefaultValuesSfGuardUser();
        if ($this->getUser()->hasCredential('Superadministrador') && in_array('Superadministrador', $sfGuardUser->getPermissionNames()) && $this->id == $this->getUser()->getId()) {
            $this->form->bind($request->getParameter('sf_guard_user'), $request->getFiles('sf_guard_user'));
            $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            $this->redirect('sfguarduser');
        } elseif (($this->getUser()->hasCredential('Administrador') || $this->getUser()->hasCredential('Editor')) && (in_array('Superadministrador', $sfGuardUser->getPermissionNames()) || in_array('Administrador', $sfGuardUser->getPermissionNames()) )) {
            $this->form->bind($request->getParameter('sf_guard_user'), $request->getFiles('sf_guard_user'));
            $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            $this->redirect('sfguarduser');
        } elseif (($this->getUser()->hasCredential('Editor') && in_array('Editor', $sfGuardUser->getPermissionNames()) && $this->getUser()->getId() != $this->id)) {
            $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            $this->redirect('sfguarduser');
        } elseif ($this->getUser()->hasCredential('Editor') && in_array('Lector', $sfGuardUser->getPermissionNames())) {
            $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            $this->redirect('sfguarduser');
        }
        $this->created_ok = false;
        if ($request->getParameter('created_ok')) {
            $this->created_ok = true;
        }

        if ($request->isMethod('post')) {
            $request_parameters = $request->getParameter('sf_guard_user');
            if (($this->getUser()->hasCredential('Superadministrador')) && ($request_parameters['permissions_list'] == 1 ) && $request_parameters['id'] != $this->getUser()->getId()) {
                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
                $this->redirect('sfguarduser');
            }

            $this->form->bind($request->getParameter('sf_guard_user'), $request->getFiles('sf_guard_user'));
            if ($this->form->isValid()) {
                $permission_id = $request_parameters['permissions_list'];
                $id = $this->form->save();
                //get user permission record
                $user_permission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $this->id);
                if ($user_permission == null) {
                    //create sfguard user permission model object
                    $user_permission = new sfGuardUserPermission();
                }
                $user_permission->create($this->id, $permission_id);
                $this->redirect('sfguarduser');
            }
        }
    }

    public function executeBaja(sfWebRequest $request) {
        $this->forward404Unless($id = $request->getParameter('id'));
        $this->forward404Unless($user = Doctrine::getTable('sfguarduser')->createQuery()->where('id=?', $id)->fetchOne());

        $user->setDisabled(true);
        $user->save();

        $this->getUser()->setFlash('notice', 'Has dado de baja al usuario seleccionado.');
        $this->redirect('sfguarduser');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $sfguarduser = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $sfguarduser)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@sfguarduser_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'sfguarduser'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeBatchBajas(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $q = Doctrine_Query::create()->from('sfguarduser')->whereIn('id', $ids);

        foreach ($q->execute() as $user) {
            $user->setDisabled(true);
            $user->save();
        }

        $this->getUser()->setFlash('notice', 'Has dado de baja a los usuarios seleccionados.');

        $this->redirect('sfguarduser');
    }

    public function executePuntos(sfWebRequest $request) {
        $this->user = $this->getRoute()->getObject();
        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
    }

    public function executeCaja(sfWebRequest $request) {

        $this->uid = $request->getParameter('id');
        $this->form = new BaseChangeCajaBackendForm();
        $this->contributor = Doctrine::getTable('sfguarduser')->createQuery()->where('id=?', $this->uid)->fetchOne();
        if ($request->isMethod(sfWebRequest::POST)) {
          
            $caja_parameter = $request->getParameter($this->form->getName());

            $this->form->bind($caja_parameter);
            if ($this->form->isValid()) {

                $profile = $this->contributor->getProfile();
                
                $caja_amount = $caja_parameter['cantidad'];
                $caja_amount = str_replace('.', '', $caja_amount);
                $caja_amount = str_replace(',', '.', $caja_amount);
                $cash_amount = $caja_amount;
                $cash_value = $cash_amount;
                $tempMoney = $caja_amount;
                
                $profile->setCaja($caja_amount, ($caja_parameter['accion'] == 1) ? '+' : '-');

                if ($caja_parameter['accion'] == 2 && $caja_amount < 0)
                {
                    $caja_amount = abs($caja_amount);
                }
                else if ($caja_parameter['accion'] == 2 && $caja_amount > 0)
                {
                    $caja_amount = -($caja_amount);
                }


                
                $comentario = $caja_parameter['comentario'];
                ColaboradorPuntosHistoricoTable::new_log($this->uid, $comentario, $caja_amount, null, null, null, 'Asignación de caja');
                if ($caja_parameter[accion] == 1) {
                    $this->getUser()->setFlash('notice', 'Has asignado una Caja de ' . $this->getUser()->getMoneyInFormat($tempMoney) . ' € al colaborador ' . $this->contributor->getUsername().".");
                } else {
                    if ($cash_value < 0) {
                        $cash_value = -($cash_value);
                    }

                    $this->getUser()->setFlash('notice', 'Has restado ' . $this->getUser()->getMoneyInFormat($tempMoney) . ' € de la Caja del colaborador  ' . $this->contributor->getUsername().".");
                }

                $this->redirect('colaboradores/index');
            } else {

            }
        }
    }

    public function executeDoPuntos(sfWebRequest $request) {
        //$this->forward404Unless($user_id = $request->getPostParameter('user_id'),'necesitas el id del usuario');

        $this->user = $this->getRoute()->getObject();
        $point_type = $request->getParameter('point_type');

        //los puntos
        $puntos = $otro_puntos = $total = 0;
        $codigos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=false')->execute();
        foreach ($codigos as $codigo) {
            if ($request->getParameter($codigo->getCodigo())) {
                $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                $this->user->getProfile()->setPuntos($puntos, $point_type);
                $total += $puntos;
                ColaboradorPuntosHistoricoTable::new_log($this->user->getId(), $codigo->getDescripcion(), $puntos, null, null);
            }
        }
        if (($otro_descripcion = $request->getParameter('otro_descripcion')) && ($otro_puntos = $request->getParameter('otro_puntos'))) {
            $this->user->getProfile()->setPuntos($otro_puntos, $point_type);
            ColaboradorPuntosHistoricoTable::new_log($this->user->getId(), $otro_descripcion, $otro_puntos, null, null);
        }
        $profile = $this->user->getProfile();
        //get heirarchy list
        $hierarchy_list = Doctrine::getTable('Jerarquia')->findAll();
        //get user hierarchy
        $user_hierarchy = $profile->getHierarchy();
        //get accumulated points
        $user_accumulated_points = $profile->getAccumulatedPoints();
        $hierarchy_record = null;
        foreach ($hierarchy_list as $index => $hierarchy) {

            //if user hierarchy is changed
            if ($user_accumulated_points >= ceil($hierarchy->getPoints()) && $user_hierarchy < $hierarchy->getId()) {
                $hierarchy_record = $hierarchy;
            }
        }
        //hierarchy is changed
        if ($hierarchy_record) {
            //and heirarchy is not same
            if ($hierarchy_record->getId() != $user_hierarchy) {
                //create hierarchy history record (for backend)
                $hierarchy_point_record = new ColaboradorPuntosHistorico();
                //insert hierarchy histroy record into db
                $hierarchy_text = 'Cambio de Jerarquía a ' . $hierarchy_record->getName();
                $hierarchy_point_record->create($this->user->getId(), $hierarchy_text);
                $profile->setHierarchy($hierarchy_record->getId());
                $profile->save();

                if ($hierarchy_record->getName() != 'Colaborador') {
                    //create alertas record
                    $alertas_record = new Alertas();
                    //insert alertas record into db
                    $alertas_record->create($this->user->getId(), 'Nuevo ' . $hierarchy_record->getName(), 'Cambio de Jerarquía');

                    //create alertas record
                    $alertas_record = new Alertas();
                    $alertas_record->create($this->user->getId(), ' ha pasado a ' . $hierarchy_record->getName(), 'Jerarquía', 32);
                }
            }
        }
        //end hierarchy block
        $p = $otro_puntos + $total;
        $this->getUser()->setFlash('notice', 'Has asignado un total de '.number_format($p, 0, '.', '.'). ' puntos al colaborador ' . $this->user->getUsername().".");
        $this->redirect('colaboradores/index');
    }

    public function executeList_ver(sfWebRequest $request) {
        $this->form = new BaseChangeCajaBackendForm();
        $validator_schema = $this->form->getValidatorSchema();
        $validator_schema['accion'] = new sfValidatorInteger(array('required' => false));
        $validator_schema['comentario'] = new sfValidatorInteger(array('required' => false));
        if ($request->getMethod() == sfWebRequest::POST) {
            $parameter = $request->getParameter($this->form->getName());

            $user_id = $request->getParameter('id');
            //get user
            $this->user = Doctrine::getTable('sfGuardUser')->find($user_id);
            $this->caja_accumulated = $parameter['cantidad'];
            $this->caja_accumulated = str_replace('.', '', $this->caja_accumulated);
            $this->caja_accumulated = str_replace(',', '.', $this->caja_accumulated);
            $this->form->bind($parameter);
            if ($this->form->isValid() && ($this->getUser()->hasCredential('Administrador') || $this->getUser()->hasCredential('Superadministrador'))) {
                $profile = $this->user->getProfile();
                $profile->setMoneySum($this->caja_accumulated);
                $profile->save();
            } elseif (!$this->getUser()->hasCredential('Administrador') && !$this->getUser()->hasCredential('Superadministrador')) {
                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
                $this->redirect($request->getUri());
            } else {

                $this->caja_error = true;
            }
            //get user id
        } else {
            $this->user = $this->getRoute()->getObject();
            $this->caja_accumulated = $this->user->getProfile()->getMoneySum();

            $this->form->setDefault('cantidad', $this->getUser()->getMoneyInFormat($this->caja_accumulated));
        }
    }

    public function executeHistorico(sfWebRequest $request) {
        $this->user = $this->getRoute()->getObject();

        $this->redirect('@colaboradorpuntoshistorico?user_id=' . $this->user->getId());
    }

    public function executeDelete(sfWebRequest $request) {

        try {
            $this->id = $request->getParameter('id');

            $sfGuardUser = Doctrine::getTable('sfGuardUser')->findOneBy('id', $this->id);
            //if ($sfGuardUser->getId() != $this->id) {


            if (($this->getUser()->hasCredential('Administrador') || $this->getUser()->hasCredential('Editor')) && (in_array('Superadministrador', $sfGuardUser->getPermissionNames()) || in_array('Administrador', $sfGuardUser->getPermissionNames()))) {

                $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            } else {
                $request->checkCSRFProtection();
                //   $this->getUser()->setFlash('error', 'Para borrar ese elemento necesitas antes borrar el concurso, empresa/entidad o producto que lo está utilizando.');
                //test if there a product with this cuestionario
                $colaborador = $this->getRoute()->getObject();
                $concurso_user = Doctrine::getTable('Concurso')
                        ->createQuery('con')
                        ->leftJoin('con.User su')
                        ->where('con.user_id=su.id')
                        ->andWhere('con.user_id =?', $request->getParameter('id'))
                        ->count();
                $contribucion_user = Doctrine::getTable('Contribucion')
                        ->createQuery('cont')
                        ->leftJoin('cont.User su')
                        ->where('cont.user_id=su.id')
                        ->andWhere('cont.user_id =?', $request->getParameter('id'))
                        ->count();
                $profesional_user = Doctrine::getTable('profesional')
                        ->createQuery('prof')
                        ->leftJoin('prof.User su')
                        ->where('prof.user_id=su.id')
                        ->andWhere('prof.user_id =?', $request->getParameter('id'))
                        ->count();
                $auditanos_user = Doctrine::getTable('auditanos')
                        ->createQuery('aud')
                        ->leftJoin('aud.sfGuardUser su')
                        ->where('aud.user_id=su.id')
                        ->andWhere('aud.user_id =?', $request->getParameter('id'))
                        ->count();
                $empresa_user = Doctrine::getTable('Empresa')
                        ->createQuery('em')
                        ->leftJoin('em.sfGuardUser su')
                        ->where('em.user_id=su.id')
                        ->andWhere('em.user_id =?', $request->getParameter('id'))
                        ->count();
                $profesionalletter_user = Doctrine::getTable('ProfesionalLetter')
                        ->createQuery('pl')
                        ->leftJoin('pl.User su')
                        ->where('pl.user_id=su.id')
                        ->andWhere('pl.user_id =?', $request->getParameter('id'))
                        ->count();
                $contactanos_user = Doctrine::getTable('contactanos')
                        ->createQuery('cnt')
                        ->leftJoin('cnt.sfGuardUser su')
                        ->where('cnt.user_id=su.id')
                        ->andWhere('cnt.user_id =?', $request->getParameter('id'))
                        ->count();
                $recomienda_user = Doctrine::getTable('recomienda')
                        ->createQuery('rec')
                        ->leftJoin('rec.sfGuardUser su')
                        ->where('rec.user_id=su.id')
                        ->andWhere('rec.user_id =?', $request->getParameter('id'))
                        ->count();
                $comentariolistanegra_user = Doctrine::getTable('ComentarioListaNegra')
                        ->createQuery('cln')
                        ->leftJoin('cln.User su')
                        ->where('cln.sf_guard_user_id=su.id')
                        ->andWhere('cln.sf_guard_user_id =?', $request->getParameter('id'))
                        ->count();
                $listacuestionariouser_user = Doctrine::getTable('ListaCuestionarioUser')
                        ->createQuery('lcu')
                        ->leftJoin('lcu.User su')
                        ->where('lcu.user_id=su.id')
                        ->andWhere('lcu.user_id =?', $request->getParameter('id'))
                        ->count();
                $listausercompanycasestudy_request = Doctrine::getTable('UserCompanycaseStudyRequest')
                        ->createQuery('uccsr')
                        ->leftJoin('uccsr.User su')
                        ->where('uccsr.user_id=su.id')
                        ->andWhere('uccsr.user_id =?', $request->getParameter('id'))
                        ->count();
                $listauserproductcasestudy_request = Doctrine::getTable('UserProductcaseStudyRequest')
                        ->createQuery('upcsr')
                        ->leftJoin('upcsr.User su')
                        ->where('upcsr.user_id=su.id')
                        ->andWhere('upcsr.user_id =?', $request->getParameter('id'))
                        ->count();
                $listausercompanycasestudy = Doctrine::getTable('UserCompanycaseStudy')
                        ->createQuery('uccs')
                        ->leftJoin('uccs.User su')
                        ->where('uccs.user_id=su.id')
                        ->andWhere('uccs.user_id =?', $request->getParameter('id'))
                        ->count();
                $listauserproductcasestudy = Doctrine::getTable('UserProductcaseStudy')
                        ->createQuery('upcs')
                        ->leftJoin('upcs.User su')
                        ->where('upcs.user_id=su.id')
                        ->andWhere('upcs.user_id =?', $request->getParameter('id'))
                        ->count();

                /* echo "concurso > ".$concurso_user."<br>";
                  echo "contribucion > ".$contribucion_user."<br>";
                  echo "profesional > ".$profesional_user."<br>";
                  echo "auditanos > ".$auditanos_user."<br>";
                  echo "empresa > ".$empresa_user."<br>";
                  echo "profesionalletter > ".$profesionalletter_user."<br>";
                  echo "contactanos > ".$contactanos_user."<br>";
                  echo "recomienda > ".$recomienda_user."<br>";
                  echo "comentariolistanegra > ".$comentariolistanegra_user."<br>";
                  echo "listacuestionariouser > ".$listacuestionariouser_user."<br>";
                  echo "user company case study request > ".$listausercompanycasestudy_request."<br>";
                  echo "user product case study request > ".$listauserproductcasestudy_request."<br>";
                  echo "user company case study > ".$listausercompanycasestudy."<br>";
                  echo "user product case study > ".$listauserproductcasestudy."<br>";
                  die; */

                if ($concurso_user <= 0 && $contribucion_user <= 0 && $profesional_user <= 0 && $auditanos_user <= 0 &&
                        $empresa_user <= 0 && $profesionalletter_user <= 0 && $contactanos_user <= 0 && $recomienda_user <= 0 &&
                        $comentariolistanegra_user <= 0 && $listacuestionariouser_user <= 0 && $listausercompanycasestudy_request <= 0 &&
                        $listauserproductcasestudy_request <= 0 && $listausercompanycasestudy <= 0 && $listauserproductcasestudy <= 0) {

                    // administration_emails
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('AdministrationEmails tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // alertas_de_caja
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('AlertasDeCaja tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // user_auditoria
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('UserAuditoria tbl');
                    $ss__DeleteQry->andWhereIn('tbl.sf_guard_user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // auditanos
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Auditanos tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // comentario_concurso
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ComentarioConcurso tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // comentario_cp
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ComentarioCp tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // comentario_lista_negra
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ComentarioListaNegra tbl');
                    $ss__DeleteQry->andWhereIn('tbl.sf_guard_user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //  company_contest_favourite_list
                    /*$ss__DeleteQry = Doctrine_Query::create()->delete()->from('CompanyContestFavouriteList tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // company_favourite_list
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('CompanyFavouriteList tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();*/

                    //   concurso_cp
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ConcursoCp tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //   concurso_referendum_cp
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ConcursoReferendumCp tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //   concurso_referendum
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ConcursoReferendum tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //   contribucion
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Contribucion tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //   contribucion_cp
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ContribucionCp tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //  concurso
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Concurso tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //   contactanos
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Contactanos tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();


                    // cuestionario_baja_value
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('CuestionarioBajaValue tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // empresa
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Empresa tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // ganadores_concursos
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('GanadoresConcursos tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // gift_favourite_list
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('GiftFavouriteList tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // gift_redemption
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('GiftRedemption tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // informa
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Informa tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // lista_cuestionario_user
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ListaCuestionarioUser tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //  metodo_banco
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('MetodoBanco tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //   metodo_paypal
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('MetodoPaypal tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //    order_preferences
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('OrderPreferences tbl');
                    $ss__DeleteQry->andWhereIn('tbl.sf_guard_user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //     product_contest_favourite_list
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ProductContestFavouriteList tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //     product_favourite_list
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ProductFavouriteList tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //     profesional
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Profesional tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //     profesional_letter
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ProfesionalLetter tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //     recomienda
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('Recomienda tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //      reward_log
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('RewardLog tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();


                    //      user_company_case_study
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('UserCompanyCaseStudy tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //      user_company_case_study_request
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('UserCompanyCaseStudyRequest tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //       user_notification
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('UserNotification tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //      user_product_case_study
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('UserProductCaseStudy tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    //      user_product_case_study_request
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('UserProductCaseStudyRequest tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();

                    // colaborador_puntos_historico
                    $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ColaboradorPuntosHistorico tbl');
                    $ss__DeleteQry->andWhereIn('tbl.user_id', $request->getParameter('id'));
                    $ss__DeleteQry->execute();


                    $colaborador->delete();
                    $this->getUser()->setFlash('notice', 'El elemento se ha borrado correctamente.');
                } else {
                    //$this->getUser()->setFlash('error', 'Para borrar ese elemento necesitas antes borrar el concurso, empresa/entidad o producto que lo está utilizando.');
                    $this->redirect('colaboradores/index?eid=1');
                }
                //$colaborador->delete();
            }
            // }
            $this->redirect('colaboradores/index');
        } catch (Exception $e) {
            $this->redirect('colaboradores/index?eid=1'.$e->getMessage());
        }
    }

    /**
     * method assign hierarchy to selected contributor
     * @param sfWebRequest $request
     */
    public function executeHierarchy(sfWebRequest $request) {
      
        //get user id
        $user_id = $request->getParameter('id');
        //get user
        $this->user = Doctrine::getTable('sfGuardUser')->find($user_id);
        //get user profile
        $user_profile = Doctrine::getTable('sfGuardUserProfile')->find($user_id);
        //create hierarchy form
        $this->sf_guard_user_profile_form = new sfGuardUserProfileForm($user_profile);

        if ($request->getMethod() == sfWebRequest::POST) {

            if($this->user->getIsDisabled())
            {
              $this->getUser()->setFlash('error','No puedes asignar jerarquías a un usuario dado de baja.');
              $this->redirect("colaboradores/index");
            }
            //get hierarchy parameter from hierarchy form
            $sf_guard_user_form_parameter = $request->getParameter($this->sf_guard_user_profile_form->getName());
            //get hierarchy
            $hierarchy = Doctrine::getTable('Jerarquia')->find($sf_guard_user_form_parameter['hierarchy']);
            //set rank (Hierarchy)
            $user_profile->setHierarchy($sf_guard_user_form_parameter['hierarchy']);
            //update db
            $user_profile->save();

            //create hierarchy history record (for backend)
            $hierarchy_record = new ColaboradorPuntosHistorico();
            //insert hierarchy histroy record into db
            $hierarchy_text = 'Asignación manual a ' . $hierarchy->getName();
            $hierarchy_record->create($user_id, $hierarchy_text);

            //create alertas record
            $alertas_record = new Alertas();
            //insert alertas record into db
            $hierarchy_name = $hierarchy->getName();
            if ($hierarchy_name == 'Colaborador') {
                $hierarchy_name = 'Service Colaborador';
            }
            $alertas_record->create($user_id, 'Nuevo ' . $hierarchy_name, 'Asignación de Jerarquía');

            //create alertas record
            $alertas_record = new Alertas();
            $alertas_record->create($user_id, ' ha pasado a ' . $hierarchy_name, 'Jerarquía', 32);

            $this->getUser()->setFlash('notice', ' Has asignado la Jerarquía de ' .$hierarchy_name. ' al colaborador '.$this->user->getUsername().".");
            
            //redirect to home of contributor
            $this->redirect('/backend.php/colaboradores');
        }
    }

    /**
     * Assign permission to existing user
     * @param sfWebRequest $request
     */
    public function executeAssignPermission(sfWebRequest $request) {
        //fetch request parameters
        $user_id = $request->getParameter('id');
        //get user
        $this->user = Doctrine::getTable('sfGuardUser')->find($user_id);
        
        //get user permission record
        $user_permission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $user_id);

        if ($user_permission && $user_permission->getPermissionId() == 1 && !$this->getUser()->hasCredential('Superadministrador')) {
            $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            $this->redirect('sfguarduser');
        } elseif ($user_permission && $user_permission->getPermissionId() == 2 && $this->getUser()->hasCredential('Administrador') && $this->getUser()->GetId() != $user_id) {
            $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
            $this->redirect('sfguarduser');
        }
        //get user
        $user = Doctrine::getTable('sfGuardUser')->find($user_id);

        $this->permission_form = new sfForm();
        $this->permission_form->setWidget('permission', new sfWidgetFormDoctrineChoice(array('default' => ($user_permission ? $user_permission->getPermissionId() : '5'), 'multiple' => false, 'model' => 'sfGuardPermission')));
        $this->permission_form->setValidator('permission', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'required' => false)));
        $this->permission_form->getWidgetSchema()->setNameFormat('sf_permission[%s]');

        //request method is POST
        if ($request->getMethod() == sfWebRequest::POST) {

            if($this->user->getIsDisabled())
            {
//              $this->getUser()->setFlash('error','No puedes asignar permisos a un usuario dado de baja');
                $this->redirect("colaboradores/index");
            }
            
            $super_admin_permission_record = Doctrine::getTable('sfGuardUserPermission')->isSuperAdminExist();
            $request_parameters = $request->getParameter($this->permission_form->getName());

            if ($super_admin_permission_record['superadmin'] == $request_parameters['permission']) {
                $this->error_message = 'Permiso superadmin se utiliza antes.';
            } else {
                $request_parameters = $request->getParameter($this->permission_form->getName());

                $this->permission_form->bind($request_parameters);
                //if form is valid
                if ($this->permission_form->isValid() && ! $this->user->getIsDisabled()) {
                    $permission_id = $request_parameters['permission'];

                    if ($user_permission == null) {
                        //create sfguard user permission model object
                        $user_permission = new sfGuardUserPermission();
                    }
                    $user_permission->create($user_id, $permission_id);
                    $permissions = Doctrine::getTable('sfGuardPermission')->findOneBy('id', $permission_id, Doctrine::HYDRATE_ARRAY);
                    $this->getUser()->setFlash('notice', 'El usuario ' . $user->getUsername() . ' ha cambiado sus privilegios a ' . $permissions['name'] . '.');
                    $this->redirect('/backend.php/sfguarduser');
                }
            }
        }
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }
        $this->filtershow = $this->getUser()->getAttribute('sfguarduser.filters', null, 'admin_module');

        $this->filters->setTableMethod($tableMethod);
        $newvar = $this->getFilters();


        $query = $this->filters->buildQuery($this->getFilters());
        
        if (!empty($newvar['email_address']))
        {
            $query->andWhere("r.email_address LIKE '%$newvar[email_address]%'");
        }        
        
        $this->addSortQuery($query);
        
        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

        // echo $query->getSqlQuery();exit;

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        return $query;
    }

    /* protected function buildQuery() {
      $tableMethod = $this->configuration->getTableMethod();
      if (null === $this->filters) {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
      }

      $this->filters->setTableMethod($tableMethod);

      $query = $this->filters->buildQuery($this->getFilters());

      $sort = $this->getSort();
      $sort_column = $this->getUser()->getAttribute('sfguarduser.sort', null, 'admin_module');
      if ($sort_column[0] == 'username') {
      $query = Doctrine_Query::create()
      ->select('sgu.*,j.id')
      ->from('sfGuardUser sgu,Jerarquia j')
      ->leftJoin('sgu.Profile sgup')
      ->where('j.id = sgup.hierarchy')
      ->groupBy('j.name')
      ->orderBy('j.name' . ' ' . $sort[1]);
      } else {
      if ($sort[0] != "") {
      $query->addOrderBy($sort[0] . ' ' . $sort[1]);
      } else {
      $this->addSortQuery($query);
      }
      }
      //echo $query->getSqlQuery();die;
      $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
      $query = $event->getReturnValue();

      return $query;
      } */
}
