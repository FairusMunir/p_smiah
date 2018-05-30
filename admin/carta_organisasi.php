<?php

session_start();

if ($_SESSION["token"] !== $_GET["token"] ){
	header("Location: /admin/"); 
	exit();
}

require __DIR__ . '/../util/config.php';
require __DIR__ . '/../util/db.php';

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
	<title>SMIAH | Dashboard Admin</title>
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
		<a href="carta_organisasi.php?token=<?php echo $_SESSION['token'] ?>" class="active">Carta Organisasi</a>
		<a href="galeri.php?token=<?php echo $_SESSION['token'] ?>">Galeri</a>
	</div>

	<div class="main">
		<div class="sect-organisasi">
			<div class="container">
				<div class="row">
					<form action="controller.php" method="post" id="form_orgChart" enctype="multipart/form-data">
						<input type="hidden" name="action" value="orgchart">
						<h3>Carta Organisasi Sekolah</h3><hr>
						<div class="row">
							<div class="col-sm-12">
								<div class="upload-btn-wrapper">
									<img id="imgInp_0" class="profile-pict" src="../icon/<?php echo $orgChart[0]["imgName"] ?>">
									<input id="img_0" name="img_0" type="file" accept="image/*" >
								</div>	
								<strong>
									<!-- <input type="text" value="<?php echo $orgChart[0]["position"] ?>" > -->
									<br>
									<?php echo $orgChart[0]["position"] ?>
								</strong>
								<br><textarea name="name_0"><?php echo $orgChart[0]["name"] ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="upload-btn-wrapper">
									<img id="imgInp_1" class="profile-pict" src="../icon/<?php echo $orgChart[1]["imgName"] ?>">
									<input id="img_1" name="img_1" type="file" accept="image/*">
								</div>							
								<strong>
									<!-- <input type="text" value="<?php echo $orgChart[1]["position"] ?>"> -->
									<br>
									<?php echo $orgChart[1]["position"] ?>
								</strong>
								<br><textarea name="name_1"><?php echo $orgChart[1]["name"] ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="upload-btn-wrapper">
									<img id="imgInp_2" class="profile-pict" src="../icon/<?php echo $orgChart[2]["imgName"] ?>">
									<input id="img_2" name="img_2" type="file" accept="image/*">
								</div>	
								<strong>
									<!-- <input type="text" value="<?php echo $orgChart[2]["position"] ?>"> -->
									<br>
									<?php echo $orgChart[2]["position"] ?>
								</strong>
								<br><textarea name="name_2"><?php echo $orgChart[2]["name"] ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="upload-btn-wrapper">
									<img id="imgInp_3" class="profile-pict" src="../icon/<?php echo $orgChart[3]["imgName"] ?>">
									<input id="img_3" name="img_3" type="file" accept="image/*">
								</div>	
								<strong>
									<!-- <input type="text" value="<?php echo $orgChart[3]["position"] ?>"> -->
									<br>
									<?php echo $orgChart[3]["position"] ?>
								</strong>
								<br><textarea name="name_3"><?php echo $orgChart[3]["name"] ?></textarea>
							</div>
							<div class="col-sm-6">
								<div class="upload-btn-wrapper">
									<img id="imgInp_4" class="profile-pict" src="../icon/<?php echo $orgChart[4]["imgName"] ?>">
									<input id="img_4" name="img_4" type="file" accept="image/*">
								</div>	
								<strong>
									<!-- <input type="text" value="<?php echo $orgChart[4]["position"] ?>"> -->
									<br>
									<?php echo $orgChart[4]["position"] ?>
								</strong>
								<br><textarea name="name_4"><?php echo $orgChart[4]["name"] ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_5" class="profile-pict" src="../icon/<?php echo $orgChart[5]["imgName"] ?>">
									<input id="img_5" name="img_5" type="file" accept="image/*">
								</div>
								<textarea name="name_5"><?php echo $orgChart[5]["name"] ?></textarea>
							</div>
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_6" class="profile-pict" src="../icon/<?php echo $orgChart[6]["imgName"] ?>">
									<input id="img_6" name="img_6" type="file" accept="image/*">
								</div>
								<textarea name="name_6"><?php echo $orgChart[6]["name"] ?></textarea>
							</div>
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_7" class="profile-pict" src="../icon/<?php echo $orgChart[7]["imgName"] ?>">
									<input id="img_7" name="img_7" type="file" accept="image/*">
								</div>	
								<textarea name="name_7"><?php echo $orgChart[7]["name"] ?></textarea>
							</div>
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_8" class="profile-pict" src="../icon/<?php echo $orgChart[8]["imgName"] ?>">
									<input id="img_8" name="img_8" type="file" accept="image/*">
								</div>
								<textarea name="name_8"><?php echo $orgChart[8]["name"] ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_9" class="profile-pict" src="../icon/<?php echo $orgChart[9]["imgName"] ?>">
									<input id="img_9" name="img_9" type="file" accept="image/*">
								</div>
								<textarea name="name_9"><?php echo $orgChart[9]["name"] ?></textarea>
							</div>
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_10" class="profile-pict" src="../icon/<?php echo $orgChart[10]["imgName"] ?>">
									<input id="img_10" name="img_10" type="file" accept="image/*">
								</div>
								<textarea name="name_10"><?php echo $orgChart[10]["name"] ?></textarea>
							</div>
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_11" class="profile-pict" src="../icon/<?php echo $orgChart[11]["imgName"] ?>">
									<input id="img_11" name="img_11" type="file" accept="image/*">
								</div>
								<textarea name="name_11"><?php echo $orgChart[11]["name"] ?></textarea>
							</div>
							<div class="col-sm-3">
								<div class="upload-btn-wrapper">
									<img id="imgInp_12" class="profile-pict" src="../icon/<?php echo $orgChart[12]["imgName"] ?>">
									<input id="img_12" name="img_12" type="file" accept="image/*">
								</div>
								<textarea name="name_12"><?php echo $orgChart[12]["name"] ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="upload-btn-wrapper">
									<img id="imgInp_13" class="profile-pict" src="../icon/<?php echo $orgChart[13]["imgName"] ?>">
									<input id="img_13" name="img_13" type="file" accept="image/*">
								</div>
								<textarea name="name_13"><?php echo $orgChart[13]["name"] ?></textarea>
							</div>
							<div class="col-sm-4">
								<div class="upload-btn-wrapper">
									<img id="imgInp_14" class="profile-pict" src="../icon/<?php echo $orgChart[14]["imgName"] ?>">
									<input id="img_14" name="img_14" type="file" accept="image/*">
								</div>
								<textarea name="name_14"><?php echo $orgChart[14]["name"] ?></textarea>
							</div>
							<div class="col-sm-4">
								<div class="upload-btn-wrapper">
									<img id="imgInp_15" class="profile-pict" src="../icon/<?php echo $orgChart[15]["imgName"] ?>">
									<input id="img_15" name="img_15" type="file" accept="image/*">
								</div>
								<textarea name="name_15"><?php echo $orgChart[15]["name"] ?></textarea>
							</div>
						</div>
						<div class="row am">
							<div class="col-sm-6">
								<div class="upload-btn-wrapper">
									<img id="imgInp_16" class="profile-pict" src="../icon/<?php echo $orgChart[16]["imgName"] ?>">
									<input id="img_16" name="img_16" type="file" accept="image/*">
								</div>	
								<strong>
									<!-- <input type="text" value="PEKERJA AM"> -->
									<br>
									<?php echo $orgChart[16]["position"] ?>
								</strong>
								<br><textarea name="name_16"><?php echo $orgChart[16]["name"] ?></textarea>
							</div>
							<div class="col-sm-6">
								<div class="upload-btn-wrapper">
									<img id="imgInp_17" class="profile-pict" src="../icon/<?php echo $orgChart[17]["imgName"] ?>">
									<input id="img_17" name="img_17" type="file" accept="image/*">
								</div>	
								<strong>
									<!-- <input type="text" value="<?php echo $orgChart[17]["position"] ?>"> -->
									<br>
									<?php echo $orgChart[17]["position"] ?>
								</strong>
								<br><textarea name="name_17"><?php echo $orgChart[17]["name"] ?></textarea>
							</div>
						</div>
					</form>
				</div>
				<hr>
				<button type="submit" form="form_orgChart" class="button_style">Simpan</button>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
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
		$("#img_1").change(function() {
			  readURL(this,"#imgInp_1");
		});
		$("#img_2").change(function() {
			  readURL(this,"#imgInp_2");
		});
		$("#img_3").change(function() {
			  readURL(this,"#imgInp_3");
		});
		$("#img_4").change(function() {
			  readURL(this,"#imgInp_4");
		});
		$("#img_5").change(function() {
			  readURL(this,"#imgInp_5");
		});
		$("#img_6").change(function() {
			  readURL(this,"#imgInp_6");
		});
		$("#img_7").change(function() {
			  readURL(this,"#imgInp_7");
		});
		$("#img_8").change(function() {
			  readURL(this,"#imgInp_8");
		});
		$("#img_9").change(function() {
			  readURL(this,"#imgInp_9");
		});
		$("#img_10").change(function() {
			  readURL(this,"#imgInp_10");
		});
		$("#img_11").change(function() {
			  readURL(this,"#imgInp_11");
		});
		$("#img_12").change(function() {
			  readURL(this,"#imgInp_12");
		});
		$("#img_13").change(function() {
			  readURL(this,"#imgInp_13");
		});
		$("#img_14").change(function() {
			  readURL(this,"#imgInp_14");
		});
		$("#img_15").change(function() {
			  readURL(this,"#imgInp_15");
		});
		$("#img_16").change(function() {
			  readURL(this,"#imgInp_16");
		});
		$("#img_17").change(function() {
			  readURL(this,"#imgInp_17");
		});
    </script>
</body>
</html>