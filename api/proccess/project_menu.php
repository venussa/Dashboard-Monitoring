<?php

$build["result"] = false;
$build["msg"] = "Data ditemukan";

function recrusive($obj, $index = 0, $id = null, $object = [])
{
	$segment = ["project","group","node","sensor"];

	$id = ($index > 0) ? "WHERE ".$segment[$index-1]."_id='".$id."'" :  null;

	$query = $obj->query("SELECT * FROM data_".$segment[$index]." ".$id)->fetch_array;

	foreach($query as $key => $value)
	{
		if(is_numeric($key))
		{
			if($index < 4)
			{	
				if(isset($value->status)) $value->status = boolval($value->status);

				if(isset($value->type))
				{
					$value->value = rand(40, 99).",".rand(40, 99)." #";
				}

				if(isset($segment[($index + 1)]))
				{
					$param = $segment[($index + 1)];
					$value->$param = recrusive($obj, ($index + 1), $value->id, $value);	
				}
				
				$tmp[] = $value;
			}
				
		}
	}

	return $tmp;

}

$result = recrusive($this);

if(count($result) > 0) $build["result"] = true;

$build["object"]["project"] = $result;

echo json_encode($build);