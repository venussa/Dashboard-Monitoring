<?php

$this->field_check();

$id = (isset($_POST["id"])) ? $_POST["id"] : $_POST["p_id"];

$data["title"] = "'".$_POST['title']."'";
$data["description"] = "'".$_POST["description"]."'";
$data["timestamp"] = time();
$data["project_id"] = (int) $id;

$index = implode(",", array_keys($data));
$value = implode(",", $data);

$this->query("insert into data_group ($index) values ($value)");

$build["result"] = true;
$build["msg"] = "Berhasil menambahkan sensor";

echo json_encode($build);
