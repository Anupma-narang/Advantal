<?php

/**
 * fichero actions.
 *
 * @package    auditoscopia
 * @subpackage fichero
 * @author
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ficheroActions extends sfActions
{


	public function executeNew(sfWebRequest $request)
	{
		$this->form = new FicheroForm();
	}
	public function executeCreate(sfWebRequest $request)
	{

		$this->forward404Unless($request->isMethod('post'));

		$this->form = new FicheroForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid()){
			$fichero = $form->save();
			$this->getUser()->updateMyRank(2);
			$this->getUser()->setFlash('notice', 'El fichero se ha añadido correctamente.');
			$this->redirect('concurso/show?id='.$fichero->Contribucion->Concurso->id);

		}
	}
}
