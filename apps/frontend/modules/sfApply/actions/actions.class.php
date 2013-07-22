<?php

// Necessary due to a bug in the Symfony autoloader
require_once(sfConfig::get('sf_plugins_dir') .
        '/sfDoctrineApplyPlugin/modules/sfApply/lib/BasesfApplyActions.class.php');

class sfApplyActions extends BasesfApplyActions {

    public function executeMail() {
        $mensaje = Swift_Message::newInstance()
                ->setFrom(sfConfig::get('app_default_mailfrom'))
                ->setTo("info@dmtsoluciones.com")
                ->setSubject('subject')
                ->setBody("body");
        $this->getMailer()->send($mensaje);
        $this->redirect("@homepage");
    }

    protected function mail($options) {
        $required = array('subject', 'parameters', 'email', 'fullname', 'html', 'text');
        foreach ($required as $option) {
            if (!isset($options[$option])) {
                throw new sfException("Required option $option not supplied to sfApply::mail");
            }
        }

        $mensaje = Swift_Message::newInstance()
                ->setFrom(sfConfig::get('app_default_mailfrom'))
                ->setTo($options['email'])
                ->setSubject($options['subject'])
                ->setBody($this->getPartial($options['text'], $options['parameters']), 'text/plain')
                ->addPart($this->getPartial($options['html'], $options['parameters']), 'text/html');
        $this->getMailer()->send($mensaje);
    }

