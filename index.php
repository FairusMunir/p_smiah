<?php

require __DIR__ . './util/config.php';
require __DIR__ . './util/db.php';

$pt3CountDown = "";
$spmCountDown = "";

$db = new db();
$conn = $db->connect();

$sql  = "SELECT * FROM setting WHERE settingId = ?";
$settingId = 1;

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $settingId);

$stmt->execute();    	

/* instead of bind_result */
$result = $stmt->get_result(); 

if($result->num_rows !== 0) {
	while( $row = $result->fetch_assoc() ) {
		$pt3CountDown = $row["pt3CountDown"];
		$spmCountDown = $row["spmCountDown"];
	}
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SMIAH | Laman Utama</title>
	<link rel="shortcut icon" href="./icon/smiah-favicon.ico" type="image/x-icon">
	<link rel="icon" href="./icon/smiah-favicon.ico" type="image/x-icon">
	
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link href="./css/main.css" rel="stylesheet">
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/font-awesome.min.css" rel="stylesheet">
	<script src="js/jssor.slider-27.0.3.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:-1,d:1,o:-0.7}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $Cols: 1,
              $Align: 0,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            var MAX_WIDTH = 3000;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        };
    </script>

    <style>
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .jssorb032 {position:absolute;}
        .jssorb032 .i {position:absolute;cursor:pointer;}
        .jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
        .jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .i.idn {opacity:.3;}

        /*jssor slider arrow skin 051 css*/
        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>

