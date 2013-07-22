<?php

require_once dirname(__FILE__) . '/../lib/administration_emailsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/administration_emailsGeneratorHelper.class.php';

/**
 * administration_emails actions.
 *
 * @package    symfony
 * @subpackage administration_emails
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class administration_emailsActions extends autoAdministration_emailsActions {

  public function executeNew(sfWebRequest $request) {
    $this->form = $this->configuration->getForm();
    $this->administration_emails = $this->form->getObject();
    $this->form->setWidget('permission_id', new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardPermission', 'add_empty' => 'Selecciona perfil'), array('disabled' => 'disabled')));
  }

  public function executeCreate(sfWebRequest $request) {
    $this->form = $this->configuration->getForm();
    $this->administration_emails = $this->form->getObject();
    $this->form->setWidget('permission_id', new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardPermission', 'add_empty' => 'Selecciona perfil'), array('disabled' => 'disabled')));
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request) {
    $this->administration_emails = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->administration_emails);
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->administration_emails = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->administration_emails);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form) {
    //fetch request parameters
    $request_parametes = $request->getParameter($form->getName());

    $user_id = $request_parametes['user_id'];
    $permission_id = null;
    if ($user_id && $form->getObject()->isNew()) {
      if ($request_parametes['permission_id']) {
        $permission_id = $request_parametes['permission_id'];
      }
      //if permission is not set
      else {
        $sf_user_record = Doctrine::getTable('sfGuardUser')->find($user_id);
        if ($sf_user_record) {
          //get permission record
          $permission_records = $sf_user_record->getPermissions();
          if ($permission_records) {
            foreach ($permission_records as $permission_record) {
              $permission_id = $permission_record->getId();
            }
          }
        }
      }
    } else {
      $permission_id = $request_parametes['permission_id'];
    }
    //set permision attribures and save
    $request_parametes['permission_id'] = $permission_id;
    if ($permission_id) {
      $permission_record = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $user_id);
      if (!$permission_record) {
        $permission_record = new sfGuardUserPermission();
      }
      $permission_record->setUserId($user_id);
      $permission_record->setPermissionId($permission_id);
      $permission_record->save();
    }

    if ($form->getObject()->isNew()) {
      $request_parametes['created_at'] = date('Y-m-d H:i:s');
    }else{
      $emal_admin_record = $form->getObject();
      $request_parametes['created_at'] = $emal_admin_record->getCreatedAt();
    }
    $form->bind($request_parametes, $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';


      try {
        $administration_emails = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $administration_emails)));

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

        $this->redirect('@administration_emails_new');
      } else {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'administration_emails', 'sf_subject' => $administration_emails));
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  /**
   * Fetch permission record from given user id
   * @param sfWebRequest $request
   * @return JSON record
   */
  public function executeGetDefaults(sfWebRequest $request) {
    //fetch request parameters
    $user_id = $request->getParameter('id');
    $output_record = array('status' => '', 'data' => '');
    //get user record
    $sf_user_record = Doctrine::getTable('sfGuardUser')->find($user_id);
    if ($sf_user_record) {
      //get permission record
      $permission_records = $sf_user_record->getPermissions();

      if ($permission_records) {
        foreach ($permission_records as $permission_record) {
          $output_record['status'] = '200';
          $output_record['data'] = $permission_record->getId();
        }
      } else {
        $output_record['status'] = '404';
      }
    } else {
      $output_record['status'] = '404';
    }
    return $this->renderText(json_encode($output_record));
  }

  /**
   * Show administrator email record in detail
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request) {
    $this->administration_emails = $this->getRoute()->getObject();
  }

  /**
   * Assign permission to existing user
   * @param sfWebRequest $request
   */
  public function executeAssignPermission(sfWebRequest $request) {
    //fetch request parameters
    $administrator_email_id = $request->getParameter('id');
    $administrator_email_record = Doctrine::getTable('AdministrationEmails')->find($administrator_email_id);
    
    $user_id = $administrator_email_record->getUserId();
    
    //get user permission record
    $user_permission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $user_id);
    if($user_permission->getPermissionId() == 1 && !$this->getUser()->hasCredential('Superadministrador'))
    {
      $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
      $this->redirect('administration_emails');
    }
    elseif($user_permission->getPermissionId() == 2 && $this->getUser()->hasCredential('Administrador') && $this->getUser()->GetId() != $user_id)
    {
      $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
      $this->redirect('administration_emails');
    }
    
    //get user 
    $user = Doctrine::getTable('sfGuardUser')->find($user_id);
    $this->user = $user;

    //get user permission record
    $user_permission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $user_id);

    $this->permission_form = new sfForm();
    $this->permission_form->setWidget('permission', new sfWidgetFormDoctrineChoice(array('default' => ($user_permission ? $user_permission->getPermissionId() : ''), 'multiple' => false, 'model' => 'sfGuardPermission')));
    $this->permission_form->setValidator('permission', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'required' => false)));
    $this->permission_form->getWidgetSchema()->setNameFormat('sf_permission[%s]');

    //request method is POST
    if ($request->getMethod() == sfWebRequest::POST) {
      $super_admin_permission_record = Doctrine::getTable('sfGuardUserPermission')->isSuperAdminExist();
      $request_parameters = $request->getParameter($this->permission_form->getName());

      if ($super_admin_permission_record['superadmin'] == $request_parameters['permission']) {
        $this->error_message = 'Permiso superadmin se utiliza antes.';
      } else {
        $request_parameters = $request->getParameter($this->permission_form->getName());

        $this->permission_form->bind($request_parameters);
        //if form is valid
        if ($this->permission_form->isValid()) {
          $permission_id = $request_parameters['permission'];

          if ($user_permission == null) {
            //create sfguard user permission model object
            $user_permission = new sfGuardUserPermission();
          }
          $administrator_email_record->setPermissionId($permission_id);
          $administrator_email_record->save();
          $user_permission->create($user_id, $permission_id);
          $permissions = Doctrine::getTable('sfGuardPermission')->findOneBy('id',$permission_id,Doctrine::HYDRATE_ARRAY);
          $this->getUser()->setFlash('notice', 'El usuario '.$user->getUsername().' ha cambiado sus privilegios a ' . $permissions['name'] .'.');
          $this->redirect('administration_emails');
        }
      }
    }
  }

protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $tempFilters = $this->getFilters();


    
    if(isset($tempFilters['user_id']) && $tempFilters['user_id'] != '')
    {
      $tempUsername = $tempFilters['user_id'];
      $tempFilters['user_id'] = '';
    }

    if(isset($tempUsername))
    {
      $tempUsers = Doctrine_Query::create()->select('id')->from('sfGuardUser')->where('username  LIKE \'%' . addslashes($tempUsername) . '%\'')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);

      if(count($tempUsers))
      {
        $query->andWhereIn('user_id', $tempUsers);
      }
    }

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

}

