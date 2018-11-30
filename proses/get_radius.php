<?php
include("connect.php");
$lat=$_GET['lat'];
$lng=$_GET['lng'];
$radius=$_GET['radius'];
$sql = "SELECT ST_AsGeoJSON(geom) as geometry FROM bangunan WHERE GeometryType(ST_Centroid(geom)) = 'POINT' AND ST_Distance_Sphere( ST_Point(ST_X(ST_Centroid(geom)), ST_Y(ST_Centroid(geom))), (ST_MakePoint($lng,$lat))) <= $radius";
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