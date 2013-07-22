
<?php

class mesa_redondaComponents extends sfComponents {

    public function executeBusquedaconcurso(sfWebRequest $request) {
        //$this->destacados = Doctrine::getTable("Concurso")->createQuery()->limit(5)->execute();
    }

    public function executeMr(sfWebRequest $request) {

        //$this->destacados = Doctrine::getTable("Concurso")->createQuery()->limit(5)->execute();
    }

    public function executeDestacadas(sfWebRequest $request) {

        $this->destacadas = Doctrine::getTable("MesaRedonda")->createQuery()->limit(5)->execute();
    }
    
    
    public function executeVotacion(sfWebRequest $request) {

        $this->referendums = Doctrine::getTable("MesaredondaReferendum")->createQuery()->where("mesa_redonda_id=?", $this->mesaredonda->id)->execute();
        $valoresVotados = array();

        foreach ($this->referendums as $referendum) {
            $valoresVotados[] = $referendum->value;
        }
        //$valores = array(1, 2, 3, 4, 5);
        $valores = array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5);
        $this->valoresBuenos = array_diff($valores, $valoresVotados);
        
        //$this->form = new ConcursoReferendumForm(array(), array('valores' => $this->valoresBuenos, contribucion>=$this->contribucion));
        $this->form = new MesaredondaReferendumForm(array(), array('valores' => $this->valoresBuenos,'ponencia'=>$this->ponencia->id,'mesaredonda'=>$this->mesaredonda->id));
    }


}