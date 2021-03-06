<?php
include "db_info.php";

$nombre = $_POST["nombre"];
$id_producto = $_POST["id"];
$precio = $_POST["precio"];

if($precio == 0){
  echo json_encode(array(0, "Se requiere el precio"));
}else if (strlen($nombre) < 1){
  echo json_encode(array(0, "Nombre no cumple los requisitos"));
}else if (strlen($id_producto) < 1){
  echo json_encode(array(0, "Se requiere la ID del producto"));
}
else{
  //Starting the connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  //Check if it doesn't exist
  if(!($stmt = $conn->prepare("SELECT * FROM producto WHERE id_producto = ?"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if(!$stmt->bind_param("i", $id_producto)){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    echo json_encode(array(0, "El ID ".$id_producto." ya se encuentra registrado."));
  }else{
    //Do the actual query
    if(!($stmt = $conn->prepare("INSERT INTO producto(id_producto, nombre_producto, precio) VALUES (?,?,?)"))){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
    }
    if(!$stmt->bind_param("isi",$id_producto, $nombre, $precio)){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
    }
    if (!$stmt->execute()) {
      echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
    }else{
      echo json_encode(array(1, "Genial! Se ha registrado el producto ".$nombre));
    }
  }

    $stmt->close();
    $conn->close();
}
 ?>
