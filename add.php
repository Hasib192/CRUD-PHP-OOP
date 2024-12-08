<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item_name"])) {
    $add_data = new DB();
    $add_data->addData($_POST["item_name"]);
}
