<?php

/**
 * We need to make sure this plugin is backward compatible.
 * The in the original, this template was invoked by "include_partial",
 * which means that now it won't work. Therefore, we set a variable in the
 * component code, and if it is not present - we call the component
 */
function my_own_stuff($module_link, $action_link) {
    $module_name = sfContext::getInstance()->getModuleName();
    $action_name = sfContext::getInstance()->getActionName();
    $requestParameter = sfContext::getInstance()->getRequest();
    $path = '';

    if ($module_name == 'conRewardLogcursos_pendientes' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', $module_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', $module_link));
    } elseif ($module_name == 'concursos_pendientes' && ($action_name == 'edit' || $action_name == 'editEmpresa' || $action_name == 'editProducto')) {
        $path.=sprintf(' / %s / %s', link_to('concursos pendientes', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s', link_to('concursos pendientes', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', $module_link), link_to('concursos pendientes', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s', link_to('concursos pendientes', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s', link_to('concursos pendientes', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concursos_pendientes_empresa' && $action_name == 'new') {
        $path.=sprintf('/ %s / %s / %s', link_to('concursos pendientes', '@concursos_pendientes'), link_to('empresa y entidad', '@concurso_concursos_pendientes_empresa'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concursos_pendientes_empresa' && $action_name == 'create') {
        $path.=sprintf('/ %s / %s / %s', link_to('concursos pendientes', '@concursos_pendientes'), link_to('empresa y entidad', '@concurso_concursos_pendientes_empresa'), link_to('nuevo', '@concurso_concursos_pendientes_empresa_new'));
    } elseif ($module_name == 'concursos_pendientes_empresa' && ($action_name == 'edit' || $action_name == 'editEmpresa')) {
        $path.=sprintf('/ %s / %s / %s', link_to('concursos pendientes', '@concursos_pendientes'), link_to('empresa y entidad', '@concurso_concursos_pendientes_empresa'), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_pendientes_empresa' && $action_name == 'update') {
        $path.=sprintf('/ %s / %s / %s', link_to('concursos pendientes', '@concursos_pendientes'), link_to('empresa y entidad', '@concurso_concursos_pendientes_empresa'), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_pendientes_empresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('empresa y entidad', '@concurso_concursos_pendientes_empresa'));
    } elseif ($module_name == 'concursos_pendientes_empresa' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('empresa y entidad', '@concurso_concursos_pendientes_empresa'), link_to('ver', $action_link));
    } elseif ($module_name == 'concursos_pendientes_product' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('producto', '@concurso_concursos_pendientes_product'));
    } elseif ($module_name == 'concursos_pendientes_product' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('producto', '@concurso_concursos_pendientes_product'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concursos_pendientes_product' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('producto', '@concurso_concursos_pendientes_product'), link_to('nuevo', '@concurso_concursos_pendientes_product_new'));
    } elseif ($module_name == 'concursos_pendientes_product' && ($action_name == 'edit' || $action_name == 'editProducto')) {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('producto', '@concurso_concursos_pendientes_product'), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_pendientes_product' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('producto', '@concurso_concursos_pendientes_product'), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_pendientes_product' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos pendientes', '@concursos_pendientes'), link_to('producto', '@concurso_concursos_pendientes_product'), link_to('ver', $action_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones pendientes', $module_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', $module_link), link_to('contribuciones pendientes', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s', link_to('contribuciones pendientes', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s', link_to('contribuciones pendientes', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s', link_to('contribuciones pendientes', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s', link_to('contribuciones pendientes', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_pendientes' && $action_name == 'rechazar') {
        $path.=sprintf(' / %s', link_to('sugerir modificaciones a una contribución', $action_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'rechazar') {
        $path.=sprintf(' / %s', link_to('sugerir modificaciones a un concurso', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', 'cartas_pendientes/index'));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'edit') {
        $path.=sprintf('/ %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', 'cartas_pendientes/index'), link_to('editar', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'update') {
        $path.=sprintf('/ %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', 'cartas_pendientes/index'), link_to('editar', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'show') {
        $path.=sprintf('/ %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'cartaPending' && $requestParameter->getParameter('letter_id') == '') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'cartaPending' && $requestParameter->getParameter('letter_id') != '') {
        $path.=sprintf('/ %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', 'cartas_pendientes/index'), link_to('editar', $action_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso' && $action_name == 'index') {
        $filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module');

        switch ($filtering_estados_tipos) {
            case 'empresa_entidad': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('empresa y entidad', $module_link));
                break;
            case 'producto': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('producto', $module_link));
                break;
            case 'referendum': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('referéndum', $module_link));
                break;
            case 'deliberacion': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('deliberación', $module_link));
                break;
            case 'observacion': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('observación', $module_link));
                break;
            case 'rechazados': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('rechazados', $module_link));
                break;
            case 'cerrados': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('cerrados', $module_link));
                break;
            case 'nulos': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('nulos', $module_link));
                break;
            case 'revision': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('revisión', $module_link));
                break;
            case 'borrador': $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('borrador', $module_link));
                break;
            default: $path.=sprintf(' / %s', link_to('concursos', $module_link));
                break;
        }
    } elseif ($module_name == 'concurso' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concurso' && $action_name == 'showEmpresa') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', $module_link), link_to('empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concurso' && $action_name == 'showProducto') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', $module_link), link_to('producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concurso' && ($action_name == 'edit' || $action_name == 'editEmpresa' || $action_name == 'editProducto')) {
        $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso' && ($action_name == 'new' || $action_name == 'newEmpresa' || $action_name == 'newProducto')) {
        $path.=sprintf(' / %s / %s', link_to('concursos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso' && ($action_name == 'setCompanyFeaturedOrder' )) {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', $module_link), link_to('empresa y entidad', $module_link), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'concurso' && ($action_name == 'setProductFeaturedOrder' )) {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', $module_link), link_to('producto', $module_link), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'contribucion' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', $module_link));
    } elseif ($module_name == 'contribucion' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'contribucion' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contribucion' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'contribucion' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'contribucion_empresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('empresa y entidad', '@contribucion_contribucion_empresa'));
    } elseif ($module_name == 'contribucion_empresa' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('empresa y entidad', '@contribucion_contribucion_empresa'), link_to('ver', $action_link));
    } elseif ($module_name == 'contribucion_empresa' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('empresa y entidad', '@contribucion_contribucion_empresa'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribucion_empresa' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('empresa y entidad', '@contribucion_contribucion_empresa'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribucion_empresa' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('empresa y entidad', '@contribucion_contribucion_empresa'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribucion_empresa' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('empresa y entidad', '@contribucion_contribucion_empresa'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('producto', '@contribucion_contribucion_product'));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('producto', '@contribucion_contribucion_product'), link_to('ver', $action_link));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('producto', '@contribucion_contribucion_product'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('producto', '@contribucion_contribucion_product'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('producto', '@contribucion_contribucion_product'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones', '@contribucion'), link_to('producto', '@contribucion_contribucion_product'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribucion_product' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones de producto', '@contribucion_contribucion_product'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'planes_de_accion' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s ', link_to('concursos', '@concurso'), link_to('planes de acción', '@contribucion_planes_de_accion'));
    } elseif ($module_name == 'planes_de_accion' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('planes de acción', '@contribucion_planes_de_accion'), link_to('ver', $action_link));
    } elseif ($module_name == 'planes_de_accion_empresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('planes de acción', '@contribucion_planes_de_accion_empresa'), link_to('empresa y entidad', '@contribucion_planes_de_accion_empresa'));
    } elseif ($module_name == 'planes_de_accion_empresa' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('planes de acción', '@contribucion_planes_de_accion_empresa'), link_to('empresa y entidad', '@contribucion_planes_de_accion_empresa'), link_to('ver', $action_link));
    } elseif ($module_name == 'planes_de_accion_producto' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('planes de acción', '@contribucion_planes_de_accion_producto'), link_to('producto', '@contribucion_planes_de_accion_producto'));
    } elseif ($module_name == 'planes_de_accion_producto' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('planes de acción', '@contribucion_planes_de_accion_producto'), link_to('producto', '@contribucion_planes_de_accion_producto'), link_to('ver', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'index') {
        $path.=sprintf(' / %s', link_to('colaboradores', $module_link));
        
    } elseif ($module_name == 'sfguarduser' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'List_ver') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'puntos') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('asignación de puntos', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'assignPermission') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('asignar permisos', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'hierarchy') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('asignación de jerarquías', $action_link));
    } elseif ($module_name == 'colaboradorpuntodefinicion' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('tabla de puntos', $module_link));
    } elseif ($module_name == 'colaboradorpuntodefinicion' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s', link_to('tabla de puntos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'colaboradorpuntodefinicion' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('tabla de puntos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'colaboradorpuntodefinicion' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('tabla de puntos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'colaboradorpuntodefinicion' && $action_name == 'new') {

        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('tabla de puntos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'colaboradorpuntodefinicion' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('tabla de puntos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'road_type' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('tipos de vía', $module_link));
    } elseif ($module_name == 'road_type' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de vía', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'road_type' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de vía', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'road_type' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de vía', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'road_type' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de vía', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'states' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('provincias', $module_link));
    } elseif ($module_name == 'states' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('provincias', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'states' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('provincias', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'states' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('provincias', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'states' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('provincias', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresa_sector_uno' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('sectores de empresa y entidad', $module_link));
    } elseif ($module_name == 'empresa_sector_uno' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'empresa_sector_uno' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa_sector_uno' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa_sector_uno' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresa_sector_uno' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresa_sector_dos' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('subsectores de empresa y entidad', $module_link));
    } elseif ($module_name == 'empresa_sector_dos' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'empresa_sector_dos' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa_sector_dos' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa_sector_dos' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresa_sector_dos' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresa_sector_tres' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('actividades de empresa y entidad', $module_link));
    } elseif ($module_name == 'empresa_sector_tres' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'empresa_sector_tres' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa_sector_tres' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa_sector_tres' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresa_sector_tres' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesional_tipo_uno' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('sectores profesionales', $module_link));
    } elseif ($module_name == 'profesional_tipo_uno' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores profesionales', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'profesional_tipo_uno' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores profesionales', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'profesional_tipo_uno' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores profesionales', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesional_tipo_dos' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('subsectores profesionales', $module_link));
    } elseif ($module_name == 'profesional_tipo_dos' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores profesionales', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'profesional_tipo_dos' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores profesionales', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'profesional_tipo_dos' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores profesionales', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesional_tipo_tres' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('actividades profesionales', $module_link));
    } elseif ($module_name == 'profesional_tipo_tres' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades profesionales', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'profesional_tipo_tres' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades profesionales', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'profesional_tipo_tres' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('actividades profesionales', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'producto_tipo_uno' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('sectores de producto', $module_link));
    } elseif ($module_name == 'producto_tipo_uno' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'producto_tipo_uno' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto_tipo_uno' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto_tipo_uno' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto_tipo_uno' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('sectores de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto_tipo_dos' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('subsectores de producto', $module_link));
    } elseif ($module_name == 'producto_tipo_dos' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'producto_tipo_dos' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto_tipo_dos' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto_tipo_dos' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto_tipo_dos' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('subsectores de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto_tipo_tres' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('tipos de producto', $module_link));
    } elseif ($module_name == 'producto_tipo_tres' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'producto_tipo_tres' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto_tipo_tres' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto_tipo_tres' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto_tipo_tres' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('tipos de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso_categoria' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso', $module_link));
    } elseif ($module_name == 'concurso_categoria' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concurso_categoria' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso_categoria' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso_categoria' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso_categoria' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'categoria_excelencia' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('las listas', $module_link), link_to('categorías de excelencia', $module_link));
    } elseif ($module_name == 'categoria_excelencia' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('categorías de excelencia', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'categoria_excelencia' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('categorías de excelencia', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'categoria_excelencia' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('categorías de excelencia', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'categoria_excelencia' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('categorías de excelencia', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'categoria_excelencia' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('categorías de excelencia', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso_categoria_empresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de empresa y entidad', $module_link));
    } elseif ($module_name == 'concurso_categoria_empresa' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concurso_categoria_empresa' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso_categoria_empresa' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso_categoria_empresa' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso_categoria_empresa' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso_categoria_producto' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de producto', $module_link));
    } elseif ($module_name == 'concurso_categoria_producto' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concurso_categoria_producto' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso_categoria_producto' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concurso_categoria_producto' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concurso_categoria_producto' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('categorías de concurso de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concursos_destacados' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('concursos destacados', $module_link));
    } elseif ($module_name == 'concursos_destacados' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos destacados ', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concursos_destacados' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos destacados ', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_destacados' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos destacados ', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_destacados' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos destacados', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'concursos_destacados' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('concursos destacados', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', $module_link));
    } elseif ($module_name == 'contribuciones_destacadas' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_empresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('empresa y entidad', '@contribucion_contribuciones_destacadas_empresa'));
    } elseif ($module_name == 'contribuciones_destacadas_empresa' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('empresa y entidad', '@contribucion_contribuciones_destacadas_empresa'), link_to('ver', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_empresa' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('empresa y entidad', '@contribucion_contribuciones_destacadas_empresa'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_empresa' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('empresa y entidad', '@contribucion_contribuciones_destacadas_empresa'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_empresa' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('empresa y entidad', '@contribucion_contribuciones_destacadas_empresa'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_empresa' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('empresa y entidad', '@contribucion_contribuciones_destacadas_empresa'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_producto' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('producto', '@contribucion_contribuciones_destacadas_producto'));
    } elseif ($module_name == 'contribuciones_destacadas_producto' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('producto', '@contribucion_contribuciones_destacadas_producto'), link_to('ver', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_producto' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('producto', '@contribucion_contribuciones_destacadas_producto'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_producto' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('producto', '@contribucion_contribuciones_destacadas_producto'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_producto' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('producto', '@contribucion_contribuciones_destacadas_producto'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribuciones_destacadas_producto' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('concursos', '@concurso'), link_to('contribuciones destacadas', '@contribuciones_destacadas'), link_to('producto', '@contribucion_contribuciones_destacadas_producto'), link_to('editar', $action_link));
    } elseif ($module_name == 'contribucion' && $action_name == 'rechazar') {
        $path.=sprintf(' / %s', link_to('sugerir modificaciones a una contribución', $action_link));
    } elseif ($module_name == 'concurso' && $action_name == 'rechazar') {
        $path.=sprintf(' / %s', link_to('sugerir modificaciones a un concurso', $action_link));
    } elseif ($module_name == 'concursos_pendientes' && $action_name == 'rechazar') {
        $path.=sprintf(' / %s', link_to('sugerir modificaciones', $action_link));
    } elseif ($module_name == 'cartas_pendientes' && $action_name == 'rechazar') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas pendientes', $module_link), link_to('sugerir modificaciones', $action_link));
    } elseif ($module_name == 'profesionales_pendientes' && $action_name == 'rechazar' || $module_name == 'profesionales_pendientes' && $action_name == 'contacted') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('profesionales pendientes', $module_link), link_to('sugerir modificaciones', $action_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('alertas', $module_link));
    } elseif ($module_name == 'concursos_alertas' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('concursos', '@concurso'), link_to('alertas', $module_link));
    } elseif ($module_name == 'concursos_alertas' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('alertas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'concursos_alertas' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('alertas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'concursos_alertas' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('concursos', '@concurso'), link_to('alertas', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cuestionario' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de empresa y entidad', $module_link));
    } elseif ($module_name == 'cuestionario' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'cuestionario' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'cuestionario' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'cuestionario' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cuestionario' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cuestionarioProducto' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios producto', $module_link));
    } elseif ($module_name == 'cuestionarioProducto' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'cuestionarioProducto' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'cuestionarioProducto' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'cuestionarioProducto' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cuestionarioProducto' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('cuestionarios de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link));
    } elseif ($module_name == 'producto' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'producto' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'producto' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'producto' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'destacadoManager') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista blanca', $module_link), link_to('destacados', $action_link));
    } elseif ($module_name == 'cuestionario_pregunta' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('cuestionario de baja', $module_link));
    } elseif ($module_name == 'cuestionario_pregunta' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('cuestionario de baja', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'cuestionario_pregunta' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('cuestionario de baja', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'cuestionario_pregunta' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('cuestionario de baja', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'cuestionario_pregunta' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('cuestionario de baja', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cuestionario_pregunta' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('cuestionario de baja', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesionales_alertas' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('directorio', '@profesional_lista'), link_to('alertas', $module_link));
    } elseif ($module_name == 'profesionales_alertas' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional_lista'), link_to('alertas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'profesionales_alertas' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional_lista'), link_to('alertas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'profesionales_alertas' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional_lista'), link_to('alertas', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesionalLista' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s ', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')));
    } elseif ($module_name == 'profesionalLista' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')), link_to('ver', $action_link));
    } elseif ($module_name == 'profesionalLista' && ($action_name == 'edit')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')), link_to('editar', $action_link));
    } elseif ($module_name == 'profesionalLista' && ($action_name == 'new')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')), link_to('nuevo', $action_link));
    } elseif ($module_name == 'profesionalLista' && ($action_name == 'setFeaturedOrder')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'profesionalLista' && ($action_name == 'destacadoManager')) {
        $path.=sprintf(' / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('destacados', $action_link));
    } elseif ($module_name == 'profesionalLista' && ($action_name == 'update')) {
        $path.=sprintf(' / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('editar', $action_link));
    } elseif ($module_name == 'profesionalLista' && ($action_name == 'create')) {
        $path.=sprintf(' / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'index')) {
        $path.=sprintf(' / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de recomendación', 'cartas_recomendacion/index'));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'show')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de recomendación', 'cartas_recomendacion/index'), link_to('ver', $action_link));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'new')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de recomendación', 'cartas_recomendacion/index'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'edit')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de recomendación', 'cartas_recomendacion/index'), link_to('editar', $action_link));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de recomendación', 'cartas_recomendacion/index'), link_to('editar', $action_link));
    } elseif ($module_name == 'cartas_desaprobacion' && ($action_name == 'index')) {
        $path.=sprintf(' / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de desaprobación', 'cartas_desaprobacion/index'));
    } elseif ($module_name == 'cartas_desaprobacion' && ($action_name == 'show')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', '@profesional'), link_to('cartas de desaprobación', 'cartas_desaprobacion/index'), link_to('ver', $action_link));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'addEditRecommand' && $requestParameter->getParameter('letter_id', '') == '')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')), link_to('nueva carta de recomendación', $action_link));
    } elseif ($module_name == 'cartas_recomendacion' && ($action_name == 'addEditRecommand' && $requestParameter->getParameter('letter_id', '') != '')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('cartas de recomendación', url_for('cartas_recomendacion/index')), link_to('editar', $action_link));
    } elseif ($module_name == 'cartas_desaprobacion' && ($action_name == 'addEditDisapproval' && $requestParameter->getParameter('letter_id', '') == '')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('profesionales', url_for('profesionalLista/index')), link_to('nueva carta de desaprobación', $action_link));
    } elseif ($module_name == 'cartas_desaprobacion' && ($action_name == 'addEditDisapproval' && $requestParameter->getParameter('letter_id', '') != '')) {
        $path.=sprintf(' / %s / %s / %s', link_to('directorio', url_for('profesionalLista/index')), link_to('cartas de desaprobación', url_for('cartas_recomendacion/index')), link_to('editar', $action_link));
    } elseif ($module_name == 'RewardLog' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('histórico de recompensas', $module_link));
    } elseif ($module_name == 'RewardLog' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('histórico de recompensas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'RewardLog' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('histórico de recompensas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'RewardLog' && ($action_name == 'new' || $action_name == 'create' )) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', '@sfguarduser'), link_to('histórico de recompensas', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'administration' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('administradores', $module_link));
    } elseif ($module_name == 'administration' && $action_name == 'changePassword') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('administradores', $module_link), link_to('cambio contraseña', $action_link));
    } elseif ($module_name == 'administration' && $action_name == 'assignPermission') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('administradores', $module_link), link_to('asignar permisos', $action_link));
    } elseif ($module_name == 'administration' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('administradores', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'administration' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('administradores', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'administration_profile' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('perfiles de administración', $module_link));
    } elseif ($module_name == 'AdministrationCaja' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('gestión de caja', $module_link));
    } elseif ($module_name == 'AdministrationCaja' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('gestión de caja', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'AdministrationCaja' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('gestión de caja', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'AdministrationCaja' && ($action_name == 'create' || $action_name == 'new')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('gestión de caja', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'pizarra' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('pizarra', $module_link));
    } elseif ($module_name == 'pizarra' && $action_name == 'List_ver') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('pizarra', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'pizarra' && ($action_name == 'edit' || $action_name == 'update' )) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('pizarra', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'pizarra' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('pizarra', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'blocked_users' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('usuarios bloqueados', $module_link));
    } elseif ($module_name == 'blackboard_section' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('secciones pizarra', $module_link));
    } elseif ($module_name == 'blackboard_section' && $action_name == 'List_ver') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('secciones pizarra', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'blackboard_section' && ($action_name == 'edit' || $action_name == 'update' )) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('secciones pizarra', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'blackboard_section' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('secciones pizarra', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'jerarquia' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('jerarquías', $module_link));
    } elseif ($module_name == 'jerarquia' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('jerarquías', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'jerarquia' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('jerarquías', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'gift' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('escaparate de regalos', $module_link));
    } elseif ($module_name == 'gift' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('escaparate de regalos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'gift' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('escaparate de regalos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'gift' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('escaparate de regalos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'gift' && $action_name == 'setFeaturedOrder') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('escaparate de regalos', $module_link), link_to('asignar orden', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'assignPermission') {
        $path.=sprintf(' / %s / %s ', link_to('colaboradores', $module_link), link_to('cambiar la contraseña', $action_link));
    } elseif ($module_name == 'gift_redemption' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('regalo', $module_link));
    } elseif ($module_name == 'gift_redemption' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('canje de regalos', $module_link));
    } elseif ($module_name == 'gift_redemption' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('canje de regalos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'gift_redemption' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('canje de regalos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'gift_redemption' && $action_name == 'List_ver') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('canje de regalos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'sfguarduser' && $action_name == 'caja') {
        $path.=sprintf(' / %s / %s ', link_to('colaboradores', $module_link), link_to('caja', $module_link));
    } elseif ($module_name == 'company_case_study' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de empresa y entidad', $module_link));
    } elseif ($module_name == 'company_case_study' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'company_case_study' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'company_case_study' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'product_case_study' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de producto', $module_link));
    } elseif ($module_name == 'product_case_study' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'product_case_study' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'product_case_study' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('nuestros casos de éxito de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'user_company_case_study' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de empresa y entidad', $module_link));
    } elseif ($module_name == 'user_company_case_study' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'user_company_case_study' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'user_company_case_study' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'user_company_case_study_request' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de empresa y entidad', $module_link));
    } elseif ($module_name == 'user_company_case_study_request' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'user_company_case_study_request' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'user_company_case_study_request' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'user_product_case_study' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de producto', $module_link));
    } elseif ($module_name == 'user_product_case_study' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'user_product_case_study' && ($action_name == 'edit' || $action_name == "update")) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'user_product_case_study' && ($action_name == 'new' || $action_name == "create")) {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('otros casos de éxito de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'user_product_case_study_request' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de producto', $module_link));
    } elseif ($module_name == 'user_product_case_study_request' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de producto', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'user_product_case_study_request' && ($action_name == 'edit' || $action_name == "update")) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de producto', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'user_product_case_study_request' && ($action_name == 'new' || $action_name == "create")) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('casos de éxito de producto', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'colaboradorpuntoshistorico' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('histórico de colaboradores', $module_link));
    } elseif ($module_name == 'colaboradorpuntoshistorico' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('histórico de colaboradores', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'colaboradorpuntoshistorico' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('histórico de colaboradores', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'colaboradorpuntoshistorico' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('histórico de colaboradores', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'colaboradorpuntoshistorico' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('histórico de colaboradores', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'colaboradorpuntoshistorico' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('histórico de colaboradores', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'auditanos' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('audítanos', $module_link));
    } elseif ($module_name == 'auditanos' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('audítanos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'auditanos' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('audítanos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'auditanos' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('audítanos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'auditanos' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('audítanos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'administration_emails' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('administración', $module_link), link_to('correo administradores ', $module_link));
    } elseif ($module_name == 'administration_emails' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('correo administradores ', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'administration_emails' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('correo administradores ', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'administration_emails' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('correo administradores ', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'administration_emails' && ($action_name == 'assignPermission')) {
        $path.=sprintf(' / %s / %s / %s', link_to('administración', $module_link), link_to('correo administradores ', $module_link), link_to('asignar permisos', $action_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('colaboradores', $module_link), link_to('alertas', $module_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('alertas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('alertas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'update') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('alertas', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('alertas', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'colaboradores_alertas' && $action_name == 'create') {
        $path.=sprintf(' / %s / %s / %s', link_to('colaboradores', $module_link), link_to('alertas', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contactanos' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('contáctanos', $module_link));
    } elseif ($module_name == 'contactanos' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('contáctanos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'contactanos' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('contáctanos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contactanos' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('contáctanos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'recomended_registration' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('recomendaciones de amigos', $module_link));
    } elseif ($module_name == 'recomended_registration' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('recomendaciones de amigos', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'recomended_registration' && $action_name == 'edit') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('recomendaciones de amigos', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'recomended_registration' && $action_name == 'new') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('recomendaciones de amigos', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'contratanos' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('contrátanos', $module_link), link_to('empresa y entidad', $module_link));
    } elseif ($module_name == 'contratanos' && $action_name == 'show') {
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('correo', $module_link), link_to('contrátanos', $module_link), link_to('empresa y entidad', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'contratanos' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('correo', $module_link), link_to('contrátanos', $module_link), link_to('empresa y entidad', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'contratanos' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('correo', $module_link), link_to('contrátanos', $module_link), link_to('empresa y entidad', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresaListaBlanca' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista blanca', $module_link));
    } elseif ($module_name == 'empresaListaBlanca' && $action_name == 'show') {
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista blanca', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'empresaListaBlanca' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista blanca', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresaListaBlanca' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista blanca', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'empresaListaBlanca' && $action_name == 'setFeaturedOrder') {
        $path.=sprintf(' / %s / %s / %s ', link_to('las listas', $module_link), link_to('lista blanca de empresas y entidades', $module_link), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'empresaListaBlanca' && $action_name == 'destacadoManager') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista blanca', $module_link), link_to('destacados', $action_link));
    } elseif ($module_name == 'empresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link));
    } elseif ($module_name == 'empresa' && $action_name == 'show') {
        $path.=sprintf(' / %s /  %s / %s ', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'empresa' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s /  %s / %s ', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'empresa' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s /  %s / %s ', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'kpi' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('las listas', $module_link), link_to('kpis', $module_link));
    } elseif ($module_name == 'kpi' && $action_name == 'show') {
        $path.=sprintf(' / %s /  %s / %s ', link_to('las listas', $module_link), link_to('kpis', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'kpi' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s /  %s / %s ', link_to('las listas', $module_link), link_to('kpis', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'kpi' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s /  %s / %s ', link_to('las listas', $module_link), link_to('kpis', $module_link), link_to('nuevo', $action_link));
    } elseif ($module_name == 'listaNegraProducto' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista negra', $module_link));
    } elseif ($module_name == 'listaNegraProducto' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista negra', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'listaNegraProducto' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista negra', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'listaNegraProducto' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('productos', $module_link), link_to('lista negra', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'listaNegraProducto' && $action_name == 'setFeaturedOrder') {
        $path.=sprintf(' / %s / %s / %s ', link_to('las listas', $module_link), link_to('lista negra de productos', $module_link), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'listaNegraEmpresa' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista negra', $module_link));
    } elseif ($module_name == 'listaNegraEmpresa' && ($action_name == 'new' || $action_name == 'create')) {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista negra', $module_link), link_to('nueva', $action_link));
    } elseif ($module_name == 'listaNegraEmpresa' && ($action_name == 'edit' || $action_name == 'update')) {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista negra', $module_link), link_to('editar', $action_link));
    } elseif ($module_name == 'listaNegraEmpresa' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s / %s', link_to('las listas', $module_link), link_to('empresas y entidades', $module_link), link_to('lista negra', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'listaNegraEmpresa' && $action_name == 'setFeaturedOrder') {
        $path.=sprintf(' / %s / %s / %s ', link_to('las listas', $module_link), link_to('lista negra de empresas y entidades', $module_link), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'productoListaBlanca' && $action_name == 'setFeaturedOrder') {
        $path.=sprintf(' / %s / %s / %s ', link_to('las listas', $module_link), link_to('lista blanca de productos', $module_link), link_to('asignar orden home', $action_link));
    } elseif ($module_name == 'cuestionario_baja' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('bajas', $module_link));
    } elseif ($module_name == 'cuestionario_baja' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('bajas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'cuestionariobajavalue' && $action_name == 'index') {
        $path.=sprintf(' / %s / %s', link_to('correo', $module_link), link_to('bajas', $module_link));
    } elseif ($module_name == 'cuestionariobajavalue' && $action_name == 'show') {
        $path.=sprintf(' / %s / %s / %s', link_to('correo', $module_link), link_to('bajas', $module_link), link_to('ver', $action_link));
    } elseif ($module_name == 'contratanos_professional' && $action_name == 'index') {
        $module_link = sfContext::getInstance()->getRequest()->getUri();
        $path.=sprintf(' / %s / %s / %s', link_to('correo', '/backend.php/contratanos_professional'), link_to('contrátanos', $module_link), link_to('profesional', $module_link));
    } elseif ($module_name == 'contratanos_professional' && $action_name == 'show') {
        $module_link = sfContext::getInstance()->getRequest()->getUri();
        $action_link = $module_link . '/ver';
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('correo', '/backend.php/contratanos_professional'), link_to('contrátanos', '/backend.php/contratanos_professional'), link_to('profesional', '/backend.php/contratanos_professional'), link_to('ver', $action_link));
    } elseif ($module_name == 'contratanos_professional' && ($action_name == 'edit' || $action_name == 'update')) {
        $module_link = sfContext::getInstance()->getRequest()->getUri();
        $action_link = $module_link;
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('correo', $module_link), link_to('contrátanos', '/backend.php/contratanos_professional'), link_to('profesional', '/backend.php/contratanos_professional'), link_to('editar', $action_link));
    } elseif ($module_name == 'contratanos_professional' && ($action_name == 'new' || $action_name == 'create')) {
        $module_link = sfContext::getInstance()->getRequest()->getUri();
        $action_link = $module_link;
        $path.=sprintf(' / %s /  %s / %s / %s', link_to('correo', '/backend.php/contratanos_professional'), link_to('contrátanos', '/backend.php/contratanos_professional'), link_to('profesional', '/backend.php/contratanos_professional'), link_to('nuevo', $action_link));
    } elseif ($module_name == 'sfGuardAuth' && $action_name == 'nocredential') {
        $module_link = sfContext::getInstance()->getRequest()->getUri();
        $path.=sprintf(' / %s ', link_to('acceso denegado', $module_link));
    } else {
        $path.=null !== $module_link ? ' / ' . link_to($module_name, $module_link) : $module_name;
        $path.=null != $action_link ? ' / ' . link_to(strtolower($action_name), $action_link) : '';
    }

    return $path;
}

if (!isset($called_from_component)):
    include_component('sfAdminDash', 'header');
else:
    ?>


    <?php
    use_helper('I18N');
    /** @var Array of menu items */ $items = $sf_data->getRaw('items');
    /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
    /** @var string|null Link to the module (for breadcrumbs) */ $module_link = $sf_data->getRaw('module_link');
    /** @var string|null Link to the action (for breadcrumbs) */ $action_link = $sf_data->getRaw('action_link');
    ?>

    <?php if ($sf_user->isAuthenticated()): ?>
        <div id='sf_admin_theme_header'>
            <a href='<?php echo url_for('homepage') ?>' class="th-link"><strong><?php echo __('Administración de auditoscopia'); ?></strong></a>
            <div id="clock_desktop" class="th-link">
                Hoy es <?php echo date('d/m/Y') ?> y <?php if (date('G') == 1): ?>es la<?php else: ?>son las<?php endif ?> <span id="current-time"></span>
            </div>
            <div id="num_colaboradores" class="th-link">                
                Ya somos <?php echo $num_colaboradores ?> colaboradores
            </div>
        </div>
        <div><span class="g-top"></span><span class="b-top"></span><span class="o-top"></span></div>


        <div id='sf_admin_menu'>

            <?php include_partial('sfAdminDash/menu', array('items' => $items, 'categories' => $categories)); ?>

            <?php if (sfAdminDash::getProperty('logout') && $sf_user->isAuthenticated()): ?>
                <div id="logout"><?php echo link_to(image_tag('../images/exit.png'), sfAdminDash::getProperty('logout_route', '@sf_guard_signout ')); ?>
                    <span class="u-name"><?php echo $sf_user; ?></span></div>
            <?php endif; ?>
            <div class="clear"></div>
        </div>

        <?php if (sfAdminDash::getProperty('include_path')): ?>
            <div id='sf_admin_path'>
                <strong><a href='<?php echo url_for('homepage'); ?>'><?php echo sfAdminDash::getProperty('site'); ?></a></strong>
                <?php print my_own_stuff($module_link, $action_link); ?>
                <br /><br />

                <?php $module_name = sfContext::getInstance()->getModuleName(); ?>
                <?php $action_name = sfContext::getInstance()->getActionName(); ?>
                <?php if ($module_name == 'recomended_registration'): ?>
                    <strong><?php echo __('Hay ') . $recomended_count . ($recomended_count == 1 ? __(' recomendación ') : __(' recomendaciones ')) . __('de amigos') ?></strong><br /><br />
                <?php elseif ($module_name == 'contactanos'): ?>
                    <strong><?php echo __('Nos  han contactado ') . $contact_us . ($contact_us == 1 ? __(' vez') : __(' veces')) ?></strong><br /><br />
                <?php elseif ($module_name == 'gift'): ?>
                    <strong>Hay <?php echo $gift_count ?> <?php echo $gift_count == 1 ? 'regalo' : 'regalos' ?> en el Escaparate </strong><br /><br />
                <?php elseif ($module_name == 'pizarra'): ?>
                    <strong>Hay <?php echo $blackboard_count . ( $blackboard_count == 1 ? ' mensaje' : ' mensajes') ?> </strong><br /><br />
                <?php elseif ($module_name == 'gift_redemption'): ?>
                    <strong>Hay <?php echo $gift_redemption_count ?> formularios de canje </strong><br /><br />
                <?php elseif ($module_name == 'empresaListaBlanca' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_empresa_lista_blanca; ?> empresas y entidades en la lista blanca </strong><br /><br />

                <?php elseif ($module_name == 'concursos_pendientes_empresa' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_concursos_pendientes_empresa; ?> concursos pendientes de Empresa/Entidad </strong><br /><br />

                <?php elseif ($module_name == 'concursos_pendientes_product' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_concursos_pendientes_product; ?> concursos pendientes de Producto</strong><br /><br />

                <?php elseif ($module_name == 'company_case_study' && ($action_name == 'index' || $action_name == 'show')): ?>
                    <strong>Hay <?php echo $num_company_case_study . ( $num_company_case_study == 1 ? ' caso de' : ' casos de'); ?> éxito de Empresa/Entidad </strong><br /><br />
                <?php elseif ($module_name == 'product_case_study' && ($action_name == 'index' || $action_name == 'show')): ?>
                    <strong>Hay <?php echo $num_product_case_study . ( $num_product_case_study == 1 ? ' caso de' : ' casos de'); ?> éxito de Producto </strong><br /><br />
                <?php elseif ($module_name == 'user_company_case_study' && ($action_name == 'index' || $action_name == 'show')): ?>
                    <strong>Hay <?php echo $num_user_company_case_study . ( $num_user_company_case_study == 1 ? ' otro caso' : ' otros casos') ?> de éxito de Empresa/Entidad </strong><br /><br />
                <?php elseif ($module_name == 'user_product_case_study' && ($action_name == 'index' || $action_name == 'show')): ?>
                    <strong>Hay <?php echo $num_user_product_case_study . ( $num_user_product_case_study == 1 ? ' otro caso' : ' otros casos'); ?> de éxito de Producto</strong><br /><br />
                <?php elseif ($module_name == 'user_company_case_study_request' && ($action_name == 'index' || $action_name == 'show')): ?>
                    <strong>Hay <?php echo $num_user_company_case_study_request . ( $num_user_company_case_study_request == 1 ? ' caso de' : ' casos de'); ?> éxito de Empresa/Entidad</strong><br /><br />
                <?php elseif ($module_name == 'user_product_case_study_request' && ($action_name == 'index' || $action_name == 'show')): ?>
                    <strong>Hay <?php echo $num_user_product_case_study_request . ( $num_user_product_case_study_request == 1 ? ' caso de' : ' casos de'); ?> éxito de Producto</strong><br /><br />
                <?php elseif ($module_name == 'productoListaBlanca' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_producto_lista_blanca; ?> productos en la lista blanca </strong><br /><br />
                <?php elseif ($module_name == 'empresaListaBlanca' && $action_name == 'show'): ?>
                    <strong>Hay <?php echo $num_empresa_lista_blanca_audit; ?><?php echo ($num_empresa_lista_blanca_audit == 1) ? " auditoría" : " auditorías" ?> para esta empresa/entidad</strong><br />
                <?php elseif ($module_name == 'productoListaBlanca' && $action_name == 'show'): ?>
                    <strong>Hay <?php echo $num_producto_lista_blanca_audit; ?><?php echo ($num_producto_lista_blanca_audit == 1) ? " auditoría" : " auditorías" ?> para este producto</strong><br />
                <?php elseif ($module_name == 'empresa' && $action_name == 'show' && $empresa_check == 'lb'): ?>
                    <strong>Hay <?php echo $num_empresa_audit; ?><?php echo ($num_empresa_audit == 1) ? " auditoría" : " auditorías" ?> para esta empresa/entidad</strong><br />
                <?php elseif ($module_name == 'empresa' && $action_name == 'show' && $empresa_check == 'ln'): ?>
                    <strong>Hay <?php echo $num_empresa_negra_comment; ?><?php echo ($num_empresa_negra_comment == 1) ? " comentario" : " comentarios" ?> para esta empresa/entidad</strong><br />
                <?php elseif ($module_name == 'producto' && $action_name == 'show' && $producto_check == 'lb'): ?>
                    <strong>Hay <?php echo $num_producto_audit; ?><?php echo ($num_producto_audit == 1) ? " auditoría" : " auditorías" ?> para este producto</strong><br />
                <?php elseif ($module_name == 'producto' && $action_name == 'show' && $producto_check == 'ln'): ?>
                    <strong>Hay <?php echo $num_producto_negra_comment; ?><?php echo ($num_producto_negra_comment == 1) ? " comentario" : " comentarios" ?> para este producto</strong><br />
                <?php elseif ($module_name == 'listaNegraProducto' && $action_name == 'show'): ?>
                    <strong>Hay <?php echo $num_producto_comment; ?><?php echo ($num_producto_comment == 1) ? " comentario" : " comentarios" ?> para este producto</strong><br />
                <?php elseif ($module_name == 'listaNegraEmpresa' && $action_name == 'show'): ?>
                    <strong>Hay <?php echo $num_empresa_comment; ?><?php echo ($num_empresa_comment == 1) ? " comentario" : " comentarios" ?> para esta empresa/entidad</strong><br />
                <?php elseif ($module_name == 'auditanos' && $action_name == 'index'): ?>
                    <strong>Nos han auditado <?php echo $num_auditanos_audit; ?><?php echo ($num_auditanos_audit == 1) ? " vez" : " veces" ?></strong><br />
                <?php elseif ($module_name == 'planes_de_accion' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_planes_accion; ?><?php echo ($num_planes_accion == 1) ? " Plane" : " Planes" ?> de acción</strong><br />
                <?php elseif ($module_name == 'planes_de_accion_empresa' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_planes_accion_empresa_count; ?><?php echo ($num_planes_accion_empresa_count == 1) ? " Plane" : " Planes" ?>  de acción de Empresa/Entidad</strong><br />
                <?php elseif ($module_name == 'planes_de_accion_producto' && $action_name == 'index'): ?>
                    <strong>Hay <?php echo $num_planes_accion_producto_count; ?><?php echo ($num_planes_accion_producto_count == 1) ? " Plane" : " Planes" ?>  de acción de Producto</strong><br />
                <?php elseif ($module_name == 'escritorio'): ?>
                    <strong>Hay <?php echo $num_concursos_abiertos ?> concursos abiertos</strong><br /><br />
                <?php elseif ($module_name == 'concurso'): ?>
                    <?php $active_filters = sfContext::getInstance()->getUser()->getAttribute('concurso.filters', '', 'admin_module'); ?>

                    <?php if (isset($active_filters['concurso_tipo_id']) && $active_filters['concurso_tipo_id'] == 1): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos de Empresa/Entidad|[1]Hay 1 concurso de Empresa/Entidad|(1,+Inf]Hay %count% concursos de Empresa/Entidad', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_tipo_id']) && $active_filters['concurso_tipo_id'] == 2): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos de Producto|[1]Hay 1 concurso de Producto|(1,+Inf]Hay %count% concursos de Producto', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 2): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos activos|[1]Hay 1 concurso activo|(1,+Inf]Hay %count% concursos activos', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 3): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos en referéndum|[1]Hay 1 concurso en referéndum|(1,+Inf]Hay %count% concursos en Referéndum', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 4): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos en Deliberación|[1]Hay 1 concurso en Deliberación|(1,+Inf]Hay %count% concursos en Deliberación', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 5): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos en Observación|[1]Hay 1 concurso en Observación|(1,+Inf]Hay %count% concursos en Observación', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 7): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos rechazados|[1]Hay 1 concurso rechazado|(1,+Inf]Hay %count% concursos rechazados', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 6): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos cerrados|[1]Hay 1 concurso cerrado|(1,+Inf]Hay %count% concursos cerrados', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 8): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos nulos|[1]Hay 1 concurso nulo|(1,+Inf]Hay %count% concursos nulos', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 10): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos en Revisión|[1]Hay 1 concurso en Revisión|(1,+Inf]Hay %count% concursos en Revisión', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 9): ?><strong><?php echo format_number_choice('[0]Hay 0 concursos en Borrador|[1]Hay 1 concurso en Borrador|(1,+Inf]Hay %count% concursos en Borrador', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br />
                    <?php else: ?><strong><?php echo format_number_choice('[0]Hay 0 concursos|[1]Hay 1 concurso|(1,+Inf]Hay %count% concursos', array('%count%' => $num_concursos), $num_concursos) ?></strong><br /><br /><?php endif ?>
                <?php elseif ($module_name == 'concursos_pendientes'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 concursos pendientes|[1]Hay 1 concurso pendiente|(1,+Inf]Hay %count% concursos pendientes', array('%count%' => $num_concursos_pendientes), $num_concursos_pendientes) ?></strong><br /><br />
                <?php elseif ($module_name == 'cartas_pendientes'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 cartas pendientes|[1]Hay 1 carta pendiente|(1,+Inf]Hay %count% cartas pendientes', array('%count%' => $num_cartas_pendientes), $num_cartas_pendientes) ?></strong><br /><br />
                <?php elseif ($module_name == 'profesionales_pendientes'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 profesionales pendientes|[1]Hay 1 profesional pendiente|(1,+Inf]Hay %count% profesionales pendientes', array('%count%' => $num_profesional_pendientes), $num_profesional_pendientes) ?></strong><br /><br />
                <?php elseif ($module_name == 'cartas_recomendacion'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 cartas de recomendación|[1]Hay 1 carta de recomendación|(1,+Inf]Hay %count% cartas de recomendación', array('%count%' => $num_profesional_recomendacion), $num_profesional_recomendacion) ?></strong><br /><br />
                <?php elseif ($module_name == 'cartas_recomendacion'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 cartas de recomendación|[1]Hay 1 carta de recomendación|(1,+Inf]Hay %count% cartas de recomendación', array('%count%' => $num_profesional_recomendacion), $num_profesional_recomendacion) ?></strong><br /><br />
                <?php elseif ($module_name == 'cartas_desaprobacion'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 cartas de desaprobación|[1]Hay 1 carta de desaprobación|(1,+Inf]Hay %count% cartas de desaprobación', array('%count%' => $num_profesional_desaprobacion), $num_profesional_desaprobacion) ?></strong><br /><br />
                <?php elseif ($module_name == 'profesionalLista'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 profesionales|[1]Hay 1 profesionales|(1,+Inf]Hay %count% profesionales', array('%count%' => $num_profesional), $num_profesional) ?></strong><br /><br />
                <?php elseif ($module_name == 'profesionales_alertas'): ?>
                    <strong><?php //echo format_number_choice('[0]Hay 0 profesionale alertas|[1]Hay 1 profesionale alertas|(1,+Inf]Hay %count% profesionale alertas', array('%count%'  => $num_profesional_alertas), $num_profesional_alertas)                                        ?></strong><br /><br />
                <?php elseif ($module_name == 'contribuciones_pendientes'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 contribuciones pendientes|[1]Hay 1 contribución pendiente|(1,+Inf]Hay %count% contribuciones pendientes', array('%count%' => $num_contribuciones_pendientes), $num_contribuciones_pendientes) ?></strong><br /><br />
                <?php elseif ($module_name == 'contribucion'): ?>
                    <?php if ($filter_estado_active): ?>
                        <?php if ($estado_filtered == 1): ?>
                            <strong> <?php echo format_number_choice('[0]Hay 0 contribuciones en Revista|[1]Hay 1 contribución en Revista|(1,+Inf]Hay %count% contribuciones en Revista', array('%count%' => $num_contribuciones_estado), $num_contribuciones_estado) ?></strong><br /><br />
                        <?php elseif ($estado_filtered == 2): ?>
                            <strong><?php echo format_number_choice('[0]Hay 0 contribuciones activas|[1]Hay 1 contribución activas|(1,+Inf]Hay %count% contribuciones activas', array('%count%' => $num_contribuciones_estado), $num_contribuciones_estado) ?></strong><br /><br />
                        <?php elseif ($estado_filtered == 3): ?>
                            <strong><?php echo format_number_choice('[0]Hay 0 contribuciones en borrador|[1]Hay 1 contribución en borrador|(1,+Inf]Hay %count% contribuciones en borrador', array('%count%' => $num_contribuciones_estado), $num_contribuciones_estado) ?></strong><br /><br />
                        <?php endif ?>
                    <?php else: ?>
                        <strong><?php echo format_number_choice('[0]Hay 0 contribuciones|[1]Hay 1 contribución|(1,+Inf]Hay %count% contribuciones', array('%count%' => $num_contribuciones), $num_contribuciones) ?></strong><br /><br />
                    <?php endif ?>
                    <?php //elseif ($module_name == 'planes_de_accion_empresa'): ?>
                <!--<strong><?php //echo format_number_choice('[0]Hay 0 Planes de acción de empresa/entidad|[1]Hay 1 Plan de acción de empresa/entidad|(1,+Inf]Hay %count% Planes de acción de empresa/entidad', array('%count%' => $num_planes_accion_empresa), $num_planes_accion_empresa)                                              ?></strong><br /><br />-->
                    <?php //elseif ($module_name == 'planes_de_accion_producto'):  ?>
                <!--<strong><?php //echo format_number_choice('[0]Hay 0 Planes de acción de producto|[1]Hay 1 Plan de acción de producto|(1,+Inf]Hay %count% Planes de acción de producto', array('%count%' => $num_planes_accion_producto), $num_planes_accion_producto)                                               ?></strong><br /><br />-->
                <?php elseif ($module_name == 'sfguarduser'): ?>
                    <strong><?php echo format_number_choice('[0]Hay 0 colaboradores activos|[1]Hay 1 colaborador activo|(1,+Inf]Hay %count% colaboradores activos', array('%count%' => $num_colaboradores_activos), $num_colaboradores_activos) ?></strong><br /><br />
                <?php endif ?>                
                <div id="info_colaboradores_cabecera">                    
                    <strong><?php echo format_number_choice('[0]Ayer se conectaron 0 colaboradores|[1]Ayer se conectó 1 colaborador|(1,+Inf]Ayer se conectaron %count% colaboradores', array('%count%' => $num_colaboradores_ayer), $num_colaboradores_ayer) ?></strong><br /><br />
                    <strong><?php echo format_number_choice('[0]Hay 0 colaboradores conectados|[1]Hay 1 colaborador conectado|(1,+Inf]Hay %count% colaboradores conectados', array('%count%' => $num_colaboradores_ahora), $num_colaboradores_ahora) ?></strong>
                </div>
            </div>

        <?php endif; ?>
    <?php endif; ?>


<?php endif; // BC check if            ?>


<script type="text/javascript">

var ClockUsingSetInterval, newYorkTime;

// Constructor function for a clock.
// initialDateTime is the time when the clock starts.
// displayCallback is a function that will be called to update the time display.
function ClockUsingSetInterval(initialDateTime, displayCallback) {
    var currentServerTime;
    currentServerTime = initialDateTime;
    displayCallback(currentServerTime);
    setInterval(tick, 1000);

    // Increment the time by 1000 milliseconds and invoke the display callback.
    function tick() {
        // Get the number of milliseconds since epoch, add 1000,
        // and create a new date object.
        currentServerTime = new Date(currentServerTime.getTime() + 1000);
        displayCallback(currentServerTime);
    }
}

// Function to display time
function displayTimeFunction(date) {
    var hours, minutes, seconds, textbox, text;
    hours = formatTwoDigitString(date.getHours());
    minutes = formatTwoDigitString(date.getMinutes());
    seconds = formatTwoDigitString(date.getSeconds());
    textbox = document.getElementById('current-time');
    text = hours + ':' + minutes + ':' + seconds;
    textbox.innerHTML = text;

    function formatTwoDigitString(n) {
        return (n < 10) ? ('0' + n) : (n.toString());
    }
}

newYorkTime = new Date();


new ClockUsingSetInterval(newYorkTime, displayTimeFunction);
</script>