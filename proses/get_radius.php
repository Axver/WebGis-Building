<?php
include("connect.php");
$lat=$_GET['lat'];
$lng=$_GET['lng'];
$radius=$_GET['radius'];
$sql = "SELECT ST_AsGeoJSON(geom) as geometry,penduduk.*,penduduk.nama as nama_penduduk,datuk.*,suku.*,bangunan.* FROM bangunan
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b
INNER JOIN penduduk ON penduduk.id_penduduk=pemilik_bangunan.id_penduduk
INNER JOIN datuk ON datuk.id_datuk=penduduk.id_datuk
INNER JOIN suku ON suku.id_suku=datuk.id_suku
WHERE GeometryType(ST_Centroid(geom)) = 'POINT' AND ST_Distance_Sphere( ST_Point(ST_X(ST_Centroid(geom)), ST_Y(ST_Centroid(geom))), (ST_MakePoint($lng,$lat))) <= $radius";
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