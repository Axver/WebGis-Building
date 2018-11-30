<?php

include 'connect.php';

$suku=$_GET['suku'];
// echo $suku;

$sql = "SELECT ST_AsGeoJSON(geom) as geometry FROM bangunan 
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b
INNER JOIN penduduk ON pemilik_bangunan.id_penduduk=penduduk.id_penduduk 
INNER JOIN datuk ON penduduk.id_datuk=datuk.id_datuk 
INNER JOIN suku ON suku.id_suku=datuk.id_suku WHERE suku.id_suku='$suku'";

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