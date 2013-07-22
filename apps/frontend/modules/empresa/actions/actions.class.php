<?php

/**
 * empresa actions.
 *
 * @package    auditoscopia
 * @subpackage empresa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empresaActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeNew(sfWebRequest $request) {
        //$this->forward('default', 'module');
        $this->form = new EmpresaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        //$this->tipo=$request->getParameter("tipo");

        $this->forward404Unless($request->isMethod('post'));

        $this->form = new EmpresaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $empresa = $form->save();
            // $this->redirect('concurso/new?tipo=empresa&confirm?id='.$empresa->id);
            $this->redirect('concurso/new?tipo=empresa&empresa_id=' . $empresa->id);
        }
    }

    /**
     * display all audit records which are made by user
     * for given company
     * @param sfWebRequest $request
     */
    public function executeAuditList(sfWebRequest $request) {

        //fetch request parameters
        $user_id = $request->getParameter('user_id');
        $company_id = $request->getParameter('type');
        //fetch user audit records for given company
        $this->compnay_audit_records = Doctrine::getTable('Empresa')->getUserAuditRecords($user_id, $company_id);
    }

    /**
     * display questionary records for given audit
     * @param sfWebRequest $request
     */
    public function executeAuditaRecord(sfWebRequest $request) {
        //fetch request parameters
        $compnay_id = $request->getParameter('company');
        $question_id = $request->getParameter('id');
        //get company record
        $this->empresa = Doctrine::getTable('Empresa')->find($compnay_id);
        $question_record = Doctrine::getTable('ListaCuestionarioUser')->find($question_id);

        if ($question_record) {
            $this->form = new ListaCuestionarioUserForm($question_record);
        } else {
            $this->form = new ListaCuestionarioUserForm();
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
        $compnay_id = $request->getParameter('company');
        //get user
        $user = $this->getUser()->getGuardUser();
        //fetch company favourit record
        $company_favourite_record = Doctrine::getTable('ComapnyFavouriteList')->getRecordByUserAndId($user->getId(), $compnay_id);

        //if exist then send exist message
        if ($company_favourite_record) {
            return $this->renderText('Esta empresa/entidad <strong>ya está</strong> en Tus favoritos.');
        }
        //if not then create new one
        else {
            $company_favourite_record = new ComapnyFavouriteList();
            $company_favourite_record->create($user->getId(), $compnay_id);
            return $this->renderText('Has añadido esta <strong>empresa/entidad a Tus favoritos</strong>.');
        }

        $this->setLayout(false);
    }

    /**
     * display all comment records which are made by user
     * for given product
     * @param sfWebRequest $request
     */
    public function executeCommentList(sfWebRequest $request) {
        //fetch request parameters
        $user_id = $request->getParameter('user_id');
        $company_id = $request->getParameter('type');
        //fetch user audit records for given company
        $this->product_audit_records = Doctrine::getTable('Empresa')->getCommentsRecords($user_id, $company_id);
    }

    /**
     * display comment records for given comment id
     * @param sfWebRequest $request
     */
    public function executeCommentRecord(sfWebRequest $request) {
        //fetch request parameters
        $company_id = $request->getParameter('company');
        $comment_id = $request->getParameter('id');
        //get company record
        $this->company = Doctrine::getTable('Empresa')->find($company_id);
        $comment_record = Doctrine::getTable('ComentarioListaNegra')->find($comment_id);


        if ($comment_record) {
            $this->form = new ComentarioListaNegraForm($comment_record);
        } else {
            $this->form = new ComentarioListaNegraForm();
        }
    }

    /**
     * fetch featured company records for homepage
     * @param sfWebRequest $request
     */
    public function executeFeaturedComapnyRecords(sfWebRequest $request) {
        //fetch company records for white list
        $this->whilte_list_comapny_records = Doctrine::getTable('Empresa')->getFeatureCompanyRecords('lb');


        //fetch company records for black list
        $this->black_list_comapny_records = Doctrine::getTable('Empresa')->getFeatureCompanyRecords('ln');
    }
}
