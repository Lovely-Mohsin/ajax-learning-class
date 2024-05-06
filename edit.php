<?php
require_once "./config.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];
   
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($db_con, $sql);

    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);
    exit;
}

