<?php

$this->field_check();

$response = false;

if(count($email) >= 2)
{	
	$email = explode(".", $email[1]);

	if(count($email) >= 2)
	{
		$response = true;
	}

}

if($response == false)
{
	echo json_encode([
		"result" => false,
		"msg" => "Email tidak valid",
	]);
	exit;
}


$query = $this->query("SELECT * FROM data_user WHERE
	email='".$_POST["email"]."' or
	username='".$_POST["user"]."'
");

if($query->total_data > 0)
{
	echo json_encode([
		"result" => false,
		"msg" => "Email / Username sudah digunakan"
	]);
	exit;	
}

if($_POST["privacy"] == "false")
{
	echo json_encode([
		"result" => false,
		"msg" => "Mohon check Privacy Policy & Terms"
	]);
	exit;
}

$this->query("INSERT INTO data_user (email, username, password, role, timestamp) VALUES (
	'".$_POST['email']."',
	'".$_POST['user']."',
	'".md5($_POST['pass'])."',
	'User',
	'".time()."'
)");

echo json_encode([
	"result" => true,
	"msg" => "Berhasil mendaftar, silahkan login"
]);