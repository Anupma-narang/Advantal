<?php

class private_comunityActions extends sfActions
{
	public function executeNew()
	{
		$this->form = new sfGuardUserEmpresaForm();
	}

	public function executeCreate(sfWebRequest $request)
	{

		$this->forward404Unless($request->isMethod('post'));

		$this->form = new sfGuardUserEmpresaForm();

		$this->processForm($request, $this->form);
		$this->setTemplate("new");
	}

	protected function processForm(sfWebRequest $request, sfForm $form) {
		$form->bind($request->getParameter($form->getName()));
		if ($form->isValid()) {
			$concurso = $form->save();
			$this->redirect('private_comunity/index');
		}
	}
	
	public function executeIndex()
	{
		$this->users_empresa=Doctrine::getTable("sfGuardUser")->createQuery("a")->leftJoin("a.Permissions p")->where ("p.id=3")->execute();
	}
}