<div id="content_breadcroum">
    <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?>
    >> <?php echo link_to("Vosotros ", "/vosotros", array('title' => 'Vosotros')) ?>
    >> <?php echo link_to("Casos de éxito ", "/vosotros/userCompanyCaseStudy", array('title' => 'Casos de éxito')) ?>

    <?php if (isset($request_type) && $request_type == 'company'): ?>
        <strong> >> Empresa/Entidad >> Otros casos de éxito >> Formulario</strong>
    <?php elseif (isset($request_type) && $request_type == 'product'): ?>
        <strong> >> Producto >> Otros casos de éxito >> Formulario</strong>
    <?php else: ?>
        >> <?php echo link_to($nombreSeccion, "vosotros/" . sfContext::getInstance()->getActionName(), array('title' => $tituloSeccion)) ?>
        <?php if (isset($type)): ?>
            >> <?php echo '<span style="font-weight:bold;">' . $type . '<span>'; ?>
        <?php endif; ?>
        <?php if (isset($tipo)): ?>
            >> <?php echo '<span style="font-weight:bold;">' . $tipo . '<span>'; ?>
        <?php endif; ?>

        <!-- Casos de éxito -->
        <?php if (isset($section)): ?>
            <?php if (isset($casetype)): ?>
                >> <?php echo '<span style="font-weight:bold;">' . $casetype . '<span>'; ?>
            <?php endif; ?>
            <?php if (isset($section)): ?>
                >> <?php echo '<span style="font-weight:bold;">' . $section . '<span>'; ?>
            <?php endif; ?>
        <?php endif; ?>
        <!-- End Casos de éxito -->
    <?php endif; ?>
</div>
