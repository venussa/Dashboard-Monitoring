<?php

$page = (int) $_POST["page"];
$page = ($page < 1) ? 1 : $page;

$limit = (int) $_POST["limit"];
$limit = ($limit < 10) ? 10 : $limit;

$offset = ($page - 1) * $limit;

$where = null;

if(!empty(trim($_POST["from"])) and !empty(trim($_POST["to"]))){
	$from = (int) strtotime($_POST["from"]);
	$to = (int) strtotime($_POST["to"]);

	$where = "WHERE datetime >= ".$from." and datetime <= ".$to;
}

$command = "SELECT * FROM data_table $where ORDER BY id ASC";

$query = $this->query($command." LIMIT $offset, $limit");

foreach($query->fetch_array as $key => $value)
{
	if(is_numeric($key))
	{	
		$value->datetime = date("d/m/Y H:i:s",$value->datetime);
		$value->status = ($value->status > 0) ? "UP" : "DOWN";
		$fix_data[] = $value;
	}
}

$build["result"] = ($query->total_data > 0) ? true : false;
$build["msg"] = ($query->total_data > 0) ? "Data Ditemukan" : "Data Tidak Ada";
$build["object"] = $fix_data;
$build["total_data_per_page"] = $query->total_data;
$build["total_data"] = $this->query($command)->total_data;


echo json_encode($build);