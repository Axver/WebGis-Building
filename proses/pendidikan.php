<?php
   
	$sql = "select distinct pendidikan as pendidikan FROM penduduk";
	$result = pg_query($sql);
	$hasil_pendidikan = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);

	while ($isinya = pg_fetch_assoc($result)) {
		$features = array(
		'type' => 'Feature',
		'properties' => array(
		'tingkat_pendidikan' => $isinya['pendidikan'],
		
	
		)
	);
	array_push($hasil_pendidikan['features'], $features);
	}
	$data= json_encode($hasil_pendidikan);

	?>