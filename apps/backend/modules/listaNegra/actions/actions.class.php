<?php

class listaNegraActions extends sfActions {

    public function executePendientes(sfWebRequest $request) {
        $this->comentarios = new sfDoctrinePager(
                        'ComentarioListaNegra',
                        sfConfig::get('app_max_home_items', 25)
        );
        $this->comentarios->setQuery(Doctrine_Core::getTable('ComentarioListaNegra')->getAprobadoQuery(false));
        $this->comentarios->setPage($request->getParameter('page', 1));
        $this->comentarios->init();


        if ($this->comentarios->count() == 0) {
            return $this->renderText('<ul><li>No existen datos.</li></ul>');
        }
    }

    public function executeAprobarComentario(sfWebRequest $request) {
        $comentario = ComentarioListaNegraTable::getInstance()->find($request->getParameter('id'));

        $comentario->setAprobado(true);
        $comentario->save();

        return $this->renderText('ok');
    }

    public function executeBorrarComentario(sfWebRequest $request) {

        $comentario = ComentarioListaNegraTable::getInstance()->find($request->getParameter('id'));
        $comentario->delete();

        sfGuardUserProfileTable::removePuntosCommenta($comentario->getSfGuardUserId());
       // $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('Coment_lista_negra');
        $codingo = Doctrine_Core::getTable('ColaboradorPuntoDefinicion')->findOneBy('codigo', 'Coment_lista_negra');
        ColaboradorPuntosHistoricoTable::new_log($comentario->getSfGuardUserId(), $codingo->getDescripcion(), '-25', '', $request->getParameter('id'));

        return $this->renderText('ok');
    }

}
