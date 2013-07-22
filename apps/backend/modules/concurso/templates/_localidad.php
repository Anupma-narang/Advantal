<?php

if ($concurso->getCityId() != ''):
    echo $concurso->getCity();
else:
    echo $concurso->getStates();
endif;
?>
