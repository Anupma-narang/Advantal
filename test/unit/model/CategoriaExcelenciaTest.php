<?php

include(dirname(__FILE__) . '/../../bootstrap/Doctrine.php');
$t = new lime_test(6);

$t->comment('->medalla de bronce');
$medalla = CategoriaExcelenciaTable::getMedalla(35);
$t->ok($medalla == 'Bronce', 'Medalla de bronze');

$t->comment('->medalla de plata');
$medalla = CategoriaExcelenciaTable::getMedalla(42);
$t->ok($medalla == 'Plata', 'Medalla de plata');

$t->comment('->medalla de oro');
$medalla = CategoriaExcelenciaTable::getMedalla(55);
$t->ok($medalla == 'Oro', 'Medalla de oro');

$t->comment('->medalla de oro');
$medalla = CategoriaExcelenciaTable::getMedalla(51);
$t->ok($medalla == 'Oro', 'Medalla de oro');
$t->comment('->medalla de oro');
$medalla = CategoriaExcelenciaTable::getMedalla(50);
$t->ok($medalla == 'Plata', 'Medalla de plata');

$t->comment('->sin medalla');
$medalla = CategoriaExcelenciaTable::getMedalla(5);
$t->ok($medalla == 'ninguno', 'Resultado: ' . $medalla);