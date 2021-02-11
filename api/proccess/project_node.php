<?php

$build["result"] = false;
$build["msg"] = "Data ditemukan";

$g_data = $this->query("SELECT * FROM data_group WHERE id='".$_POST['g_id']."' ");
$p_data = $this->query("SELECT * FROM data_project WHERE id='".$g_data->fetch_array->project_id."' ");
$n_data = $this->query("SELECT * FROM data_node WHERE group_id='".$g_data->fetch_array->id."' ");

$build["p_id"] = $p_data->fetch_array->id;
$build["p_title"] = $p_data->fetch_array->title;

$build["g_id"] = $g_data->fetch_array->id;
$build["g_title"] = $g_data->fetch_array->title;

$build["description"] = $g_data->fetch_array->description;

foreach($n_data->fetch_array as $key => $val)
{
	if(is_numeric($key))
	{
		$build["object"][$key]["id"] = $val->id;
		$build["object"][$key]["title"] = $val->title;
		$build["object"][$key]["description"] = $val->description;

		$s_data = $this->query("SELECT * FROM data_sensor WHERE node_id='".$val->id."'");

		foreach($s_data->fetch_array as $key1 => $val1)
		{
			if(is_numeric($key1))
			{
				$build["object"][$key]["sensor"][$key1]["id"] = $val1->id;
				$build["object"][$key]["sensor"][$key1]["title"] = $val1->title;
				$build["object"][$key]["sensor"][$key1]["description"] = $val1->description;
				$build["object"][$key]["sensor"][$key1]["type"] = $val1->type;
				$build["object"][$key]["sensor"][$key1]["value"] = rand(40, 99).",".rand(40, 99)." #";
				$build["object"][$key]["sensor"][$key1]["status"] = boolval($val1->status);
			}
		}

		$build["result"] = true;
	}
}

echo json_encode($build);
