<?php
  include "db_info.php";
  $id = $_POST["id_producto"];
  $conn = new mysqli($servername, $username, $password, $dbname);

  $stmt = $conn->prepare("DELETE FROM producto WHERE id_producto = '".$id."'");
  $stmt->execute();
  $stmt->close();
  $conn->close();
 ?>
