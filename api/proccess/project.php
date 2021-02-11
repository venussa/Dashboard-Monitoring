<?php

$build["result"] = false;
$build["msg"] = "Data ditemukan";

$p_data = $this->query("SELECT * FROM data_project");

$build["p_id"] = $p_data->fetch_array->id;
$build["p_title"] = $p_data->fetch_array->title;
$build["description"] = $p_data->fetch_array->description;

foreach($p_data->fetch_array as $key => $val)
{
	if(is_numeric($key))
	{
		$g_data = $this->query("SELECT * FROM data_group WHERE project_id='".$val->id."'");
		$n_data = $this->query("SELECT * FROM data_node WHERE group_id='".$g_data->fetch_array->id."'");
		$s_data = $this->query("SELECT * FROM data_sensor WHERE node_id='".$n_data->fetch_array->id."'");
		$val->group = $g_data->total_data;
		$val->node = $n_data->total_data;
		$val->sensor = $s_data->total_data;

		$build["object"][] = $val;
		$build["result"] = true;
	}
}

echo json_encode($build);
