<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/Department.php";

$id = $_GET["id"];
$sql = "SELECT * FROM `departments` WHERE `id`=;";
$result = $conn->query($sql);

$departments = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $curr_department = new Department($row["id"], $row["name"]);
    $curr_department->setInfo($row["address"], $row["phone"], $row["email"], $row["website"]);
    $curr_department->head_of_department = $row["head_of_department"];
    $departments[] = $curr_department;
  }
} elseif ($result) {
  echo "Nessuna corrispondenza.";
} else {
  echo "Errore nella richiesta.";
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dipartimento</title>
</head>
<body>
  <h1>Dipartimento</h1>
  <h3>Direttore</h3>
  <div>Info</div>
  
</body>
</html>
