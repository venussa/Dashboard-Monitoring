<?php

$page = (int) $_POST["page"];
$page = ($page < 1 ) ? 1 : $page;
$limit = $_POST["per_page"];
$limit = ($limit < 1 ) ? 1 : $limit;

$offset = ($page - 1) * $limit;

$command = "SELECT * FROM data_user WHERE 
	( fullname like '%".$_POST['keyword']."%' or 
	email like '%".$_POST['keyword']."%' or 
	role like '%".$_POST['keyword']."%' or 
	mobile like '%".$_POST['keyword']."%') and id != '".$_POST['my_id']."' ORDER BY id DESC";

if(isset($_POST["id"])) $command = "SELECT * FROM data_user WHERE id='".$_POST['id']."' ";

$query = $this->query($command." LIMIT $offset , $limit");
$query1 = $this->query($command);

foreach($query->fetch_array as $key => $val)
{
	if(is_numeric($key))
	{
		if(isset($_POST["id"])){
			$build = $val;
			break;
		}
			
		else $build[] = $val;
	}
}

echo json_encode([
	"result" => (isset($build)) ? true : false,
	"msg" => "Data Found",
	"object" => $build,
	"total_data" => $query1->total_data
]);