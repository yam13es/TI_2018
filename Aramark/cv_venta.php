<?php
  session_start();
 ?>

<html style="height:100%;">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="sticky-footer-navbar.css" rel="stylesheet">
  <title>Registro electronico - Aramark</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <script>
    function login(){
      var rut_ing = $("#rut-trabajador").val();
      var clave_ing = $("#clave-trabajador").val();
      $.post("login.php",
      {
        rut: rut_ing,
        clave: clave_ing
      },
      function(output){
          $("#collapse_top").collapse("show");
          var result = $.parseJSON(output);
          if(result[0] == 0){
            $("#alert_top").attr({"class":"alert alert-danger"});
          }else if(result[0] == 1){
            $("#alert_top").attr({"class":"alert alert-success"});
            $("#rut-trabajador").val("");
            $("#clave-trabajador").val("");
            window.location.reload(false);
          }
          $("#top_alert_text").html(result[1]);

      });
    }

    function logout(){
      $.post("logout.php",{},function(output){
        window.location.reload(false);
      });
    }
    function get_cliente(){
      var id_ing = $("#id-cliente").val();
      $.post("PHP/get/get_cliente.php",
        {
          id: id_ing
        },
        function(output){
          var result = $.parseJSON(output);
          if(result[0] == 1){
            $("#collapse-id").collapse("show");
            $("#nombre-tarjeta").html(result[2]);
            $("#rut-tarjeta").html(result[3]);
          }else{
            $("#collapse-id").collapse("hide");
          }
        }
      )
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
  <nav class="navbar navbar-expand-lg navbar-light border-bottom border-top">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compra y Venta</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="cv_compra.php">Compra</a>
                <a class="dropdown-item" href="cv_venta.php">Venta</a>
              </div>
          </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informe</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Consultas</a>
                <a class="dropdown-item" href="#">Compra</a>
                <a class="dropdown-item" href="#">Venta</a>
              </div>
          </li>
          <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Registro</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="reg_cliente.php">Cliente</a>
                <a class="dropdown-item" href="reg_producto.php">Producto</a>
                <a class="dropdown-item" href="reg_proveedor.php">Proveedor</a>
                <a class="dropdown-item" href="reg_trabajador.php">Trabajador</a>
              </div>
          </li>
        </ul>
  </nav>
  <?php
    if(!isset($_SESSION["username"]) || !isset($_SESSION["rut"])){
      echo '
      <div class="border-bottom" style="width:100%;">
        <form style="width: 30%; margin: 20px auto;">
          <div class = "collapse" id="collapse_top">
            <div class="alert alert-primary" role="alert" id="alert_top">
              <p id="top_alert_text"></p>
            </div>
          </div>
          <h4 id="Titulo">Se requiere inicio de sesión</h4>
          <div class="form-group">
            <label for="rut-trabajador">Rut</label> <p style="font-size: 11px"><i>(sin puntos y con guión)</i></p>
            <input type="text" class="form-control" id="rut-trabajador" placeholder="Ingrese el rut del trabajador">
          </div>
          <div class="form-group">
            <label for="clave-trabajador">Contraseña</label><p style="font-size: 11px"><i>(Por defecto, el rut)</i></p>
            <input type="password" class="form-control" id="clave-trabajador" placeholder="Password">
          </div>
          <button type="button" class="mx-auto btn btn-danger" id="sendButton" onclick="login();">Enviar</button>
        </form>
      </div>

      ';
    }else{
      echo '
      <div class = "container">
        <div class="row">
          <div class="col">
          </div>
          <div class="col">
            <p align="right">Sesión iniciada como: <b>'.$_SESSION["username"].'</b> (<a href="javascript:logout();">Salir</a>)</p>
          </div>
        </div>
      </div>

      ';
    }
  ?>
  <div class = "container">
    <div class = "row">
      <div class = "col">
        <h4>Ingresar una nueva venta</h4>
        <form>
          <div class="form-group">
            <label for="id-cliente">ID cliente</label>
            <input type="text" class="form-control" id="id-cliente" placeholder="Ingrese el numero identificador" onchange="get_cliente();">
          </div>
        </form>
      </div>
      <div class = "col">
        <div class = "collapse" id = "collapse-id">
          <div class="card" style="margin:0 auto; max-height: 125px;width:70%;background-color:#EEEEEE">
            <div class="card-body">
              <h3 id="nombre-tarjeta"></h3>
              <h7 id="rut-tarjeta"></h7>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class = "col">
      <form>
        <div class="form-group">
          <div class="dropdown">
            <label for="nombre-producto">Producto</label>
            <select class="custom-select" id="nombre-producto">
              <option selected>Open this select menu</option>

            </select>
          </div>

        </div>
      </form>
    </div>
    </div>
  </div>


  <div>
    <br><br><br>
  </div>

	<footer class = "footer">
		<div class = "container">
			<p id="foot_text">Avda. del Condor 760 Ciudad Empresarial, Huechuraba, Santiago, Chile <br>
							  Telefono mesa central [56-2] 2385 1000</p>
		</div>
	</footer>
</body>
</html>
