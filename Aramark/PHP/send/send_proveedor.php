<?php
include "db_info.php";

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$direccion = $_POST["direccion"];
$numero = $_POST["numero"];
$ciudad = $_POST["ciudad"];
$fono = $_POST["fono"];

if(!val_mail($correo)){
  echo json_encode(array(0, "Correo incorrecto"));
}else if (strlen($nombre) < 1){
  echo json_encode(array(0, "Nombre no cumple los requisitos"));
}else if (strlen($direccion) < 1){
  echo json_encode(array(0, "Direccion no cumple los requisitos"));
}else if (strlen($ciudad) < 1){
  echo json_encode(array(0, "Ciudad no cumple los requisitos"));
}else if (strlen($fono) < 1){
  echo json_encode(array(0, "Telefono no cumple los requisitos"));
}
else{
  //prepare the data
  $fono = "+56".$fono;
  if(strlen($numero)>0){
    $direccion = $direccion." #".$numero.", ".$ciudad;
  }else{
    $direccion = $direccion.", ".$ciudad;
  }
  //Starting the connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  //Check if it doesn't exist
  if(!($stmt = $conn->prepare("SELECT * FROM proveedor WHERE nombre = ?"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if(!$stmt->bind_param("s", $nombre)){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    echo json_encode(array(0, "El nombre ".$nombre." ya se encuentra registrado."));
  }else{
    //Do the actual query
    if(!($stmt = $conn->prepare("INSERT INTO proveedor(nombre, correo, telefono, direccion) VALUES (?,?,?,?)"))){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
    }
    if(!$stmt->bind_param("ssss", $nombre, $correo, $fono, $direccion)){
      echo json_encode(array(0, "Error: " . $sql . "<br>" . $stmt->error));
    }
    if (!$stmt->execute()) {
      echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
    }else{
      echo json_encode(array(1, "Genial! Se ha registrado al proveedor ".$nombre));
    }
  }

    $stmt->close();
    $conn->close();
}
 ?>
