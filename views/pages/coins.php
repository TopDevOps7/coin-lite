<div id="coins" class="container pt-2 pb-5">
  <div class="p-3" style="text-align: center; margin-bottom: 10px">
    <h1>Top 3 Currencies by Market Cap</h1>
  </div>
  <div id="top-coins" style="margin-bottom: 50px" class="row"></div>
  <div style="text-align: center; margin-bottom: 30px">
    <h1>Cryptocurrency Prices</h1>
  </div>
  <table id="coins-table" class="table is-hoverable" style="width: 100%">
    <thead>
      <tr>
        <th><?php echo esc_html( __( 'RANK' ) ); ?></th>
        <th><?php echo esc_html( __( 'NAME' ) ); ?></th>
        <th class="text-end"><?php echo esc_html( __( 'PRICE' ) ); ?></th>
        <th class="text-end"><?php echo esc_html( __( 'MARKET CAP' ) ); ?></th>
        <th class="text-end"><?php echo esc_html( __( '24H CHANGE' ) ); ?></th>
      </tr>
    </thead>
  </table>
  <div style="display: flex; justify-content: space-around; margin-top: 50px">
    <div style="font-weight: 600">
      <div style="color: #2899C1">TOTAL MARKET CAP</div>
      <div style="font-size: 20px" id="total_market_cap"></div>
    </div>
    <div style="font-weight: 600">
      <div style="color: #2899C1">24H TOTAL VOLUME</div>
      <div style="font-size: 20px" id="total_volume"></div>
    </div>
    <div style="font-weight: 600">
      <div style="color: #2899C1">NUMBER OF COINS</div>
      <div style="font-size: 20px" id="total_coins"></div>
    </div>
  </div>
</div>
