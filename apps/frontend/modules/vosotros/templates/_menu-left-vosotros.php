<?php $action_name = sfContext::getInstance()->getActionName(); ?>
<?php if ($sf_user->isAuthenticated()): ?>
    <div id="menu_side">
        <ul class="vert-one">
            <li><?php echo link_to("Mi cuenta", "vosotros/micuenta", array("class" => sfContext::getInstance()->getActionName() == "micuenta" ? "active" : "", "title" => "Mi cuenta")) ?></li>
            <li><?php echo link_to("Mis borradores", "vosotros/borradores", array("class" => sfContext::getInstance()->getActionName() == "borradores" ? "active" : "", "title" => "Mis borradores")) ?></li>
            <li><?php echo link_to("Mis concursos", "vosotros/misconcursos", array("class" => sfContext::getInstance()->getActionName() == "misconcursos" ? "active" : "", "title" => "Concursos creados por mí")) ?></li>
            <li><?php echo link_to("Mis contribuciones", "vosotros/miscontribuciones", array("class" => sfContext::getInstance()->getActionName() == "miscontribuciones" ? "active" : "", "title" => "Contribuciones creadas por mí")) ?></li>
            <li><?php echo link_to("Mis Profesionales", "vosotros/misProfessionals", array("class" => sfContext::getInstance()->getActionName() == "misProfessionals" ? "active" : "", "title" => "Profesionales recomendadados por mí")) ?></li>
            <li><?php echo link_to("Mis cartas", "vosotros/miscartas", array("class" => sfContext::getInstance()->getActionName() == "miscartas" ? "active" : "", "title" => "Cartas de recomendación y desaprobación creadas por mí")) ?></li>
            <li><?php echo link_to("Mis Referéndums", url_for('concurso-referendum'), array("class" => sfContext::getInstance()->getActionName() == "misreferendums" ? "active" : "", "title" => "Referéndums de concursos en los que he contribuido")) ?></li>
            <li><?php echo link_to("Mis auditorías", "vosotros/misauditorias", array("class" => sfContext::getInstance()->getActionName() == "misauditorias" ? "active" : "", "title" => "Auditorías realizadas por mí en la lista blanca")) ?></li>
            <li><?php echo link_to("Mis comentarios", "vosotros/misComentarios", array("class" => sfContext::getInstance()->getActionName() == "misComentarios" ? "active" : "", "title" => "Comentarios realizados por mí en la lista negra")) ?></li>
            <li><?php echo link_to("Mis favoritos", "vosotros/misfavoritos", array("class" => sfContext::getInstance()->getActionName() == "misfavoritos" ? "active" : "", "title" => "Favoritos")) ?></li>
            <li><?php echo link_to("Mis recompensas", "vosotros/misrecompensas", array("class" => ($action_name == "misrecompensas" || $action_name == "misrecompensasGift") ? "active" : "", "title" => "Recompensas ganadas por mí")) ?></li>
            <li><?php echo link_to("Ranking de colaboradores", "vosotros/hierarchyRanking", array("class" => sfContext::getInstance()->getActionName() == "hierarchyRanking" ? "active" : "" . ' gray_box', "title" => "Ranking de colaboradores de la comunidad")) ?></li>
            <li><?php echo link_to("Ranking de recompensas", "vosotros/rewardRanking", array("class" => sfContext::getInstance()->getActionName() == "rewardRanking" ? "active" : "" . ' gray_box', "title" => "Ranking de recompensas de la comunidad")) ?></li>
            <li><?php echo link_to("Escaparate de regalos", "vosotros/giftList", array("class" => sfContext::getInstance()->getActionName() == "giftList" ? "active" : "", "title" => "Escaparate de regalos de la comunidad")) ?></li>
            <li><?php echo link_to("Casos de éxito", "vosotros/companyCaseStudy", array("class" => ($action_name == "companyCaseStudy" || $action_name == "userCompanyCaseStudy" || $action_name == "productCaseStudy" || $action_name == "userProductCaseStudy" || $action_name == "userCompanyCaseStudyRequest" || $action_name == "userProductCaseStudyRequest") ? "active" : "" . ' gray_box red_box', "title" => "Casos de éxito de la comunidad")) ?></li>
            <li><?php echo link_to("Recomiéndanos a un amigo", "vosotros/recomiendanos", array("class" => sfContext::getInstance()->getActionName() == "recomiendanos" ? "active" : "" . ' gray_box red_box', "title" => "Recomiéndanos a un amigo")) ?></li>


            <?php //echo image_tag("img/static/porque_existimos.jpg")?>      </ul>
    </div>
<?php else: ?>
    <div id="menu_side">
        <ul class="vert-one">
            <li><?php echo link_to("Ranking de colaboradores", "vosotros/hierarchyRanking", array("class" => sfContext::getInstance()->getActionName() == "hierarchyRanking" ? "active" : "" . ' gray_box', "title" => "Ranking de colaboradores de la comunidad")) ?></li>
            <li><?php echo link_to("Ranking de recompensas", "vosotros/rewardRanking", array("class" => sfContext::getInstance()->getActionName() == "rewardRanking" ? "active" : "" . ' gray_box', "title" => "Ranking de recompensas de la comunidad")) ?></li>
            <li><?php echo link_to("Escaparate de regalos", "vosotros/giftList", array("class" => sfContext::getInstance()->getActionName() == "giftList" ? "active" : "", "title" => "Escaparate de regalos de la comunidad")) ?></li>
            <li><?php echo link_to("Casos de éxito", "vosotros/companyCaseStudy", array("class" => ($action_name == "companyCaseStudy" || $action_name == "userCompanyCaseStudy" || $action_name == "productCaseStudy" || $action_name == "userProductCaseStudy") ? "active" : "" . ' gray_box red_box', "title" => "Casos de éxito de la comunidad")) ?></li>
            <li><?php echo link_to("Recomiéndanos a un amigo", "vosotros/recomiendanos", array("class" => sfContext::getInstance()->getActionName() == "recomiendanos" ? "active" : "" . ' gray_box red_box', "title" => "Recomiéndanos a un amigo")) ?></li>

            <?php //echo image_tag("img/static/porque_existimos.jpg")?>      </ul>
    </div>
<?php endif; ?>
