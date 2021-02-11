<?php

$build["result"] = false;
$build["msg"] = "Data ditemukanz";

$g_data = $this->query("SELECT * FROM data_group WHERE project_id='".$_POST["p_id"]."'");

$p_data = $this->query("SELECT * FROM data_project WHERE id='".$_POST["p_id"]."'");

$build["p_id"] = $p_data->fetch_array->id;
$build["p_title"] = $p_data->fetch_array->title;
$build["description"] = $p_data->fetch_array->description;

foreach($g_data->fetch_array as $key => $value)
{
	if(is_numeric($key))
	{
		$n_data = $this->query("SELECT * FROM data_node WHERE group_id='".$g_data->fetch_array->id."'");
		$s_data = $this->query("SELECT * FROM data_sensor WHERE node_id='".$n_data->fetch_array->id."'");
		$value->node = $n_data->total_data;
		$value->sensor = $s_data->total_data;
		$build["object"][] = $value;
		$build["result"] = true;
	}
}

echo json_encode($build);