<?php

session_start();

require __DIR__ . '/../util/config.php';
require __DIR__ . '/../util/db.php';

$action = "";

if ( isset($_POST["action"]) ){
	$action = $_POST["action"];
} else if ( isset($_GET["action"]) ){
	$action = $_GET["action"];
} else {
	header("Location: /admin/kiraturun.php?token=".$_SESSION["token"]); 
	exit();
}


//req process here
if ($action === "orgchart"){

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

	$target_dir = "../icon/";
	
	for ($i=0 ; $i<18 ; $i++){

		if ( $_FILES["img_".strval($i)]["name"] !== "" ){

			if ($orgChart[$i]["imgName"] !== "profile.jpg"){
				$link = "../icon/".$orgChart[$i]["imgName"];			
				unlink($link);				
			}

			//get name
			$string = explode('.', $_FILES["img_".strval($i)]["name"]);
			$target_file = $target_dir . "img_dp_" . strval($i) . "." .$string[ count($string)-1 ];

			move_uploaded_file($_FILES["img_".strval($i)]["tmp_name"], $target_file);

			$sql  = "UPDATE orgchart SET imgName = ? WHERE orgChartId = ?";

			$stmtImg = $conn->prepare($sql);
			$stmtImg->bind_param("si", $imgName, $orgChartId );

			$imgName    = "img_dp_" . strval($i) . "." .$string[ count($string)-1 ];
			$orgChartId = $i+1;

			$stmtImg->execute();	
			$stmtImg->close();
		}

		if ( $_POST["name_".strval($i)] !==  $orgChart[$i]["name"] ){

			$sql  = "UPDATE orgchart SET name = ? WHERE orgChartId = ?";

			$stmtName = $conn->prepare($sql);
			$stmtName->bind_param("si", $name, $orgChartId );

			$name       = $_POST["name_".strval($i)];
			$orgChartId = $i+1;

			$stmtName->execute();
			$stmtName->close();
		}			
	}

	$stmt->close();
	$conn->close();

	header("Location: /admin/carta_organisasi.php?token=".$_SESSION["token"]); 
	exit();
} else if ($action === "pelajarcemerlang"){
	//var_dump($_FILES);

	$db = new db();
	$conn = $db->connect();

	// echo '<pre>' . var_export($_FILES["pelajarcemerlang"], true) . '</pre>';

	// echo "<br><br>";

	$target_dir = "../img/";

	for ( $i=0 ; $i < count($_FILES["pelajarcemerlang"]["name"]) ; $i++){

		//explode so that i get the name in array, where everything is split with "."
		$fileName    = explode('.', $_FILES["pelajarcemerlang"]["name"][$i]);
		$url     = "profil_" . time() ."_". $fileName[ count($fileName)-2 ]. "." .$fileName[ count($fileName)-1 ];
		$target_file = $target_dir . $url;

		$status = move_uploaded_file($_FILES["pelajarcemerlang"]["tmp_name"][$i], $target_file);

		$sql  = "INSERT INTO alumni (imgName, url) VALUES (?, ?)";
		if ($status){
			$stmtImg = $conn->prepare($sql);
			$stmtImg->bind_param("ss", $imgName, $url );

			$string  = explode ('.',$url);
			$imgName = $string[ count($string)-2 ];

			$stmtImg->execute();	
			$stmtImg->close();
		}
	}
	
	$conn->close();

	header("Location: /admin/cemerlang_pelajar.php?token=".$_SESSION["token"]); 
	exit();
} else if ($action === "galeri"){

	$eventName = $_POST["activiti"];
	echo $eventName."<br>";
	echo $_POST["tarikh"]."<br>";	

	//get the year and month
	$year  = intval ( date( "Y", strtotime($_POST["tarikh"]) ) );
	$month = date( "F", strtotime($_POST["tarikh"]) );
	$monthId = 0;

	$db = new db();
	$conn = $db->connect();

	$target_dir = "../img/galeri/";	

	//month in malay and monthId
	switch ($month) {
		case "January":
			$month   = "Januari";
			$monthId = 1;
			break;
		case "February":
			$month   = "Februari";
			$monthId = 2;
			break;
		case "March":
			$month   = "Mac";
			$monthId = 3;
			break;
		case "April":
			$month   = "April";
			$monthId = 4;
			break;
		case "May":
			$month   = "Mei";
			$monthId = 5;
			break;
		case "June":
			$month   = "Jun";
			$monthId = 6;
			break;
		case "July":
			$month   = "Julai";
			$monthId = 7;
			break;
		case "August":
			$month    = "Ogos";
			$$monthId = 8;
			break;
		case "September":
			$month   = "September";
			$monthId = 9;
			break;
		case "October":
			$month   = "Oktober";
			$monthId = 10;
			break;
		case "November":
			$month   = "November";
			$monthId = 11;
			break;
		case "December":
			$month   = "Disember";
			$monthId = 12;
			break;
	}

	//check if the year month already in the database
	$sqlReg = "SELECT * FROM gallery_reg WHERE yearInt=? and monthId=?";
	$stmtReg = $conn->prepare($sqlReg);

	$stmtReg->bind_param("ii", $year, $monthId);
	$stmtReg->execute(); 

	$resultReg = $stmtReg->get_result(); 

	$yearId = 0;

	//create if there not found if found, retrieve the yearId
	if($resultReg->num_rows !== 0) {
		while( $row = $resultReg->fetch_assoc() ) {
			$yearId = $row["yearId"];
		}

	} else {

		$sql  = "INSERT INTO gallery_reg (yearInt, month, monthId) VALUES (?, ?, ?)";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("isi", $year, $month, $monthId);		

		$stmt->execute();	

		$yearId = $conn->insert_id;
		
		$stmt->close();
	}

	//register event
	$sqlActivity  = "INSERT INTO gallery_events (eventName, yearId) VALUES (?, ?)";

	$stmtActivity = $conn->prepare($sqlActivity);
	$stmtActivity->bind_param("si", $eventName, $yearId);

	$stmtActivity->execute();

	$eventId = $conn->insert_id;	

	$stmtActivity->close();
	//==================================================================================//


	//CnP from alumni pelajar cemerlang
	for ( $i=0 ; $i < count($_FILES["galeri"]["name"]) ; $i++){

		//explode so that i get the name in array, where everything is split with "."
		$fileName    = explode('.', $_FILES["galeri"]["name"][$i]);
		$url         = strval($year)."_".str_replace(' ', '', $eventName) ."_". time() ."_". $fileName[ count($fileName)-2 ]. "." .$fileName[ count($fileName)-1 ];
		$target_file = $target_dir . $url;

		$status = move_uploaded_file($_FILES["galeri"]["tmp_name"][$i], $target_file);

		$sql  = "INSERT INTO gallery_imgs (eventId, imgName) VALUES (?, ?)";
		if ($status){
			$stmtImg = $conn->prepare($sql);
			$stmtImg->bind_param("is", $eventId, $url);

			$stmtImg->execute();	
			$stmtImg->close();
		}
	}

	$conn->close();
	header("Location: /admin/galeri.php?token=".$_SESSION["token"]); 
	exit();
} else if ($action === "deletePT3" or $action === "deleteSPM"){
	$db = new db();
	$conn = $db->connect();

	$studentId = intval( $_POST["idPelajar"] );
	
	$sql = "DELETE FROM pt3 WHERE studentId = ?";

	if ($action === "deleteSPM")
		$sql = "DELETE FROM spm WHERE studentId = ?";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $studentId);		

	$stmt->execute();	
	
	$stmt->close();
	$conn->close();

	if ($action === "deleteSPM")
		header("Location: /admin/cemerlang_spm.php?token=".$_SESSION["token"]); 
	else
		header("Location: /admin/cemerlang_pt3.php?token=".$_SESSION["token"]); 
	exit();
} else if ($action === "addPT3" or $action === "addSPM"){

	$db = new db();
	$conn = $db->connect();

	echo $nama  = $_POST["nama"];
	echo $tahun = intval( $_POST["tahun"] );
	echo $gred  = $_POST["gred"]; 

	$sql  = "INSERT INTO pt3 (studentName, year, gred) VALUES (?, ?, ?)";

	if ($action === "addSPM")
		$sql  = "INSERT INTO spm (studentName, year, gred) VALUES (?, ?, ?)";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sis", $nama, $tahun, $gred);		

	$stmt->execute();	
	
	$stmt->close();
	$conn->close();

	if ($action === "addSPM")
		header("Location: /admin/cemerlang_spm.php?token=".$_SESSION["token"]); 
	else
		header("Location: /admin/cemerlang_pt3.php?token=".$_SESSION["token"]); 
	exit();
} else if ($action === "setPT3" or $action === "setSPM"){

	$db = new db();
	$conn = $db->connect();

	//Oct 8, 2018	
	$month = date( "M", strtotime($_POST["tarikh"]) );
	$date  = date( "j", strtotime($_POST["tarikh"]) );
	$year  = date( "Y", strtotime($_POST["tarikh"]) );

	$date  = $month." ".$date.", ".$year;

	$sql  = "UPDATE setting SET pt3CountDown = ? WHERE settingId = 1";

	if ($action === "setSPM")
		$sql  = "UPDATE setting SET spmCountDown = ? WHERE settingId = 1";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", trim($date) );		

	$stmt->execute();	
	
	$stmt->close();
	$conn->close();
	header("Location: /admin/kiraturun.php?token=".$_SESSION["token"]); 
	exit();
} else if ($action === "logmasuk"){	

	$db = new db();
	$conn = $db->connect();

	$salt  = "1qaz@WSX";
	$key   = $_POST["key"];
	$email = $_POST["email"];

	$hashedPass = strval( hash("sha256",$key).$salt ) ;

	$sql = "SELECT * FROM users WHERE email = ? AND password = ?";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $hashedPass);

	$stmt->execute(); 

	$result = $stmt->get_result();

	$bytes = "";

	if($result->num_rows !== 0) {
		$stmt->close();
		$conn->close();
		$bytes = bin2hex( random_bytes(20) );

	} else {
		$stmt->close();
		$conn->close();
		header("Location: /admin/"); 
		exit();
	}

	$_SESSION["token"] = $bytes;

	header("Location: /admin/kiraturun.php?token=" . $bytes ); 
	exit();
} else if ($action === "logkeluar"){
	$_SESSION = array();
	session_destroy();
	header("Location: /admin/"); 
}