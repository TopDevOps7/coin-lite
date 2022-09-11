<div id="coins" class="container pt-2 pb-5">
  <div class="p-3" style="text-align: center; margin-bottom: 20px">
    <h1>Top Currencies</h1>
  </div>
  <div id="top-coins" style="display: flex; justify-content: space-between; margin-bottom: 80px"></div>
  <div style="text-align: center; margin-bottom: 30px">
    <h1>Today's Cryptocurrency Prices</h1>
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
      <div style="font-size: 20px">$1,080.26 BILLION</div>
    </div>
    <div style="font-weight: 600">
      <div style="color: #2899C1">24H TOTAL VOLUME</div>
      <div style="font-size: 20px">$93.03 BILLION</div>
    </div>
    <div style="font-weight: 600">
      <div style="color: #2899C1">NUMBER OF COINS</div>
      <div style="font-size: 20px">1100</div>
    </div>
  </div>
  <div class="mt-5 mb-3 pt-2">
    <div
      style="background-image: linear-gradient(90deg, #1F3C95, #2BABCA); width: fit-content; margin: auto; color: #FFFFFF; font-weight: 600; padding: 10px 30px; cursor: pointer">
      MARKET OVERVIEW</div>
  </div>
</div>
