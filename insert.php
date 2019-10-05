<?php 
 $email_id = $_POST['email_id'];
 $password = $_POST['password'];
 $rpassword = $_POST['rpassword'];

 if (!empty($email_id) || !empty($password) || !empty($rpassword)) {
 	$host = "localhost";
 	$dbUsername = "root";
 	$dbPassword = "";
 	$dbname = "forum";

 	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

 	if (mysqli_connect_error()) {
 		die('CONNECT ERROR (',mysqli_connect_errorno(), ')', mysqli_connect_error());
 	}
 	else{
 		$SELECT = "SELECT email_id From users Where email_id = ? Limit = 1";
 		$INSERT = "INSERT Into users (email_id, password, rpassword) values(?,?,?)";

 		$stmt = $conn->prepare($SELECT);
 		$stmt->bind_param("s", $email_id);
 		$stmt->execute();
 		$stmt->bind_result($email_id);
 		$stmt->store_result();
 		$rnum = $stmt->num_rows;

 		if (rnum == 0) {
 			$stmt->close();
 			$stmt = $conn->prepare($INSERT);

 			$stmt->bind_param("sss", $email_id, $password, $rpassword);
 			$stmt->execute();
 			echo "NEW ACCOUNT CREATED";
 		}
 		else{
 			echo "ACCOUNT ALREADY EXISTS";
 		}
 		$stmt->close();
 		$conn->close();
 	}
 }
 else{
 	echo "FILL THE FORM COMPLETELY";
 	die();
 }
  ?>