<?php if ($parent_menu_type == 'user_case_study'): ?>
    <!-- <a class="float-right" href="/vosotros/userCompanyCaseStudyRequest">cuéntanos tu caso de éxito</a> -->
<?php endif; ?>
<?php foreach ($pager as $index => $company_record): ?>
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" >
                <div style="float: left; width: 100%">
                    <?php if ($company_record->getLogo() && file_exists("images/uploads/documents/" . $company_record->getLogo())): ?>
                        <div class="width100" style="padding-bottom: 5px;">
                            <img width="62" height="62" src="/images/uploads/documents/<?php echo $company_record->getLogo() ?>">
                        </div>
                    <?php endif; ?>
                    <div style="float: left; width: 75%; margin-top: -3px;">
                        <?php if ($is_user_submitted): ?>
                            <?php if ($is_authenticated): ?>
                                <p class="rojo_marron" style="margin-top: 0"><strong><?php echo __('Creado por ') . ($company_record->getUserName() == $sf_user->getUsername() ? 'ti' : $company_record->getUserName()); ?></strong></p>
                            <?php else: ?>
                                <p class="rojo_marron" style="margin-top: 0"><strong><?php echo __('Creado por ') . $company_record->getUserName(); ?></strong></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="azul">
                            <b><?php echo $company_record->getName(); ?></b>
                        </p>
                        <p class="gris">
                            <?php
                            $addr = $company_record->getRoadType();
                            if ($company_record->getDireccion())
                                $addr .= ' ' . $company_record->getDireccion();
                            if ($company_record->getNumero())
                                $addr .= ', ' . $company_record->getNumero();
                            if ($company_record->getPiso())
                                $addr .= ', Piso: ' . $company_record->getPiso();
                            if ($company_record->getPuerta())
                                $addr .= ', Puerta: ' . $company_record->getPuerta();

                            echo (strlen($addr) > 135) ? substr($addr, 0, 135) . "..." : $addr;
                            ?>
                        </p>
                        <p class="verde">
                            <b><?php echo $company_record->getCMunicipioProvincia(); ?></b>
                        </p>
                        <p class="naranja">
                            <b><?php echo $company_record->getSector(); ?></b>
                        </p>
                    </div>
                    <div style="float: right; width: 25%">
                        <div style="margin-left: 53px; position: absolute;">
                            <?php $sector_image = $company_record->getEmpresaSectorUno()->getImage() ? $company_record->getEmpresaSectorUno()->getImage() : $company_record->getEmpresaSectorDos()->getImage(); ?>
                            <?php if (!$company_record->getLogo() && !file_exists("images/uploads/documents/" . $company_record->getLogo())): ?>
                                <div style="height: <?php echo ($company_record->getLogo() && file_exists("images/uploads/documents/" . $company_record->getLogo())) ? '68px' : '4px'; ?>">&nbsp;</div>
                            <?php endif; ?>
                            <?php if ($sector_image && file_exists("images/uploads/thumbnails/" . $sector_image)): ?>
                                <img width="62" height="62" src="/images/uploads/thumbnails/<?php echo $sector_image ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div style="float:left; font-size: 13px; width: 100%;">
                    <strong><?php echo __('Resumen del caso de éxito'); ?></strong>
                </div>
                <div class="pers70 sum-box" style="font-size: 13px;">
                    <br />
                    <?php echo html_entity_decode($company_record->getSummary()); ?>
                </div>
                <div style="float:right; width:123px; margin-top: -30px;">
                    <?php $type = ($category_type == "CompanyCaseStudy") ? "companycase" : "usercompanycase"; ?>
                    <?php echo link_to('ver caso de éxito', 'vosotros/showCompanyCaseStudyDetail?id=' . $company_record->getId() . '&type=' . $type, array("class" => "btn-ver-caso", "popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
<?php endforeach; ?>
<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '/vosotros/' . lcfirst($category_type), 'params' => array())) ?>
<?php endif; ?>
<style type="text/css">
    p.azul, p.gris, p.verde, p.naranja{
        word-wrap: break-word;
        width: 360px;
    }
    .pers70{
        width: 75%;
    }
    .pers70 ol{
        margin-left: -17px;
    }
    .pers70 ul{
        margin-left: -6px;
    }
    p.rojo_marron, p.azul{
        text-align: left;
        overflow: hidden;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 360px;
    }
    p.azul, p.gris, p.naranja{
        text-align: left;
        overflow: hidden;
        text-align: left;
        text-overflow: ellipsis;
        white-space: normal;
        width: 360px;
    }
    p.verde{
        text-align: left;
    }
    div.pers70 ul li {
        list-style-type: disc;
    }

    .pagination ul li{
        float: left;
    }
    .pagination ul li a{
        text-decoration: none;
    }
    .pagination ul li.active a, .pagination ul li.pagina a{
        border-right: 1px solid #4D5357;
        padding: 0 2px;
    }
    .pagination ul li.active a{
        color: #F65E13;
    }

    .top-right{
        font-size: 12px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("div.pagination ul li:last").css("padding-left", "2px");
    });
</script>