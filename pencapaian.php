<?php

require __DIR__ . './util/config.php';
require __DIR__ . './util/db.php';

$pt3Student     = array();
$spmStudent     = array();
$alumniStudent  = array();

$db = new db();
$conn = $db->connect();

$sqlpt3  = "SELECT * FROM pt3 ORDER BY year";
$sqlspm  = "SELECT * FROM spm ORDER BY year";
$alumni  = "SELECT * FROM alumni";

$stmtpt3 = $conn->prepare($sqlpt3);
$stmtpt3->execute(); 

/* instead of bind_result */
$resultpt3 = $stmtpt3->get_result(); 

if($resultpt3->num_rows !== 0) {
	while( $row = $resultpt3->fetch_assoc() ) {
		array_push($pt3Student,$row);
	}
}

$stmtspm = $conn->prepare($sqlspm);
$stmtspm->execute();       	

/* instead of bind_result */
$resultspm = $stmtspm->get_result(); 

if($resultspm->num_rows !== 0) {
	while( $row = $resultspm->fetch_assoc() ) {
		array_push($spmStudent,$row);
	}
}

$stmtalumni = $conn->prepare($alumni);
$stmtalumni->execute();       	

/* instead of bind_result */
$resultalumni = $stmtalumni->get_result(); 

if($resultalumni->num_rows !== 0) {
	while( $row = $resultalumni->fetch_assoc() ) {
		array_push($alumniStudent,$row);
	}
}

$stmtalumni->close();
$stmtpt3->close();
$stmtspm->close();
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SMIAH | Pencapaian</title>
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
					<h1>PENCAPAIAN</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="sect-content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<h3>Pencapaian Pelajar</h3>
					<p>Kejayaan sesuatu program itu selalunya diukur dari pencapaian yang diperolehi oleh pelajar-pelajar yang mengikuti program berkenaan. Dalam hal program tarbiyyah Sekolah Menengah Islam Al-Husna juga terikat kepada telahan ini. Kalau inilah sahaja yang diambil sebagai ukuran, maka kita hanya mengukur pencapaian dari satu aspek sahaja. Kita tidak akan mengambil pertimbangan tentang akhlak, ruhiyah dan persepsi pelajar lulusan Sekolah Menengah Islam Al-Husna.</p>
					<p>Cuma yang dapat dikatakan bahawa setiap pelajar yang lulus dari program tarbiyyah Sekolah Menengah Islam Al-Husna, dari aspek Ad-Dien (mereka mengambil dua jurusan iaitu ad-dien dan sains tulen atau ad-dien dan sastera) mereka sudah lulus peperiksaan kelolaan Lembaga Peperiksaan Malaysia. Selain dari itu mereka juga sudah lulus Peperiksaan Sijil Menengah Agama (SMA). Dari dua pencapaian ini secara kebendaan mereka sudah mampu mengikuti pengajian jurusan Ad-Dien di mana-man kolej, IPTA atau IPTS di dalam dan luar negeri.</p>
					<p>Selain dari itu mereka telah menghafal sekurang-kurangnya lima juz Al-Quran. Kalau mereka gagal dalam matapelajaran Hifz Al-Quran dan Al-Hadith mereka tidak akan memperolehi kebenaran untuk menduduki peperiksaan SMA dan SPM. Setiap pelajar yang lulus dari Sekolah Menengah Islam Al-Husna mempunyai kemampuan ini sama ada pelajar itu mengambil jurusan Sains Tulen atau Sastera.</p>

					<h3>Peperiksaan Menengah Rendah (PT3)</h3>
					<table class="table table-bordered">
						<thead>
						    <tr>
							    <th scope="col">BIL</th>
							    <th scope="col">NAMA CALON</th>
							    <th scope="col">TAHUN</th>
							    <th scope="col">GRED</th>
						    </tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0 ; $i<sizeof($pt3Student) ; $i++){
							?>
								<tr>
								    <td><?php echo $i+1 ?></td>
								    <td><?php echo $pt3Student[$i]["studentName"] ?></td>
								    <td><?php echo $pt3Student[$i]["year"] ?></td>
								    <td><?php echo $pt3Student[$i]["gred"] ?></td>
							    </tr>							    
							<?php
							}
							?>
						</tbody>
					</table>

					<h3>Sijil Peperiksaan Malaysia (SPM)</h3>
					<table class="table table-bordered">
						<thead>
						    <tr>
							    <th scope="col">BIL</th>
							    <th scope="col">NAMA CALON</th>
							    <th scope="col">TAHUN</th>
							    <th scope="col">GRED</th>
						    </tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0 ; $i<sizeof($spmStudent) ; $i++){
							?>
								<tr>
								    <td><?php echo $i+1 ?></td>
								    <td><?php echo $spmStudent[$i]["studentName"] ?></td>
								    <td><?php echo $spmStudent[$i]["year"] ?></td>
								    <td><?php echo $spmStudent[$i]["gred"] ?></td>
							    </tr>							    
							<?php
							}
							?>						    
						</tbody>
					</table>

					var_dump();

					<h3>Profil Pelajar Cemerlang SPM 2015 dan Profil Bekas Pelajar Al-Husna</h3>

					<?php 
					for ($i=0 ; $i<sizeof($alumniStudent) ; $i++){
					?>
						<div class="col-sm-4"><img style="width: 350px; height: auto;" src="./img/<?php echo $alumniStudent[$i]["url"]?>"></div>
					<?php
					}
					?>
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