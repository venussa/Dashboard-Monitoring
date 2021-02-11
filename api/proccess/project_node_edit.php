<?php

$this->field_check();

if($_POST['docs'] == "Sensor")
{
	$data["title"] = "'".$_POST['title']."'";
	$data["type"] = "'".$_POST["sensor_type"]."'";

	foreach($data as $key => $val)
	{
		$value[] = $key."=".$val;
	}

	$value = implode(",", $value);

	$this->query("UPDATE data_sensor SET $value WHERE id='".$_POST['s_id']."' ");

	$build["result"] = true;
	$build["msg"] = "Berhasil di pdate";

	echo json_encode($build);
}

if($_POST['docs'] == "Node")
{
	$data["title"] = "'".$_POST['title']."'";
	$data["description"] = "'".$_POST["description"]."'";

	foreach($data as $key => $val)
	{
		$value[] = $key."=".$val;
	}

	$value = implode(",", $value);

	$this->query("UPDATE data_node SET $value WHERE id='".$_POST['n_id']."' ");

	$build["result"] = true;
	$build["msg"] = "Berhasil di pdate";

	echo json_encode($build);
}