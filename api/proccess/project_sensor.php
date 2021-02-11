<?php

$build["result"] = true;
$build["msg"] = "Data ditemukan";

$s_data = $this->query("SELECT * FROM data_sensor WHERE id='".$_POST['s_id']."'");
$n_data = $this->query("SELECT * FROM data_node WHERE id='".$s_data->fetch_array->node_id."'");
$g_data = $this->query("SELECT * FROM data_group WHERE id='".$n_data->fetch_array->group_id."'");
$p_data = $this->query("SELECT * FROM data_project WHERE id='".$g_data->fetch_array->project_id."'");

$build["p_id"] = $p_data->fetch_array->id;
$build["p_title"] = $p_data->fetch_array->title;

$build["g_id"] = $g_data->fetch_array->id;
$build["g_title"] = $g_data->fetch_array->title;

$build["n_id"] = $n_data->fetch_array->id;
$build["n_title"] = $n_data->fetch_array->title;

$build["s_id"] = $n_data->fetch_array->id;
$build["s_title"] = $s_data->fetch_array->title;

$build["description"] = $n_data->fetch_array->description;
$build["sensor_type"] = $s_data->fetch_array->type;
$build["sensor_value"] = rand(40, 99).",".rand(40, 99)." #";
$build["sensor_status"] = boolval($s_data->fetch_array->status);
$build["update_time"] = "20 Second";
$build["last_data"] = "62s";
$build["up_time"] = "99,997%";
$build["down_time"] = "0,0987%";

echo json_encode($build);