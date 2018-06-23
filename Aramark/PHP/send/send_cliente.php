<?php
include "db_info.php";

$nombre = $_POST["nombre"];
$id_cliente = $_POST["id"];
$rut = $_POST["rut"];

if(!val_rut($rut)){
  echo json_encode(array(0, "Rut incorrecto"));
}else if (strlen($nombre) < 1){
  echo json_encode(array(0, "Nombre no cumple los requisitos"));
}else if (strlen($id_cliente) < 1){
  echo json_encode(array(0, "Se requiere la ID del cliente"));
}
else{
  //Starting the connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  //Check if it doesn't exist
  if(!($stmt = $conn->prepare("SELECT * FROM cliente WHERE id_cliente = ?"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if(!$stmt->bind_param("i", $id_cliente)){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    echo json_encode(array(0, "El ID ".$id_cliente." ya se encuentra registrado."));
  }else{
    //Do the actual query
    if(!($stmt = $conn->prepare("INSERT INTO cliente(id_cliente, nombre, rut) VALUES (?,?,?)"))){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
    }
    if(!$stmt->bind_param("iss",$id_cliente, $nombre, $rut)){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
    }
    if (!$stmt->execute()) {
      echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
    }else{
      echo json_encode(array(1, "Genial! Se ha registrado al cliente ".$nombre));
    }
  }

    $stmt->close();
    $conn->close();
}
 ?>
