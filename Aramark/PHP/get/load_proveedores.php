<?php
  include "db_info.php";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  if(!($stmt = $conn->prepare("SELECT nombre_proveedor FROM proveedor"))){
    echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
  }
  if (!$stmt->execute()) {
    echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
  }
  $result = $stmt->get_result();
  if($result->num_rows != 0){
    while($row = $result->fetch_assoc()){
      echo "<option>".$row['nombre_proveedor']."</option>";
    }
  }
    $stmt->close();

    echo '</select>
    <small class="form-text text-muted">¿No lo encuentras? <a href="reg_proveedor.php">Agregar</a> </small>
  </div>
  <div class="form-row">
    <div class="col-10">
      <div class="form-group">
        <label for="nombre-producto">Producto</label>
        <select class="custom-select" id="nombre-producto">
          <option selected>Selecciona un elemento...</option>';

          if(!($stmt = $conn->prepare("SELECT nombre_producto FROM producto"))){
            echo json_encode(array(0, "Error: " . $sql . "<br>" . $conn->error));
          }
          if (!$stmt->execute()) {
            echo json_encode(array(0,"Execute failed: (" . $stmt->errno . ") " . $stmt->error));
          }
          $result = $stmt->get_result();
          if($result->num_rows != 0){
            while($row = $result->fetch_assoc()){
              echo "<option>".$row['nombre_producto']."</option>";
            }
          }
            $stmt->close();

    $conn->close();
?>
