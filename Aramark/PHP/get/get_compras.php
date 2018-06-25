<?php
include "db_info.php";
$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("SELECT * FROM compra, lote, producto, proveedor WHERE compra.id_proveedor = proveedor.id_proveedor
   AND compra.id_lote = lote.id_lote AND lote.id_producto = producto.id_producto ORDER BY fecha DESC");
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows == 0){
  echo "<p class=text-muted style='margin:0 auto;'>No exiten ventas registradas.</p>";
}else{
  echo '
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Producto</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Proveedor</th>
        <th scope="col">Fecha</th>
      </tr>
    </thead>
    <tbody>';

    while($row = $result->fetch_assoc()){
      $id = $row["id_compra"];
      $producto = $row["nombre_producto"];
      $cantidad = $row["cantidad"];
      $proveedor = $row["nombre_proveedor"];
      $fecha = $row["fecha"];

      echo '
      <tr>
        <th scope="row">'.$id.'</th>
        <td>'.$producto.'</td>
        <td>'.$cantidad.'</td>
        <td>'.$proveedor.'</td>
        <td>'.$fecha.'</td>
      </tr>
      ';
    }
    echo '
    </tbody>
  </table>
  ';
}

  ;
 ?>
