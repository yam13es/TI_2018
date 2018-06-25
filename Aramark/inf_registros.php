<html style="height:100%;">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="sticky-footer-navbar.css" rel="stylesheet">
  <title>Registro electronico - Aramark</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <script>
  $(document).ready(function(){
    $("#nav_inf").attr({"class":"nav-item dropdown active"});
    $("#nav_cv").attr({"class":"nav-item dropdown"});
    $("#nav_reg").attr({"class":"nav-item dropdown"});
  });
  function delete_cliente(id){
    $.post("PHP/modify/delete_cliente.php",{
      id_cliente:id
    },function(output){
      window.location.reload(false);
    });
  }
  function delete_producto(id){
    $.post("PHP/modify/delete_producto.php",{
      id_producto:id
    },function(output){
      window.location.reload(false);
    });
  }
  function delete_proveedor(id){
    $.post("PHP/modify/delete_proveedor.php",{
      id_proveedor:id
    },function(output){
      window.location.reload(false);
    });
  }
  function delete_trabajador(rut, digito){
    $.post("PHP/modify/delete_trabajador.php",{
      id_trabajador:rut,
      dig: digito
    },function(output){
      window.location.reload(false);
    });
  }
  </script>

</head>

<style type="text/css">
.footer {
  width: 100%;
    padding: .8rem;
    background-color: #EAEAEA;
    text-align: center;
}

#foot_text{
  color: #656565;
  font-size: .8em;
}
.b_line{
  border-bottom: 10px;
}
</style>

<body style="margin:0;padding:0; height: 100%;">
  <div class ="media">
    <a href="index.html" style="margin: 0 auto;"><img class="img-responsive"  src="https://botw-pd.s3.amazonaws.com/styles/logo-thumbnail/s3/122013/aramark.png?itok=gWhdqGKd"></a>
  </div>
  <?php include "nav_bar.php" ?>
  <div><br></div>

  <div class = "container">
    <h3 id="probar-1">Registro de clientes</h3>
    <?php
    include "db_info.php";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("SELECT * FROM cliente");
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows == 0){
      echo "<p class=text-muted style='margin:0 auto;'>No exiten clientes registrados.</p>";
    }else{
      echo '
      <table class="table table-hover" style="margin-top:10px">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">ID-ENAP</th>
            <th scope="col">Rut</th>
            <th scope="col-1"></th>
          </tr>
        </thead>
        <tbody>';

        $i = 0;
        while($row = $result->fetch_assoc()){
          $id = $row["id_cliente"];
          $cliente = $row["nombre"];
          $rut = $row["rut"];

          echo '
          <tr>
            <td>'.$cliente.'</td>
            <td>'.$id.'</td>
            <td>'.$rut.'</td>
            <td scope="col-1"><span><button type="button" class="mx-auto btn btn-sm btn-danger" id="boton-'.$i.'" onclick="delete_cliente('.$id.')">Eliminar</button></span></td>
          </tr>
          ';
          $i++;
        }
        echo '
        </tbody>
      </table>
      ';
    }
      ;
     ?>
  </div>
  <div class = "container">
    <h3 id="probar">Registro de Productos</h3>
    <?php

    $stmt = $conn->prepare("SELECT * FROM producto");
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows == 0){
      echo "<p class=text-muted style='margin:0 auto;'>No exiten productos registrados.</p>";
    }else{
      echo '
      <table class="table table-hover" style="margin-top:10px">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col-1"></th>
          </tr>
        </thead>
        <tbody>';

        $i = 0;
        while($row = $result->fetch_assoc()){
          $id = $row["id_producto"];
          $cliente = $row["nombre_producto"];
          $rut = $row["precio"];

          echo '
          <tr>
            <td>'.$id.'</td>
            <td>'.$cliente.'</td>
            <td>'.$rut.'</td>
            <td scope="col-1"><span><button type="button" class="mx-auto btn btn-sm btn-danger" id="boton-'.$i.'" onclick="delete_producto('.$id.')">Eliminar</button></span></td>
          </tr>
          ';
          $i++;
        }
        echo '
        </tbody>
      </table>
      ';
    }
      ;
     ?>
  </div>
  <div class = "container">
    <h3 id="probar">Registro de Proveedores</h3>
    <?php

    $stmt = $conn->prepare("SELECT * FROM proveedor");
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows == 0){
      echo "<p class=text-muted style='margin:0 auto;'>No exiten proveedores registrados.</p>";
    }else{
      echo '
      <table class="table table-hover" style="margin-top:10px">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Dirrecion</th>
            <th scope="col">Telefono</th>
            <th scope="col-1"></th>
          </tr>
        </thead>
        <tbody>';

        $i = 0;
        while($row = $result->fetch_assoc()){
          $nombre = $row["nombre_proveedor"];
          $correo = $row["correo"];
          $telefono = $row["telefono"];
          $direccion = $row["direccion"];
          $id = $row["id_proveedor"];

          echo '
          <tr>
            <td>'.$nombre.'</td>
            <td>'.$correo.'</td>
            <td>'.$direccion.'</td>
            <td>'.$telefono.'</td>
            <td scope="col-1"><span><button type="button" class="mx-auto btn btn-sm btn-danger" id="boton-'.$i.'" onclick="delete_proveedor('.$id.')">Eliminar</button></span></td>
          </tr>
          ';
          $i++;
        }
        echo '
        </tbody>
      </table>
      ';
    }
      ;
     ?>
       <h3 id="probar">Registro de Trabajadores</h3>
       <?php

       $stmt = $conn->prepare("SELECT * FROM trabajador");
       $stmt->execute();

       $result = $stmt->get_result();
       if($result->num_rows == 0){
         echo "<p class=text-muted style='margin:0 auto;'>No exiten trabajadores registrados.</p>";
       }else{
         echo '
         <table class="table table-hover" style="margin-top:10px">
           <thead>
             <tr>
               <th scope="col">Nombre</th>
               <th scope="col">Rut</th>
               <th scope="col-1"></th>
             </tr>
           </thead>
           <tbody>';

           $i = 0;
           while($row = $result->fetch_assoc()){
             $nombre = $row["nombre_trabajador"];
             $rut_trabajador = strval($row["rut_trabajador"]);
             $rut = substr($rut_trabajador, 0, strpos($rut_trabajador, "-"));
             $digito = substr($rut_trabajador, strpos($rut_trabajador, "-")+1);
             echo '
             <tr>
               <td>'.$nombre.'</td>
               <td>'.$rut_trabajador.'</td>
               <td scope="col-1"><span><button type="button" class="mx-auto btn btn-sm btn-danger" id="boton-'.$i.'" onclick="delete_trabajador('.$rut.', '.$digito.')">Eliminar</button></span></td>
             </tr>
             ';
             $i++;
           }
           echo '
           </tbody>
         </table>
         ';
       }
         ;
        ?>

  <div><br><br><br></div>
  <footer class = "footer">
    <div class = "container">
      <p id="foot_text">Avda. del Condor 760 Ciudad Empresarial, Huechuraba, Santiago, Chile <br>
                Telefono mesa central [56-2] 2385 1000</p>
    </div>
  </footer>
</body>
</html>
