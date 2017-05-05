<?php
/*
 * File			: koneksi.php
 * Lokasi		: ./koneksi.php
 * Pembuat		: A. panji Hafiidh / Riel Melfost
 * Versi		: 1.0
 */
define("DB_HOST", "localhost", true);
define("DB_USER", "root", true);
define("DB_PASS", "", true);
define("DB_NAME", "akademik", true);

if(defined("DB_HOST") && defined("DB_USER") && defined("DB_PASS") && defined("DB_NAME"))
{
	$koneksi = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
	if($koneksi)
		$pilih_db = @mysql_select_db(DB_NAME);
		if(!$pilih_db)
			exit("<h1>Tidak Ada Database Yang DiPilih</h1>");
}

?>