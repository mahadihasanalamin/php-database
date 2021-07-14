<?php

	function connect(){
		$conn = new mysqli("localhost", "alamin", "1234", "wtm");
		if($conn->connect_errno){
			die("connection failed due to " .$conn->connect_error);
		}
		return $conn;
	}
	
	function register($firstName, $lastName, $dob, $gender, $religion, $presentAddress, $permanentAddress, $phone, $email, $website,
        $userName ,$password){
		$conn = connect();
		$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, dob, gender, religion, present_address, permanent_address, phone, email, website, username , password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssssss", $firstName, $lastName, $dob, $gender, $religion, $presentAddress, $permanentAddress, $phone, $email, $website, $userName ,$password);
		
		return $stmt->execute();
	}
	
	function login($userName ,$password){
		$conn = connect();
		$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? and password = ?");
		$stmt->bind_param("ss", $userName ,$password);
		$stmt->execute();
		$records = $stmt-> get_result();
		return $records->num_rows ===1;
	}
?>