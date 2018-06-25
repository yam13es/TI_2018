<?php
  session_start();
  include "db_info.php";

  $checks = $_POST["chek"];
  $names = $_POST["names"];
  $lotes = $_POST["lotes"];
  $maxs = $_POST["maxs"];
  $cantidades = $_POST["cantidades"];
  $id_cliente = $_POST["id_cliente"];
  $fecha = date("Y/m/d");
  $suma_check = 0;
  // Validacion
  for($i=0; $i<4;$i++){
    if($checks[$i] == 1){
      $suma_check += 1;
      if($names[$i] == "Elige un producto..."){
        echo json_encode(array(0, "Debes elegir un producto"));
        die();
      }else if($lotes[$i] == "Elige un lote..."||$lotes[$i] == 0){
        echo json_encode(array(0, "Debes elegir un lote disponible"));
        die();
      }else if($cantidades[$i] > $maxs[$i]){
        echo json_encode(array(0, "La cantidad excede el maximo"));
        die();
      }else if($cantidades[$i] <1){
        echo json_encode(array(0, "La cantidad debe ser positiva"));
        die();
      }else if(strlen($id_cliente) <1){
        echo json_encode(array(0, "Ingresa un Cliente valido"));
        die();
      }
    }
  }
  //Enviar el registro de compra y de compra-lote
  if($suma_check > 0){
    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("SELECT MAX(id_venta) FROM venta");
    //$stmt->bind_param("i", $id_cliente[i]);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $id_venta = $row["MAX(id_venta)"]+1;
    }else{
      $id_venta = 1;
    }

    $stmt = $conn->prepare("INSERT INTO venta(id_venta, fecha, id_cliente, rut_trabajador) VALUES (?,?,?,?)");
    $stmt->bind_param("isis", $id_venta, $fecha, $id_cliente, $_SESSION["rut"]);
    $stmt->execute();


    for($i=0;$i<4;$i++){
      if($checks[$i]){
        $stmt = $conn->prepare("INSERT INTO venta_lote(id_venta, id_lote, cantidad) VALUES (?,?,?)");
        $stmt->bind_param("iii", $id_venta, $lotes[$i],$cantidades[$i]);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT stock FROM lote WHERE id_lote = ?");
        $stmt->bind_param("i", $lotes[$i]);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $final = $row["stock"]-$cantidades[$i];

        $stmt = $conn->prepare("UPDATE lote SET stock = ? WHERE id_lote = ?");
        $stmt->bind_param("ii", $final, $lotes[$i]);
        $stmt->execute();
      }
    }
    $stmt->close();
    $conn->close();
    echo json_encode(array(1, "Genial! Se ha registrado la venta y actualizado el inventario"));
  }else{
    echo json_encode(array(2, "."));
  }








?>
