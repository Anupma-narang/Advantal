<?php if (isset($type)): ?>
    <h3><?php echo $type ?></h3>
<?php endif; ?>
<?php if ($sf_params->get('action') == 'index'): ?>
    <div>
        <div style="width:100%; padding-bottom: 8px;text-align:center;">
            <a id="hide_show_filters" href="#" style="bottom: 0;display:block;margin-top:-7px;right:0;text-align:center;top:0;width:100%;outline:none;">
                <strong>Esconder/Mostrar filtros</strong>
            </a>
        </div>
    </div>
<?php endif; ?>