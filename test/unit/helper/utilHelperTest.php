<?php

include(dirname(__FILE__) . '/../../bootstrap/unit.php');
include(sfConfig::get('sf_lib_dir'). '/helper/utilHelper.php');
$values = array(
    '2.00' => 2,
    '2.20' => 2.20,
    '5.45' => 5.45,
    '5.40' => 5.40,
    '5.31' => 5.30,
    '5.32' => 5.30,
    '5.33' => 5.35,
    '5.34' => 5.35,
    '5.36' => 5.35,
    '5.37' => 5.35,
    '5.38' => 5.40,
    '5.39' => 5.40,
    '5.98' => 6,
    '5.01' => 5,
    '9.98' => 10,
    '9.97' => 9.95
);

$t = new lime_test(count($values));

$t->comment('->muestra kpis...');
foreach ($values as $value => $ret) {
    $t->ok(mostrar5centesimas($value) == $ret, sprintf('Para "%s" Se muestra: %s', $value,  mostrar5centesimas($value)));
}
