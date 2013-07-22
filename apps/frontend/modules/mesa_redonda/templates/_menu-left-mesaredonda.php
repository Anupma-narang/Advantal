<!--    <div id="menu_side">-->
      <div id="mesaredonda_side">
        <div id="mesaredonda_botones">
          <div id="crear_mesaredonda">
              <?php echo link_to("Crea mesa redonda","mesa_redonda/new")?>
          </div>
          <div id="referendum_mesaredonda">
          <?php echo link_to("Referéndums activos", "mesa_redonda/index?estado=3") ?>
          </div>
          <div id="historico_mesaredonda">
                        <?php echo link_to("Histórico de M redondas", "mesa_redonda/index?estado=6") ?>
          </div>
        </div>
      </div>

    <!--</div>  fin menu-side -->  