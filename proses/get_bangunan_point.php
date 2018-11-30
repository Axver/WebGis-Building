<?php
include("connect.php");
$sql = "select ST_asgeojson(ST_Centroid(geom)) AS geometry, gid_bangunan,air_pam,id_pemilik_b FROM bangunan";
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
			'gid_bangunan' => $isinya['gid_bangunan'],
			'air_pam' => $isinya['air_pam'],
            'id_pemilik_b' => $isinya['id_pemilik_b']
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>