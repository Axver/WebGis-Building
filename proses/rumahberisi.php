<?php
include("connect.php");
$sql = "SELECT ST_AsGeoJSON(bangunan.geom) as geometry,id_b_rumah, b_rumah.gid_bangunan, status FROM public.b_rumah INNER JOIN bangunan ON bangunan.gid_bangunan=b_rumah.gid_bangunan
WHERE status='Berisi'";
$result = pg_query($sql);
$hasil = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);

while ($isinya = pg_fetch_assoc($result)) {
	$features = array(
		'type' => 'Feature',
		'geometry' => json_decode($isinya['geometry']),
		'properties' => array(
			'status' => $isinya['status']
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>