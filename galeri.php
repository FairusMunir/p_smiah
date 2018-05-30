<?php

require __DIR__ . './util/config.php';
require __DIR__ . './util/db.php';

$gallery_reg = array();

$db = new db();
$conn = $db->connect();

$sql  = "SELECT * FROM gallery_reg ORDER BY yearInt, monthId";

$stmt = $conn->prepare($sql);

$stmt->execute();    	

/* instead of bind_result */
$result = $stmt->get_result(); 

if($result->num_rows !== 0) {
	while( $row = $result->fetch_assoc() ) {
		array_push($gallery_reg, $row);
	}
}

$stmt->close();
$conn->close();

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
					<h3>Galeri</h3>
					<div class="panel-group" id="accordion">

						<?php
						$yearInt = "";

						for ( $i=0 ; $i<count($gallery_reg) ; ){
							if ($gallery_reg[$i]["yearInt"] !== $yearInt) {
								$yearInt = $gallery_reg[$i]["yearInt"];
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
						        		<h4 class="panel-title">
						         			<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo '_'.$gallery_reg[$i]["yearInt"];?>">
						         				<h4><b> <?php echo $gallery_reg[$i]["yearInt"]; ?> </b></h4>
						         			</a>
						        		</h4>
						      		</div>	

						      		<div id="<?php echo '_'.$gallery_reg[$i]["yearInt"];?>" class="panel-collapse collapse">
								        <div class="panel-body">
								        	<ul style="list-style-type: none;">
								        		<?php
								        		while ($gallery_reg[$i]["yearInt"] === $yearInt) {
								        		?>								        		
								        				<li>
								        					<a href="galeri_view.php?id=<?php echo $gallery_reg[$i]["yearId"];?>">
								        						<?php echo $gallery_reg[$i]["month"];?>	
								        					</a>
								        				</li>
								        		<?php
								        			$i++;
								        		}
								        		?>								        		
								        	</ul>
								        </div>
					      			</div>							
					      		</div>
								<?php
							} 
						} 
						?>

					    <!-- <div class="panel panel-default">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><h4><b>2014</b></h4></a>
					        </h4>
					      </div>
					      <div id="collapse2" class="panel-collapse collapse">
					        <div class="panel-body">
					        	<ul style="list-style-type: none;">
					        		<li><a href="galeri2014_mei.html">Mei</a></li>
					        		<li><a href="galeri2014_sept.html">September</a></li>
					        		<li><a href="galeri2014_oct.html">Oktober</a></li>
					        	</ul>
					        </div>
					      </div>
					    </div> -->					   					   
					</div>

					<!-- <div class="col-sm-3">
						<a href=""><img class="img-responsive galery" src="./img/folder-icon.png"></a>
						<p style="text-decoration: none;color: #5e5a5b; margin: 0 auto;">Album 1</p>
					</div> -->
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

   <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

</body>
</html>