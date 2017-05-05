<?php
include 'koneksi.php';
include 'includes/functions.php';

$css = "laporan_mahasiswa.css";
include 'header.php';
?>
<div id="laporan_container">
<h3 class="judul">Laporan Data Mahasiswa</h3>
<table border="0" cellpadding="0" cellspacing="0">
<thead>
    </tr>
	<tr>
		<th>No</th>
		<th>NIM</th>
		<th>Nama</th>
		<th>jurusan</th>
		<th>Tempat, TGL Lahir</th>
		<th>Semester</th>
		<th>Jenis Kelamin</th>
		<th>Alamat</th>
		<th>Foto</th>
        <th>Aksi</th>
	</tr>
</thead>
<tbody>
<?php
	$i=1;
	$query = mysql_query("SELECT * FROM mahasiswa");
	if(mysql_num_rows($query) > 0){
	while($data = mysql_fetch_object($query)){
	?>
	<tr>
		<td><?=$i++; ?>.</td>
		<td><?=$data->nim; ?></td>
		<td><?=$data->nama; ?></td>
		<td><?=$data->jurusan; ?></td>
		<td><?=$data->tempat_lahir . ", ". tgl_indo(strtotime($data->tgl_lahir)); ?></td>
       	<td><?=$data->semester; ?></td>
        <td><?=jenis_kelamin($data->jenis_kelamin); ?></td>
        <td><?=$data->alamat; ?></td>
        <td><a href="<?=$data->foto; ?>" title="Klik untuk memperbesar"><img src="<?=$data->foto; ?>" width="36" height="auto"></a></td>
        <td><a href="form_edit_mhs.php?nim=<?=$data->nim; ?>">Edit</a> | <a href="hapus_mhs.php?nim=<?=$data->nim; ?>" onclick="return confirm('Yakin?');">Hapus</a></td>
    </tr>
    <?php
	}
	}else{
	?>
    <tr>
    	<td colspan="10" align="center">Tidak ada data</td>
    </tr>
    <?php } ?>
    <tr>
    	<td colspan="2"><a href="form_input_mhs.php" class="tombol1" style="display:block;">+ Tambah</a></td>
        <td colspan="8">&nbsp;</td>
    </tr>
</tbody>
</table>
</div>
<?php include 'footer.php'; ?>