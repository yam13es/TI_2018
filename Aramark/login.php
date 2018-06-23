<?php
session_start();
  include "db_info.php";

  $rut = $_POST["rut"];
  $clave = $_POST["clave"];

  if(!val_rut($rut)){
    echo json_encode(array(0, "Rut incorrecto"));
  }else if (strlen($clave) < 1){
    echo json_encode(array(0, "Se requiere ingreso de clave"));
  }else{
    //Starting the connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      echo json_encode(array(0, "Error conectandose a la base de datos."));
      die("Connection failed: " . $conn->connect_error);
    }
    //Check if it does exist
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
    if($result->num_rows == 0){
      echo json_encode(array(0, "El rut ".$rut." no se encuentra registrado."));
    }else{
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
      if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $srv_pass = $row["clave"];
        if($clave == $srv_pass){
          //Exito
          $_SESSION["username"] = $row["nombre"];
          $_SESSION["rut"] = $rut;
          echo json_encode(array(1, "Has iniciado sesion."));
        }else{
          //clave incorrecta
          echo json_encode(array(0, "El rut o la clave ingresados son incorrectos."));
        }
      }else{
        echo json_encode(array(0, "Ha ocurrido un error."));
      }
    }
      $stmt->close();
      $conn->close();
  }
?>
