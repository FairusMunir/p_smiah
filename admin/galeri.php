<?php 
session_start();

if ($_SESSION["token"] !== $_GET["token"] ){
	header("Location: /admin/"); 
	exit();
}
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
		<a href="cemerlang_pelajar.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang Sekolah</a>
		<a href="carta_organisasi.php?token=<?php echo $_SESSION['token'] ?>">Carta Organisasi</a>
		<a href="galeri.php?token=<?php echo $_SESSION['token'] ?>" class="active">Galeri</a>
	</div>

	<div class="main">
		<div>
			<div class="container">
				<div class="row">
					<div class="content-box">
						<h3>Galeri</h3><hr>
						<form class="form-horizontal" action="controller.php" method="post" id="form_gallery" enctype="multipart/form-data">
						    <div class="form-group">
							    <label class="control-label col-sm-2" for="tarikh">Tarikh Aktiviti:</label>
								<div class="col-sm-10">
								    <input type="date" class="form-control" id="tarikh" name="tarikh">
								</div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-2" for="aktiviti">Nama Aktiviti:</label>
							    <div class="col-sm-10">          
							        <input type="text" class="form-control" id="aktiviti" placeholder="Nama Aktiviti" name="activiti">
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-2" for="gambar">Gambar:</label>
							    <div class="col-sm-10">          
							        <input type="file" class="form-control" name="galeri[]" id="gambar" accept="image/*" multiple>
							        <input type="hidden" name="action" value="galeri">
							    </div>
							</div>
							<hr>
							<button type="submit" form="form_gallery" class="button_style">Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>