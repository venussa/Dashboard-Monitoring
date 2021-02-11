<?php

$build["result"] = true;
$build["msg"] = "Data ditemukan";
$build["object"]["total_user"] = $this->query("SELECT * FROM data_user")->total_data;
$build["object"]["total_project"] = $this->query("SELECT * FROM data_project")->total_data;
$build["object"]["group"] = $this->query("SELECT * FROM data_group")->total_data;
$build["object"]["node"] = $this->query("SELECT * FROM data_node")->total_data;
$build["object"]["sensor"] = $this->query("SELECT * FROM data_sensor")->total_data;
$build["object"]["update_time"] = "1 days";

echo json_encode($build);