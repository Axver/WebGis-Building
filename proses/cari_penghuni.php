<?php

include 'connect.php';

$nama=$_GET['nama'];
// echo $suku;

$sql = "SELECT penduduk.nama,gid_bangunan, air_pam, bangunan.id_pemilik_b, bangunan.id_penghuni_b, kapasitas_listrik, pbb, ST_asgeojson(geom) as geometry
FROM public.bangunan
INNER JOIN penghuni_bangunan ON bangunan.id_penghuni_b=penghuni_bangunan.id_penghuni_b
INNER JOIN penduduk ON penghuni_bangunan.id_penduduk=penduduk.id_penduduk
WHERE penduduk.nama LIKE '%$nama%';";

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