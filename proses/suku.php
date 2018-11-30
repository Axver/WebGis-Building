<?php
   
	$sql = "select id_suku, nama_suku FROM suku";
	$result = pg_query($sql);
	$hasil_suku = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);

	while ($isinya = pg_fetch_assoc($result)) {
		$features = array(
		'type' => 'Feature',
		'properties' => array(
		'id_suku' => $isinya['id_suku'],
		'nama_suku' => $isinya['nama_suku'],
	
		)
	);
	array_push($hasil_suku['features'], $features);
	}
	$data= json_encode($hasil_suku);

	?>