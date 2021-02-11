<?php

$this->field_check();


$data["title"] = "'".$_POST['title']."'";
$data["description"] = "'".$_POST["description"]."'";

foreach($data as $key => $val)
{
	$value[] = $key."=".$val;
}

$value = implode(",", $value);

$this->query("UPDATE data_project SET $value WHERE id='".$_POST['p_id']."' ");

$build["result"] = true;
$build["msg"] = "Berhasil di pdate";

echo json_encode($build);
