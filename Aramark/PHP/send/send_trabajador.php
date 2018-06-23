<?php
include "db_info.php";

$rut = $_POST["rut"];
$nombre = $_POST["nombre"];

if(!val_rut($rut)){
  echo json_encode(array(0, "Rut incorrecto"));
}else if (strlen($nombre) < 1){
  echo json_encode(array(0, "Nombre no cumple los requisitos"));
}else{
  //Starting the connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  //Check if it doesn't exist
  if(!($stmt = $conn->prepare("SELECT * FROM trabajador WHERE rut = ?"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if(!$stmt->bind_param("s", $rut)){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    echo json_encode(array(0, "El rut ".$rut." ya se encuentra registrado."));
  }else{
    //Do the actual query
    if(!($stmt = $conn->prepare("INSERT INTO trabajador(rut, nombre, clave) VALUES (?,?, ?)"))){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
    }
    if(!$stmt->bind_param("sss", $rut, $nombre, $rut)){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
    }
    if (!$stmt->execute()) {
      echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
    }else{
      echo json_encode(array(1, "Genial! Se ha registrado ".$nombre." con rut ".$rut));
    }
  }

    $stmt->close();
    $conn->close();
}
?>
