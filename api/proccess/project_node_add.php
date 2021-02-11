<?php

$this->field_check();

if($_POST['docs'] == "Sensor")
{
	$id = (isset($_POST["id"])) ? $_POST["id"] : $_POST["n_id"];
	$data["title"] = "'".$_POST['title']."'";
	$data["type"] = "'".$_POST["sensor_type"]."'";
	$data["status"] = 1;
	$data["timestamp"] = time();
	$data["node_id"] = (int) $id;

	$index = implode(",", array_keys($data));
	$value = implode(",", $data);

	$this->query("insert into data_sensor ($index) values ($value)");

	$build["result"] = true;
	$build["msg"] = "Berhasil menambahkan sensor";

	echo json_encode($build);
}

if($_POST['docs'] == "Node")
{
	$id = (isset($_POST["id"])) ? $_POST["id"] : $_POST["g_id"];
	$data["title"] = "'".$_POST['title']."'";
	$data["description"] = "'".$_POST["description"]."'";
	$data["timestamp"] = time();
	$data["group_id"] = (int) $id;

	$index = implode(",", array_keys($data));
	$value = implode(",", $data);

	$this->query("insert into data_node ($index) values ($value)");

	$build["result"] = true;
	$build["msg"] = "Berhasil menambahkan node";

	echo json_encode($build);
}