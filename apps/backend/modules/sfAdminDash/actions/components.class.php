<?php

require_once(dirname(__FILE__) . '/../lib/BasesfAdminDashComponents.class.php');

/**
 * sfAdminDash components.
 *
 * @package    plugins
 * @subpackage sfAdminDash
 * @author     kevin
 * @version    SVN: $Id: components.class.php 25203 2009-12-10 16:50:26Z Crafty_Shadow $
 */
class sfAdminDashComponents extends BasesfAdminDashComponents {

    /**
     * The main navigation component for the sfAdminDash plugin
     */
    public function executeHeader() {
        
        $this->num_colaboradores = Doctrine::getTable('sfGuardUser')
                ->createQuery('s')
                ->where('s.is_active=?', 1)
                ->count();        
        
        $this->num_colaboradores_ayer = Doctrine::getTable('UsersOnlineYesterday')
                ->createQuery('s')
                ->where('s.logged_in=?', date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))))
                ->groupBy('s.user_id')
                ->count();

        $this->num_colaboradores_ahora = Doctrine::getTable('sfGuardUserProfile')
                ->createQuery('s')
                ->where('s.is_online= true')
                ->count();
        


        $module_name = sfContext::getInstance()->getModuleName();
        $action_name = sfContext::getInstance()->getActionName();

        if ($module_name == 'escritorio') {
            $this->num_concursos_abiertos = Doctrine::getTable('concurso')
                    ->createQuery('c')
                    ->whereIn('c.concurso_estado_id', array(2, 3, 4, 5, 10))
                    ->count();
        } elseif ($module_name == 'contactanos') {
            $this->contact_us = count(Doctrine::getTable('Contactanos')->findAll());
        } elseif ($module_name == 'recomended_registration') {
            $this->recomended_count = count(Doctrine::getTable('RecomendedRegistration')->findAll());
        } elseif ($module_name == 'gift') {
            $this->gift_count = count(Doctrine::getTable('Gift')->findAll());
        } elseif ($module_name == 'pizarra') {
            $this->blackboard_count = count(Doctrine::getTable('Pizarra')->findAll());
        } elseif ($module_name == 'gift_redemption') {
            $this->gift_redemption_count = count(Doctrine::getTable('GiftRedemption')->findAll());
        } elseif ($module_name == 'concurso') {
            $sql_concursos = Doctrine::getTable('concurso')->createQuery('c');

            $active_filters = $this->getUser()->getAttribute('concurso.filters', '', 'admin_module');
            if (isset($active_filters['concurso_tipo_id']) && $active_filters['concurso_tipo_id'] == 1)
                $sql_concursos->addWhere('concurso_tipo_id=?', 1);
            elseif (isset($active_filters['concurso_tipo_id']) && $active_filters['concurso_tipo_id'] == 2)
                $sql_concursos->addWhere('concurso_tipo_id=?', 2);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 2)
                $sql_concursos->addWhere('concurso_estado_id=?', 2);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 3)
                $sql_concursos->addWhere('concurso_estado_id=?', 3);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 4)
                $sql_concursos->addWhere('concurso_estado_id=?', 4);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 5)
                $sql_concursos->addWhere('concurso_estado_id=?', 5);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 7)
                $sql_concursos->addWhere('concurso_estado_id=?', 7);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 6)
                $sql_concursos->addWhere('concurso_estado_id=?', 6);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 8)
                $sql_concursos->addWhere('concurso_estado_id=?', 8);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 10)
                $sql_concursos->addWhere('concurso_estado_id=?', 10);
            elseif (isset($active_filters['concurso_estado_id']) && $active_filters['concurso_estado_id'] == 9)
                $sql_concursos->addWhere('concurso_estado_id=?', 9);

            $this->num_concursos = $sql_concursos->count();
        } elseif ($module_name == 'concursos_pendientes') {
            $this->num_concursos_pendientes = Doctrine::getTable('concurso')
                    ->createQuery('c')
                    ->where('c.concurso_estado_id=?', 1)
                    ->count();
        } elseif ($module_name == 'profesionales_pendientes') {
            $this->num_profesional_pendientes = Doctrine::getTable('profesional')
                    ->createQuery('c')
                    ->where('c.profesional_estado_id=?', 1)
                    ->count();
        } elseif ($module_name == 'cartas_pendientes') {
            $this->num_cartas_pendientes = Doctrine::getTable('profesionalletter')
                    ->createQuery('c')
                    ->where('c.profesional_letter_estado_id=?', 1)
                    ->leftJoin('c.States s WITH s.name != "Borrador" AND s.name = "Activa"')
                    ->count();
        } elseif ($module_name == 'cartas_recomendacion') {
            $this->num_profesional_recomendacion = Doctrine::getTable('profesionalletter')
                    ->createQuery('c')
                    ->where('c.profesional_letter_estado_id=?', 2)
                    ->andWhere('c.profesional_letter_type_id=?', 1)
                    ->andWhere('c.is_first=?', 0)
                    ->leftJoin('c.States s WITH s.name != "Borrador" AND s.name = "Activa"')
                    ->count();
        } elseif ($module_name == 'cartas_desaprobacion') {
            $this->num_profesional_desaprobacion = Doctrine::getTable('profesionalletter')
                    ->createQuery('c')
                    ->where('c.profesional_letter_estado_id=?', 2)
                    ->andWhere('c.profesional_letter_type_id=?', 2)
                    ->count();
        } elseif ($module_name == 'profesionalLista') {
            $this->num_profesional = Doctrine::getTable('profesional')
                    ->createQuery('c')
                    ->where('c.profesional_estado_id IN (2,9)')
                    ->count();
        } elseif ($module_name == 'profesionales_alertas') {
            $this->num_profesional_alertas = Doctrine::getTable('alertas')
                    ->createQuery('p')
                    ->where('p.entity=?', 3)
                    ->count();
        } elseif ($module_name == 'contribuciones_pendientes') {
            $this->num_contribuciones_pendientes = Doctrine::getTable('contribucion')
                    ->createQuery('c')
                    ->where('principal=false')->andWhere('contribucion_estado_id=?', 1)
                    ->count();
        } elseif ($module_name == 'contribucion') {
            $active_filters = sfContext::getInstance()->getUser()->getAttribute('contribucion.filters', '', 'admin_module');
            if (isset($active_filters['contribucion_estado_id']) && $active_filters['contribucion_estado_id'] > 0) {  // filter 'estado' is active
                $this->filter_estado_active = true;
                $this->estado_filtered = $active_filters['contribucion_estado_id'];
                $this->num_contribuciones_estado = Doctrine::getTable('contribucion')
                        ->createQuery('c')
                        ->where('principal=false')->andWhere('contribucion_estado_id=?', $active_filters['contribucion_estado_id'])
                        ->count();
            } else {
                $this->filter_estado_active = false;
                $this->num_contribuciones = Doctrine::getTable('contribucion')
                        ->createQuery('c')
                        ->where('principal=false')
                        ->count();
            }
        } elseif ($module_name == 'planes_de_accion_empresa') {

            $this->num_planes_accion_empresa = Doctrine::getTable('contribucion')
                    ->createQuery('c')
                    ->leftJoin('c.Concurso con')
                    ->where('con.concurso_tipo_id=1')
                    ->count();

            $this->num_planes_accion_empresa_count = Doctrine::getTable('contribucion')
                    ->createQuery('c')
                    ->leftJoin('c.Concurso con')
                    ->where('con.concurso_tipo_id=1')
                    ->andWhere('c.contribucion_estado_id = 2')
                    //->andWhere('principal=false')
                    ->count();
        } elseif ($module_name == 'planes_de_accion_producto') {

            $this->num_planes_accion_producto = Doctrine::getTable('contribucion')
                    ->createQuery('c')
                    ->leftJoin('c.Concurso con')
                    ->where('con.concurso_tipo_id=2')
                    ->count();

            $this->num_planes_accion_producto_count = Doctrine::getTable('contribucion')
                    ->createQuery('c')
                    ->leftJoin('c.Concurso con')
                    ->where('con.concurso_tipo_id=2')
                    ->andWhere('c.contribucion_estado_id = 2')
                    //->andWhere('principal=false')
                    ->count();
        } elseif ($module_name == 'sfguarduser') {

            $this->num_colaboradores_activos = Doctrine::getTable('sfguarduser')
                    ->createQuery('c')
                    ->where('c.is_active=?', 1)
                    ->count();
        } elseif ($module_name == 'concursos_pendientes_empresa') {

            $this->num_concursos_pendientes_empresa = Doctrine::getTable('concurso')
                    ->createQuery('c')
                    ->addWhere('concurso_estado_id=?', 1)
                    ->addWhere('concurso_tipo_id=?', 1)
                    ->count();
        } elseif ($module_name == 'concursos_pendientes_product') {

            $this->num_concursos_pendientes_product = Doctrine::getTable('concurso')
                    ->createQuery('c')
                    ->addWhere('concurso_estado_id=?', 1)
                    ->addWhere('concurso_tipo_id=?', 2)
                    ->count();
        } elseif ($module_name == 'empresaListaBlanca') {

            $this->num_empresa_lista_blanca = Doctrine::getTable('empresa')
                    ->createQuery('c')
                    ->where('lista = ?', 'lb')
                    ->count();
            $this->num_empresa_lista_blanca_audit = Doctrine::getTable('ListaCuestionarioUser')->createQuery()
                    ->select('COUNT(DISTINCT user_id)')
                    ->where('empresa_id = ?', $this->getRequestParameter('id'))
                    ->andwhere('aprobado = ?', (bool) true)
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'company_case_study') {

            $this->num_company_case_study = Doctrine::getTable('CompanyCaseStudy')
                    ->createQuery('c')
                    ->count();
        } elseif ($module_name == 'product_case_study') {

            $this->num_product_case_study = Doctrine::getTable('ProductCaseStudy')
                    ->createQuery('c')
                    ->count();
        } elseif ($module_name == 'user_company_case_study') {

            $this->num_user_company_case_study = Doctrine::getTable('UserCompanyCaseStudy')
                    ->createQuery('c')
                    ->count();
        } elseif ($module_name == 'user_company_case_study_request') {

            $this->num_user_company_case_study_request = Doctrine::getTable('UserCompanyCaseStudyRequest')
                    ->createQuery('c')
                    ->count();
        } elseif ($module_name == 'user_product_case_study_request') {

            $this->num_user_product_case_study_request = Doctrine::getTable('UserProductCaseStudyRequest')
                    ->createQuery('c')
                    ->count();
        } elseif ($module_name == 'user_product_case_study') {

            $this->num_user_product_case_study = Doctrine::getTable('UserProductCaseStudy')
                    ->createQuery('c')
                    ->count();
        } elseif ($module_name == 'empresa') {

            $this->empresa_check = Doctrine::getTable('empresa')->createQuery()
                    ->select('lista')
                    ->where('id = ?', $this->getRequestParameter('id'))
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);

            $this->num_empresa_audit = Doctrine::getTable('ListaCuestionarioUser')->createQuery()
                    ->select('COUNT(DISTINCT user_id)')
                    ->where('empresa_id = ?', $this->getRequestParameter('id'))
                    ->andwhere('aprobado = ?', (bool) true)
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);

            $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
            $this->num_empresa_negra_comment = Doctrine_Query::create()
                    ->select('COUNT(DISTINCT id)')
                    ->from('ComentarioListaNegra cln')
                    ->andWhere('cln.empresa_id =?', $this->getRequestParameter('id'))
                    ->andWhere('cln.aprobado =?', (bool) true)
                    ->orderby('cln.created_at DESC')
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'productoListaBlanca') {

            $this->num_producto_lista_blanca = Doctrine::getTable('producto')
                    ->createQuery('c')
                    ->where('lista = ?', 'lb')
                    ->count();

            $this->num_producto_lista_blanca_audit = Doctrine::getTable('ListaCuestionarioUser')->createQuery()
                    ->select('COUNT(DISTINCT user_id)')
                    ->where('producto_id = ?', $this->getRequestParameter('id'))
                    ->andwhere('aprobado = ?', (bool) true)
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'producto') {

            $this->producto_check = Doctrine::getTable('producto')->createQuery()
                    ->select('lista')
                    ->where('id = ?', $this->getRequestParameter('id'))
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);

            $this->num_producto_audit = Doctrine::getTable('ListaCuestionarioUser')->createQuery()
                    ->select('COUNT(DISTINCT user_id)')
                    ->where('producto_id = ?', $this->getRequestParameter('id'))
                    ->andwhere('aprobado = ?', (bool) true)
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);

            $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
            $this->num_producto_negra_comment = Doctrine_Query::create()
                    ->select('COUNT(DISTINCT id)')
                    ->from('ComentarioListaNegra cln')
                    ->andWhere('cln.producto_id =?', $this->getRequestParameter('id'))
                    ->andWhere('cln.aprobado =?', (bool) true)
                    ->orderby('cln.created_at DESC')
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'listaNegraProducto') {

            $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
            $this->num_producto_comment = Doctrine_Query::create()
                    ->select('COUNT(DISTINCT id)')
                    ->from('ComentarioListaNegra cln')
                    ->andWhere('cln.producto_id =?', $this->getRequestParameter('id'))
                    ->andWhere('cln.aprobado =?', (bool) true)
                    ->orderby('cln.created_at DESC')
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'listaNegraEmpresa') {

            $user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
            $this->num_empresa_comment = Doctrine_Query::create()
                    ->select('COUNT(DISTINCT id)')
                    ->from('ComentarioListaNegra cln')
                    ->andWhere('cln.empresa_id =?', $this->getRequestParameter('id'))
                    ->andWhere('cln.aprobado =?', (bool) true)
                    ->orderby('cln.created_at DESC')
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'auditanos') {

            $this->num_auditanos_audit = Doctrine_Query::create()
                    ->select('COUNT(user_id)')
                    ->from('auditanos aut')
                    ->execute(null, DOCTRINE::HYDRATE_SINGLE_SCALAR);
        } elseif ($module_name == 'planes_de_accion') {

            $this->num_planes_accion = Doctrine::getTable('contribucion')
                    ->createQuery('c')
                    ->leftJoin('c.Concurso con')
                    ->where('con.concurso_estado_id != 1')
                    ->andWhere('c.contribucion_estado_id = 2')
                    ->count();
        } elseif ($module_name == 'planes_de_accion_empresa') {

        } elseif ($module_name == 'planes_de_accion_producto') {

        }


        parent::executeHeader();
    }

}
