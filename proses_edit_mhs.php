<?php
/*
 * File			: koneksi.php
 * Lokasi		: ./koneksi.php
 * Pembuat		: A. panji Hafiidh / Riel Melfost
 * Versi		: 1.0
 */
// sertakan file koneksi database
include 'koneksi.php';
include 'includes/functions.php';

if(isset($_POST['simpan']))
{
	$data 			= $_POST;
	
	$nim 			= $data['nim'];
	$nama 			= $data['nama'];
	$jurusan 		= $data['jurusan'];
	$tempat_lahir	= $data['tempat_lahir'];
	$tgl_lahir		= $data['tgl_lahir'];
	$bln_lahir 		= $data['bln_lahir'];
	$thn_lahir 		= $data['thn_lahir'];
	$tgl			= $thn_lahir ."-". $bln_lahir ."-". $tgl_lahir;
	$semester		= $data['semester'];
	$jenis_kelamin	= $data['jenis_kelamin'];
	$alamat			= $data['alamat'];
	
	// foto
	$foto			= $_FILES['foto'];
	$nama_file		= $foto['name'];
	$ekstensi 		= get_ekstensi($nama_file);
	$lokasi_upload	= "upload/foto/";
	$nama_baru		= $lokasi_upload . $nim ."_". $nama .".". $ekstensi;	
	$file			= $foto['tmp_name'];
	
	if(empty($nim)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, Nim tidak boleh kosong..";
	}elseif(empty($nama)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, Nama tidak boleh kosong..";
	}elseif(empty($jurusan)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, jurusan dulu..";
	}elseif(empty($tempat_lahir)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, tempat lahir tidak boleh kososng..";
	}elseif( ($tgl_lahir == "null") or ($bln_lahir == "null") or ($thn_lahir == "null")){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, tentukan tanggal lahir dulu..";
	}elseif($semester == "null"){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, pilih semester dulu..";
	}elseif(!isset($jenis_kelamin)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, pilih jenis kelamin dulu..";
	}elseif(empty($alamat)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, masukkan alamat dulu..";
	}elseif(isset($data['ubag-foto']) && $data['ubah-foto'] == "true" && empty($foto['name'])){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, filih fotonya dulu..";
	}else{
		if(isset($data['ubah-foto']) && $data['ubah-foto'] == "true" && !empty($foto['name'])){
			$upload = move_uploaded_file($file, $nama_baru);
			if($upload){				
				$update = TRUE;
				
				$sql = "UPDATE mahasiswa SET nim='".$nim."', nama='".$nama."', jurusan = '".$jurusan."', tempat_lahir = '".$tempat_lahir."', tgl_lahir = '".$tgl."', semester = '".$semester."', jenis_kelamin = '".$jenis_kelamin."', alamat = '".$alamat."', foto = '".$nama_baru."' WHERE nim = '".$_GET['nim']."'";				
			}
		}else{
			$update = TRUE;
			$sql = "UPDATE mahasiswa SET nim='".$nim."', nama='".$nama."', jurusan = '".$jurusan."', tempat_lahir = '".$tempat_lahir."', tgl_lahir = '".$tgl."', semester = '".$semester."', jenis_kelamin = '".$jenis_kelamin."', alamat = '".$alamat."' WHERE nim = '".$_GET['nim']."'";
		}
		
		if($update){
			$simpan_perubahan = mysql_query($sql);
			if($simpan_perubahan){
				$pesan['type'] = "sukses";
				$pesan['text'] = 'Yuhu, data mahasiswa berhasil di ubah.. <a href="index.php">Lihat Data</a>';
			}else{
				$pesan['type'] = "error";
				$pesan['text'] = "Oow, data mahasiswa gagal disimpan..";
			}
		}
		
		
	}
}
?>