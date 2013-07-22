<?php

include(dirname(__FILE__) . '/../../bootstrap/Doctrine.php');
$t = new lime_test(2);

// carga un nuevo cuestionario

$user = Doctrine_Core::getTable('sfGuardUser')->findOneByUsername('joan');
$users = crearUsuarios($user);

$empresa = Doctrine_Core::getTable('Empresa')->findOneBySlug('el-raco');
$auditorias = $empresa->getDivisor();
$puntos_iniciales = $empresa->getDividendo();
$cuestionario = Doctrine_Core::getTable('ListaCuestionario')->findOneByNombre("Cuestionario de un restaurante");

$cuestionarioRespuesta = crearNuevoCuestionario($empresa, $cuestionario, $users);

$puntos_obtenidos = $cuestionarioRespuesta->getPuntos();
// se añade la auditoria



$t->ok(($auditorias + 1) == $empresa->getDivisor(), 'Número auditorías son:' . $empresa->getDivisor());
$t->ok($puntos_iniciales + $puntos_obtenidos == $empresa->getDividendo(), 'Total puntos:' . $empresa->getDividendo());


function crearNuevoCuestionario(&$empresa, &$cuestionario, $user, $puntos = 1)
{
    $cuestionarioRespuesta = new ListaCuestionarioUser();
    $cuestionarioRespuesta->setEmpresa($empresa);
    $cuestionarioRespuesta->setCuestionario($cuestionario);
    $cuestionarioRespuesta->setUser($user[0]);
    $cuestionarioRespuesta->save();

    foreach ($cuestionario->getListaCuestionarioPregunta() as $pregunta) {

        $r = new ListaCuestionarioRespuesta();
        $r->setRespuesta($puntos);
        $r->setListaCuestionarioPreguntaId($pregunta->getId());
        $r->setListaCuestionarioUser($cuestionarioRespuesta);
        $r->save();
    }
    $empresa->addAuditoria($cuestionarioRespuesta);

    return $cuestionarioRespuesta;

}


function crearUsuarios($nb)
{
    $users = array();
    for ($i = 1; $i <= $nb; $i++) {
        $user = new sfGuardUser();
        $user->setUsername('user_' . $i);
        $user->setEmailAddress('user_' . $i . '@dummy.com');
        $user->save();
        $users[] = $user;
    }
    return $users;
}







