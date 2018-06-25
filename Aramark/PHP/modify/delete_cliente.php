<?php
  include "db_info.php";
  $id = $_POST["id_cliente"];
  $conn = new mysqli($servername, $username, $password, $dbname);

  $stmt = $conn->prepare("DELETE FROM cliente WHERE id_cliente = '".$id."'");
  $stmt->execute();
  $stmt->close();
  $conn->close();
 ?>
