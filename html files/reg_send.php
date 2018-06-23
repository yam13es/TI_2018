<?php
$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
if(strlen($rut) <1){
  echo json_encode(array(0, "No me gusta tu rut"));
  //echo "No me gusta tu rut";
}else if (strlen($nombre) < 1){
  echo json_encode(array(0, "No me gusta tu nombre"));
  //echo "No me gusta tu nombre";
}else{
  sleep(1);
  //echo "Exito!";
  echo json_encode(array(1, "Genial! Se ha subido a la base de datos ".$nombre." con rut ".$rut));
}
//echo json_encode(array($num1, $num2));
?>
