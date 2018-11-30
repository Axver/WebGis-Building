<?php
include("connect.php");
$sql = "SELECT ST_AsGeoJSON(bangunan.geom) geometry,jenis_industri.nama_jenis_industri as jenis FROM public.b_industri 
INNER JOIN bangunan ON b_industri.gid_bangunan=bangunan.gid_bangunan
INNER JOIN jenis_industri ON b_industri.id_jenis_industri=jenis_industri.id_jenis_industri";
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
			'jenis' => $isinya['jenis']
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>