<?php

include 'connect.php';

$nama=$_GET['nama'];
// echo $suku;

$sql = "SELECT ST_AsGeoJSON(geom) as geometry FROM public.bangunan WHERE gid_bangunan=$nama";

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