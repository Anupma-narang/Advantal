<?php
//ConcurosCp
//for ($i=1;$i<20;$i++)
//{
//    $concursocp=new ConcursoCp();
//    $concursocp->name="nombre_".$i;
//    $concursocp->incidencia="nombre_".$i;
//    $concursocp->concurso_estado_id="2";
//    $concursocp->concurso_tipo_id="1";
//    $concursocp->road_type_id=5;
//    $concursocp->states_id=28;
//    $concursocp->city_id=5;
//    $concursocp->save();
//}


//Contribuciones
for ($i=3;$i<20;$i++) //ConcursosCp
{
    for($j=1;$j<5;$j++){
    $contribucioncp=new ContribucionCp();
    
    $contribucioncp->name="Contribucion _".$j;
    $contribucioncp->concurso_cp_id=$i;
    
    $contribucioncp->contribucionestado_cp_id=2;
    $contribucioncp->incidencia="Contribucion Contribucion Contribucion Contribucion nombre_".$i;

    $contribucioncp->plan_accion="alsdkfjñasdkjfñaskdfñasdkfa";
    $contribucioncp->resumen="  josidf apoijapsdoiaspdas ihoiu h isisdf iu f v jj pisjdb odij sd slj";

    $contribucioncp->save();

    }

}
?>
