<?php

$this->field_check();

$email = explode("@", $_POST["email"]);
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


$check = $this->query("SELECT * FROM data_user WHERE username='".$_POST['username']."' or email='".$_POST['email']."'")->total_data;

if($check > 0)
{
	echo json_encode([
		"result" => false,
		"msg" => "Username / Email sudah terdaftar",
	]);
	exit;
}

if(empty($_FILES['photo']['name']))
{
	echo json_encode([
		"result" => false,
		"msg" => "Belum mengupload foto",
	]);
	exit;
}

if(!empty($_FILES['photo']['name']))
{
	$file = $_FILES['photo'];
	$name = time().".png";
	$path = "../src/assets/images/photo/".$name;

	if(move_uploaded_file($file['tmp_name'], $path))
	{
		$_POST['photo'] = $name;
	}
}

$_POST["password"] = md5($_POST["password"]);

foreach($_POST as $key => $val)
{
	$build[$key] = "'".$val."'";
}
$index = implode(",", array_keys($build));
$value = implode(",", $build);

$this->query("INSERT INTO data_user ($index) VALUES ($value)");

echo json_encode([
	"result" => True,
	"msg" => "Berhasil menambahkan data",
]);