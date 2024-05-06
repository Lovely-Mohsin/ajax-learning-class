<?php

// database connection
$db_con = mysqli_connect("localhost", "root", "", "Ajax_Php");
if (!$db_con) {
    die("database not connected");
}
