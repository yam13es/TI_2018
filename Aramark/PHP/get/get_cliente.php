<?php
include "db_info.php";

$id = $_POST["id"];

if(strlen($id) < 1){
  echo json_encode(array(0, "No se ingreso ID"));
}
else{
  //Starting the connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  //Check if it doesn't exist
  if(!($stmt = $conn->prepare("SELECT nombre, rut FROM cliente WHERE id_cliente = ?"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if(!$stmt->bind_param("i", $id)){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }
  $result = $stmt->get_result();
  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    echo json_encode(array(1, "Se encontro el cliente.", $row["nombre"], $row["rut"]));
  }else{
    echo json_encode(array(0, "Se encontraron multiples o ninguno."));
  }

    $stmt->close();
    $conn->close();
}
 ?>
