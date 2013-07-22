<?php
class comunidadprivadaComponents extends sfComponents {
    public function executeContribucionesdestacadas(sfWebRequest $request) {
        $this->contribucionesdestacadascp=Doctrine::getTable("ContribucionCp")->createQuery()->where("concurso_cp_id=?",$request->getParameter("id"))->execute();    
    }

    public function executeDestacadoscp(sfWebRequest $request) {
        $this->concursosdestacados = Doctrine::getTable("ConcursoCp")->createQuery()->limit(5)->execute();
    }

    public function executeSemana() {
        //$this->concurso_semana = Doctrine::getTable("Concurso")->findOneByid(32);
        //$this->concurso_mes = Doctrine::getTable("Concurso")->findOneByid(32);
        //$this->concurso_anho = Doctrine::getTable("Concurso")->findOneByid(32);
    }

    public function executeVotacion(sfWebRequest $request) {

        $this->referendumscp = Doctrine::getTable("ConcursoReferendumCp")->createQuery()->where("concurso_cp_id=?", $this->concurso->id)->execute();
        $valoresVotados = array();

        foreach ($this->referendumscp as $referendum) {
            $valoresVotados[] = $referendum->value;
        }
        $valores = array(1, 2, 3, 4, 5);
        $valores = array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5);
        $this->valoresBuenos = array_diff($valores, $valoresVotados);
        $this->form = new ConcursoReferendumCpForm(array(), array('valores' => $this->valoresBuenos,'contribucioncp'=>$this->contribucioncp->id,'concursocp'=>$this->concursocp->id));
    }

}