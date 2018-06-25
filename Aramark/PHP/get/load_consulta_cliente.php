<?php
  include "db_info.php";
  $id_cliente = $_POST["id"];
  if(strlen($id_cliente) < 1){
  }else{
  $conn = new mysqli($servername, $username, $password, $dbname);
  $stmt = $conn->prepare("SELECT * FROM venta, venta_lote, cliente, lote, producto WHERE cliente.id_cliente = ?
    AND cliente.id_cliente = venta.id_cliente AND venta.id_venta = venta_lote.id_venta
     AND venta_lote.id_lote = lote.id_lote AND lote.id_producto = producto.id_producto");
  $stmt->bind_param("i", $id_cliente);
  $stmt->execute();

  $fechas = array();
  $productos = array();
  $cantidades = array();
  $precios = array();
  $suma = 0;

  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $fecha = $row["fecha"];
    $producto = $row["nombre_producto"];
    $cantidad = $row["cantidad"];
    $precio = $row["precio"];
    array_push($fechas, $fecha);
    array_push($productos, $producto);
    array_push($cantidades, $cantidad);
    array_push($precios, $cantidad*$precio);
    $suma+=$cantidad*$precio;
  }
  echo json_encode(array($fechas, $productos, $cantidades, $precios, $suma));
}
 ?>
