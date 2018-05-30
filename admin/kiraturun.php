<?php

session_start();

if ($_SESSION["token"] !== $_GET["token"] ){
	header("Location: /admin/"); 
	exit();
}

require __DIR__ . '/../util/config.php';
require __DIR__ . '/../util/db.php';

$countDownPt3 = "";
$countDownSpm = "";

$db = new db();
$conn = $db->connect();

$sql  = "SELECT * FROM setting";

$stmt = $conn->prepare($sql);
$stmt->execute(); 

$result = $stmt->get_result(); 

if($result->num_rows !== 0) {
	while( $row = $result->fetch_assoc() ) {
		$countDownPt3 = $row["pt3CountDown"];
		$countDownSpm = $row["spmCountDown"];
	}
}

$stmt->close();
$conn->close();


$format = 'M j, Y';
$datept3 = $countDownPt3;
$dateSpm = $countDownSpm;
 
$date = DateTime::createFromFormat($format , $countDownPt3);
$newDatePt3 = $date->format('Y-m-d');

$date = DateTime::createFromFormat($format , $countDownSpm);
$newDateSpm = $date->format('Y-m-d');

?>


<!DOCTYPE html>
<html>
<head>
	<title>SMIAH | Dashboard Admin</title>

	<!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./css/main.css" rel="stylesheet">
</head>
<body>

	<header>
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">SMIAH Dashboard</a>
			</div>
			<div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Admin</a></li>
					<li><a href="controller.php?action=logkeluar">Keluar</a></li>
				</ul>
			</div>
		</div>
	</header>

	<div class="sidenav">
		<a href="kiraturun.php?token=<?php echo $_SESSION['token'] ?>" class="active">Kiraturun Peperiksaan</a>
		<a href="cemerlang_pt3.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang PT3</a>
		<a href="cemerlang_spm.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang SPM</a>
		<a href="cemerlang_pelajar.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang Sekolah</a>
		<a href="carta_organisasi.php?token=<?php echo $_SESSION['token'] ?>">Carta Organisasi</a>
		<a href="galeri.php?token=<?php echo $_SESSION['token'] ?>">Galeri</a>	
	</div>

	<div class="main">
		<div class="container">
			<div class="row">
				<div class="content-box">
					<h3>Tarikh Peperiksaan Tingkatan 3 (PT3)</h3>
					<form action="controller.php" method="post" id="pt3Form">
						<input type="date" name="tarikh" value="<?php echo $newDatePt3 ?>">
						<input type="hidden" name="action" value="setPT3">						
					</form>
					<hr>
					<button type="submit" form="pt3Form" class="button_style">Simpan</button>						
				</div>
				<hr>
				<div class="content-box">
					<h3>Tarikh Peperiksaan Sijil Pelajaran Malaysia (SPM)</h3>
					<form action="controller.php" method="post" id="spmForm">
						<input type="date" name="tarikh" value="<?php echo $newDateSpm ?>">
						<input type="hidden" name="action" value="setSPM">
					</form>
					<hr>
					<button type="submit" form="spmForm" class="button_style">Simpan</button>						
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>