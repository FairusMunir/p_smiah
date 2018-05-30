<!DOCTYPE html>
<html>
<head>
	<title>SMIAH | Dashboard Admin</title>

	<!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./css/main.css" rel="stylesheet">
</head>
<body style="background-color: #34495e;">

	<section id="login">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
	        	    <div class="form-wrap">
	                <h1>Daftar Masuk</h1>
	                    <form role="form" action="controller.php" method="post" id="login-form" autocomplete="off">
	                        <div class="form-group">
	                            <label for="email" class="sr-only">Emel</label>
	                            <input type="email" name="email" id="email" class="form-control" placeholder="seseorang@contoh.com" required>
	                        </div>
	                        <div class="form-group">
	                            <label for="key" class="sr-only">Kata Laluan</label>
	                            <input type="password" name="key" id="key" class="form-control" placeholder="Kata Laluan" required>
	                            <input type="hidden" name="action" value="logmasuk">
	                        </div>
	                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Masuk">
	                    </form>
	                    <hr>
	        	    </div>
	    		</div>
			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>