<?php 

	include('config/db_connect.php');

	// write query for all shipments
	$dest_sql = 'SELECT destination AS current_dest, (SELECT cntr WHERE destination = current_dest) AS current_cntr , (SELECT sum(m3) FROM shipments where destination = current_dest AND cntr = current_cntr AND instructions = "roi") AS vol_roi_cntr, (SELECT sum(m3) FROM shipments where destination = current_dest AND cntr = current_cntr AND instructions = "BKG") AS vol_bkg_cntr, Sum(pcs) AS pcs, Sum(kgs) AS kgs, Sum(m3) AS m3, (SELECT count(instructions) FROM shipments WHERE destination = current_dest AND instructions = "bkg") AS bkg, (SELECT sum(m3) FROM shipments WHERE destination = current_dest AND instructions = "bkg") AS vol_bkg, (SELECT count(instructions) FROM shipments WHERE destination = current_dest AND instructions = "roi") AS roi, (SELECT sum(m3) FROM shipments WHERE destination = current_dest AND instructions = "roi") AS vol_roi FROM shipments GROUP BY destination';
	// get the result set (set of rows)
	$dest_count = mysqli_query($conn, $dest_sql);
  $cntr_count = mysqli_query($conn, $dest_sql);
	// fetch the resulting rows as an array
	$dest_shipments = mysqli_fetch_all($dest_count, MYSQLI_ASSOC);
  $cntrs_shipments = mysqli_fetch_all($cntr_count, MYSQLI_ASSOC);
	// free the $result from memory (good practise)
	mysqli_free_result($dest_count);
  mysqli_free_result($cntr_count);
	// close connection
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
	<head>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
 	<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
	<script src="map/datamaps.world.min.js"></script>
	<style>
        .active { fill: blue !important;}
        /*.datamaps-key dt, .datamaps-key dd {float: none !important;}
        .datamaps-key {right: -50px; top: 0;}*/
    </style>	
    
    
	</head>
	
	
	<h4 class="center grey-text">Shipments</h4>
	<div style="width:100%;height:700px;text-align:center;">
		<div id="container1" style="position: relative; width: 900px; height: 500px;"></div>
	</div>
	<div class="container">
		<div class="row">
			
			<?php foreach($dest_shipments as $dest_shipment): ?>
				
    			<?php 
    			
    			
    			$minumum_volume_arica = 6;
    			$minumum_volume_asuncion = 7;
    			$minumum_volume_buenaventura = 13;
    			$minumum_volume_buenos_aires = 4;
    			$minumum_volume_callao = 15;
    			$minumum_volume_cartagena = 17;
    			$minumum_volume_costa_rica = 13;
    			$minumum_volume_guatemala = 21;
    			$minumum_volume_guayaquil = 5;
    			$minumum_volume_honduras = 10;
    			$minumum_volume_managua = 2;
    			$minumum_volume_montevideo = 8;
    			$minumum_volume_panama = 6;
    			$minumum_volume_rio = 7;
    			$minumum_volume_rio_haina = 6;
    			$minumum_volume_rosario = 6;
    			$minumum_volume_san_antonio = 12;
    			$minumum_volume_san_salvador = 0;
    			$minumum_volume_santos = 6;
    			$minumum_volume_valencia = 4;
    			$minumum_volume_venezuela = 7;
    			$minumum_volume_veracruz = 24;

    			$negative_profit_color = "#F28E13";
    			$positive_profit_color = "#5DC2E5";

    			?>
				<?php 
					if ($dest_shipment['current_dest'] == "Arica" AND $dest_shipment['m3'] > $minumum_volume_arica) 
     					{$profit_color = $positive_profit_color AND $profit_color_arica = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Arica" AND $dest_shipment['m3'] < $minumum_volume_arica)
     							{$profit_color = $negative_profit_color AND $profit_color_arica = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Asuncion" AND $dest_shipment['m3'] > $minumum_volume_asuncion) 
     					{$profit_color = $positive_profit_color AND $profit_color_asuncion = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Asuncion" AND $dest_shipment['m3'] < $minumum_volume_asuncion)
     							{$profit_color = $negative_profit_color AND $profit_color_asuncion = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Buenaventura" AND $dest_shipment['m3'] > $minumum_volume_buenaventura) 
     					{$profit_color = $positive_profit_color AND $profit_color_buenaventura = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Buenaventura" AND $dest_shipment['m3'] < $minumum_volume_buenaventura)
     							{$profit_color = $negative_profit_color AND $profit_color_buenaventura = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Buenos Aires" AND $dest_shipment['m3'] > $minumum_volume_buenos_aires) 
     					{$profit_color = $positive_profit_color AND $profit_color_buenos_aires = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Buenos Aires" AND $dest_shipment['m3'] < $minumum_volume_buenos_aires)
     							{$profit_color = $negative_profit_color AND $profit_color_buenos_aires = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Callao" AND $dest_shipment['m3'] > $minumum_volume_callao) 
     					{$profit_color = $positive_profit_color AND $profit_color_callao = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Callao" AND $dest_shipment['m3'] < $minumum_volume_callao)
     							{$profit_color = $negative_profit_color AND $profit_color_callao = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Cartagena" AND $dest_shipment['m3'] > $minumum_volume_cartagena) 
     					{$profit_color = $positive_profit_color AND $profit_color_cartagena = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Cartagena" AND $dest_shipment['m3'] < $minumum_volume_cartagena)
     							{$profit_color = $negative_profit_color AND $profit_color_cartagena = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Costa Rica" AND $dest_shipment['m3'] > $minumum_volume_costa_rica) 
     					{$profit_color = $positive_profit_color AND $profit_color_costa_rica = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Costa Rica" AND $dest_shipment['m3'] < $minumum_volume_costa_rica)
     							{$profit_color = $negative_profit_color AND $profit_color_costa_rica = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Guatemala" AND $dest_shipment['m3'] > $minumum_volume_guatemala) 
     					{$profit_color = $positive_profit_color AND $profit_color_guatemala = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Guatemala" AND $dest_shipment['m3'] < $minumum_volume_guatemala)
     							{$profit_color = $negative_profit_color AND $profit_color_guatemala = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Guayaquil" AND $dest_shipment['m3'] > $minumum_volume_guayaquil) 
     					{$profit_color = $positive_profit_color AND $profit_color_guayaquil = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Guayaquil" AND $dest_shipment['m3'] < $minumum_volume_guayaquil)
     							{$profit_color = $negative_profit_color AND $profit_color_guayaquil = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Honduras" AND $dest_shipment['m3'] > $minumum_volume_honduras) 
     					{$profit_color = $positive_profit_color AND $profit_color_honduras = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Honduras" AND $dest_shipment['m3'] < $minumum_volume_honduras)
     							{$profit_color = $negative_profit_color AND $profit_color_honduras = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Managua" AND $dest_shipment['m3'] > $minumum_volume_managua) 
     					{$profit_color = $positive_profit_color AND $profit_color_managua = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Managua" AND $dest_shipment['m3'] < $minumum_volume_managua)
     							{$profit_color = $negative_profit_color AND $profit_color_managua = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Montevideo" AND $dest_shipment['m3'] > $minumum_volume_montevideo) 
     					{$profit_color = $positive_profit_color AND $profit_color_montevideo = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Montevideo" AND $dest_shipment['m3'] < $minumum_volume_montevideo)
     							{$profit_color = $negative_profit_color AND $profit_color_montevideo = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Panama" AND $dest_shipment['m3'] > $minumum_volume_panama) 
     					{$profit_color = $positive_profit_color AND $profit_color_panama = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Panama" AND $dest_shipment['m3'] < $minumum_volume_panama)
     							{$profit_color = $negative_profit_color AND $profit_color_panama = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Rio" AND $dest_shipment['m3'] > $minumum_volume_rio) 
     					{$profit_color = $positive_profit_color AND $profit_color_rio = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Rio" AND $dest_shipment['m3'] < $minumum_volume_rio)
     							{$profit_color = $negative_profit_color AND $profit_color_rio = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Rio Haina" AND $dest_shipment['m3'] > $minumum_volume_rio_haina) 
     					{$profit_color = $positive_profit_color AND $profit_color_rio_haina = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Rio Haina" AND $dest_shipment['m3'] < $minumum_volume_rio_haina)
     							{$profit_color = $negative_profit_color AND $profit_color_rio_haina = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Rosario" AND $dest_shipment['m3'] > $minumum_volume_rosario) 
     					{$profit_color = $positive_profit_color AND $profit_color_rosario = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Rosario" AND $dest_shipment['m3'] < $minumum_volume_rosario)
     							{$profit_color = $negative_profit_color AND $profit_color_rosario = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "San Antonio" AND $dest_shipment['m3'] >= $minumum_volume_san_antonio) 
              {$profit_color = $positive_profit_color AND $profit_color_san_antonio = $positive_profit_color;} 
                else if ($dest_shipment['current_dest'] == "San Antonio" AND $dest_shipment['m3'] < $minumum_volume_san_antonio)
                  {$profit_color = $negative_profit_color AND $profit_color_san_antonio = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "San Salvador" AND $dest_shipment['m3'] >= $minumum_volume_san_salvador) 
     					{$profit_color = $positive_profit_color AND $profit_color_san_salvador = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "San Salvador" AND $dest_shipment['m3'] < $minumum_volume_san_salvador)
     							{$profit_color = $negative_profit_color AND $profit_color_san_salvador = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Santos" AND $dest_shipment['m3'] >= $minumum_volume_santos) 
     					{$profit_color = $positive_profit_color AND $profit_color_santos = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Santos" AND $dest_shipment['m3'] < $minumum_volume_santos)
     							{$profit_color = $negative_profit_color AND $profit_color_santos = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Valencia" AND $dest_shipment['m3'] >= $minumum_volume_valencia) 
     					{$profit_color = $positive_profit_color AND $profit_color_valencia = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Valencia" AND $dest_shipment['m3'] < $minumum_volume_valencia)
     							{$profit_color = $negative_profit_color AND $profit_color_valencia = $negative_profit_color;}

    				if ($dest_shipment['current_dest'] == "Venezuela" AND $dest_shipment['m3'] >= $minumum_volume_venezuela) 
     					{$profit_color = $positive_profit_color AND $profit_color_venezuela = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Venezuela" AND $dest_shipment['m3'] < $minumum_volume_venezuela)
     							{$profit_color = $negative_profit_color AND $profit_color_venezuela = $negative_profit_color;}

    				if ($dest_shipment['current_dest'] == "Veracruz" AND $dest_shipment['m3'] >= $minumum_volume_veracruz) 
     					{$profit_color = $positive_profit_color AND $profit_color_veracruz = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Veracruz" AND $dest_shipment['m3'] < $minumum_volume_veracruz)
     							{$profit_color = $negative_profit_color AND $profit_color_veracruz = $negative_profit_color;}

     			?>
				<div class="col s6 m6 l2">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($dest_shipment['current_dest']); ?></h6>
							<div style="color:<?php echo $profit_color;?>">
							<?php echo htmlspecialchars($dest_shipment['m3']); ?> m3</br>
							</div>
							BKG
							<?php echo htmlspecialchars($dest_shipment['bkg']); ?>, <?php echo htmlspecialchars($dest_shipment['vol_bkg']); ?> m3
							</br>
							ROI
							<?php echo htmlspecialchars($dest_shipment['roi']); ?>, <?php echo htmlspecialchars($dest_shipment['vol_roi']); ?> m3
							</br>		
              <?php echo htmlspecialchars($dest_shipment['current_cntr']); ?>
              </br>   
              <?php foreach($dest_shipment_['current_cntr'] as $dest_shipment_cntr):
              
                echo htmlspecialchars($dest_shipment_cntr['current_cntr']);
              
               endforeach; ?>

               
              
              </br> 				
						</div>						
					</div>
				</div>
			<?php endforeach; ?>	

		</div>
	</div>	


    

<script>
       //basic map config with custom fills, mercator projection
      var map = new Datamap({
        scope: 'world',
        element: document.getElementById('container1'),
        projection: 'mercator',
        height: 700,
        geographyConfig: {
                popupOnHover: true,
                highlightOnHover: true,
                borderColor: '#fff',
                borderWidth: 0.1,
                highlightFillColor: '#4e6386',
                highlightBorderColor: '#4e6386',
                highlightBorderWidth: 2,
                highlightBorderOpacity: 1,
                highlightFillOpacity: 1,
                exitDelay: 100, // Milliseconds
            },
        fills: {
          defaultFill: '#EFEFEF',
          
          borderWidth: '0.1px',
          lt50: 'yellow',
          gt50: 'red'
          
          
        },
        
        data: {

          <?php if ($profit_color_santos == $negative_profit_color OR $profit_color_rio == $negative_profit_color){$color_brazil = $negative_profit_color;} else {$color_brazil = $positive_profit_color;} ?>
          BRA: {fillColor: '<?php echo $color_brazil ?>'},
          
          <?php if ($profit_color_rosario == $negative_profit_color OR $profit_color_buenos_aires == $negative_profit_color){$color_arg = $negative_profit_color;} else {$color_arg = $positive_profit_color;} ?>
          ARG: {fillColor: '<?php echo $color_arg;?>'/*$color_arg*/},

          <?php if ($profit_color_buenaventura == $negative_profit_color OR $profit_color_cartagena == $negative_profit_color){$color_col = $negative_profit_color;} else {$color_col = $positive_profit_color;} ?>
          COL: {fillColor: '<?php echo $color_col; ?>' /*$color_col*/},

          GTM: {fillColor: '<?php echo $profit_color_guatemala;?>' /*$color_gtm*/}, 
          PER: {fillColor: '<?php echo $profit_color_callao;?>'/*$color_per*/ },  
          ECU: {fillColor: '<?php echo $profit_color_guayaquil;?>' /*$color_ecu*/}, 

          <?php if ($profit_color_san_antonio == $negative_profit_color OR $profit_color_arica == $negative_profit_color){$color_chl = $negative_profit_color;} else {$color_chl = $positive_profit_color;} ?>
          CHL: {fillColor: '<?php echo $color_chl;?>' /*$color_chl*/},  

          PRY: {fillColor: '<?php echo $profit_color_asuncion;?>' /*$color_pry*/}, 
          HND: {fillColor: '<?php echo $profit_color_honduras;?>' /*$color_pry*/},
          URY: {fillColor: '<?php echo $profit_color_montevideo;?>' /*$color_ury*/}, 
          ESP: {fillColor: '<?php echo $profit_color_valencia;?>' /*$color_esp*/},
          SLV: {fillColor: '<?php echo $profit_color_san_salvador;?>' /*$color_slv*/},
          CRI: {fillColor: '<?php echo $profit_color_costa_rica;?>' /*$color_cri*/},
          NIC: {fillColor: '<?php echo $profit_color_managua;?>' /*$color_nic*/},
          PAN: {fillColor: '<?php echo $profit_color_panama;?>' /*$color_pan*/},
          VEN: {fillColor: '<?php echo $profit_color_venezuela;?>' /*$color_ven*/},
          DOM: {fillColor: '<?php echo $profit_color_rio_haina;?>' /*$color_dom*/},
          MEX: {fillColor: '<?php echo $profit_color_veracruz;?>' /*$color_mex*/},
        }
      })
      
      
      /*sample of the arc plugin
      map.arc([
       {
        origin: {
            latitude: 40.639722,
            longitude: 73.778889
        },
        destination: {
            latitude: 37.618889,
            longitude: -122.375
        }
      },
      {
          origin: {
              latitude: 30.194444,
              longitude: -97.67
          },
          destination: {
              latitude: 25.793333,
              longitude: -0.290556
          }
      }
      ], {strokeWidth: 1});
       */
      
       //bubbles, custom popup on hover template
       <?php $map_bubble_radius = 3;?>
     map.bubbles([
       
       <?php if ($profit_color_arica == $negative_profit_color) {echo "{name: 'Arica', latitude: -18, longitude: -70, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_asuncion == $negative_profit_color) {echo "{name: 'Asuncion', latitude: -25, longitude: -57, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_buenaventura == $negative_profit_color) {echo "{name: 'Buenaventura', latitude: 3, longitude: -77, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_buenos_aires == $negative_profit_color) {echo "{name: 'Buenos Aires', latitude: -34, longitude: -58, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_callao == $negative_profit_color) {echo "{name: 'Callao', latitude: -12, longitude: -77, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

        <?php if ($profit_color_cartagena == $negative_profit_color) {echo "{name: 'Cartagena', latitude: 10, longitude: -75, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>
        /*borderColor, borderWidth, borderOpacity, fillOpacity*/

       <?php if ($profit_color_costa_rica == $negative_profit_color) {echo "{name: 'Costa Rica', latitude: 9, longitude: -83, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_venezuela == $negative_profit_color) {echo "{name: 'La Guaira', latitude: 10, longitude: -66, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

        <?php if ($profit_color_guatemala == $negative_profit_color) {echo "{name: 'Guatemala', latitude: 15, longitude: -90, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

        <?php if ($profit_color_guayaquil == $negative_profit_color) {echo "{name: 'Guayaquil', latitude: -2, longitude: -79, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

        <?php if ($profit_color_honduras == $negative_profit_color) {echo "{name: 'Honduras', latitude: 15, longitude: -86, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>
       
       <?php if ($profit_color_managua == $negative_profit_color) {echo "{name: 'Managua', latitude: 12, longitude: -86, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_montevideo == $negative_profit_color) {echo "{name: 'Montevideo', latitude: -34, longitude: -56, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_panama == $negative_profit_color) {echo "{name: 'Panama', latitude: 8, longitude: -80, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_rio == $negative_profit_color) {echo "{name: 'Rio', latitude: -22, longitude: -43, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_rio_haina == $negative_profit_color) {echo "{name: 'Rio Haina', latitude: 18, longitude: -70, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>
       
       <?php if ($profit_color_rosario == $negative_profit_color) {echo "{name: 'Rosario', latitude: -32, longitude: -60, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>
       
       <?php if ($profit_color_san_antonio == $negative_profit_color) {echo "{name: 'San Antonio', latitude: -33, longitude: -71, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

       <?php if ($profit_color_san_salvador == $negative_profit_color) {echo "{name: 'San Salvador', latitude: 13, longitude: -89, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>
       
      <?php if ($profit_color_santos == $negative_profit_color) {echo "{name: 'Santos', latitude: -23, longitude: -46, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

      <?php if ($profit_color_valencia == $negative_profit_color) {echo "{name: 'Valencia', latitude: 39, longitude: -0.3, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>

      <?php if ($profit_color_veracruz == $negative_profit_color) {echo "{name: 'Veracruz', latitude: 19, longitude: -96, radius:" . $map_bubble_radius . ", fillKey: 'gt50'}," ;} ?>
       
     ], {
       popupTemplate: function(geo, data) {
         return "<div class='hoverinfo'>" + data.name + "</div>";
       }
     });
     </script>
</html>