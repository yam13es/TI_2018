<?php
  include "db_info.php";
  $nombre = $_POST["nombre"];

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  if(!($stmt = $conn->prepare("SELECT id_lote, fecha_elab, fecha_venc, stock FROM lote, producto WHERE lote.id_producto=producto.id_producto AND producto.nombre_producto = '".$nombre."'"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }

  $nombres = array("Elige un lote...");
  $stock = array(0);
  $ids = array(0);


  $result = $stmt->get_result();
  if($result->num_rows != 0){
    while($row = $result->fetch_assoc()){
      array_push($nombres, $row["fecha_elab"]."/".$row["fecha_venc"]);
      array_push($stock, $row["stock"]);
      array_push($ids, $row["id_lote"]);
    }
  }
  $stmt->close();
  $conn->close();
  echo json_encode(array($nombres, $stock, $ids));
?>
