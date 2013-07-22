<?php

class AlertListener
{
    static public function createAlert(sfEvent $event)
    {
        $params = $event->getParameters();
        $object = $params['object'];
        //comentado porqué esta parte esta desarrollada por Calambret
//        if ($object instanceof Empresa) {
//            if ($object->getValida() == 0) {
//                self::generateEmpresaAlert($object);
//            }
//        }

        if ($object instanceOf ListaCuestionarioUser) {
            if (!$object->getAprobado()) {
                self::generateListaCuestionarioAlert($object);
            }
        }

        if ($object instanceof ComentarioListaNegra) {
            AlertasTable::nueva(3, 'Comentario lista negra', sprintf('Nuevo comentario lista negra para validar en empresa %s', $params['object']->getEmpresa()->getName()));
        }
    }



    static public function generateEmpresaAlert($empresa)
    {
        AlertasTable::nueva(3, 'Empresa sin validar', sprintf('Se ha creado la empresa %s y se ha de validar', $empresa->getName()));
    }

    static public function generateListaCuestionarioAlert(ListaCuestionarioUser $cuestionario)
    {
        AlertasTable::nueva(3, 'Cuestionario pendiente de moderar', sprintf('Se ha creado un nuevo cuestioario para %s con comentarios', $cuestionario->getEmpresa()->getName()));
    }



}