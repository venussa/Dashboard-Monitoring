<?php

$this->query("DELETE FROM data_project WHERE id='".$_POST['p_id']."' ");

$build["result"] = true;
$build["msg"] = "Data sensor telah dihapus";

echo json_encode($build);
