<?php

$this->query("DELETE FROM data_group WHERE id='".$_POST['g_id']."' ");

$build["result"] = true;
$build["msg"] = "Data sensor telah dihapus";

echo json_encode($build);
