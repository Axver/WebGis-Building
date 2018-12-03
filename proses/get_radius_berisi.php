<?php
include("connect.php");
$lat=$_GET['lat'];
$lng=$_GET['lng'];
$radius=$_GET['radius'];
$sql = "SELECT ST_AsGeoJSON(bangunan.geom) as geometry,bangunan.*,pemilik_bangunan.*,penduduk.*,datuk.*,suku.* FROM bangunan
INNER JOIN b_rumah ON b_rumah.gid_bangunan=bangunan.gid_bangunan
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b
INNER JOIN penduduk ON pemilik_bangunan.id_penduduk=penduduk.id_penduduk
INNER JOIN datuk ON penduduk.id_datuk=datuk.id_datuk
INNER JOIN suku ON suku.id_suku=datuk.id_suku
WHERE GeometryType(ST_Centroid(geom)) = 'POINT' AND ST_Distance_Sphere( ST_Point(ST_X(ST_Centroid(geom)), ST_Y(ST_Centroid(geom))), (ST_MakePoint($lng,$lat))) <= $radius AND b_rumah.status='Berisi'";
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
			
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>