<?php

class fakemime
{
    public static function detect($file)
    {
        // Cuando subimos un fichero tipo docx (bastante común), dado que la función fileinfo() del php los detecta como ZIP,
        // el medodo sfValidatedFile->save() guarda estos ficheros con una extensión incorrecta.
        // Como mínimo hay dos formas de arreglar esto: la buena y la guarra.  Dado que en el esquema actual no tiene en cuenta
        // el mime-type para nada, escogemos la segunda opción que cumple con el objetivo marcado.
        // Lo que vamos a hacer es forzar el sfValidatorFile (usando la opción 'mime_type_guessers') que use esta función para
        // calcular el mimetype, que retornará siempre un valor que no aparece en las tablas de sfValidatedFile y por lo tanto,
        // sfValidatedFile->getExtension() nos dará la extensión del fichero original, que ya nos vale.

        return 'application/absolutelyAFake';
    }
}
