<?php
include("connect.php");
$sql = "SELECT ST_AsGeoJSON(bangunan.geom) as geometry,penduduk.nama as nama_penduduk,id_b_rumah, b_rumah.gid_bangunan,suku.*, status,bangunan.*,b_rumah.*,penduduk.*,datuk.* FROM public.b_rumah 
LEFT JOIN bangunan ON bangunan.gid_bangunan=b_rumah.gid_bangunan 
LEFT JOIN pemilik_bangunan ON pemilik_bangunan.id_pemilik_b=bangunan.id_pemilik_b
LEFT JOIN penduduk ON pemilik_bangunan.id_penduduk=penduduk.id_penduduk
LEFT JOIN datuk ON penduduk.id_datuk=datuk.id_datuk
LEFT JOIN suku ON datuk.id_suku=suku.id_suku
WHERE status='Kosong'";
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