</head>
<body style="background-image: url(./img/background.jpg);">

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="row">
				<div class="navbar-header">
			  		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navbar">
			  			<span class="icon-bar"></span>
			  			<span class="icon-bar"></span>
			  			<span class="icon-bar"></span>
			  		</button>
			  		<span class="navbar-brand"><a href="/"><img src="./img/logo-insaniah.png"></a></span>
			  	</div>

			  	<div class="collapse navbar-collapse" id="top-navbar">
			  		<ul class="nav navbar-nav navbar-right">
			  			<li class="dropdown">
			  				<a href="/" class="dropdown-toggle" style="text-transform: uppercase;">Utama</a>
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

	<header>
		<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
		    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
	            <div data-p="225.00">
	                <img data-u="image" src="./img/header5.jpg" />
	            </div>
	            <div data-p="225.00">
	                <img data-u="image" src="./img/header2.jpg" />
	            </div>
	            <div data-p="225.00">
	                <img data-u="image" src="./img/header4.jpg" />
	            </div>
	        </div>
	        <div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
	            <div data-u="prototype" class="i" style="width:16px;height:16px;">
	                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
	                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
	                </svg>
	            </div>
	        </div>
	        <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
	            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
	                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
	            </svg>
	        </div>
	        <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
	            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
		            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
	            </svg>
			</div>
	    </div>
	</header>

	<section class="sect-main">
		<div class="container">
			<div class="row">
				<h2 class="big-subtitle">SEKOLAH MENENGAH ISLAM AL-HUSNA</h2>
				<p class="big-content">
					Sekolah Menengah Islam Al-Husna atau nama singkatnya SMI Al-Husna adalah sebuah wadah Tarbiyyah Islamiyah yang ditegakkan atas dasar kesedaran tentang keperluan ummah akan satu program pendidikan yang menyepadukan secara kental dan tegar, secara kamil dan mantap aqidah yang murni dan amalan yang soleh di dalam kehidupan sehari-harian di dunia ini. Sekolah Menengah Islam Al-Husna merupakan sebuah sekolah Islam swasta berasrama penuh. Sekolah ini ditubuhkan pada tahun 1995 oleh Prof Dr Zakaria Bin Awang Soh dan telah beroperasi selama 18 tahun. Dasar tarbiyyah adalah berasaskan Al-Quran dan As-Sunnah.
				</p>

				<h3 class="big-subtitle" id="fertigo"><i>MOTO</i></h3>
				<p class="big-content">Melahirkan insan yang kamil dan muttaqin.</p>

				<h3 class="big-subtitle" id="fertigo"><i>VISI</i></h3>
				<p class="big-content">
					Menjadi institusi pendidikan yang terunggul dalam membentuk masyarakat beriman dan berakhlak mulia.
				</p>

				<h3 class="big-subtitle" id="fertigo"><i>MISI</i></h3>
				<p class="big-content">
					Mewujudkan kesepaduan ilmu naqli dan aqli. Bertunjangkan aqidah murni dalam kamilan iman, ilmu dan amal.
				</p>
			</div>
		</div>
	</section>

	<section class="sect0">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-sm-offset-2 pt3-count">
					<h2>PT3</h2>
					<div class="countdown" id="js-countdown">
					    <div class="countdown__item countdown__item--large">
					      <div class="countdown__timer js-countdown-days" aria-labelledby="day-countdown">
					      </div>
					      <div class="countdown__label" id="day-countdown">Hari</div>
					    </div>
					    
					    <div class="countdown__item">
					      <div class="countdown__timer js-countdown-hours" aria-labelledby="hour-countdown">
					      </div>
					      <div class="countdown__label" id="hour-countdown">Jam</div>
					    </div>
					    
					    <div class="countdown__item">
					      <div class="countdown__timer js-countdown-minutes" aria-labelledby="minute-countdown">
					      </div>
					      <div class="countdown__label" id="minute-countdown">Minit</div>
					    </div>
					    
					    <div class="countdown__item">
					      <div class="countdown__timer js-countdown-seconds" aria-labelledby="second-countdown">
					      </div>
					      <div class="countdown__label" id="second-countdown">Saat</div>
					    </div>
					  </div>
				</div>
				<div class="col-xs-12 col-sm-4 spm-count">
					<h2>SPM</h2>
					<div class="countdown" id="js-countdown1">
					    <div class="countdown__item countdown__item--large">
					      <div class="countdown__timer js-countdown-days1" aria-labelledby="day-countdown1">
					      </div>
					      <div class="countdown__label" id="day-countdown1">Hari</div>
					    </div>
					    
					    <div class="countdown__item">
					      <div class="countdown__timer js-countdown-hours1" aria-labelledby="hour-countdown1">
					      </div>
					      <div class="countdown__label" id="hour-countdown1">Jam</div>
					    </div>
					    
					    <div class="countdown__item">
					      <div class="countdown__timer js-countdown-minutes1" aria-labelledby="minute-countdown1">
					      </div>
					      <div class="countdown__label" id="minute-countdown1">Minit</div>
					    </div>
					    
					    <div class="countdown__item">
					      <div class="countdown__timer js-countdown-seconds1" aria-labelledby="second-countdown1">
					      </div>
					      <div class="countdown__label" id="second-countdown1">Saat</div>
					    </div>
					  </div>
				</div>
			</div>
		</div>
	</section>

	<section class="sect2">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<h3>KURIKULUM</h3>
					<a href="kurikulum.php"><img align="center" src="./img/kurikulum1.jpg"></a>
				</div>
				<div class="col-xs-12 col-sm-4">
					<h3>KOKURIKULUM</h3>
					<a href="kokurikulum.php"><img src="./img/kokurikulum4.jpg"></a>
				</div>
				<div class="col-xs-12 col-sm-4">
					<h3>KEMUDAHAN</h3>
					<a href="kemudahan.php"><img src="./img/kemudahan2.jpg"></a>
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
					<a href="https://www.facebook.com/smihusna"><strong>facebook</strong></a>
				</span>
			</div>
		</div>
	</footer>



	<script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">jssor_1_slider_init();</script>
    
    <!-- PT3 -->
	<script>

		const countdown = new Date("<?php echo $pt3CountDown ?>");

		function getRemainingTime(endtime) {
		  const milliseconds = Date.parse(endtime) - Date.parse(new Date());
		  const seconds = Math.floor( (milliseconds/1000) % 60 );
		  const minutes = Math.floor( (milliseconds/1000/60) % 60 );
		  const hours = Math.floor( (milliseconds/(1000*60*60)) % 24 );
		  const days = Math.floor( milliseconds/(1000*60*60*24) );

		  return {
		    'total': milliseconds,
		    'seconds': seconds,
		    'minutes': minutes,
		    'hours': hours,
		    'days': days,
		  };
		}
		  
		function initClock(id, endtime) {
		  const counter = document.getElementById(id);
		  const daysItem = counter.querySelector('.js-countdown-days');
		  const hoursItem = counter.querySelector('.js-countdown-hours');
		  const minutesItem = counter.querySelector('.js-countdown-minutes');
		  const secondsItem = counter.querySelector('.js-countdown-seconds');

		  function updateClock() {
		    const time = getRemainingTime(endtime);

		    daysItem.innerHTML = time.days;
		    hoursItem.innerHTML = ('0' + time.hours).slice(-2);
		    minutesItem.innerHTML = ('0' + time.minutes).slice(-2);
		    secondsItem.innerHTML = ('0' + time.seconds).slice(-2);

		    if (time.total <= 0) {
		      clearInterval(timeinterval);
		    }
		  }

		  updateClock();
		  const timeinterval = setInterval(updateClock, 1000);
		}

		initClock('js-countdown', countdown);
	</script>

	<!-- SPM -->
	<script>		
		const countdown1 = new Date("<?php echo $spmCountDown ?>");

		function getRemainingTime(endtime1) {
		  const milliseconds1 = Date.parse(endtime1) - Date.parse(new Date());
		  const seconds1 = Math.floor( (milliseconds1/1000) % 60 );
		  const minutes1 = Math.floor( (milliseconds1/1000/60) % 60 );
		  const hours1 = Math.floor( (milliseconds1/(1000*60*60)) % 24 );
		  const days1 = Math.floor( milliseconds1/(1000*60*60*24) );

		  return {
		    'total': milliseconds1,
		    'seconds': seconds1,
		    'minutes': minutes1,
		    'hours': hours1,
		    'days': days1,
		  };
		}
		  
		function initClock(id, endtime1) {
		  const counter = document.getElementById(id);
		  const daysItem1 = counter.querySelector('.js-countdown-days1');
		  const hoursItem1 = counter.querySelector('.js-countdown-hours1');
		  const minutesItem1 = counter.querySelector('.js-countdown-minutes1');
		  const secondsItem1 = counter.querySelector('.js-countdown-seconds1');

		  function updateClock1() {
		    const time1 = getRemainingTime(endtime1);

		    daysItem1.innerHTML = time1.days;
		    hoursItem1.innerHTML = ('0' + time1.hours).slice(-2);
		    minutesItem1.innerHTML = ('0' + time1.minutes).slice(-2);
		    secondsItem1.innerHTML = ('0' + time1.seconds).slice(-2);

		    if (time1.total <= 0) {
		      clearInterval(timeinterval1);
		    }
		  }

		  updateClock1();
		  const timeinterval1 = setInterval(updateClock1, 1000);
		}

		initClock('js-countdown1', countdown1);
	</script>
	
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

</body>
</html>