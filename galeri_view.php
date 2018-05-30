<?php

require __DIR__ . './util/config.php';
require __DIR__ . './util/db.php';

$yearId = NULL;
$imgs = array();

if ( isset($_GET["id"]) and $_GET["id"] !== "" ){
	$yearId = $_GET["id"];
	//echo "yearId = ".$yearId;
} else {
	header("Location: /galeri.php"); 
	exit();
}


$db = new db();
$conn = $db->connect();

$sql = "SELECT gallery_events.yearId, gallery_events.eventId, gallery_events.eventName, gallery_imgs.imgId, gallery_imgs.imgName,
gallery_reg.yearInt, gallery_reg.month
FROM gallery_imgs 
INNER JOIN gallery_events 
ON gallery_imgs.eventId=gallery_events.eventId 
INNER JOIN gallery_reg
ON gallery_events.yearId=gallery_reg.yearId
WHERE gallery_events.yearId = ? ORDER BY gallery_events.eventId";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $yearId);

$stmt->execute(); 

$result = $stmt->get_result(); 

if($result->num_rows !== 0) {
	while( $row = $result->fetch_assoc() ) {
		array_push($imgs, $row);
	}
}

$stmt->close();
$conn->close();

// var_dump($imgs);

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SMIAH | Galeri</title>
	<link rel="shortcut icon" href="./icon/smiah-favicon.ico" type="image/x-icon">
	<link rel="icon" href="./icon/smiah-favicon.ico" type="image/x-icon">
	
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link href="./css/main.css" rel="stylesheet">
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="row">
				<div class="navbar-header">
			  		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navbar">
			  			<span class="icon-bar"></span>
			  			<span class="icon-bar"></span>
			  			<span class="icon-bar"></span>
			  		</button>
			  		<span class="navbar-brand"><a href="index.php"><img src="./img/logo-insaniah.png"></a></span>
			  	</div>

			  	<div class="collapse navbar-collapse" id="top-navbar">
			  		<ul class="nav navbar-nav navbar-right">
			  			<li class="dropdown">
			  				<a href="index.php" class="dropdown-toggle" style="text-transform: uppercase;">Utama</a>
			  			</li>
			  			<li class="dropdown">
			  				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform: uppercase;">Pengenalan <b class="caret"></b></a>
			  				<ul class="dropdown-menu">
			  					<li><a href="pengenalan-sekolah.php">Pengenalan Sekolah</a></li>
			  					<li><a href="pencapaian.php">Pencapaian</a></li>
			  					<li><a href="struktur-organisasi.php">Struktur Pengurusan</a></li>
			  					<li><a href="carta-organisasi.php">Carta Organisasi</a></li>
			  					<li><a href="sijil-perakuan.php">Sijil Perakuan</a></li>
			  					<li><a href="taqwim.php">Taqwim</a></li>
			  				</ul>
			  			</li>
			  			<li class="dropdown">
			  				<a href="kurikulum.php" class="dropdown-toggle" style="text-transform: uppercase;">Kurikulum</a>
			  			</li>
			  			<li class="dropdown">
			  				<a href="kokurikulum.php" class="dropdown-toggle" style="text-transform: uppercase;">Ko-Kurikulum</a>
			  			</li>
			  			<li class="dropdown">
			  				<a href="kemasukan.php" class="dropdown-toggle" style="text-transform: uppercase;">Kemasukan</a>
			  			</li>
			  			<li class="dropdown">
			  				<a href="kemudahan.php" class="dropdown-toggle" style="text-transform: uppercase;">Kemudahan</a>
			  			</li>
			  			<li class="dropdown">
			  				<a href="galeri.php" class="dropdown-toggle" style="text-transform: uppercase;">Galeri</a>
			  			</li>
			  			<li class="dropdown">
			  				<a href="hubungi.php" class="dropdown-toggle" style="text-transform: uppercase;">Hubungi</a>
			  			</li>
			  		</ul>
			  	</div>
			</div>
		</div>
	</nav>

	<section class="main-title">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<h1>GALERI</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="sect-content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="galeri.php">Galeri</a></li>
					    <li class="breadcrumb-item"><a href="galeri.php"><?php echo $imgs[0]["yearInt"]; ?></a></li>
					    <li class="breadcrumb-item active" aria-current="page"><?php echo $imgs[0]["month"]; ?></li>
					  </ol>
					</nav>

					<div>
					<?php		
					$eventId = "";			
					for ($i=0 ; $i < count($imgs) ; $i++){

						if ($eventId !== $imgs[$i]["eventId"]){
							$eventId = $imgs[$i]["eventId"];
						
					?>
							<h3><?php echo $imgs[$i]["eventName"]; ?></h3>
							<img class="img-galeri" src="./img/galeri/<?php echo $imgs[$i]["imgName"]; ?>">

					<?php
						} else {
							?>
								<img class="img-galeri" src="./img/galeri/<?php echo $imgs[$i]["imgName"]; ?>">
							<?php
						}
					} 
					?>
					</div>					
<!-- 
					<div>
						<h3>Sukan Tahunan</h3>
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan1.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan2.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan3.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan4.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan5.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan6.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan7.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_sukan8.jpg">
					</div>

					<div>
						<h3>Persatuan Matematik & Sains @ Lawatan UMT</h3>
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan1.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan2.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan3.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan4.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan5.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan6.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan7.jpg">
						<img class="img-galeri" src="./img/galeri/2015_apr_lawatan8.jpg">
					</div> 
-->

				</div>
			</div>
		</div>
	</section>	

	<section class="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<p><b>Hubungi</b></p><br>
					<p>Tel : +609-7711087 (Pejabat) | +6012-5188194 (En. Irman) | +6017-2137034 (Ustaz Nasrudin Sidi)</p>
					<p>Fax : 609-7711708</p>
					<p>Thailand : 0851063033 | 0950924645</p>
				</div>
				<div class="col-xs-12 col-sm-4">
					
				</div>
				<div class="col-xs-12 col-sm-4">
					<p><b>Unit Pengambilan</b></p><br>
					<p>Unit Pengambilan Pelajar, Sekolah Menengah Islam Al-Husna, Lot 947 Kok Kubur, Jalan Kuala Besar, 15350 Kota Bharu, Kelantan.</p>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="row">
				<p>Dimiliki oleh Sekolah Menengah Agama Al-Husna</p>
				<span>
					<a href="https://www.facebook.com/smihusna">facebook</a>
				</span>
			</div>
		</div>
	</footer>



	<script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

   <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>