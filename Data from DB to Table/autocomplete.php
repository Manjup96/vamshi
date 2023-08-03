<?php
$mysqli = new mysqli("localhost", "root", "", "data_db_table");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$searchTerm = $_GET['term'];

$query = "SELECT name FROM db_table WHERE name LIKE '%$searchTerm%'";
$result = $mysqli->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row['name'];
}

$mysqli->close();

echo json_encode($data);
?>
