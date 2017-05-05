
<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($judul) && !empty($judul) ? $judul . " &raquo;" : ""); ?>  UNSIQ</title>
    <link type="text/css" rel="stylesheet" href="styles/style.css">
    <?php
	if(isset($css) && !empty($css)){
	?>
    <link type="text/css" rel="stylesheet" href="styles/<?=$css; ?>">
    <?php } ?>
    <link rel="shortcut icon" href="unsiq.jpg">
</head>
<body>
<div id="header" class="container">
	<div id="logo"><img src="unsiq.png" width="100" height="100" /></div>
    <div id="judul">
      <p>UNIVERSITAS SAINS AL-QUR'AN<br>
      </p>
      <p>Jl. Kalibeber ,Mojotengah,Wonosobo</p>
    </div>
    <div id="menu">
    	<ul class="menu-farent">
        	<li><a href="index.php" title="Beranda">Beranda</a></li>
        	<li>
            	<a href="form_input_mhs.php">Input</a>
                
            </li>
            <li>
            	<a href="laporan_mhs.php">Laporan</a>
               
            </li>
        </ul>
    </div>
</div>
<div id="content" class="container">
<!-- end tag ada di footer.php -->