<?php

include(dirname(__FILE__) . '/../../bootstrap/Doctrine.php');
$t = new lime_test(6);

// carga un nuevo cuestionario

$user = Doctrine_Core::getTable('sfGuardUser')->findOneByUsername('joan');
$users = crearUsuarios(10);

$empresa = Doctrine_Core::getTable('Empresa')->findOneBySlug('el-raco');
$auditorias = $empresa->getDivisor();
$puntos_iniciales = $empresa->getDividendo();
$cuestionario = Doctrine_Core::getTable('ListaCuestionario')->findOneByNombre("Cuestionario de un restaurante");

crearNuevoCuestionario($empresa, $cuestionario, $users);

//test sobre los Kpis...
$kpis = $empresa->getKpis();
foreach ($kpis as $kpi) {
    $t->is(1, $kpi->getMedia(), 'Media Kpis:' . $kpi->getMedia());
}


//nuevas...
$users = crearUsuarios(10);
crearNuevoCuestionario($empresa, $cuestionario, $users, 4);

$kpis = $empresa->getKpis();
foreach ($kpis as $kpi) {
    $t->is(2.5, $kpi->getMedia(),  'Media Kpis:' . $kpi->getMedia());
}

$users = crearUsuarios(5);
crearNuevoCuestionario($empresa, $cuestionario, $users, 2);
$kpis = $empresa->getKpis();
foreach ($kpis as $kpi) {
    $t->is(2.4, $kpi->getMedia(), 'Media Kpis:' . $kpi->getMedia());
}



function crearNuevoCuestionario($empresa, $cuestionario, $users, $puntos = 1)
{
    foreach ($users as $user) {

        $cuestionarioRespuesta = new ListaCuestionarioUser();
        $cuestionarioRespuesta->setEmpresa($empresa);
        $cuestionarioRespuesta->setCuestionario($cuestionario);
        $cuestionarioRespuesta->setUser($user);
        $cuestionarioRespuesta->save();

        foreach ($cuestionario->getListaCuestionarioPregunta() as $pregunta) {

            $r = new ListaCuestionarioRespuesta();
            $r->setRespuesta($puntos);
            $r->setListaCuestionarioPreguntaId($pregunta->getId());
            $r->setListaCuestionarioUser($cuestionarioRespuesta);
            $r->save();
        }
        $empresa->addAuditoria($cuestionarioRespuesta);

    }
}


function crearUsuarios($nb)
{
    $users = array();
    $hash = time();
    for ($i = 1;  $i <= $nb; $i++) {
        $user = new sfGuardUser();
        $user->setUsername('user_' . $hash . $i);
        $user->setEmailAddress('user_' . $hash . $i  .'@dummy.com');
        $user->save();
        $users[] = $user;
    }
    return $users;
}







