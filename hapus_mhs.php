<?php
/*
 * File			: koneksi.php
 * Lokasi		: ./koneksi.php
 * Pembuat		: A. panji Hafiidh / Riel Melfost
 * Versi		: 1.0
 */
// sertakan file koneksi database
include 'koneksi.php';

$nim = $_GET['nim'];
if(empty($nim)){
	$pesan['type'] = "error";
	$pesan['text'] = "Ups, NIM tidak boleh kosong..";
} else {
	$sql = mysql_query("SELECT * FROM mahasiswa WHERE nim = '".$nim."'") or die(mysql_error());
	
	$ada = mysql_num_rows($sql);
	if($ada > 0){
		
		$data = mysql_fetch_object($sql);
		
		$hapus = mysql_query("DELETE FROM mahasiswa WHERE nim = '".$nim."'");
		if($hapus){			
			$foto = dirname(__FILE__) ."/". $data->foto;
			
			if(!empty($data->foto) && file_exists($foto)){
				// hapus file foto
				@unlink($foto);				
			}
			// kembali ke index				
			header("location: index.php");
			exit;
		}else{
			$pesan['type'] = "error";
			$pesan['text'] = "Oow, data mahasiswa gagal disimpan..";
		}
	}
		
}
?>
<!--<html>
<head>
	<title>Hapus Data Mahasiswa</title>
    <link type="text/css" rel="stylesheet" href="styles/style.css">
</head>
<body>
	<div class="<? //$pesan['type']; ?>"><? //$pesan['text']; ?></div>
</body>
</html>-->