    public function executeApply(sfRequest $request) {
        $this->getUser()->setFlash('errorregister', NULL);
        $this->prefix = 'sfApplyForm';
        $this->step = intval($request->getParameter('step', 1));
        $this->backpressed = $request->hasParameter('_back');
        if (count($this->getUser()->getAttributeHolder()->getAll($this->prefix)) < $this->step - 1) {
            $this->getUser()->getAttributeHolder()->removeNamespace($this->prefix);
            $this->getUser()->getAttributeHolder()->removeNamespace($this->prefix . '_tainted');
            $this->getUser()->getAttributeHolder()->removeNamespace($this->prefix . '_files');
            $this->getUser()->getAttributeHolder()->removeNamespace('image_array');
            $this->getUser()->getAttributeHolder()->removeNamespace('image_object');
            $this->step = 1;
            $form_name = $this->prefix . $this->step;
            $this->form = new $form_name();
        } else {
            $form_name = $this->prefix . ($this->backpressed ? $this->step - 1 : $this->step);
            $this->form = new $form_name();
            if ($request->isMethod(sfRequest::POST)) {
                if ($this->backpressed) {
                    $this->getUser()->setAttribute($this->prefix . $this->step, $request->getParameter($this->prefix . $this->step), $this->prefix . '_tainted');
                    $this->step = $this->step - 1;
                    $values = $this->getUser()->getAttribute($this->form->getName(), array(), $this->prefix);

                    // image upload and show image for temparary
                    $image_array = $this->getUser()->getAttribute('image_array', array());
                    if (is_array($image_array) && isset($image_array['persistid'])) {
                        $file_persist = new pkValidatorFilePersistent();
                        $file_info = $file_persist->getFileInfo($image_array['persistid']);
                        if ($file_info) {
                            $pathInfo = pathinfo($file_info['name']);
                            $filename = sha1($file_info['name'] . microtime() . rand()) . "." . $pathInfo['extension'];
                            copy($file_info['tmp_name'], sfConfig::get('sf_images_dir') . '/users/' . $filename);
                            $thumb = new sfThumbnail(52, 52, true, false, 75, 'sfGDAdapter');
                            $thumb->loadFile(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                            $thumb->save(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                            $this->thumbnail = $filename;
                        }
                    }


                    $this->form->bind($values, array());
                    $this->form->resetErrorSchema();
                } else {
                    $taintedValues = $request->getParameter($form_name);
                    if ($form_name == 'sfApplyForm1') {
                        $this->getUser()->setAttribute('image_array', $taintedValues['image']);
                        $taintedValues = array_merge($taintedValues, array('captcha' => array(
                                'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
                                'recaptcha_response_field' => $request->getParameter('recaptcha_response_field'))
                                ));

                        // image upload and show image for temparary
                        $image_array = $this->getUser()->getAttribute('image_array', array());
                        if (is_array($image_array) && isset($image_array['persistid'])) {
                            $file_persist = new pkValidatorFilePersistent();
                            $file_info = $file_persist->getFileInfo($image_array['persistid']);
                            if ($file_info) {
                                $pathInfo = pathinfo($file_info['name']);
                                $filename = sha1($file_info['name'] . microtime() . rand()) . "." . $pathInfo['extension'];
                                copy($file_info['tmp_name'], sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $thumb = new sfThumbnail(52, 52, true, false, 75, 'sfGDAdapter');
                                $thumb->loadFile(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $thumb->save(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $this->thumbnail = $filename;
                            }
                        }
                    }

                    $this->form->bind($taintedValues, $request->getFiles($form_name));
                    if ($this->form->isValid()) {
                        $values = $this->form->getValues();

                        if ($form_name == 'sfApplyForm1') {
                            $this->getUser()->setAttribute('image_array', $taintedValues['image']);
                            $this->getUser()->setAttribute('image_object', $values['image']);
                            $values = $taintedValues;
                        }

                        $this->getUser()->setAttribute($form_name, $values, $this->prefix);
                        foreach ($values as $key => $val) {
                            if (is_object($val) and 'sfValidatedFile' == get_class($val)) {
                                $rawfile = file_get_contents($val->getTempName());
                                $this->getUser()->setAttribute($key, $rawfile, $this->prefix . '_files');
                            }
                        }

                        if (class_exists($this->prefix . ($this->step + 1))) {
                            $this->step = $this->step + 1;
                            $next_form_name = $this->prefix . $this->step;
                            $this->form = new $next_form_name();

                            $values = $this->getUser()->getAttribute($this->form->getName(), array(), $this->prefix . '_tainted');
                            if (is_null($values)) {
                                $values = $this->getUser()->getAttribute($this->form->getName(), array(), $this->prefix);
                                $this->form->bind($values, array());
                            } else {
                                $this->form->setDefaults($values);
                            }
                        } else {
                            // save this multipage form
                            $values = $this->getUser()->getAttributeHolder()->getAll($this->prefix);

                            $user = new sfGuardUser();
                            $user->setUsername($values['sfApplyForm1']['username']);
                            $user->setPassword($values['sfApplyForm1']['password']);
                            $user->setEmailAddress($values['sfApplyForm1']['email']);
                            $user->setIsActive(false);
                            $user->addPermissionByName('Colaborador');
                            $user->save();

                            $profile = new sfGuardUserProfile();
                            $profile->setValidate('n' . self::createGuid());
                            $profile->setUserId($user->getId());
                            $profile->setCityId($values['sfApplyForm2']['city_id']);
                            $profile->fromArray(array_merge($values['sfApplyForm1'], $values['sfApplyForm2']));
                            //$raw_image = $this->getUser()->getAttribute('image', null, $this->prefix . '_files');
                            ///if ($raw_image) {
                            //$profile->setImage($values['sfApplyForm1']['image'], $raw_image);
                            //}                            
                            $image_array = $this->getUser()->getAttribute('image_array');
                            $image_object = $this->getUser()->getAttribute('image_object');
                            $file_persist = new pkValidatorFilePersistent();
                            $file_info = $file_persist->getFileInfo($image_array['persistid']);
                            if ($file_info) {
                                $pathInfo = pathinfo($file_info['name']);
                                $filename = sha1($file_info['name'] . microtime() . rand()) . "." . $pathInfo['extension'];
                                copy($file_info['tmp_name'], sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $thumb = new sfThumbnail(52, 52, true, false, 75, 'sfGDAdapter');
                                $thumb->loadFile(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $thumb->save(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $profile->setFrontrndImage($filename);
                            }
                            $profile->save();





                            // Save the related notifications
                            $notification = new UserNotification();
                            $notification->setUserId($user->getId());
                            $notification->fromArray($values['sfApplyForm3']);
                            $notification->setHash(sha1(microtime(true) . mt_rand(10000, 90000)));
                            $notification->save();

                            //AlertasTable::nueva(2, 'Alta de colaborador', 'Se ha dado de alta', array('user_id' => $user->getId()));
                            // Purge the session stuff
                            $this->getUser()->getAttributeHolder()->removeNamespace($this->prefix);
                            $this->getUser()->getAttributeHolder()->removeNamespace($this->prefix . '_files');
                            $this->getUser()->getAttributeHolder()->removeNamespace($this->prefix . '_tainted');
                            $this->getUser()->getAttributeHolder()->removeNamespace('image_array');
                            $this->getUser()->getAttributeHolder()->removeNamespace('image_object');

                            try {
                                $this->sendVerificationMail($profile);
                                return 'After';
                            } catch (Exception $e) {
                                throw new sfException("Error en mailer: $e");
                            }
                        }
                    } else {

                        // image upload and show image for temparary
                        $image_array = $this->getUser()->getAttribute('image_array', array());
                        if ($form_name == 'sfApplyForm1' && is_array($image_array) && isset($image_array['persistid'])) {
                            $file_persist = new pkValidatorFilePersistent();
                            $file_info = $file_persist->getFileInfo($image_array['persistid']);
                            if ($file_info) {
                                $pathInfo = pathinfo($file_info['name']);
                                $filename = sha1($file_info['name'] . microtime() . rand()) . "." . $pathInfo['extension'];
                                copy($file_info['tmp_name'], sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $thumb = new sfThumbnail(52, 52, true, false, 75, 'sfGDAdapter');
                                $thumb->loadFile(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $thumb->save(sfConfig::get('sf_images_dir') . '/users/' . $filename);
                                $this->thumbnail = $filename;
                            }
                        }


                        $this->getUser()->setFlash('errorregister', 'El formulario no se ha guardado porque se ha producido algún error.');
                    }
                }
            }
        }
    }

    protected function sendVerificationMail($profile) {
        $this->mail(array('subject' => sfConfig::get('app_sfApplyPlugin_apply_subject', sfContext::getInstance()->getI18N()->__("Confirmación datos de colaborador - auditoscopia")),
            'fullname' => $profile->getUserName(),
            'email' => $profile->getEmail(),
            'parameters' => array('fullname' => $profile->getUserName(), 'validate' => $profile->getValidate()),
            'text' => 'sfApply/sendValidateNewText',
            'html' => 'sfApply/sendValidateNew'));
    }

    public function resetRequestBody($user) {
        if (!$user) {
            //return 'NoSuchUser';
            sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
            $this->getUser()->setFlash('error_form', 'Ese correo electrónico no corresponde a ningún colaborador.');
            $this->redirect('@resetRequest');
        }
        $this->forward404Unless($user);
        $profile = $user->getProfile();

        if (!$user->getIsActive()) {
            $type = $this->getValidationType($profile->getValidate());
            if ($type === 'New') {
                try {
                    $this->sendVerificationMail($profile);
                } catch (Exception $e) {
                    return 'UnverifiedMailerError';
                }
                return 'Unverified';
            } elseif ($type === 'Reset') {
                // They lost their first password reset email. That's OK. let them try again
            } else {
                return 'Locked';
            }
        }
        $profile->setValidate('r' . self::createGuid());
        $profile->save();
        try {
            $this->mail(array('subject' => sfConfig::get('app_sfApplyPlugin_reset_subject', sfContext::getInstance()->getI18N()->__("Please verify your password reset request on %1%", array('%1%' => $this->getRequest()->getHost()))),
                'fullname' => $profile->getUserName(),
                'email' => $profile->getEmail(),
                'username' => $user->getUsername(),
                'parameters' => array('fullname' => $profile->getUserName(), 'validate' => $profile->getValidate(), 'username' => $user->getUsername()),
                'text' => 'sfApply/sendValidateResetText',
                'html' => 'sfApply/sendValidateReset'));
        } catch (Exception $e) {
            throw new sfException("Error en mailer: $e");
        }
        return 'After';
    }

    public function executeConfirm(sfRequest $request) {
        $validate = $this->request->getParameter('validate');

        // Note that this only works if you set foreignAlias and
        // foreignType correctly
        $sfGuardUser = Doctrine_Query::create()->
                from("sfGuardUser u")->
                innerJoin("u.Profile p with p.validate = ?", $validate)->
                fetchOne();
        if (!$sfGuardUser) {
            return 'Invalid';
        }

        $type = self::getValidationType($validate);
        if (!strlen($validate)) {
            return 'Invalid';
        }
        $profile = $sfGuardUser->getProfile();
        $profile->setValidate(null);
        $profile->save();

        AlertasTable::nueva(2, 'Alta de colaborador', 'Se ha dado de alta', array('user_id' => $sfGuardUser->getId()));
        AlertasTable::nueva(900, 'Alta de colaborador', 'El colaborador <strong><a href="colaboradores/' . $sfGuardUser->getId() . '/List_ver">' . ($sfGuardUser->getUsername()) . '</a></strong> se ha dado de alta.');

        if ($type == 'New') {
            //asignar puntos al amigo
            $amigo = Doctrine_Core::getTable('Recomienda')->createQuery('a')->where('a.email LIKE ?', $profile->getEmail())->fetchOne();

            if ($amigo) {
                $recomended_user = Doctrine::getTable('sfGuardUser')->findOneBy('id', $amigo->getUserId());
                if ($recomended_user) {
                    //get user limit to recomende users
                    $recomende_limit = Doctrine::getTable('Recomienda')->getRecomendLimiFor($recomended_user->getId());

                    if (!$recomende_limit || $recomende_limit <= 10) {
                        $recomended_user->getProfile()->setPuntos(ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('recommend_amigo'));
                        ColaboradorPuntosHistoricoTable::new_log($recomended_user->getId(), 'Recomendar amigo', ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('recommend_amigo'));
                    }

                    //create alert message
                    alertasTable::nueva(32, 'Alta por recomendación', 'ha sido recomendado por <a href="/backend.php/colaboradores/' . $recomended_user->getId() . '/List_ver">' . $recomended_user->getUsername() . '</a> y ya es colaborador', array('user_id' => $sfGuardUser->getId()));
                    alertasTable::nueva(2, 'Alta por recomendación', 'Nuevo colaborador recomendado', array('user_id' => $sfGuardUser->getId()));

                    ColaboradorPuntosHistoricoTable::new_log($sfGuardUser->getId(), 'Alta colaborador recomendado', ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('crear_cuenta_recomend'));
                    // Doctrine_Query::create()->delete()->from('Recomienda r')->where('r.email LIKE ?',$aux['email'])->execute();
                    //set recomeded registration model object
                    $recomended_registration = new RecomendedRegistration();
                    $recomended_registration->create($recomended_user->getUsername(), $sfGuardUser->getUsername(), $sfGuardUser->getEmailAddress());
                    //get points for recommended entry
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('crear_cuenta_recomend');
                    //update user record
                    if ($puntos > 0) {
                        $profile->setPuntos($puntos);
                    }
                    //update the recomended record
                    $amigo->setIsRegisterd(true);
                    $amigo->save();
                }
            } else {
                //if not recommended they create non recommended entry
                $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('crear_cuenta');
                if ($puntos > 0) {
                    $profile->setPuntos($puntos);
                    $msg = ColaboradorPuntoDefinicionTable::getDescripcionbyCodigo('crear_cuenta');
                    ColaboradorPuntosHistoricoTable::new_log($sfGuardUser->getId(), $msg, $puntos);
                }
            }
            $sfGuardUser->setIsActive(true);
            $sfGuardUser->save();
            $this->getUser()->signIn($sfGuardUser);

            //mandamos el mail de bienvenida
            $this->mail(array('subject' => sfConfig::get('app_sfApplyPlugin_apply_subject_welcome', sfContext::getInstance()->getI18N()->__("Bienvenid@ a auditoscopia")),
                'alias' => $profile->getUserName(),
                'name' => $profile->getName(),
                'fullname' => $profile->getUserName(),
                'email' => $profile->getEmail(),
                'parameters' => array('alias' => $profile->getUserName(), 'fullname' => $profile->getUserName(), 'name' => $profile->getName(), 'email' => $sfGuardUser->getEmailAddress(), 'password' => $sfGuardUser->getRealPassword()),
                'text' => 'sfApply/sendWelcomeNewText',
                'html' => 'sfApply/sendWelcomeNew'));
        }

        if ($type == 'Reset') {
            $this->getUser()->setAttribute('sfApplyReset', $sfGuardUser->getId());
            return $this->redirect('sfApply/reset');
        }
    }

    static private function createGuid() {
        $guid = '';
        for ($i = 0; ($i < 8); $i++) {
            $guid .= sprintf('%02x', mt_rand(0, 255));
        }
        return $guid;
    }

    static private function getValidationType($validate) {
        $t = substr($validate, 0, 1);
        if ($t == 'n') {
            return 'New';
        } elseif ($t == 'r') {
            return 'Reset';
        } else {
            return sfView::NONE;
        }
    }

}