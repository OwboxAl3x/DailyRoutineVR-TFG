<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'dailyroutinevr');

define('PATH', '../../DailyRoutineVR/');

define('TIPODETALLE', array('OMISION' => 1,
        'ADICION' => 2,
        'SECUENCIA' => 3,
//        'ESTIMACION' => 4,
        'PREGUNTA' => 5,
//        'CONTROL' => 6,
        'ADHESION' => 7,
        'DESPLAZAMIENTO' => 8,
        'CORRECTO' => 9)
//        'ACABA' => 10)
);

define('TIPODETALLECOMPLETO', array('OMISION' => 1,
        'ADICION' => 2,
        'ERROR DE SECUENCIA DE SUSTITUCION' => 3,
//        'ERROR DE ESTIMACION' => 4,
        'PREGUNTA' => 5,
//        'ERROR DE CONTROL' => 6,
        'ADHESION AL MEDIO AMBIENTE' => 7,
        'DESPLAZAMIENTO SIN PROPOSITO' => 8,
        'OBJETOS CORRECTO' => 9)
//        'ACABA ANTES DEL FINAL DEL TIEMPO' => 10)
);

?>