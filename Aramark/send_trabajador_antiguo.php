<?php
include "db_info.php";

$rut = $_POST["rut"];
$nombre = $_POST["nombre"];

if(!val_rut($rut)){
  echo json_encode(array(0, "Rut incorrecto"));
  //echo "No me gusta tu rut";
}else if (strlen($nombre) < 1){
  echo json_encode(array(0, "Nombre no cumple los requisitos"));
  //echo "No me gusta tu nombre";
}else{
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      echo json_encode(array(0, "Error conectandose a la base de datos."));
  }
  $sql = "SELECT * FROM trabajador WHERE rut ='".$rut."'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    echo json_encode(array(0, "El rut ".$rut." ya se encuentra registrado."));
  }else{
    $sql = "INSERT INTO trabajador (rut, nombre)
    VALUES ('" .$rut. "','" .$nombre. "')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array(1, "Genial! Se ha registrado ".$nombre." con rut ".$rut));
    } else {
        echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
    }
  }
  $conn->close();
}
?>
