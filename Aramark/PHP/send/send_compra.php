<?php
include "db_info.php";

$proveedor = $_POST["proveedor"];
$producto = $_POST["producto"];
$cantidad = $_POST["cantidad"];
$elab = $_POST["elab"];
$venc = $_POST["venc"];
$fecha = date("Y/m/d");
if($proveedor == "Selecciona un elemento..."){
  echo json_encode(array(0, "Elige un proveedor"));
}else if($producto == "Selecciona un elemento..."){
  echo json_encode(array(0, "Elige un producto"));
}else if($cantidad < 1){
  echo json_encode(array(0, "Debes ingresar una cantidad positiva"));
}else if(!val_date($elab) || !val_date($venc) ||(strtotime($elab) > strtotime($venc))){
  echo json_encode(array(0, "Revisa las fechas"));
}else{
  $conn = new mysqli($servername, $username, $password, $dbname);

  $stmt = $conn->prepare("SELECT id_producto FROM producto WHERE nombre_producto = ?");
  $stmt->bind_param("s", $producto);
  $stmt->execute();

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $id_producto = $row["id_producto"];

  $stmt = $conn->prepare("SELECT id_proveedor FROM proveedor WHERE nombre_proveedor = ?");
  $stmt->bind_param("s", $proveedor);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $id_proveedor = $row["id_proveedor"];

  $stmt = $conn->prepare("SELECT * FROM lote WHERE id_producto = ? AND fecha_venc = ? AND fecha_elab = ?");
  $stmt->bind_param("iss", $id_producto, $venc, $elab);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $stock = $row["stock"];
    $id_lote = $row["id_lote"];
    $final = $stock + $cantidad;

    $stmt = $conn->prepare("UPDATE lote SET stock = ? WHERE id_lote = ?");
    $stmt->bind_param("ii", $final, $id_lote);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO compra(id_proveedor, fecha, cantidad, id_lote) VALUES (?,?,?,?)");
    $stmt->bind_param("isii",$id_proveedor, $fecha, $cantidad, $id_lote);
    if(!$stmt->execute()){
      echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
    }else{
      echo json_encode(array(1, "Compra registrada, inventario actualizado."));
    }
  }else{
    $stmt = $conn->prepare("INSERT INTO lote(id_producto, fecha_venc, fecha_elab, stock) VALUES (?,?,?,?)");
    $stmt->bind_param("issi",$id_producto, $venc, $elab, $cantidad);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM lote WHERE id_producto = ? AND fecha_venc = ? AND fecha_elab = ?");
    $stmt->bind_param("iss", $id_producto, $venc, $elab);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 1){
      $row = $result->fetch_assoc();
      $id_lote = $row["id_lote"];

      $stmt = $conn->prepare("INSERT INTO compra(id_proveedor, fecha, cantidad, id_lote) VALUES (?,?,?,?)");
      $stmt->bind_param("isii",$id_proveedor, $fecha, $cantidad, $id_lote );
      if(!$stmt->execute()){
        echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
      }else{
        echo json_encode(array(1, "Compra registrada, inventario actualizado."));
      }
    }
  }

  $stmt->close();
  $conn->close();
}
 ?>
