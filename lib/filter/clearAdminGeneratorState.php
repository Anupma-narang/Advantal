<?php

class clearAdminGeneratorState extends sfFilter
{
    public function execute ($filterChain)
    {
        // "Si navegas por la página 3 de 'concursos' y cambia mediante el menú a
        // otra sección, al volver a entrar en 'concursos' entras directamente en
        // la página 3... es muy confuso"   :-O
        $current = sfContext::getInstance()->getModuleName();
        $last = sfContext::getInstance()->getUser()->getAttribute('last_module');
        if ($current != $last)
        {
            sfContext::getInstance()->getUser()->getAttributeHolder()->removeNamespace('admin_module');
        }
        sfContext::getInstance()->getUser()->setAttribute('last_module', $current);

        $filterChain->execute();
    }
}
