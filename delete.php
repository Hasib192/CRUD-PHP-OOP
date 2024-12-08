<?php
include "db.php";

$item_id = $_GET["id"];
$delete_data = new DB();
$delete_data->deleteData($item_id);
