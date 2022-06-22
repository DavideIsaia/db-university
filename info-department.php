<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/Department.php";

$id = $_GET["id"];
$sql = "SELECT * FROM `departments` WHERE `id`=$id;";
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
  echo "Errore nella query.";
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
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <?php foreach ($departments as $department) { ?>
      <h1><?php echo $department->name; ?></h1>
      <div class="card">
        <h3><?php echo $department->head_of_department; ?></h3>
        <ul>
          <?php foreach ($department->getInfo() as $key => $value) { ?>
            <li><?php echo "$key: $value" ?></li>          
          <?php } ?>
        </ul>
      </div>
    </div>
  <?php } ?>  
</body>
</html>
