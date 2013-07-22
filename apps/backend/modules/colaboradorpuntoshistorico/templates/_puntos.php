<?php $points = $colaboradorpuntoshistorico->getPuntos(); ?>

<?php

$tempPoint = $sf_user->getMoneyInFormat($points);

if($colaboradorpuntoshistorico->getTipoPunto() == "Asignación de caja")
{
  $tempPoint .= " €";
}

echo $tempPoint;
?>
