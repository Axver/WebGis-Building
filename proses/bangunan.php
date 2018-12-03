<?php
include("connect.php");
$sql = "select suku.*,penduduk.nama as nama_penduduk,penduduk.* ,bangunan.kapasitas_listrik as kapasitas_listrik, bangunan.pbb as pbb,ST_asgeojson(geom) AS geometry,ST_X(ST_centroid(geom)) as x,ST_Y(ST_Centroid(geom)) as y,St_AsGEoJSON(ST_Centroid(geom)) as center, gid_bangunan,air_pam,bangunan.id_pemilik_b FROM bangunan
LEFT JOIN pemilik_bangunan ON pemilik_bangunan.id_pemilik_b=bangunan.id_pemilik_b INNER JOIN penghuni_bangunan ON bangunan.id_penghuni_b=penghuni_bangunan.id_penghuni_b
LEFT JOIN penduduk ON penduduk.id_penduduk=pemilik_bangunan.id_penduduk 
LEFT JOIN datuk ON penduduk.id_datuk=datuk.id_datuk
LEFT JOIN suku ON datuk.id_suku=suku.id_suku";
$result = pg_query($sql);
$hasil = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);

while ($isinya = pg_fetch_assoc($result)) {
	$features = array(
		'type' => 'Feature',
		'geometry' => json_decode($isinya['geometry']),
		'geometry_point'=>json_decode($isinya['center']),
		'properties' => array(
			'gid_bangunan' => $isinya['gid_bangunan'],
			'air_pam' => $isinya['air_pam'],
            'id_pemilik_b' => $isinya['id_pemilik_b'],
            'x' => $isinya['x'],
			'y' => $isinya['y'],
			'center'=>$isinya['center'],
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