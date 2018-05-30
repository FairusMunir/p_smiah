<?php

session_start();

if ($_SESSION["token"] !== $_GET["token"] ){
	header("Location: /admin/"); 
	exit();
}

require __DIR__ . '/../util/config.php';
require __DIR__ . '/../util/db.php';

$alumniStudent = array();

$db = new db();
$conn = $db->connect();

$alumni  = "SELECT * FROM alumni";

$stmtalumni = $conn->prepare($alumni);
$stmtalumni->execute(); 

$resultalumni = $stmtalumni->get_result(); 

if($resultalumni->num_rows !== 0) {
	while( $row = $resultalumni->fetch_assoc() ) {
		array_push($alumniStudent,$row);
	}
}

$stmtalumni->close();
$conn->close();

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
		<a href="kiraturun.php?token=<?php echo $_SESSION['token'] ?>">Kiraturun Peperiksaan</a>
		<a href="cemerlang_pt3.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang PT3</a>
		<a href="cemerlang_spm.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang SPM</a>
		<a href="cemerlang_pelajar.php?token=<?php echo $_SESSION['token'] ?>" class="active">Pelajar Cemerlang Sekolah</a>
		<a href="carta_organisasi.php?token=<?php echo $_SESSION['token'] ?>">Carta Organisasi</a>
		<a href="galeri.php?token=<?php echo $_SESSION['token'] ?>">Galeri</a>
	</div>

	<div class="main">
		<div>
			<div class="container" id="student_top">
				<div class="row">
					<h3>Profil Pelajar Cemerlang SPM 2015 dan Profil Bekas Pelajar Al-Husna</h3>
					<?php 
					for ($i=0 ; $i<sizeof($alumniStudent) ; $i++){
					?>
						<div class="col-sm-4"><img style="width: 350px; height: auto;" src="../img/<?php echo $alumniStudent[$i]["url"]?>"></div>
					<?php
					}
					?>
					
					<div class="col-sm-4">
						<div class="up_img">
						 	<form action="controller.php" method="post" enctype="multipart/form-data">						
								<input type="file" name="pelajarcemerlang[]" accept="image/*" type="file" multiple="multiple">
								<input type="hidden" name="action" value="pelajarcemerlang">						
								<button type="submit" class="button_style" style="margin-right: 10px;">Simpan</button>		
								<p><small>*Maximum size of image is 2MB</small></p>
							</form>			

						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script >
    	function readURL(input,imgId) {
			if (input.files && input.files[0]) {
			    var reader = new FileReader();

			    reader.onload = function(e) {
			      $(imgId).attr('src', e.target.result);
			    }

			    reader.readAsDataURL(input.files[0]);
			}
		}

		$("#img_0").change(function() {
			  readURL(this,"#imgInp_0");
		});
    </script>
</body>
</html>