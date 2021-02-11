<?php

$this->field_check();

$data["title"] = "'".$_POST['title']."'";
$data["description"] = "'".$_POST["description"]."'";
$data["timestamp"] = time();

$index = implode(",", array_keys($data));
$value = implode(",", $data);

$this->query("insert into data_project ($index) values ($value)");

$build["result"] = true;
$build["msg"] = "Berhasil menambahkan project";

echo json_encode($build);
