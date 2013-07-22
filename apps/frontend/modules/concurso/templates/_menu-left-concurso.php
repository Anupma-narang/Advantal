<?php use_helper('mihelper')?>

<div id="concurso_side">
    <div id="concurso_botones">
        <div id="crear_concurso">
            <?php echo link_to('Crea concurso',"concurso/new?tipo=".sfContext::getInstance()->getRequest()->getParameter('tipo','empresa'),array('title' => 'Crea un concurso de ideas para mejorar una empresa, entidad pública o producto','class'=>'login_required', 'message'=>'Para crear un concurso <strong>necesitas ser colaborador</strong>')); ?>
        </div>
        <div id="referendum">
        <?php if(sfContext::getInstance()->getRequest()->getParameter('list')=='referendum'):?>
            <?php echo link_to("Concursos abiertos", "concurso/index?tipo=".sfContext::getInstance()->getRequest()->getParameter('tipo','empresa')) ?>
        <?php else:?>
            <?php echo link_to("Referéndums activos", "concurso/index?tipo=".sfContext::getInstance()->getRequest()->getParameter('tipo','empresa')."&list=referendum", array('title' => 'Referéndums activos')) ?>
        <?php endif;?>
        </div>
        <div id="historico_concurso">
        <?php if(sfContext::getInstance()->getRequest()->getParameter('list')=='historico'):?>
            <?php echo link_to("Concursos abiertos", "concurso/index?tipo=".sfContext::getInstance()->getRequest()->getParameter('tipo','empresa')) ?>
        <?php else:?>
            <?php echo link_to("Histórico de concursos", "concurso/index?tipo=".sfContext::getInstance()->getRequest()->getParameter('tipo','empresa')."&list=historico", array('title' => 'Histórico de concursos')) ?>
        <?php endif;?>
        </div>
    </div>
</div>