<?php

include 'connect.php';

$nama=$_GET['nama'];
// echo $suku;

$sql = "SELECT ST_AsGeoJSON(bangunan.geom) as geometry, id_b_industri, id_jenis_industri, id_kelas_industri, b_industri.gid_bangunan, nama_industri, pendapatan, jumlah_karyawan
FROM public.b_industri
INNER JOIN bangunan ON b_industri.gid_bangunan=bangunan.gid_bangunan
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b WHERE b_industri.pendapatan $nama";

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