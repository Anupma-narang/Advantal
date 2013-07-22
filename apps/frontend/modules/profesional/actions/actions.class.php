<?php

/**
 * profesional actions.
 *
 * @package    symfony
 * @subpackage profesional
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfProjectConfiguration::getActive()->loadHelpers('Url');

class profesionalActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        if ($request->getParameter('id')) {
            $oProfesional = Doctrine::getTable('Profesional')->find($request->getParameter('id'));
            $this->form = new ProfesionalRegisterForm($oProfesional);
        }
        else
            $this->form = new ProfesionalRegisterForm();

        if ($request->isMethod('POST')) {
            $asValues = $request->getParameter($this->form->getName());
            $ma_values = $request->getParameter($this->form->getName());
            //unset($ma_values['borrador']);
            $this->form->bind($ma_values, $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $oProfesional = Profesional::addInformation($asValues, $request->getParameter('id', ''), $request->getParameter('lid', ''));

                if ($this->form->getValue('borrador'))
                    $this->getUser()->setFlash('notice', 'Tu profesonal se ha guardado correctamente en borradores.<br/>');
                else
                    $this->getUser()->setFlash('notice', '<p>Has recomendado a un profesional para formar parte del Directorio correctamente.</p><p>
                    Tu ' . 'opinión' . ' es muy importante para <strong>publicar a los mejores profesionales.</strong></p><p>
                    ' . '¡Muchas' . ' gracias por contribuir!');
                $param = (!$this->form->isNew()) ? '&mode=borador' : '';

                $this->redirect('profesional/show?id=' . $oProfesional . $param);
                // $this->redirect('@profesional');
            } else {
                if ($this->form->getValue('borrador'))
                    $this->getUser()->setFlash('notice', 'El profesonal se ha modificado correctamente.');
                else
                    $this->getUser()->setFlash('error', 'El formulario no se ha guardado porque se ha producido algún error.', false);
            }
        }
        //$this->sectoresActivos = $this->crearSectoresActivos($request);
    }

    public function executeRecomend(sfWebRequest $request) {
        $snIdprofesional = $request->getParameter('idprofesional');
        $snLetterId = $request->getParameter('letter_id', '');
        $this->isValidProfestionInterval = Doctrine::getTable('ProfesionalLetter')->getLastInterval($snIdprofesional, $this->getUser()->getGuardUser()->getId());
        $oProfesional = Doctrine::getTable('Profesional')->find($snIdprofesional);
        $this->dataProfesional = $oProfesional->toArray();
        $this->ssFirstName = $oProfesional->getSlug();
        $this->states_id = $oProfesional->getStates_id();
        $this->city_id = $oProfesional->getCity_id();
        //$this->isValidProfestionInterval['flag'] = true;
        $this->form = new ProfesionalRecomendForm($oProfesional);


        if ($this->isValidProfestionInterval['flag'] === true) {
            $this->bValid = true;
            if ($request->isMethod('POST')) {
                $asValues = $request->getParameter($this->form->getName());
                $ma_values = $request->getParameter($this->form->getName());
                //unset($ma_values['borrador']);
                $this->form->bind($ma_values);
                if ($this->form->isValid()) {

                    Profesional::addRecomendInformation($asValues, $snIdprofesional, $snLetterId);

                    if ($this->form->getValue('borrador'))
                        $this->getUser()->setFlash('notice', 'Tu carta de recomendación se ha guardado correctamente en borradores.<br/>');
                    else
                        $this->getUser()->setFlash('notice', '<p>Has <strong>recomendado a este profesional</strong> correctamente.</p>
                      <p>Si quieres recomendar a otro profesional,<strong> haz clic </strong><a href="' .
                                url_for("profesional/recomend?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>
                      <p>Si quieres desaprobar a un profesional,<strong> haz clic</strong>
                      <a href="' . url_for("profesional/disaproval?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>
                      ' . '¡Muchas gracias por recomendar a un profesional!');
                    $this->redirect('/las-listas/directorio-de-buenos-profesionales/profesionales/' . $this->ssFirstName);
                } else {
                    if ($this->form->getValue('borrador'))
                        $this->getUser()->setFlash('notice', 'El profesonal se ha modificado correctamente.');
                    else
                        $this->getUser()->setFlash('error', 'El formulario no se ha guardado porque se ha producido algún error.', false);
                }
            }
        } else {
            $this->bValid = false;
            /* if ($this->isValidProfestionInterval['type'] === 'maxperday')
              $this->getUser()->setFlash('notice', 'No puedes <strong>auditar más de 5 profesionales</strong> por día.');
              else if ($this->isValidProfestionInterval['type'] === 'per_year')
              $this->getUser()->setFlash('notice', 'No puedes volver a recomendar o desaprobar a este profesional <strong>hasta el próximo mes de enero.</strong>');
              else if ($this->isValidProfestionInterval['type'] === 'interval')
              $this->getUser()->setFlash('notice', 'No puedes volver a recomendar o desaprobar a este profesional <strong>hasta el ' . $this->isValidProfestionInterval['option'] . '</strong>'); */
            if ($this->isValidProfestionInterval['type'] === 'per_year')
                $this->getUser()->setFlash('notice', 'No puedes volver a recomendar o desaprobar a este profesional <strong>hasta el próximo mes de enero.</strong>');
            $this->redirect('/las-listas/directorio-de-buenos-profesionales');
        }
    }

    public function executeDisaproval(sfWebRequest $request) {

        $snIdprofesional = $request->getParameter('idprofesional');
        $snLetterId = $request->getParameter('letter_id', '');
        $this->isValidProfestionInterval = Doctrine::getTable('ProfesionalLetter')->getLastInterval($snIdprofesional, $this->getUser()->getGuardUser()->getId());
        $oProfesional = Doctrine::getTable('Profesional')->find($snIdprofesional);
        $this->dataProfesional = $oProfesional->toArray();
        $this->ssFirstName = $oProfesional->getSlug();
        $this->states_id = $oProfesional->getStates_id();
        $this->city_id = $oProfesional->getCity_id();
        //$this->isValidProfestionInterval['flag'] = true;
        $this->form = new ProfesionalDisaprovalForm($oProfesional);

        if ($this->isValidProfestionInterval['flag'] === true) {
            $this->bValid = true;

            if ($request->isMethod('POST')) {
                $asValues = $request->getParameter($this->form->getName());
                $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
                if ($this->form->isValid()) {
                    $upload = $request->getFiles($this->form->getName());
                    $savefilename = array();
                    foreach ($upload as $ssFiles) {
                        if ($ssFiles['file']['newfile']['size'] != 0) {
                            $pathInfo = pathinfo($ssFiles['file']['newfile']['name']);
                            $extention = $pathInfo['extension'];
                            $filename = sha1($ssFiles['file']['newfile']['name'] . microtime() . rand()) . "." . $extention;
                            $savefilename[] = $filename;
                            //move_uploaded_file($ssFiles['file']['newfile']['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                            if ($this->form->getValue('borrador')) {
                                copy($ssFiles['file']['newfile']['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                            } else {
                                move_uploaded_file($ssFiles['file']['newfile']['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                            }
                        }
                    }

                    if ($this->form->getValue('borrador')) {
                        $savefilename = array();
                        for ($i = 1; $i <= count($upload); $i++) {
                            $savefilename[] = $asValues['archivo_' . $i]['file']['persistid'];
                        }
                    }

                    Profesional::addDisaprovalInformation($asValues, $savefilename, $snIdprofesional, $snLetterId);

                    if ($this->form->getValue('borrador'))
                        $this->getUser()->setFlash('notice', 'Tu carta de desaprobación se ha guardado correctamente en borradores.<br/>');
                    else
                        $this->getUser()->setFlash('notice', '<p>Has <strong>desaprobado a este profesional</strong> correctamente.</p>
                        <p>Si quieres desaprobar a otro profesional,<strong> haz clic </strong><a href="' .
                                url_for("profesional/disaproval?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>
                        <p>Si quieres recomendar a un profesional,<strong> haz clic</strong>
                        <a href="' . url_for("profesional/recomend?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>¡Muchas gracias por desaprobar a un profesional!');

                    $this->redirect('/las-listas/directorio-de-buenos-profesionales/profesionales/' . $this->ssFirstName);
                } else {
                    if ($this->form->getValue('borrador'))
                        $this->getUser()->setFlash('notice', 'El profesonal se ha modificado correctamente.');
                    else
                        $this->getUser()->setFlash('error', 'El formulario no se ha guardado porque se ha producido algún error.', false);
                }
            }
        } else {
            $this->bValid = false;
            /* if ($this->isValidProfestionInterval['type'] === 'maxperday')
              $this->getUser()->setFlash('notice', 'No puedes <strong>auditar más de 5 profesionales</strong> por día.');
              else if ($this->isValidProfestionInterval['type'] === 'per_year')
              $this->getUser()->setFlash('notice', 'No puedes volver a recomendar o desaprobar a este profesional <strong>hasta el próximo mes de enero.</strong>');
              else if ($this->isValidProfestionInterval['type'] === 'interval')
              $this->getUser()->setFlash('notice', 'No puedes volver a recomendar o desaprobar a este profesional <strong>hasta el ' . $this->isValidProfestionInterval['option'] . '</strong>'); */
            if ($this->isValidProfestionInterval['type'] === 'per_year')
                $this->getUser()->setFlash('notice', 'No puedes volver a recomendar o desaprobar a este profesional <strong>hasta el próximo mes de enero.</strong>');
            $this->redirect('/las-listas/directorio-de-buenos-profesionales');
        }
    }

    public function executeShow(sfWebRequest $request) {

        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter('id'));

        $oProfesional = Doctrine::getTable('Profesional')->find($request->getParameter('id'));
        $this->dataProfesional = $oProfesional->toArray();

        $this->form = new ProfesionalRegisterForm($this->profesional);

        $this->forward404Unless($this->profesional);

        // Los concursos en estado revista s�lo son accesibles por sus propietarios
        if (1 == $this->profesional->getProfesionalEstadoId()) {
            if (!$this->getUser()->isAuthenticated() or $this->profesional->getUserId() != $this->getUser()->getGuardUser()->getId()) {
                $this->forward404('No tienes permisos para ver este profesioanl');
            }
        }
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeProfessional(sfWebRequest $request) {
        if ($request->isMethod('POST')) {
            $uploadDir = sfConfig::get('sf_upload_dir') . '/documents';
            move_uploaded_file($_FILES['test']["tmp_name"], $uploadDir . "/" . $_FILES['test']["name"]);
            $this->redirect('profesional/professional');
        }
        $this->setLayout(false);
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeHomePageProfessionalList(sfWebRequest $request) {
        //get gift list
        $this->professioanl_list = Doctrine::getTable('Profesional')->getFeaturedProfessionalList();
        //set layout
        $this->setLayout(false);
    }

    public function executeEdit(sfWebRequest $request) {
        if ($request->getParameter('id')) {
            $this->forward404Unless($this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id")));
            $this->dataProfesional = $this->profesional->toArray();
        }
        $this->id = $request->getParameter('id', null);
        $this->form = new ProfesionalRegisterForm($this->profesional);

        if ($request->isMethod('POST')) {
            $asValues = $request->getParameter($this->form->getName());
            $ma_values = $request->getParameter($this->form->getName());
            unset($ma_values['borrador']);
            $this->form->bind($ma_values, $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $this->profesional = Profesional::addInformation($asValues, $request->getParameter('id', ''), $request->getParameter('lid', ''));

                $this->redirect('@profesional-draft');
                /* if (isset($asValues['borrador'])) {
                  $this->getUser()->setFlash('notice', 'Tu profesonal se ha guardado correctamente en borradores.<br/>');
                  $this->redirect('@profesional-draft');
                  } else {
                  $this->getUser()->setFlash('notice', '<p>Has recomendado a un profesional para formar parte del Directorio correctamente.</p><p>
                  Tu ' . 'opinión' . ' es muy importante para <strong>publicar a los mejores profesionales.</strong></p><p>
                  ' . '¡Muchas' . ' gracias por contribuir!');
                  $param = (!$this->form->isNew()) ? '&mode=borador' : '';
                  $this->redirect('profesional/show?id=' . $oProfesional . $param);
                  } */
            } else {
                if ($this->form->getValue('borrador'))
                    $this->getUser()->setFlash('notice', 'El profesonal se ha modificado correctamente.');
                else
                    $this->getUser()->setFlash('error', 'El formulario no se ha guardado porque se ha producido algún error.', false);
            }
        }
    }

    public function executeEditRecomend(sfWebRequest $request) {
        $this->forward404Unless($this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id")));
        $this->id = $request->getParameter('id', null);
        $snIdprofesional = $request->getParameter('id');
        $snLetterId = $request->getParameter('letter_id', '');
        $this->isValidProfestionInterval = Doctrine::getTable('ProfesionalLetter')->getLastInterval($snIdprofesional, $this->getUser()->getGuardUser()->getId());
        $this->form = new ProfesionalRecomendForm($this->profesional);
        $this->dataProfesional = $this->profesional->toArray();
        $this->ssFirstName = $this->profesional->getSlug();
        $this->states_id = $this->profesional->getStates_id();
        $this->city_id = $this->profesional->getCity_id();

        // if ($this->isValidProfestionInterval['flag'] === true) {
        //$this->bValid = true;
        if ($request->isMethod('POST')) {
            $asValues = $request->getParameter($this->form->getName());
            $ma_values = $request->getParameter($this->form->getName());
            unset($ma_values['borrador']);
            $this->form->bind($ma_values);
            if ($this->form->isValid()) {
                Profesional::addRecomendInformation($asValues, $snIdprofesional, $snLetterId);

                /* if ($this->form->getValue('borrador'))
                  $this->getUser()->setFlash('notice', 'Tu carta de recomendación se ha guardado correctamente en borradores.<br/>');
                  else
                  $this->getUser()->setFlash('notice', '<p>Has <strong>recomendado a este profesional</strong> correctamente.</p>
                  <p>Si quieres recomendar a otro profesional,<strong> haz clic </strong><a href="' .
                  url_for("profesional/recomend?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>
                  <p>Si quieres desaprobar a un profesional,<strong> haz clic</strong>
                  <a href="' . url_for("profesional/disaproval?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>
                  ' . '¡Muchas gracias por recomendar a un profesional!'); */
                $this->redirect('@profesional-cartas-draft');
            } else {
                if ($this->form->getValue('borrador'))
                    $this->getUser()->setFlash('notice', 'El profesonal se ha modificado correctamente.');
                else
                    $this->getUser()->setFlash('error', 'El formulario no se ha guardado porque se ha producido algún error.', false);
            }
        }
    }

    public function executeEditDisaproval(sfWebRequest $request) {
        $this->forward404Unless($this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id")));
        $this->id = $request->getParameter('id', null);
        $snIdprofesional = $request->getParameter('id');

        $snLetterId = $request->getParameter('letter_id', '');
        $this->isValidProfestionInterval = Doctrine::getTable('ProfesionalLetter')->getLastInterval($snIdprofesional, $this->getUser()->getGuardUser()->getId());
        $this->form = new ProfesionalDisaprovalForm($this->profesional);
        $this->profesional_letter_archivo = Doctrine::getTable('ProfesionalLetterArchivo')->findByProfesionalLetterId($snLetterId);
        $this->dataProfesional = $this->profesional->toArray();
        $this->ssFirstName = $this->profesional->getSlug();
        $this->states_id = $this->profesional->getStates_id();
        $this->city_id = $this->profesional->getCity_id();

        // if ($this->isValidProfestionInterval['flag'] === true) {
        //$this->bValid = true;
        if ($request->isMethod('POST')) {
            $asValues = $request->getParameter($this->form->getName());
            $ma_values = $request->getParameter($this->form->getName());

            $this->form->bind($ma_values, $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $upload = $request->getFiles($this->form->getName());
                $savefilename = array();
                $file_persist = new pkValidatorFilePersistent();
                $i = 1;
                foreach ($upload as $ssFiles) {
                    if ($ssFiles['file']['newfile']['size'] != 0) {
                        $pathInfo = pathinfo($ssFiles['file']['newfile']['name']);
                        $extention = $pathInfo['extension'];
                        $filename = sha1($ssFiles['file']['newfile']['name'] . microtime() . rand()) . "." . $extention;
                        $savefilename[] = $filename;

                        if ($request->hasParameter('borrador')) {
                            copy($ssFiles['file']['newfile']['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                        } else {
                            move_uploaded_file($ssFiles['file']['newfile']['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                        }
                    } else {
                        $file_info = $file_persist->getFileInfo($asValues['archivo_' . $i]['file']['persistid']);
                        if ($file_info) {
                            $pathInfo = pathinfo($file_info['name']);
                            $filename = sha1($file_info['name'] . microtime() . rand()) . "." . $pathInfo['extension'];
                            copy($file_info['tmp_name'], sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                            $savefilename[] = $filename;
                        }
                    }
                    $i++;
                }

                if ($this->form->getValue('borrador')) {
                    $savefilename = array();
                    for ($i = 1; $i <= count($upload); $i++) {
                        $savefilename[] = $asValues['archivo_' . $i]['file']['persistid'];
                    }
                }

                Profesional::addDisaprovalInformation($asValues, $savefilename, $snIdprofesional, $snLetterId);

                /* if ($this->form->getValue('borrador'))
                  $this->getUser()->setFlash('notice', 'Tu carta de desaprobación se ha guardado correctamente en borradores.<br/>');
                  else
                  $this->getUser()->setFlash('notice', '<p>Has <strong>desaprobado a este profesional</strong> correctamente.</p>
                  <p>Si quieres desaprobar a otro profesional,<strong> haz clic </strong><a href="' .
                  url_for("profesional/disaproval?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>
                  <p>Si quieres recomendar a un profesional,<strong> haz clic</strong>
                  <a href="' . url_for("profesional/recomend?idprofesional=" . $snIdprofesional) . '">' . 'aquí' . '</a>.</p>¡Muchas gracias por desaprobar a un profesional!'); */

                $this->redirect('@profesional-cartas-draft');
            } else {
                if ($this->form->getValue('borrador'))
                    $this->getUser()->setFlash('notice', 'El profesonal se ha modificado correctamente.');
                else
                    $this->getUser()->setFlash('error', 'El formulario no se ha guardado porque se ha producido algún error.', false);
            }
        }
    }

}

