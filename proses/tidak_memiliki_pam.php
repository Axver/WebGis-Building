<?php
include("connect.php");
$sql = "select ST_asgeojson(geom) AS geometry,ST_X(ST_centroid(geom)) as x,ST_Y(ST_Centroid(geom)) as y, gid_bangunan,air_pam,id_pemilik_b FROM bangunan WHERE air_pam='Tidak'";
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
            'id_pemilik_b' => $isinya['id_pemilik_b'],
            'x' => $isinya['x'],
            'y' => $isinya['y']
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>