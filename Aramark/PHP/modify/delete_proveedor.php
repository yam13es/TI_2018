<?php
  include "db_info.php";
  $id = $_POST["id_proveedor"];
  $conn = new mysqli($servername, $username, $password, $dbname);

  $stmt = $conn->prepare("DELETE FROM proveedor WHERE id_proveedor = '".$id."'");
  $stmt->execute();
  $stmt->close();
  $conn->close();
 ?>
