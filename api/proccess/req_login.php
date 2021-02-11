<?php

$this->field_check();

$query = $this->query("SELECT * FROM data_user WHERE email='".$_POST["email"]."'");

if($query->fetch_array->email == $_POST["email"])
{
	if($query->fetch_array->password !== md5($_POST["pass"]))
	{
		echo json_encode([
			"result" => false,
			"msg" => "Password anda salah."
		]);
	}
	else
	{
		unset($query->fetch_array->password);
		echo json_encode([
			"result" => true,
			"object" => $query->fetch_array,
			"msg" => "berhasil login"
		]);
	}

	exit;
}

echo json_encode([
	"result" => false,
	"msg" => "Email tidak terdaftar"
]);