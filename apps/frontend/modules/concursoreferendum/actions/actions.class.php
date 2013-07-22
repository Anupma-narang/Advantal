<?php
class concursoreferendumActions extends sfActions {
    public function executeCreate(sfWebRequest $request) {
        /* Form submit handler */
        $this->forward404Unless($request->isMethod('post'));

        $this->contribucion = doctrine::getTable('Contribucion')->find($request->getParameter('contribucion_id'));
        $user = $this->getUser()->getGuardUser();
        $this->forward404Unless($user);
        $this->forward404Unless($this->contribucion);

        $this->numero_votos_usuario = $this->contribucion->getConcurso()->getNumeroVotacionesUsuario($user->getId());
        if ($this->numero_votos_usuario < 5 and !$this->getUser()->hasVotedContribucion($this->contribucion->getId()))
        {
            $this->form = new ConcursoReferendumForm(null, array('contribucion_id'=>$this->contribucion->getId()));
            if ($this->form->bindAndSave($request->getParameter($this->form->getName())))
            {
                $this->numero_votos_usuario = $this->numero_votos_usuario + 1;
                $this->puntuacion = $this->form->getObject()->getValue();
                $has_votado_previamente_este_concurso = Doctrine::getTable('ColaboradorPuntosHistorico')->createQuery()
                    ->where('objeto like ?', 'concurso')
                    ->andWhere('objeto_id=?', $this->contribucion->getConcurso()->getId())
                    ->andWhere('user_id=?', $user->getId())
                    ->count() > 0;

                if( !$has_votado_previamente_este_concurso )
                {
                    // Asignación de puntos al colaborador (sólo una vez por usuario/concurso)
                    $puntos = doctrine::getTable('ColaboradorPuntoDefinicion')->findOneByCodigo('vot_ref');
                    $this->getUser()->getProfile()->setPuntos($puntos->getPuntos());

                    ColaboradorPuntosHistoricoTable::new_log( $user->getId(), $puntos->getDescripcion(),
                        $puntos->getPuntos(),'concurso', $this->contribucion->getConcurso()->getId(),
                        array('contribucion' => $this->contribucion->getId()));
                }
            }
        }
        $this->numero_votantes = $this->contribucion->getConcurso()->getVotosTotales();
    }
}
