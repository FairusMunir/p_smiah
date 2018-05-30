<?php

session_start();

if ($_SESSION["token"] !== $_GET["token"] ){
	header("Location: /admin/"); 
	exit();
}

require __DIR__ . '/../util/config.php';
require __DIR__ . '/../util/db.php';

$pt3Student = array();

$db = new db();
$conn = $db->connect();

$sqlpt3  = "SELECT * FROM pt3 ORDER BY year";

$stmtpt3 = $conn->prepare($sqlpt3);
$stmtpt3->execute(); 

$resultpt3 = $stmtpt3->get_result(); 

if($resultpt3->num_rows !== 0) {
	while( $row = $resultpt3->fetch_assoc() ) {
		array_push($pt3Student,$row);
	}
}

$stmtpt3->close();
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
		<a href="cemerlang_pt3.php?token=<?php echo $_SESSION['token'] ?>" class="active">Pelajar Cemerlang PT3</a>
		<a href="cemerlang_spm.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang SPM</a>
		<a href="cemerlang_pelajar.php?token=<?php echo $_SESSION['token'] ?>">Pelajar Cemerlang Sekolah</a>
		<a href="carta_organisasi.php?token=<?php echo $_SESSION['token'] ?>">Carta Organisasi</a>
		<a href="galeri.php?token=<?php echo $_SESSION['token'] ?>">Galeri</a>
	</div>

	<div class="main">
		<div>
			<div class="container">
				<div class="row">
					<h3>Peperiksaan Menengah Rendah (PT3)</h3>
					<table class="table table-bordered">
						<thead>
						    <tr>
							    <th scope="col">BIL</th>
							    <th scope="col">NAMA CALON</th>
							    <th scope="col">TAHUN</th>
							    <th scope="col">GRED</th>
							    <th scope="col"></th>
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
								    <td>
								    	<form action="controller.php" method="post">
								    		<input type="hidden" name="action" value="deletePT3">
								    		<input type="hidden" name="idPelajar" value="<?php echo $pt3Student[$i]["studentId"] ?>">
								    		<button type="submit" class="btn btn-default">
          										<span class="glyphicon glyphicon-trash"></span>
        									</button>
								    	</form>
								    </td>
							    </tr>							    
							<?php
							}
							?>
						</tbody>						
					</table>

					<button type="button" class="button_style" data-toggle="modal" data-target="#cemerlang_pt3" style="float: right;">Tambah Pelajar</button>
					<!-- Modal -->
					  <div class="modal fade" id="cemerlang_pt3" role="dialog">
					    <div class="modal-dialog modal-lg">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Pelajar Cemerlang PT3</h4>
					        </div>
					        <div class="modal-body">
					          <form class="form-horizontal" action="controller.php" method="post">
							    <div class="form-group">
							      <label class="control-label col-sm-2" for="nama">Nama:</label>
							      <div class="col-sm-8">
							        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama pelajar" name="nama" required>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-sm-2" for="tahun">Tahun:</label>
							      <div class="col-sm-8">          
							        <input type="number" class="form-control" name="tahun" id="tahun" placeholder="Tahun peperiksaan" name="tahun" required>
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-sm-2" for="gred">Gred:</label>
							      <div class="col-sm-8">          
							        <input type="text" class="form-control" name="gred" id="gred" placeholder="Gred peperiksaan" name="gred" required>
							        <input type="hidden" name="action" value="addPT3">
							      </div>
							    </div>
							    <div class="form-group">        
							      <div class="col-sm-offset-2 col-sm-10">
							        <button type="submit" class="button_style">Hantar</button>
							      </div>
							    </div>
							  </form>
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					        </div>
					      </div>
					    </div>
					  </div>
				</div>
			</div>
		</div>
	</div>


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>