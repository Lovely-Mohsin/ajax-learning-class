<?php
require_once "./config.php";

$q = (isset($_GET['query']) && !empty($_GET['query'])) ? trim($_GET['query']) : null;

$sql = "SELECT * FROM users";

if($q !== null){
    $sql .= " WHERE fname , lname LIKE '%".$q."%' ";
}
$result = mysqli_query($db_con, $sql);

$html = "<table class='table table-striped'>";
$html .= "<thead>";
$html .= "<tr>";
$html .= "<th>ID</th>";
$html .= "<th>First Name</th>";
$html .= "<th>Last Name</th>";
$html .= "<th>Actions</th>";
$html .= "</tr>";
$html .= "</thead>";


$html .= "<tbody>";

while($row = mysqli_fetch_assoc($result)){

$html .= "<tr>";
$html .= "<td>$row[id]</td>";
$html .= "<td>$row[fname]</td>";
$html .= "<td>$row[lname]</td>";
$html .= "<td><button class='btn btn-success btn-sm me-2 editBtn' data-id = '$row[id]'>Edit</button>   <button class='btn btn-danger btn-sm deletebtn' data-id = '$row[id]'>Delete</button></td>";
$html .= "</tr>";
}
$html .= "</tbody></table>";

echo $html;
exit;
?>