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
    $(document).ready(function() {
      dict_lotes ={0:0,1:0,2:0,3:0};
      id_cliente = "";
      $("#nav_inf").attr({"class":"nav-item dropdown"});
      $("#nav_cv").attr({"class":"nav-item dropdown active"});
      $("#nav_reg").attr({"class":"nav-item dropdown"});
      $.post("PHP/get/load_productos.php",{},
      function(output){
        var result = $.parseJSON(output);
        dict = {};
        var i;
        var string= "";
        for(i=0; i<result[0].length;i++){
          dict[result[0][i]] = result[1][i];
          string +="<option>"+result[0][i]+"</option>";
        }
        for(i=0;i<4;i++){
          $("#nombre-producto-"+i).html(string);
          $("#precio-"+i).html(dict[$("#nombre-producto-"+i).val()]);
          $("#total-"+i).html($("#precio-"+i).val()*$("#cant-producto-"+i).val());
        }
      });
    });

    function update(i){
      $("#check-"+i).attr("checked", true);
      update_all();
    }

    function update_lote(i){
      var name = $("#nombre-producto-"+i).val();
      $.post("PHP/get/load_lotes.php",{
        nombre:name
      },
      function(output){
        var result = $.parseJSON(output);
        var int_dict={}
        var u;
        var string_out = "";
        for(u = 0; u<result[0].length;u++){
          int_dict[result[0][u]] = [result[1][u], result[2][u]];
          string_out +="<option>"+result[0][u]+"</option>";
        }
        $("#lote-producto-"+i).html(string_out);
        dict_lotes[i] = int_dict;
      });
      update(i);
    }

    function change_lote(i){
      $("#cant-producto-"+i).attr({"max":dict_lotes[i][$("#lote-producto-"+i).val()][0]});
    }



    function enviar(){
      var checked = [];
      var prod_name =[];
      var lote_id =[];
      var cant = [];
      var max = [];
      var cliente = id_cliente;
      var i;
      for(i=0;i<4;i++){
        if($("#check-"+i).is(":checked")){
          checked.push(1);
        }else{
          checked.push(0);
        }
        prod_name.push($("#nombre-producto-"+i).val());
        if(typeof dict_lotes[i][$("#lote-producto-"+i).val()] !== "undefined"){
          lote_id.push(dict_lotes[i][$("#lote-producto-"+i).val()][1]);
        }else{
          lote_id.push(0);
        }
        if(typeof dict_lotes[i][$("#lote-producto-"+i).val()] !== "undefined"){
          max.push(dict_lotes[i][$("#lote-producto-"+i).val()][0]);
        }else{
          max.push(0);
        }
        cant.push($("#cant-producto-"+i).val());
      }
      $.post("PHP/send/send_venta.php",
        {
          chek:checked,
          names:prod_name,
          lotes:lote_id,
          cantidades:cant,
          id_cliente:cliente,
          maxs:max
        },
        function(output){
          var result = $.parseJSON(output);
          if(result[0] != 2){
            $("#collapse_result").collapse("show");
          }
          if(result[0] == 0){
            $("#alert_top").attr({"class":"alert alert-danger"});
          }else if(result[0] == 1){
            var i;
            $("#alert_top").attr({"class":"alert alert-success"});
            $("#id-cliente").val("");
            for (i=0; i<4;i++){
              $("#lote-producto-"+i).val("Elige un lote...");
              $("#nombre-producto-"+i).val("Elige un producto...");
              $("#cant-producto-"+i).val("");
              $("#check-"+i).attr("checked", false);
            }
          }
          $("#top_alert_result").html(result[1]);
        }
      )
    }

    function update_all(){
      var i;
      var suma = 0;
      for(i=0;i<4;i++){
        $("#precio-"+i).html(dict[$("#nombre-producto-"+i).val()]);
        $("#total-"+i).html($("#precio-"+i).html()*($("#cant-producto-"+i).val()));
        suma += parseInt($("#total-"+i).html());
      }
      $("#totaltotal").html(suma);
    }
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
            id_cliente = id_ing;
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
  <!--<nav class="navbar navbar-expand-lg navbar-light border-bottom border-top">
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
  </nav>-->
  <?php
  include "nav_bar.php";
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


  <div class = "container border-bottom" style="margin-top:10px;">
    <div class="row">
      <div class = "collapse" id="collapse_result">
        <div class="alert alert-primary" role="alert" id="alert_top">
          <p id="top_alert_result"></p>
        </div>
      </div>
    </div>
    <div class = "row">
      <div class = "col">
        <h4 id="probar">Ingresar una nueva venta</h4>
        <form>
          <div class="form-group">
            <label for="id-cliente">ID cliente</label>
            <input type="text" class="form-control" id="id-cliente" placeholder="Ingrese el numero identificador" onchange="get_cliente();">
          </div>
        </form>
      </div>
      <div class = "col">
        <div class = "collapse" id = "collapse-id">
          <div class="card" style="margin:0 auto; max-height: 125px;width:70%;background-color:#FFFFFF">
            <div class="card-body" style="color:#000000">
              <div class="row">
                <div class="col">
                  <h3 id="nombre-tarjeta"></h3>
                  <h7 id="rut-tarjeta"></h7>
                  <br><br><br>
                </div>
                <div class="col" style="margin-bottom:15px">
                  <div class ="media" style = "margin-bottom:15px">
                    <img class="img-responsive" style="margin: 0 auto; max-height:100px; !important"  src="https://i.imgur.com/GKRSqbG.jpg">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="padding-top:10px">
    <div class = "col">
      <form>
        <div class="row">
          <div class="col-5">
            <label for="nombre-producto">Productos</label>
          </div>
          <div class="col-4">
            <label for="nombre-producto">Elaboración/Vencimiento</label>
          </div>
          <div class="col" style="padding-left:10px">
              <label for="cant-producto">Cantidad</label>
          </div>
          <div class="col" style="padding-left:33px">
            <label >Total</label>
          </div>
        </div>




        <div class="form-row">
          <div class="col-4">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="check-0">
                  </div>
                </div>
                <select class="custom-select" id="nombre-producto-0" onchange="update_lote(0);">
                  <option selected>Open this select menu</option>

                </select>
              </div>
            </div>
          </div>
          <div class="col-4">
            <select class="custom-select" id="lote-producto-0" onchange="change_lote(0);">
              <option selected>Elige un lote...</option>

            </select>
          </div>
          <div class="col-1">
            <center id="precio-0">950</center>
          </div>
          <div class="col-1">
            <input class="form-control" id="cant-producto-0" min="0" max = "0" type="number" onchange="update(0);">
          </div>
          <div class="col-2">
            <p><center id="total-0">Total</center></p>
          </div>
        </div>




        <div class="form-row">
          <div class="col-4">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="check-1">
                  </div>
                </div>
                <select class="custom-select" id="nombre-producto-1" onchange="update_lote(1);">
                  <option selected>Open this select menu</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-4">
            <select class="custom-select" id="lote-producto-1" onchange="change_lote(1);">
              <option selected>Elige un lote...</option>

            </select>
          </div>
        <div class="col-1">
          <center id="precio-1">950</center>
        </div>
        <div class="col-1">
          <input class="form-control" id="cant-producto-1" min="0" type="number" onchange="update(1);">
        </div>
        <div class="col-2">
          <p><center id="total-1">Total</center></p>
        </div>
      </div>




      <div class="form-row">
        <div class="col-4">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="check-2">
                  </div>
                </div>
                <select class="custom-select" id="nombre-producto-2" onchange="update_lote(2);">
                  <option selected>Open this select menu</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-4">
            <select class="custom-select" id="lote-producto-2" onchange="change_lote(2);">
              <option selected>Elige un lote...</option>

            </select>
          </div>
          <div class="col-1">
            <center id="precio-2">950</center>
          </div>
          <div class="col-1">
            <input class="form-control" id="cant-producto-2" min="0" type="number" onchange="update(2);">
          </div>
          <div class="col-2">
            <p><center id="total-2">Total</center></p>
          </div>
        </div>




        <div class="form-row">
          <div class="col-4">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="check-3">
                  </div>
                </div>
                <select class="custom-select" id="nombre-producto-3" onchange="update_lote(3);">
                  <option selected>Open this select menu</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-4">
            <select class="custom-select" id="lote-producto-3" onchange="change_lote(3);">
              <option selected>Elige un lote...</option>

            </select>
          </div>
          <div class="col-1">
            <center id="precio-3">950</center>
          </div>
          <div class="col-1">
            <input class="form-control" id="cant-producto-3" min="0" type="number" onchange="update(3);">
          </div>
          <div class="col-2">
            <p><center id="total-3">Total</center></p>
          </div>
        </div>
      </form>
    </div>
    </div>
  </div>


  <div class="container" style="padding-top:15px;">
    <div class="row">
      <div class="col-9">
      </div>
      <div class="col">
        <b>Total: </b>
      </div>
      <div class="col">
        <p id="totaltotal"></p>
      </div>
    </div>
  </div>
  <div class="container" style="padding-top:15px;">
    <div class="row">
      <div class="col-10">
      </div>
      <div class="col">
        <button type="button" class="mx-auto btn btn-danger" id="sendButton" onclick="enviar();">Enviar</button>
      </div>
    </div>
  </div>
  <div>
    <br><br><br>
  </div>
  ';
  }
  ?>
	<footer class = "footer">
		<div class = "container">
			<p id="foot_text">Avda. del Condor 760 Ciudad Empresarial, Huechuraba, Santiago, Chile <br>
							  Telefono mesa central [56-2] 2385 1000</p>
		</div>
	</footer>
</body>
</html>
