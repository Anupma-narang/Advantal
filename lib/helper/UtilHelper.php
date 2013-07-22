<?php


function mostrar5centesimas($value)
{
    $formatted = number_format($value, 2);
    $srtVal = explode('.', strval($formatted));
    if ($srtVal[1] == '00') {
        return $srtVal[0];
    }

    if ($srtVal[1] % 5 == 0 ) {
        return $formatted;
    }

    $decimals = ((int) $srtVal[1]) / 10;
    $lastDecimal = substr($srtVal[1], 1, 1);

    if (($lastDecimal <= 2) || ($lastDecimal >= 8)) {

        if(round($decimals,0) == 10) {
            return $srtVal[0] + 1;
        } elseif (round($decimals,0) == 0) {
            return $srtVal[0];
        } else {

            return number_format((int) $srtVal[0] . '.' . round($decimals,0),2);
        }

    } else {
        return (int) $srtVal[0] . '.' . substr($srtVal[1], 0, 1) . '5';
    }


}