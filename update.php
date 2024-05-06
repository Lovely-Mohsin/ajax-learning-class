<?php
require_once "./config.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $sql = "UPDATE users SET `fname`='$fname' ,`lname`='$lname' WHERE id = '$id'";
    $result = mysqli_query($db_con, $sql);
    if ($result) {
        echo "successfully updated";
    } else {
        echo "something went wrong";
    }
}
