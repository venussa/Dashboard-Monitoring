<?php

if($_POST['docs'] == "Sensor")
{
	$this->query("DELETE FROM data_sensor WHERE id='".$_POST['s_id']."' ");

	$build["result"] = true;
	$build["msg"] = "Data sensor telah dihapus";

	echo json_encode($build);
}

if($_POST['docs'] == "Node")
{
	$this->query("DELETE FROM data_node WHERE id='".$_POST['n_id']."' ");

	$build["result"] = true;
	$build["msg"] = "Data sensor telah dihapus";

	echo json_encode($build);
}