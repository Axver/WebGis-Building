<?php
include("connect.php");
$sql = "select ST_asgeojson(geom) AS geometry,ST_X(ST_centroid(geom)) as x,ST_Y(ST_Centroid(geom)) as y, gid_bangunan,air_pam,bangunan.id_pemilik_b FROM bangunan
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b INNER JOIN penghuni_bangunan ON bangunan.id_penghuni_b=penghuni_bangunan.id_penghuni_b
INNER JOIN penduduk ON penduduk.id_penduduk=pemilik_bangunan.id_penduduk 
INNER JOIN datuk ON penduduk.id_datuk=datuk.id_datuk
INNER JOIN suku ON datuk.id_suku=suku.id_suku";
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