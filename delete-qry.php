<?php
require_once "./config.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $sql = "DELETE FROM `users` WHERE id = '$id' ";

    $result = mysqli_query($db_con, $sql);

    if($result){
        echo "Successfully Deleted";
    }
    else{
        echo "Failed to Delete";
    }
}

?>