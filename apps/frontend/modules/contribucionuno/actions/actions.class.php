<?php

/**
 * contribucionuno actions.
 *
 * @package    auditoscopia
 * @subpackage contribucionuno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribucionunoActions extends sfActions {

    public function executeLista(sfWebRequest $request) {
        $this->idconcurso = $request->getParameter("concurso_id");
        $this->listacontribuciones = Doctrine::getTable("Contribucion")->createQuery()->where("concurso_id=?", $this->idconcurso)->andWhere("contribucion_estado_id=?", 2)->execute();
    }

    public function executeIndex(sfWebRequest $request) {
    }

    public function executeNew(sfWebRequest $request) {
        $this->concurso = Doctrine::getTable('Concurso')->findOneById($request->getParameter('concurso_id'));
        $this->forward404Unless($this->concurso);

        if($request->hasParameter('contribucion_id'))
        {
            $this->contribucion = Doctrine::getTable('Contribucion')->createQuery()
                ->where('id=?', $request->getParameter('contribucion_id'))
                ->andWhere('concurso_id=?', $this->concurso->getId())
                ->fetchOne();
            $this->forward404Unless($this->contribucion);
        }
        else
        {
            $this->contribucion = $this->concurso->getContribucionPrincipal();
        }

        $this->form = new ContribucionFormUno(array(), array('concurso_id'=>$this->concurso->getId()));
        
        $this->processForm($request, $this->form);
        
    }

    public function executeEdit(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("id"));
        $this->concurso = $this->contribucion->getConcurso();
        $this->from = $request->getParameter('from', 'nothing');
        $this->form = new ContribucionFormUno($this->contribucion);
        $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        if ($request->getMethod() == sfWebRequest::POST)
        {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $concurid = $form->save();
                if ($concurid->getConcurso()->getConcursoTipoId() == 1)
                {
                    $this->getUser()->setFlash('nueva_contribucion', 'La contribución se ha enviado correctamente.<br/>No la podrás ver hasta que sea revisada por un moderador.<br/><strong>Si quieres mejorar algún otro aspecto esta empresa o entidad, haz clic <a href="' . $this->getController()->genUrl('/contribucionuno/new?concurso_id=' . $concurid->Concurso->id) . '">aquí</a>.</strong><br/>¡Muchas gracias por contribuir en este concurso!');
                }
                else
                {
                    $this->getUser()->setFlash('nueva_contribucion', 'La contribución se ha enviado correctamente.<br/>No la podrás ver hasta que sea revisada por un moderador.<br/><strong>Si quieres mejorar algún otro aspecto este producto, haz clic <a href="' . $this->getController()->genUrl('/contribucionuno/new?concurso_id=' . $concurid->Concurso->id) . '">aquí</a>.</strong><br/>¡Muchas gracias por contribuir en este concurso!');
                }

                $this->redirect('concurso/show?id=' . $concurid->Concurso->id . '&contribucion_id=' . $concurid->getId());
            }
        }
    }

    public function executeConfirm(sfWebRequest $request) {

    }

    public function executeShowincidenciadescripcion(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));
    }

    public function executeShowresumenplandeaccion(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));
    }

    public function executeShowplandeaccion(sfWebRequest $request) {
        $this->forward404Unless($this->getUser()->isAuthenticated());

        $this->forward404Unless($this->contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));

        $this->forward404Unless($this->contribucion->getUserId() == $this->getUser()->getGuardUser()->getId());
    }

    public function executeDownload_pdf(sfWebRequest $request) {
        $this->forward404Unless($contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));
        if ($this->getUser()->getGuardUser()->getId() != $contribucion->getUserId())
            $this->forward404('No eres el autor de esta contribución.');

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

}
