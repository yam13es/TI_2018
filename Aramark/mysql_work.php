<?php

function start_connection(){
  $servername = "localhost";
  $username = "root";
  $password = "aramark2018";
  $dbname = "aramark";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    echo json_encode(array(0, "Error conectandose a la base de datos."));
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}

function prepare_insert_statement($table, $columns, $con){
  $aux = "";
  $aux_questions = "";
  for($i = 0; $i<sizeof($columns);$i++){
    $aux = $aux." ".$columns[i];
    $aux_questions = $aux_questions." ?";
    if($i != sizeof($columns)-1){
      $aux = $aux.",";
      $aux_questions = $aux_questions.",";
    }
  }
  $stmt = $con->prepare("INSERT INTO ".$table."(".$aux.") VALUES (".$aux_questions.")");
  return $stmt;
}
 ?>
