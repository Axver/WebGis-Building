<?php
include("connect.php");
$id_suku=$_GET['id_suku'];
$sql = "SELECT gid_bangunan, air_pam, bangunan.id_pemilik_b, id_penghuni_b, kapasitas_listrik, pbb, ST_AsGEOJSON(geom) as geometry
FROM public.bangunan INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b
INNER JOIN penduduk ON pemilik_bangunan.id_penduduk=penduduk.id_penduduk
INNER JOIN datuk ON penduduk.id_datuk=datuk.id_datuk 
INNER JOIN suku ON datuk.id_suku=suku.id_suku WHERE suku.id_suku=$id_suku";
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
			'gid_bangunan' => $isinya['gid_bangunan']
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>