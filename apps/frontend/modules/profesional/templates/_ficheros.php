<?php if (count($ficheros)>0): ?>
<div id="files">
<ul><?php
    $url_prefix = '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/';
    $extensiones_privadas = sfConfig::get('app_ficheros_privados', array());
    $count = 1;
    foreach($ficheros as $fichero)
    {
        $extension = pathinfo($fichero->getFile(), PATHINFO_EXTENSION);
        $fichero_privado = TRUE === in_array($extension, $extensiones_privadas);
        if (!$fichero_privado or ($fichero_privado and $sf_user->isAuthenticated() and $user_id==$sf_user->getGuardUser()->getId()))
        {
            printf ('<li><a target="_blank" href="%s">Archivo%d.%s</a></li>', url_for($url_prefix . $fichero->getFile()), $count, $extension);
            $count = $count + 1;
        }
    }
?></ul>
</div>
<?php endif; ?>