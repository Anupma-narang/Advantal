<?php

/**
 * producto actions.
 *
 * @package    auditoscopia
 * @subpackage producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productoActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    //$this->forward('default', 'module');
  }

  public function executeNew(sfWebRequest $request) {
    $this->form = new ProductoForm();
    //$this->forward('default', 'module');
  }

  public function executeCreate(sfWebRequest $request) {
    //$this->tipo=$request->getParameter("tipo");

    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ProductoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid()) {
      $producto = $form->save();
      // $this->redirect('concurso/new?tipo=empresa&confirm?id='.$empresa->id);
      $this->redirect('concurso/new?tipo=producto&producto_id=' . $producto->id);
    }
  }

  /**
   * display all audit records which are made by user
   * for given product
   * @param sfWebRequest $request
   */
  public function executeAuditList(sfWebRequest $request) {
    //fetch request parameters
    $user_id = $request->getParameter('user_id');
    $product_id = $request->getParameter('type');
    //fetch user audit records for given company
    $this->product_audit_records = Doctrine::getTable('Producto')->getUserAuditRecords($user_id, $product_id);
  }

  /**
   * display questionary records for given audit
   * @param sfWebRequest $request
   */
  public function executeAuditaRecord(sfWebRequest $request) {
    //fetch request parameters
    $product_id = $request->getParameter('product');
    $question_id = $request->getParameter('id');
    //get company record
    $this->product = Doctrine::getTable('Producto')->find($product_id);
    $question_record = Doctrine::getTable('ListaCuestionarioUser')->find($question_id);

    if ($question_record) {
      $this->form = new ListaCuestionarioUserForm($question_record);
    } else {
      $this->form = new ListaCuestionarioUserForm();
    }
  }

  /**
   * display all comment records which are made by user
   * for given product
   * @param sfWebRequest $request
   */
  public function executeCommentList(sfWebRequest $request) {
    //fetch request parameters
    $user_id = $request->getParameter('user_id');
    $product_id = $request->getParameter('type');
    //fetch user audit records for given company
    $this->product_audit_records = Doctrine::getTable('Producto')->getCommentsRecords($user_id, $product_id);
  }

  /**
   * display questionary records for given comment id
   * @param sfWebRequest $request
   */
  public function executeCommentRecord(sfWebRequest $request) {
    //fetch request parameters
    $product_id = $request->getParameter('product');
    $comment_id = $request->getParameter('id');
    //get product record
    $this->product = Doctrine::getTable('Producto')->find($product_id);
    $comment_record = Doctrine::getTable('ComentarioListaNegra')->find($comment_id);


    if ($comment_record) {
      $this->form = new ComentarioListaNegraForm($comment_record);
    } else {
      $this->form = new ComentarioListaNegraForm();
    }
  }

  /**
   * add comapny to user's favourit records
   * @param sfWebRequest $request
   */
  public function executeAddToFavorite(sfWebRequest $request) {

    if (!$this->getUser()->isAuthenticated()) {
      return $this->renderPartial('global/login_required_favorit', array('msg' => "Para <strong>auditar</strong> necesitas ser colaborador."));
    }

    //fetch request parameters
    $product_id = $request->getParameter('product');
    //get user
    $user = $this->getUser()->getGuardUser();
    //fetch company favourit record
    $product_favourite_record = Doctrine::getTable('ProductFavouriteList')->getRecordByUserAndId($user->getId(), $product_id);
    //if exist then send exist message
    if ($product_favourite_record) {
      return $this->renderText('Este producto <strong>ya está</strong> en Tus favoritos.');
    }
    //if not then create new one
    else {
      $product_favourite_record = new ProductFavouriteList();
      $product_favourite_record->create($user->getId(), $product_id);
      return $this->renderText('Has añadido este <strong>producto a Tus favoritos</strong>.');
    }

    $this->setLayout(false);
  }

  /**
   * fetch featured product records for homepage
   * @param sfWebRequest $request
   */
  public function executeFeaturedProductRecords(sfWebRequest $request) {
    //fetch company records for white list
    $this->white_list_product_records = Doctrine::getTable('Producto')->getFeatureProductRecords('lb');


    //fetch company records for black list
    $this->black_list_product_records = Doctrine::getTable('Producto')->getFeatureProductRecords('ln');
  }

}
