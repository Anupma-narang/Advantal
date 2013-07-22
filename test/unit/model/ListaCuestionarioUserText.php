<?php

include(dirname(__FILE__) . '/../../bootstrap/Doctrine.php');
$t = new lime_test(1);

$t->comment('->cuestionario');
$cuestionario = Doctrine_Core::getTable('ListaCuestionarioUser')->findAll();
ldd($cuestionario->getPuntos());
//$t->ok($medalla == 'Bronce', 'Medalla de bronce');
