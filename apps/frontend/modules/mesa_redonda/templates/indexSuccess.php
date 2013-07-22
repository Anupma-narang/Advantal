<?php if ($estado == 2): ?>
<div id="titulo_mr_activa">Mesas redondas activas </div>
<?php elseif ($estado == 3): ?>
<div id="titulo_mr_activa">Referendums activos </div>

<?php elseif ($estado == 6): ?>
<div id="titulo_mr_activa">Histórico de M redondas </div>
<?php endif; ?>
<div id="conten_mr_activas">
            <?php foreach($mesasredondas as $mesaredonda):?>
            <?php include_partial("mesa_redonda/mr", array("mesa_redonda"=>$mesaredonda)) ?>
            <?php endforeach;?> 

</div>