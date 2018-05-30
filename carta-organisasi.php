<?php

require __DIR__ . './util/config.php';
require __DIR__ . './util/db.php';

$orgChart = array();

$db = new db();
$conn = $db->connect();

$sql  = "SELECT * FROM orgchart";

$stmt = $conn->prepare($sql);
$stmt->execute();    	

/* instead of bind_result */
$result = $stmt->get_result(); 

if($result->num_rows !== 0) {
	while( $row = $result->fetch_assoc() ) {
		array_push($orgChart,$row);
	}
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SMIAH | Carta Organisasi</title>
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
					<h1>CARTA ORGANISASI</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="sect-organisasi">
		<div class="container">
			<div class="row">
				<!-- <div class="col-xs-12 col-sm-12">
					<h3 style="font-weight: bold; padding: 15px 0;">CARTA ORGANISASI</h3>
					<img style="margin-left: 20%; margin-bottom: 35px;" src="./img/orgChart.png">
				</div> -->
				<div class="row">
					<div class="col-sm-12">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[0]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[0]["position"] ?>
						</strong><br><?php echo $orgChart[0]["name"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[1]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[1]["position"] ?>							
						</strong><br><?php echo $orgChart[1]["name"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[2]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[2]["position"] ?>							
						</strong><br><?php echo $orgChart[2]["name"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[3]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[3]["position"] ?>							
						</strong><br><?php echo $orgChart[3]["name"] ?></p>
					</div>
					<div class="col-sm-6">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[4]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[4]["position"] ?>							
						</strong><br><?php echo $orgChart[4]["name"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[5]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[5]["name"] ?></p>
					</div>
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[6]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[6]["name"] ?></p>
					</div>
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[7]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[7]["name"] ?></p>
					</div>
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[8]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[8]["name"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[9]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[9]["name"] ?></p>
					</div>
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[10]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[10]["name"] ?></p>
					</div>
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[11]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[11]["name"] ?></p>
					</div>
					<div class="col-sm-3">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[12]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[12]["name"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[13]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[13]["name"] ?></p>
					</div>
					<div class="col-sm-4">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[14]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[14]["name"] ?></p>
					</div>
					<div class="col-sm-4">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[15]["imgName"] ?>">
						<p class="jawatan"><?php echo $orgChart[15]["name"] ?></p>
					</div>
				</div>
				<div class="row am">
					<div class="col-sm-6">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[16]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[16]["position"] ?>
						</strong><br><?php echo $orgChart[16]["name"] ?></p>
					</div>
					<!-- <div class="col-sm-4">
						<p class="jawatan"><strong>PEKERJA AM</strong></p>
					</div> -->
					<div class="col-sm-6">
						<img class="profile-pict" src="./icon/<?php echo $orgChart[17]["imgName"] ?>">
						<p class="jawatan"><strong><?php echo $orgChart[17]["position"] ?>							
						</strong><br><?php echo $orgChart[17]["name"] ?></p>
					</div>
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