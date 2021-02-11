<?php

$this->field_check(['password', 'photo']);

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


$check_id = $this->query("SELECT * FROM data_user WHERE id='".$_POST['id']."' ")->fetch_array;

$check = $this->query("SELECT * FROM data_user WHERE (username='".$_POST['username']."' or email='".$_POST['email']."') and username !='".$check_id->username."' and email='".$check_id->email."'")->total_data;

if($check > 0)
{
	echo json_encode([
		"result" => false,
		"msg" => "Username / Email sudah terdaftar",
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

if(!empty(trim($_POST['password']))) $_POST['password'] = md5($_POST['password']);

if(empty(trim($_POST['password']))) unset($_POST['password']);

foreach($_POST as $key => $val)
{
	if($key !== "id")
		$build[] = $key."='".$val."'";
}

$value = implode(",", $build);

$this->query("UPDATE data_user SET ".$value." WHERE id='".$_POST['id']."'");

$check_id = $this->query("SELECT * FROM data_user WHERE id='".$_POST['id']."' ");
$data = $check_id->fetch_array;
unset($data->password);

echo json_encode([
	"result" => True,
	"msg" => "Berhasil di update",
	"object" => $data,
]);