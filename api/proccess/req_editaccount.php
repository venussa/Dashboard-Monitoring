<?php

$build["result"] = false;
$build["msg"] = null;
$build["object"] = null;

$query = $this->query("SELECT * FROM data_user WHERE id='".$_POST['id']."' ");
$get_data = $query->fetch_array;

if(!empty($_POST["old-password"]) and !empty($_POST["new-password"]))
{
	$this->field_check();

	if($get_data->password !== md5($_POST['old-password']))
	{	
		$build["msg"] = "Password lama tidak cocok";
		echo json_encode($build);
		exit;
	}
	
	if($_POST["new-password"] !== $_POST["retype-new-password"])
	{
		$build["msg"] = "Password baru tidak cocok";
		echo json_encode($build);
		exit;
	}
		
	$paramater["password"] = md5($_POST["new-password"]);
		
}
else
{
	$this->field_check();
	$paramater["fullname"] = $_POST['name'];
	$paramater["email"] = $_POST["email"];
	$paramater["mobile"] = $_POST["mobile"];
	$paramater["username"] = $_POST["user"];

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

	if(!empty($_FILES["photo"]["name"]))
	{
		$file = $_FILES["photo"];
		$name = time().".png";
		$path = "../src/assets/images/photo/".$name;
		if(move_uploaded_file($file["tmp_name"], $path))
		{
			$paramater["photo"] = $name;
		}
	}
}

foreach($paramater as $key => $value)
{
	$param[] = $key."='".$value."'";
}

$q = implode(",", $param);

if($this->query("UPDATE data_user SET ".$q." WHERE id='".$get_data->id."'"))
{
	$query = $this->query("SELECT * FROM data_user WHERE id='".$_POST['id']."' ");
	$build["result"] = true;
	$build["msg"] = "Data berhasil di rubah";
	$build["object"] = $query->fetch_array;
}


echo json_encode($build);