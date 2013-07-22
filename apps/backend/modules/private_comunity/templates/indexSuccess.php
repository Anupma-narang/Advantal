<ul>
	<?php foreach ($users_empresa as $user):?>
		<li><?php echo link_to($user->Empresa->name,"private_comunity/show?id=".$user->id)?> | <?php echo link_to("crear concurso privado","concurso_cp/new?user_id=".$user->id)?></li>	
	<?php endforeach;?>
</ul>
