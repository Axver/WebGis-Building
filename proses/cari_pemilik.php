<?php

include 'connect.php';

$nama=$_GET['nama'];
// echo $suku;

$sql = "SELECT penduduk.nama as nama_penduduk,gid_bangunan,bangunan.*,datuk.*,penduduk.*,suku.*, air_pam, bangunan.id_pemilik_b, id_penghuni_b, kapasitas_listrik, pbb, ST_asgeojson(geom) as geometry
FROM public.bangunan
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b
INNER JOIN penduduk ON pemilik_bangunan.id_penduduk=penduduk.id_penduduk
INNER JOIN datuk ON penduduk.id_datuk=datuk.id_datuk
INNER JOIN suku ON datuk.id_suku=suku.id_suku
WHERE LOWER(penduduk.nama) LIKE LOWER('%$nama%');";

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
			'nama_penduduk'=>$isinya['nama_penduduk'],
			'nama_suku'=>$isinya['nama_suku'],
			'no_kk'=>$isinya['no_kk'],
			'tgl_lahir'=>$isinya['tgl_lahir'],
			'pendidikan'=>$isinya['pendidikan'],
			'penghasilan'=>$isinya['penghasilan'],
			'asuransi'=>$isinya['asuransi'],
			'tabungan'=>$isinya['tabungan'],
			'kapasitas_listrik'=>$isinya['kapasitas_listrik'],
			'pbb'=>$isinya['pbb']
                )
            );
        array_push($hasil['features'], $features);
    }

    echo json_encode($hasil);


?>