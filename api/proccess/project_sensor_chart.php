<?php

$build["result"] = false;
$build["msg"] = ($query->total_data > 0) ? "Data ditemukan" : "Data tidak ditemukan";

if($_POST["chart_type"] == "pie")
{
	$query = $this->query("SELECT * FROM data_table");

	foreach($query->fetch_array as $key => $value)
	{
		if(is_numeric($key))
		{
			$index = "data_".date("M_Y", $value->datetime);
			$tmp[$index] +=  (int) str_replace("#",null, $value->value);
		}
	}

	$idx = 0;
	$total = 0;
	foreach($tmp as $key => $value)
	{
		$total += $value;
		$rebuild[$idx]["value"] = $value;
		$rebuild[$idx]["name"] = str_replace(["data_","_"],[null, " "], $key);
		$build["result"] = true;
		$idx++;
	}
	$build["total_data"] = number_format($total);
	$build["object"] = $rebuild;
}
else
{
	$query = $this->query("SELECT * FROM data_table ORDER BY datetime ASC LIMIT 10");

	foreach($query->fetch_array as $key => $value)
	{
		if(is_numeric($key))
		{
			$build["object"]["xAxisData"][] = date("d/M",$value->datetime);
			$build["object"]["series"][] = (int) trim(str_replace("#",null,$value->value));
			$build["result"] = true;
		}
	}
}

echo json_encode($build);