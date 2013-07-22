<div id="concurso_side">
    <div id="concurso_botones">
        <div id="crear_concurso">
            <?php echo link_to("Crea concurso", "comunidadprivada/new") ?>
        </div>
        <div id="referendum">
            <?php echo link_to("Referéndums activos", "comunidadprivada/index?estado=3") ?>
        </div>
        <div id="historico_concurso">
            <?php echo link_to("Histórico de concursos", "comunidadprivada/index?estado=6") ?>        
        </div>
    </div>
</div>
<!--      <div id="concurso_destacados">
        <div align="center"><span class="concurso_destacado">Concursos Destacados</span></div>
        </p>
<?php //echo image_tag("img/linea_concursos_destacados.png")?>
        <p>&nbsp;</p>
      </div>
      <div id="concurso_semana">Concurso de la semana</div>
      <div id="concurso_mes">Concurso del mes</div>
      <div id="concurso_year">Concurso del año</div>-->
