<?php

require_once dirname(__FILE__) . '/../lib/administrationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/administrationGeneratorHelper.class.php';

/**
 * administration actions.
 *
 * @package    symfony
 * @subpackage administration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class administrationActions extends autoAdministrationActions {

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    
    if($this->getUser()){
      $this->getUser()->setAttribute('change_password_id',$this->getUser()->getId());
    }
  }
  protected function buildQuery() {


    $query = parent::buildQuery();
    // var_dump($this->filters->getValues());die;
    //echo $_GET['sort_type'];die;
    $query->from('sfGuardUser sgu');
    $query->leftJoin('sgu.sfGuardUserPermission sgup')
            ->leftJoin('sgu.Profile pf')
            ->leftJoin('sgup.Permission p')
            ->where('sgup.user_id IS NOT NULL')
            ->andWhere('p.name <> "Colaborador"');
    $tempSort=isset($_GET['sort']) ? $_GET['sort']:'';
    switch ($tempSort) {
      case'surname1':
        $query->orderBy('pf.surname1 ' . $_GET['sort_type']);
        break;
      case'surname2':
        $query->orderBy('pf.surname2 ' . $_GET['sort_type']);
        break;
      case'name':
        $query->orderBy('pf.name ' . $_GET['sort_type']);
        break;
      case'permission':
        $query->orderBy('p.name ' . $_GET['sort_type']);
        break;
    }

    $this->filter_records = $this->getFilterRecord();
    if (isset($this->filter_records['email_address']['text'])) {
      $query->andWhere("sgu.email_address LIKE '%" . $this->filter_records['email_address']['text'] . "%'");
    }
    if (isset($this->filter_records['username']['text'])) {
      $query->andWhere('sgu.username  LIKE "%' . $this->filter_records['username']['text'] . '%"');
    }
    if (isset($this->filter_records['permissions_list'])) {
      $query->andWhere('sgup.permission_id =?', $this->filter_records['permissions_list']);
    }
    
    //add filters
    /* if($filter_parameters['email_address']){
      $query->andWhere('sgu.email_address LIKE %'.$filter_parameters['email_address']);
      }
      if($filter_parameters['permissions_list']){
      $query->andWhere('sgup.permission_id =?'.$filter_parameters['permissions_list']);
      }
      if($filter_parameters['username']){
      echo $filter_parameters['username'];die;
      $query->andWhere('sgu.username LIKE %'.$filter_parameters['username']);
      } */
    
      $request = sfContext::getInstance()->getRequest();

      if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
      {
        $query->orderBy('created_at DESC');
      }
    
        
    // echo $query->getSqlQuery();exit;
    
    return $query;
  }

  protected function addSortQuery($query) {
    if (array(null, null) == ($sort = $this->getSort())) {
      return;
    }

    if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
        $sort[1] = 'asc';
    }
    if($sort[0] == 'permission'){
        $sort[0] = 'p.name';
      }
    $query->addOrderBy($sort[0] . ' ' . $sort[1]);
  }

  public function executeFilter(sfWebRequest $request) {
    $this->setPage(1);

    if ($request->hasParameter('_reset')) {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@sf_guard_user');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid()) {
      $this->setFilters($this->filters->getValues());

      $request_paramters = $request->getParameterHolder();
      $this->filter_records = array();
      $this->filter_records['email_address'] = $request->getParameter('email_address');
      $this->filter_records['username'] = $request->getParameter('username');
      $this->filter_records['permissions_list'] = $request->getParameter('permissions_list');
      $this->setFilterRecord($this->filter_records);
      $this->redirect('@sf_guard_user');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  protected function getFilterRecord() {
    return $this->getUser()->getAttribute('administration.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilterRecord(array $filters) {
    return $this->getUser()->setAttribute('administration.filters', $filters, 'admin_module');
  }

  /**
   * Assign permission to existing user
   * @param sfWebRequest $request
   */
  public function executeAssignPermission(sfWebRequest $request) {
    //fetch request parameters
    $user_id = $request->getParameter('id');
    //get user permission record
    $user_permission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $user_id);
    if($user_permission->getPermissionId() == 1 && !$this->getUser()->hasCredential('Superadministrador')){
      $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
      $this->redirect('@sf_guard_user');
    }elseif($user_permission->getPermissionId() == 2 && $this->getUser()->hasCredential('Administrador') && $this->getUser()->GetId() != $user_id){
      $this->getUser()->setFlash('error', 'No tienes privilegios para realizar esta operación.');
      $this->redirect('@sf_guard_user');
    }
    //get user 
    $user = Doctrine::getTable('sfGuardUser')->find($user_id);
    $this->user = $user;

    $this->permission_form = new sfForm();
    $this->permission_form->setWidget('permission', new sfWidgetFormDoctrineChoice(array('default' => ($user_permission ? $user_permission->getPermissionId() : '5'), 'multiple' => false, 'model' => 'sfGuardPermission')));
    $this->permission_form->setValidator('permission', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'required' => false)));
    $this->permission_form->getWidgetSchema()->setNameFormat('sf_permission[%s]');

    //request method is POST
    if ($request->getMethod() == sfWebRequest::POST) {
      $super_admin_permission_record = Doctrine::getTable('sfGuardUserPermission')->isSuperAdminExist();
      $request_parameters = $request->getParameter($this->permission_form->getName());

      if ($super_admin_permission_record['superadmin'] == $request_parameters['permission']) {
        $this->error_message = 'Permiso superadmin se utiliza antes.';
      } else {
        $this->permission_form->bind($request_parameters);
        //if form is valid
        if ($this->permission_form->isValid()) {
          $permission_id = $request_parameters['permission'];

          if ($user_permission == null) {
            //create sfguard user permission model object
            $user_permission = new sfGuardUserPermission();
          }
          $user_permission->create($user_id, $permission_id);
          $permissions = Doctrine::getTable('sfGuardPermission')->findOneBy('id', $permission_id, Doctrine::HYDRATE_ARRAY);
          $this->getUser()->setFlash('notice', 'El usuario ' . $user->getUsername() . ' ha cambiado sus privilegios a ' . $permissions['name'].'.');
          $this->redirect('@sf_guard_user');
        }
      }
    }
  }

  public function executeChangePassword(sfWebRequest $request) {
    //fetch request parameters
    $user_id = $request->getParameter('id');
    $this->user = Doctrine::getTable('sfGuardUser')->find($user_id);
    
    //create custom user form
    $this->sf_user_form = new sfForm();
    $this->sf_user_form->setWidget('password', new sfWidgetFormInputPassword(array(),array('style' => 'width:130px','maxlength' => '16')));
    $this->sf_user_form->setValidator('password', new sfValidatorString(array('required' => true), array('required' => 'contraseña requerida', 'invalid' => 'se introduce la contraseña no es válida')));
    $this->sf_user_form->getWidgetSchema()->setNameFormat('sf_user_form[%s]');

    //if request method is POST
    if ($request->getMethod() == sfWebRequest::POST) {
      //get form parameter
      $form_paramteres = $request->getParameter($this->sf_user_form->getName());
      $this->sf_user_form->bind($form_paramteres);
      if ($this->sf_user_form->isValid()) {
        //get user model object
        $user = Doctrine::getTable('sfGuardUser')->find($user_id);
        if ($user) {
          $user->setPassword($form_paramteres['password']);
          $user->save();
          $this->getUser()->setFlash('notice', 'Contraseña de usuario cambiada.');
        }
        $this->redirect('@sf_guard_user');
      }
    }
  }

  protected function isValidSortColumn($column) {
    return true;
  }

}
