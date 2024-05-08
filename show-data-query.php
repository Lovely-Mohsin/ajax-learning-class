<?php
require_once "./config.php";

$q = (isset($_GET['query']) && !empty($_GET['query'])) ? trim($_GET['query']) : null;



$page = $_GET['page'];
$limit = 3;
$offset = ($page - 1) * $limit;


$sql = "SELECT * FROM users ";

if ($q !== null) {
    $sql .= " WHERE fname LIKE '%".$q."%' OR lname LIKE '%".$q."%'";
}

$sql .= " LIMIT $limit OFFSET $offset";

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

// get total number of records
$totalRecordsSql = "SELECT COUNT(*) as total FROM users ";

if ($q !== null) {
    $sql .= " WHERE fname LIKE '%".$q."%' OR lname LIKE '%".$q."%'";
}

$result2 = mysqli_query($db_con, $totalRecordsSql);
$totals = mysqli_fetch_array($result2);

$pages = ceil($totals['total'] / $limit);

//  echo $pages;
//  exit;

// pagination ui
$html .= "<nav>
<ul class='pagination pagination-sm'>";

for($i = 1; $i <= $pages; $i++) {
    if($page == $i) {
        $html .= " <li class='page-item'><a class='page-link active page' href='#' data-page=".$i.">".$i."</a></li>";
    } else {
        $html .= " <li class='page-item'><a class='page-link page' href='#' data-page=".$i.">".$i."</a></li>";
    }

}

$html .= "</ul>
</nav>";


echo $html;
exit;
?>