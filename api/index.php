<?php

error_reporting(0);

class api
{
	public function __construct()
	{
		$content_type = [
			"Content-Type",
			"Access-Control-Allow-Headers",
			"Authorization",
			"X-Requested-With",
		];

		header("Access-Control-Allow-Headers: ".implode(", ", $content_type));

		header("Content-type:application/json");

		require_once("proccess/".$this->slice(1).".php");

	}

	public function query($command = null, $type = true)
	{
		$conn = mysqli_connect("localhost", "root", "", "test_api");
		$query = mysqli_query($conn, $command);

		while($show = mysqli_fetch_array($query))
		{
			$build[] = $show;
		}

		$index = 0;

		$result = [];

		if(isset($build))
		{
			foreach($build as $key => $val)
			{
				foreach($val as $key1 => $val1)
				{
					if(!is_numeric($key1))
					{
						$result[$index][$key1] = $val1;					
					}
				}

				$index++;
			}

			$result = ($type == true) ? array_merge($result, $result[0]) : $result;
		}

		return json_decode(json_encode(array(
			"total_data" => mysqli_num_rows($query),
			"fetch_array" => $result
		)));
	}

	public function field_check($wh = null)
	{
		$build = $_POST;

		if(is_array($wh))
		{
			foreach($wh as $key => $val)
			{
				unset($build[$val]);
			}
		}

		foreach($build as $key => $val)
		{
			if(empty(trim($val))) 
			{
				echo json_encode([
					"result" => false,
					"msg" => "Mohon isi seluruh field"
				]);

				exit;
			}
		}

		return true;
	}

	public function slice($position = 1)
	{
		$ROOT_DIR = str_replace("\\","/",__DIR__);
		$ROOT_DIR = explode("/", $ROOT_DIR);
		$ROOT_DIR = end($ROOT_DIR);

		$paramaters = $_SERVER["REQUEST_URI"];

		$data = explode($ROOT_DIR, $paramaters);

		if(count($data) > 1)
		{
			$paramaters = $data[1];
		}

		$scan_query = explode("?", $paramaters);
		$split_data = explode("/", $paramaters);
		
		if(count($scan_query) > 1)
		{
			$split_data = explode("/", $scan_query[0]);
		}

		return $split_data[$position];		

	}
}

( new api );