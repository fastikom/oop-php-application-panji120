<?php
/*
 * File			: koneksi.php
 * Lokasi		: ./koneksi.php
 * Pembuat		: A. panji Hafiidh / Riel Melfost
 * Versi		: 1.0
 */
// fungsi untuk mengetahui ekstensi dari suatu file
// contoh : abc.contoh abc.abcd.jpg
// Versi  : 1.0
function get_ekstensi($str = ''){
	if(empty($str))
		return;
	if(strpos($str, ".")){
		$ex = explode(".", $str);
		$j = count($ex);
		$ekstensi = $ex[$j - 1];
		return $ekstensi;
	}
}

function jenis_kelamin($str = ''){
	switch($str){
		case "L": return "Laki-Laki"; break;
		case "P": return "Perempuan"; break;
	}
}

function tgl_indo($waktu= ''){
	if($waktu === 0)
		return date('d-m-Y');
		
	$now = date('d M Y', $waktu);
	$bulan = array(
		'Jan' => "Januari",
		'Feb' => "Februari",
		'Mar' => "Maret",
		'Apr' => "April",
		'May' => "Mei",
		'Jun' => "Juni",
		'Jul' => "Juli",
		'Aug' => "Agustus",
		'Sep' => "September",
		'Oct' => "Oktober",
		'Nov' => "November",
		'Des' => "Desember"
	);
	$out = $now;
	foreach($bulan as $key => $value){
			$out = str_replace($key, $value, $out);
	}
	return $out;
}