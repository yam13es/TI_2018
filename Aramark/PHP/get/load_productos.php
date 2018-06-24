<?php
  include "db_info.php";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  if(!($stmt = $conn->prepare("SELECT * FROM producto"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }

  $nombres = array("Elige un producto...");
  $precios = array(0);


  $result = $stmt->get_result();
  if($result->num_rows != 0){
    while($row = $result->fetch_assoc()){
      array_push($nombres, $row["nombre_producto"]);
      array_push($precios, $row["precio"]);
    }
  }
  $stmt->close();
  $conn->close();
  echo json_encode(array($nombres, $precios));
?>
