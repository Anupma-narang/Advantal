<?php

class slxDate
{
  /*
   función que devuelve un array con los días de un determinado mes
  */
  public static function getDiasMes($mes, $anio)
  {
    $primer_dia_mes = mktime (0, 0, 0, $mes, 1, $anio);
    $n_dias_mes = date('t', $primer_dia_mes);
    $dias = array();
    $fecha = array();
    for ($i = 1; $n_dias_mes >= $i; $i++)
    {
      $tiempo = mktime(0, 0, 0, $mes, $i, $anio); 
      $fecha = date('Y-m-d', $tiempo);

      $dias[] = $fecha;
    }
    //print_r($dias); die;
    return $dias;
  }
  
   /*
   función que devuelve el nuemero de minutos que van desde una hora de inicio a una de fin
   en un horario de 24 horas
  */
  public static function getMinutosDiff($hora_inicio, $hora_fin)
  {
    $hora_inicio = strtotime($hora_inicio);
    $hora_fin = strtotime($hora_fin);
    $minutos = 0;
    $minutos = abs(($hora_fin - $hora_inicio)/60);
    return $minutos;
  }
  
 
  /*
   función que devuelve el nuemero de horas que van desde una hora de inicio a una de fin
   en un horario de 24 horas
  */
  public static function getHorasDiff($hora_inicio, $hora_fin)
  {
    $minutos = self::getMinutosDiff($hora_inicio, $hora_fin);
    return floor($minutos/60);
  }
  
  /*
   función que devuelve la diferencia de dias entre dos fechas
  */
  public static function getAniosDiff($fecha_inicio, $fecha_fin)
  {
    $diff = strtotime($fecha_fin)-strtotime($fecha_inicio);
    return date('Y', $diff)-1970;     
  }
  
  /*
   función que devuelve el nuemero de dias que van desde una fecha de inicio a una de fin
  */
  public static function getDiasDiff($fecha_inicio, $fecha_fin)
  {
    $diff = strtotime($fecha_fin)-strtotime($fecha_inicio);
    $dias_diferencia = $diff / (60 * 60 * 24);
    $dias = floor($dias_diferencia); 
    return $dias;     
  }
  
  // Esta función devuleve un array con las fechas que hay entre fecha_inicio y fecha_fin, ambas incluidas
  public static function getRangoFechas($fecha_inicio, $fecha_fin)
  {
    $date_array = array();
    while ( $fecha_inicio <= $fecha_fin )
    {
      $date_array[] = $fecha_inicio;
      $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio." + 1 day"));
    }
    
    return $date_array;
  }
  
  // Esta función devuleve un array con las fecha contenidas entre fecha_inicio y fecha_fin
  public static function getRangoEntreFechas($fecha_inicio, $fecha_fin, $format = 'Y-m-d' )
  {
    $fechas = self::getRangoFechas($fecha_inicio, $fecha_fin, $format);
    array_shift($fechas);
    array_pop($fechas);    

    return $fechas;
  }
  
  public static function getNombreMes($num,$abbr=0)
  {
    $devuelve = "error";
    if($num>0){
      if($abbr==1){
        $meses = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
      }      
      else
      {
        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      }
      $devuelve = $meses[$num];
    }
    
    return $devuelve;
  }
  
  public static function esBisiesto($year=NULL)
  {
    return checkdate(2, 29, ($year==NULL)? date('Y'):$year); // devolvemos true si es bisiesto
  }  
  
}