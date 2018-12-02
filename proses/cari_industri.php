<?php

include 'connect.php';

$nama=$_GET['nama'];
// echo $suku;

$sql = "SELECT id_b_industri, id_jenis_industri, id_kelas_industri, b_industri.gid_bangunan, nama_industri, pendapatan, jumlah_karyawan,ST_AsGeoJSON(bangunan.geom) as geometry
FROM public.b_industri INNER JOIN bangunan ON bangunan.gid_bangunan=b_industri.gid_bangunan
INNER JOIN pemilik_bangunan ON pemilik_bangunan.id_pemilik_b=bangunan.id_pemilik_b
INNER JOIN penduduk ON penduduk.id_penduduk=pemilik_bangunan.id_penduduk WHERE nama_industri LIKE '%$nama%';";

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