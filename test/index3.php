<?php 

	include('config/db_connect.php');

	// write query for all shipments
	$dest_sql = 'SELECT destination AS current_dest, Sum(pcs) AS pcs, Sum(kgs) AS kgs, Sum(m3) AS m3, (SELECT count(instructions) FROM shipments WHERE destination = current_dest AND instructions = "bkg") AS bkg, (SELECT sum(m3) FROM shipments WHERE destination = current_dest AND instructions = "bkg") AS vol_bkg, (SELECT count(instructions) FROM shipments WHERE destination = current_dest AND instructions = "roi") AS roi, (SELECT sum(m3) FROM shipments WHERE destination = current_dest AND instructions = "roi") AS vol_roi FROM shipments GROUP BY destination';
	// get the result set (set of rows)
	$dest_count = mysqli_query($conn, $dest_sql);
	// fetch the resulting rows as an array
	$dest_shipments = mysqli_fetch_all($dest_count, MYSQLI_ASSOC);
	// free the $result from memory (good practise)
	mysqli_free_result($dest_count);

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
	<div style="width:100%;text-align:center;">
		<div id="map_bombs"  style=" display: inline-block;width: 1000px; height: 500px;"></div>
	</div>
	<div class="container">
		<div class="row">
			
			<?php foreach($dest_shipments as $dest_shipment): ?>
				
    			<?php 
    			
    			
    			$minumum_volume_arica = 8;
    			$minumum_volume_asuncion = 24;
    			$minumum_volume_buenaventura = 24;
    			$minumum_volume_buenos_aires = 24;
    			$minumum_volume_callao = 20;
    			$minumum_volume_cartagena = 24;
    			$minumum_volume_costa_rica = 24;
    			$minumum_volume_guatemala = 21;
    			$minumum_volume_guayaquil = 24;
    			$minumum_volume_honduras = 24;
    			$minumum_volume_managua = 24;
    			$minumum_volume_montevideo = 24;
    			$minumum_volume_panama = 24;
    			$minumum_volume_rio = 24;
    			$minumum_volume_rio_haina = 24;
    			$minumum_volume_rosario = 24;
    			$minumum_volume_san_antonio = 24;
    			$minumum_volume_san_salvador = 0;
    			$minumum_volume_santos = 24;
    			$minumum_volume_valencia = 24;
    			$minumum_volume_venezuela = 24;
    			$minumum_volume_veracruz = 24;

    			$negative_profit_color = "#FF0000";
    			$positive_profit_color = "#00FF00";

    			?>
				<?php 
					if ($dest_shipment['current_dest'] == "Arica" AND $dest_shipment['m3'] > $minumum_volume_arica) 
     					{$profit_color = $positive_profit_color AND $profit_color_guatemala = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Arica" AND $dest_shipment['m3'] < $minumum_volume_arica)
     							{$profit_color = $negative_profit_color AND $profit_color_arica = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Asuncion" AND $dest_shipment['m3'] > $minumum_volume_asuncion) 
     					{$profit_color = $positive_profit_color AND $profit_color_asuncion = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "Asuncion" AND $dest_shipment['m3'] < $minumum_volume_asuncion)
     							{$profit_color = $negative_profit_color AND $profit_color_asuncion = $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "Buenaventura" AND $dest_shipment['m3'] > $minumum_volume_buenaventura) 
     					{$profit_color = $positive_profit_color AND $profit_color_buenaventura = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "buenaventura" AND $dest_shipment['m3'] < $minumum_volume_buenaventura)
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

     				if ($dest_shipment['current_dest'] == "San Antonio" AND $dest_shipment['m3'] > $minumum_volume_san_antonio) 
     					{$profit_color = $positive_profit_color AND $profit_color_san_antonio = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "San Antonio" AND $dest_shipment['m3'] < $minumum_volume_san_antonio)
     							{$profit_color = $negative_profit_color AND $profit_color_san_antonio= $negative_profit_color;}

     				if ($dest_shipment['current_dest'] == "San&nbsp;Salvador" AND $dest_shipment['m3'] >= $minumum_volume_san_salvador) 
     					{$profit_color = $positive_profit_color AND $profit_color_san_salvador = $positive_profit_color;} 
     						else if ($dest_shipment['current_dest'] == "San&nbsp;Salvador" AND $dest_shipment['m3'] < $minumum_volume_san_salvador)
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
						</div>						
					</div>
				</div>
			<?php endforeach; ?>	

		</div>
	</div>	

<script>
					var bombMap = new Datamap({
    element: document.getElementById('map_bombs'),
    scope: 'world',
    geographyConfig: {
        popupOnHover: false,
        highlightOnHover: false
    },
    fills: {
        'USA': '<?php echo $profit_color_guatemala;?>',
  
        defaultFill: '#EFEFEF'

    },
    data: {
       'USA': {fillKey: 'USA'}
       
    }
});

     //var bombs = [{
       // name: 'Joe 4',
        //radius: 25,
        //yield: 400,
       // country: 'USSR',
       // fillKey: 'USA',
       // significance: 'First fusion weapon test by the USSR (not "staged")',
       // date: '1953-08-12',
       // latitude: 50.07,
       // longitude: 78.43
     // },{
      //  name: 'RDS-37',
      //  radius: 20,
      //  yield: 20,
      //  country: 'USSR',
      //  fillKey: 'USA',
       // significance: 'First "staged" thermonuclear weapon test by the USSR (deployable)',
       // date: '1955-11-22',
       // latitude: 50.07,
       // longitude: 78.43

     // },{
        //name: 'Tsar Bomba',
        //radius: 75,
       // yield: 50000,
       // country: 'USSR',
       // fillKey: 'RUS',
       // significance: 'Largest thermonuclear weapon ever tested—scaled down from its initial 100 Mt design by 50%',
        //date: '1961-10-31',
        //latitude: 80.1918,
       // longitude: 25.7617
      //}
    //];
//draw bubbles for bombs
bombMap.bubbles(bombs, {
    popupTemplate: function (geo, data) {
            return ['<div class="hoverinfo">' +  data.name,
            '<br/>Payload: ' +  data.yield + ' kilotons',
            '<br/>Country: ' +  data.country + '',
            '<br/>Date: ' +  data.date + '',
            '</div>'].join('');
    }
});
				</script>
</html>