<?php

class mesa_redondaActions extends sfActions {

    public function executeNuevaponencia(sfWebRequest $request) {
        $this->formnp = new MesaredondaPonenciaForm();
    }

    public function executeIndex(sfWebRequest $request) {
        $this->estado = $request->getParameter("estado");
        if (!$this->estado) {
            $this->estado = 2;
        }

        if ($this->estado == 2) {
             $this->mesasredondas = Doctrine::getTable("MesaRedonda")->createQuery()->where("mesaredonda_estado_id=?", $this->estado)->orWhere("mesaredonda_estado_id=?", 3)->execute(); 
        } else {
            $this->mesasredondas = Doctrine::getTable("MesaRedonda")->createQuery()->where("mesaredonda_estado_id=?", $this->estado)->execute();
        }
    }

    public function executeShow(sfWebRequest $request) {
        //$this->idmr = $request->getParameter("id");
        $this->mesaredonda = Doctrine::getTable("Mesaredonda")->findOneById($request->getParameter("id"));
        //$this->mesaredonda_id = Doctrine::getTable("MesaredondaPonencia")->createQuery()->where("mesa_redonda_id=?", $this->idmr)->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new MesaRedondaFormFrontend();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('post'));

        $this->form = new MesaRedondaFormFrontend();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $newmr = $form->save();
            $this->redirect('mesa_redonda/confirm?id=' . $newmr->id);
        }
    }

    public function executeConfirm(sfWebRequest $request) {

        //$this->form = new OfertForm();
    }

}
