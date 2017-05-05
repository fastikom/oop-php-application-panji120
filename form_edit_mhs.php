<?php
/*
 * File			: koneksi.php
 * Lokasi		: ./koneksi.php
 * Pembuat		: A. panji Hafiidh / Riel Melfost
 * Versi		: 1.0
 */
// sertakan file proses_edit_mhs.php untuk memproses data form
include 'proses_edit_mhs.php';

$sql = mysql_query("SELECT * FROM mahasiswa WHERE nim = '".$_GET['nim']."'");
$data = mysql_fetch_object($sql);

$css = "input_mahasiswa.css";
$judul = "Edit Data Mahasiswa";

include 'header.php';
?>
<div id="form-input-mhs-container">
	<form name="form-input-mhs" id="form-input-mhs" enctype="multipart/form-data" action="" method="post">
    	<fieldset>
        	<legend>Edit Data Mahasiswa</legend>
            <table border="0" cellpadding="0" cellspacing="0">
            	<?php
				if(isset($pesan) && !empty($pesan)){
				?>
                <tr>
                	<td colspan="3"><div class="<?=$pesan['type']; ?>"><?=$pesan['text']; ?></div></td>
                </tr>
                <?php } ?>
            	<tr>
                	<td><label for="nim">NIM</label></td>
                    <td>:</td>
                    <td><input type="text" name="nim" id="nim" value="<?=(isset($data->nim) ? $data->nim : ""); ?>" /></td>
                </tr>
                <tr>
                	<td><label for="nama">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" name="nama" id="nama" value="<?=(isset($data->nama) ? $data->nama : ""); ?>" /></td>
                </tr>
                <tr>
                	<td><label for="jurusan">Jurusan</label></td>
                    <td>:</td>
                    <td>
                    	<select id="jurusan" name="jurusan">
                        	<option value="null"><< Pilih Jurusan >></option>
                            <option value="Manajemen Informatika" <?=(isset($data->jurusan) && $data->jurusan == "Manajemen Informatika" ? 'selected="selected"' : ''); ?>>Manajemen Informatika</option>
                            <option value="Teknik Komputer" <?=(isset($data->jurusan) && $data->jurusan == "Teknik Komputer" ? 'selected="selected"' : ''); ?>>Teknik Komputer</option>
                            <option value="Komputer Akuntansi" <?=(isset($data->jurusan) && $data->jurusan == "Komputer Akuntansi" ? 'selected="selected"' : ''); ?>>Komputer Akuntansi</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="tempat_lahir">Tempat, Tgl Lahir</label></td>
                    <td>:</td>
                    <td>
                    	<input type="text" id="tempat_lahir" name="tempat_lahir" value="<?=(isset($data->tempat_lahir) ? $data->tempat_lahir : ''); ?>" />, 
                        <?php
						// 0000-00-00
						$tgl = explode("-", $data->tgl_lahir);
						$tgl_lahir = $tgl[2];
						$bln_lahir = $tgl[1];
						$thn_lahir = $tgl[0];
						?>
                        <select name="tgl_lahir" id="tgl_lahir">
                        	<option value="null">&nbsp;</option>
                            <?php
								for($i=1; $i<=31; $i++){
									echo '<option value="'.$i.'" '.(isset($tgl_lahir) && $tgl_lahir == $i ? 'selected="selected"' : '').'>'.$i.'</option>';
								}
							?>
                        </select> 
                        
                        <select name="bln_lahir" id="bln_lahir">
                        	<option value="null">&nbsp;</option>
                        	<?php
							$bulan = array(
								'01' => 'Januari', 
								'02' => 'Februari', 
								'03' => 'Maret', 
								'04' => 'April',
								'05' => 'Mei',
								'06' => 'Juni',
								'07' => 'Juli',
								'08' => 'Agustus',
								'09' => 'September',
								'10' => 'Oktober',
								'11' => 'November',
								'12' => 'Desember'
							);
							foreach($bulan as $key => $value){
							?>
                            <option value="<?=$key; ?>" <?=(isset($bln_lahir) && $bln_lahir == $key ? 'selected="selected"' : ''); ?>><?=$value; ?></option>
                            <?php 
							}
							?>
                        </select> 
                        <select name="thn_lahir" id="thn_lahir">
                        	<option value="null">&nbsp;</option>
                        	<?php
							for($i=1985; $i<=((int)date('Y') - 13); $i++){
							?>
                            <option value="<?=$i; ?>" <?=(isset($thn_lahir) && $thn_lahir == $i ? 'selected="selected"' : ''); ?>><?=$i; ?></option>
                            <?php
							} // end for
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="jurusan">Semester</label></td>
                    <td>:</td>
                    <td>
                    	<select id="semester" name="semester">
                        	<option value="null"><< Pilih Semester >></option>
                            <?php
							for($i=1; $i<=6; $i++){
								echo '<option value="'.$i.'" '.(isset($data->semester) && $data->semester == $i ? 'selected="selected"' : '').'>Semester '.$i.'</option>';
							}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="jenis_kelamin">Jenis Kelamin</label></td>
                    <td>:</td>
                    <td>
                    	<label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" <?=(isset($data->jenis_kelamin) && $data->jenis_kelamin =="L" ? 'checked="checked"' : ''); ?> value="L" /> Laki-Laki</label>
                        <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" <?=(isset($data->jenis_kelamin) && $data->jenis_kelamin =="P" ? 'checked="checked"' : ''); ?> value="P" /> Perempuan</label>
                    </td>
                </tr>
                <tr>
                	<td valign="top"><label for="alamat">Alamat</label>
                    <td valign="top">:</td>
                    <td><textarea name="alamat" id="alamat" rows="5" cols="30"><?=(isset($data->alamat) ? $data->alamat : ''); ?></textarea></td>
                </tr>
                <tr>
                	<td><label for="foto">Foto</label></td>
                    <td>:</td>
                    <td>
                    	<div id="source-image">
                        	<img src="<?=$data->foto; ?>" width="100" height="auto">
                            <label for="foto" id="ganti-foto-nav">Ganti Foto</label>
                        </div>
                        <div id="input-image" style="display:none">
                        	<input type="file" name="foto" id="foto" value="<?=(isset($foto['name']) ? $foto['name'] : ''); ?>" onChange="document.getElementById('ubah-foto').value = 'true'" />
                            <input type="hidden" name="ubah-foto" id="ubah-foto" value="false">
                        </div>
                    </td>
                </tr>
                <tr>
                	<td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="simpan" id="simpan" value="SIMPAN" class="tombol1"  /> <a href="laporan_mhs.php" class="tombol2">Batal</a></td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<?php
include 'footer.php';
?>