
<?php

class contribucionComponents extends sfComponents {

    public function executeList(sfWebRequest $request){

      //fetch user
      $user = $this->getUser()->getGuardUser();
      
      //fetch contribution records
      $this->contribution_records = Doctrine::getTable('Contribucion')->getContributionByConcurso($this->concurso->getId(), $user->getId(), $this->contribution_status_array);
      $this->destacada = false;
      
    }
    
    public function executeContributionCount(sfWebRequest $request){
      //fetch user
       $user = $this->getUser()->getGuardUser();
       //fetch contribution count 
       
       $this->contribution_count = Doctrine::getTable('Contribucion')->getContributionCountByConcurso($this->concurso->getId(), $user->getId(), $this->contribution_status_array);
    }

}