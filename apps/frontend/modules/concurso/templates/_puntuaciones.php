<?php use_helper('Concursos') ?>
<?php $results = $concurso->getReferendumResult(); ?>
<?php if(count($results)): ?>
    <div id="tabla_puntuaciones">
        <div id="content_concursos_arriba2">Resultados del Referéndum</div>
        <div style="clear:both"></div>
        <div class="border-box"><div class="top-left"><div class="top-right">
            <p>Han votado <?php print $concurso->getNumeroVotantes() ?> colaboradores.<br/>
            Son el <?php printf ('%d%%', $concurso->ratioParticipacion()) ?> de los colaboradores con derecho a voto para este concurso.</p>

            <table class="results">
                <thead><tr><th>Puesto</th><th>Colaborador</th><th>Contribución</th><th>Puntos</th><th>Colaboradores que le han votado</th></tr></thead>
                <tbody>
                <?php
                    $count = 1;
                    foreach ($results as $r)
                    {
                        printf('<tr><td class="num">%s</td><td>%s</td><td><a href="%s">%s</a></td><td class="num">%s</td><td class="num">%s</td></tr>',
                            $count, $r['username'], '#contribucion'.$r['contribucion_id'], $r['contribucion_name'], $r['puntos'], $r['votos']);
                        $count = $count + 1;
                    }
                ?>
                </tbody>
            </table>

            <?php if ($sf_user->isAuthenticated()): ?>
                <?php $tus_votos = $concurso->getVotosReferendum($sf_user->getGuardUser()->getId()); ?>
                <?php if(count($tus_votos)): ?>
                    <h2>Tú has votado a:</h2>
                    <table class="results">
                        <thead><tr><th>Contribución</th><th>Colaborador</th><th>Puntos</th></tr></thead><tbody>
                        <?php
                            foreach ($tus_votos as $v)
                            {
                                printf('<tr><td><a href="%s">%s</a></td><td>%s</td><td class="num">%s</td></tr>',
                                    '#contribucion'.$v['contribucion_id'], $v['name'], $v['username'], $v['puntos']
                                    //$v['name'], $v['username'], $v['puntos']
                                );
                            }
                        ?>
                        </tbody></table>
                <?php endif; ?>
            <?php endif; ?>

        </div></div><div class="bottom-left"><div class="bottom-right"></div></div></div>
    </div>
<?php endif; ?>