<?php
include("connect.php");
$lat=$_GET['lat'];
$lng=$_GET['lng'];
$radius=$_GET['radius'];
// echo $radius;
$sql = "SELECT ST_AsGeoJSON(geom) as geometry,penduduk.nama as nama_penduduk,kelas_industri.*,jenis_industri.*,b_industri.*,bangunan.*,pemilik_bangunan.*,penduduk.*,datuk.*,suku.* FROM bangunan 
INNER JOIN b_industri ON b_industri.gid_bangunan=bangunan.gid_bangunan 
INNER JOIN jenis_industri ON b_industri.id_jenis_industri=jenis_industri.id_jenis_industri
INNER JOIN kelas_industri ON b_industri.id_kelas_industri=kelas_industri.id_kelas_industri
INNER JOIN pemilik_bangunan ON bangunan.id_pemilik_b=pemilik_bangunan.id_pemilik_b
INNER JOIN penduduk ON pemilik_bangunan.id_penduduk=penduduk.id_penduduk
INNER JOIN datuk ON penduduk.id_datuk=datuk.id_datuk
INNER JOIN suku ON datuk.id_suku=suku.id_suku
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
			'pbb'=>$isinya['pbb'],
			'jenis_kelas'=>$isinya['jenis_kelas'],
			'nama_jenis_industri'=>$isinya['nama_jenis_industri'],
			'nama_industri'=>$isinya['nama_industri'],
			'pendapatan'=>$isinya['pendapatan']
			
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
?>