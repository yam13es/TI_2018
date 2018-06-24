<?php
include "db_info.php";
$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("SELECT producto.id_producto,nombre_producto, SUM(stock) FROM lote, producto WHERE lote.id_producto = producto.id_producto GROUP BY id_producto;");
if (!$stmt->execute()) {
  echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
}

$result = $stmt->get_result();
if($result->num_rows == 0){
  echo "<p class=text-muted style='margin:0 auto;'>No exiten articulos en el inventario.</p>";
}else{
  echo '
  <table class="table">
    <thead>
      <tr>
        <th scope="col" >Producto</th>
        <th scope="col" style="text-align: center;">Stock</th>
      </tr>
    </thead>
    <tbody>';

    while($row = $result->fetch_assoc()){
      $producto = $row["nombre_producto"];
      $cantidad = $row["SUM(stock)"];

      echo '
      <tr>
        <td>'.$producto;
        if($cantidad <5){
          echo '<span class="badge badge-warning">Pocas unidades</span>';
        }
        echo '</td>
        <td style="text-align: center;">'.$cantidad.'</td>
      </tr>
      ';
    }
    echo '
    </tbody>
  </table>
  ';
}






 ?>
