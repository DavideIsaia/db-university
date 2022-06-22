<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/Department.php";

// per evitare sql injection dobbiamo evitare che possano venir scritti comandi sql dopo la query
$stmt = $conn->prepare("SELECT * FROM `departments` WHERE `id`=?");
// diciamo allo statement che deve accettare solo cifre e troncare eventuali caratteri estranei
$stmt->bind_param("d", $id); 
$id = $_GET["id"];

// adesso possiamo eseguire la query
$stmt->execute();
$result = $stmt->get_result();

// prepariamo un array anche se andrà un solo elemento perchè più facile  da mmanipolare
$departments = [];

// creiamo un ciclo if else per avere riscontri di eventuali errori
if ($result && $result->num_rows > 0) {
  // se la query va bene, usiamo il ciclo while perchè non sappiamo il numero di iterazioni
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
    <?php } ?>
    <a href="index.php">&larr; Torna alla Home</a>
  </div>
</body>
</html>
