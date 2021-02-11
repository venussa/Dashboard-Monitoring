<?php

$this->query("DELETE FROM data_user WHERE id='".$_POST['id']."'");
echo json_encode([
	"result" => true,
	"msg" => "Success delete user"
]);