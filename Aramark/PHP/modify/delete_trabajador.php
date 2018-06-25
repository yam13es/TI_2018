<?php
  include "db_info.php";
  $rut = $_POST["id_trabajador"];
  $digito = $_POST["dig"];
  $conn = new mysqli($servername, $username, $password, $dbname);

  $stmt = $conn->prepare("DELETE FROM trabajador WHERE rut_trabajador = '".$rut."-".$digito."'");
  $stmt->execute();
  $stmt->close();
  $conn->close();
 ?>
