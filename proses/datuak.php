<?php
   
	$sql = "select id_datuk,nama_datuk FROM datuk";
	$result = pg_query($sql);
	$hasil_datuak = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);

	while ($isinya = pg_fetch_assoc($result)) {
		$features = array(
		'type' => 'Feature',
		'properties' => array(
		'id_datuak' => $isinya['id_datuk'],
		'nama_datuak' => $isinya['nama_datuk'],
	
		)
	);
	array_push($hasil_datuak['features'], $features);
	}
	$data= json_encode($hasil_datuak);

	?>