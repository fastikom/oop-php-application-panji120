<?php
/*
 * File			: koneksi.php
 * Lokasi		: ./koneksi.php
 * Pembuat		: A. panji Hafiidh / Riel Melfost
 * Versi		: 1.0
 */
// jika tombol simpan diklik
if(isset($_POST['simpan']))
{
	// sertakan file koneksi database
	include 'koneksi.php';
	// sertakan file fungsi
	include 'includes/functions.php';
	
	$data = $_POST;
	
	// mendefinisikan variabel dan nilainya
	$nim 			= $data['nim'];
	$nama 			= $data['nama'];
	$jurusan 		= $data['jurusan'];
	$tempat_lahir 	= $data['tempat_lahir'];
	$tgl_lahir 		= $data['tgl_lahir'];
	$bln_lahir 		= $data['bln_lahir'];
	$thn_lahir 		= $data['thn_lahir'];
	$tgl 			= $thn_lahir ."-". $bln_lahir ."-". $tgl_lahir;
	$semester 		= $data['semester'];
	$jenis_kelamin	= (!isset($data['jenis_kelamin']) ? $data['jenis_kelamin'] = "L" : $data['jenis_kelamin']);
	$alamat			= $data['alamat'];
	$foto			= $_FILES['foto'];
	$ekstensi		= get_ekstensi($foto['name']);
	// foto
	$lokasi_upload	= "upload/foto/";
	$nama_baru 		= $lokasi_upload . $nim ."_". $nama .".".$ekstensi;
	
	$file			= $foto['tmp_name'];
	
	// validasi data
	if(empty($nim)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, masukkan nim dulu..";
	}elseif(empty($nama)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, masukkan nama dulu..";
	}elseif($jurusan == "null"){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, pilih jurusan dulu..";
	}elseif(empty($tempat_lahir)){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, masukkan tempat lahir dulu..";
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
	}elseif(empty($foto['name'])){
		$pesan['type'] = "error";
		$pesan['text'] = "Ups, filih fotonya dulu..";
	}else{
		// jika semua sudah lengkap
		// upload foto dulu
		$upload = move_uploaded_file($file, $nama_baru);
		if($upload){
			$simpan = @mysql_query("INSERT INTO mahasiswa (nim, nama, jurusan, tempat_lahir, tgl_lahir, semester, jenis_kelamin, alamat, foto) VALUES('{$nim}', '{$nama}', '{$jurusan}', '{$tempat_lahir}', '{$tgl}', '{$semester}', '{$jenis_kelamin}', '{$alamat}', '{$nama_baru}')") or die(mysql_error());
			if($simpan){
				$pesan['type'] = "sukses";
				$pesan['text'] = 'Yuhu, data mahasiswa sudah tersimpan.. <a href="index.php">Tampilkan Data</a>';
				
				// kosongkan semua variabel
				unset($nim, $nama, $jurusan, $tempat_lahir, $tgl_lahir, $bln_lahir, $thn_lahir, $semester, $jenis_kelamin, $alamat, $foto);
			}else{
				$pesan['type'] = "error";
				$pesan['text'] = "Oow, data mahasiswa gagal disimpan..";
			}
		}
	}
}
?>