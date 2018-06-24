<html style="height:100%;">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="sticky-footer-navbar.css" rel="stylesheet">
  <title>Registro electronico - Aramark</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <script>
  function send(){
    var prov = $("#nombre-proveedor").val();
    var prod = $("#nombre-producto").val();
    var cant = $("#cant-producto").val();
    var f_elab =$("#fecha_elab").val();
    var f_venc =$("#fecha_venc").val();

    $.post("PHP/send/send_compra.php",
    {
      proveedor:prov,
      producto:prod,
      cantidad:cant,
      elab:f_elab,
      venc:f_venc
    },
    function(output){
      $("#collapse_top").collapse("show");
      var result = $.parseJSON(output);
      if(result[0] == 0){
        $("#alert_top").attr({"class":"alert alert-danger"});
      }else if(result[0] == 1){
        $("#alert_top").attr({"class":"alert alert-success"});
      }
      $("#top_alert_text").html(result[1]);
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



  <form style="width: 70%; margin: 10px auto;">
    <div class = "collapse" id="collapse_top">
      <div class="alert alert-primary" role="alert" id="alert_top">
        <p id="top_alert_text"></p>
      </div>
    </div>
    <h4 id="Titulo">Registro de compra</h4>
    <div class="form-group">
      <label for="nombre-proveedor">Nombre proveedor</label>
      <select class="custom-select" id="nombre-proveedor">
        <option selected>Selecciona un elemento...</option>
        <?php
            include "PHP/get/load_proveedores.php";
         ?>
    <!--  </select>
      <small class="form-text text-muted">¿No lo encuentras? <a href="reg_proveedor.php">Agregar</a> </small>
    </div>
    <div class="form-row">
      <div class="col-10">
        <div class="form-group">
          <label for="nombre-producto">Producto</label>
          <select class="custom-select" id="nombre-producto">
            <option selected>Selecciona un elemento...</option>-->
          </select>
          <small class="form-text text-muted">¿No lo encuentras? <a href="reg_producto.php">Agregar</a> </small>
        </div>
      </div>
      <div class = "col">
        <div class="form-group">
          <label for="cant-producto">Cantidad</label>
          <input class="form-control" type="number" id="cant-producto" min="0"/>
        </div>
      </div>
    </div>
    <div class="form-row" style="margin-bottom:10px">
      <div class="col">
        <div class="form-group">
          <label class="control-label" for="date">Fecha de elaboración</label>
          <input class="form-control" id="fecha_elab" name="f_elab" placeholder="AAAA/MM/DD" type="text"/>
          <small class="form-text text-muted">Debe ser en formato Año/Mes/Dia</small>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label class="control-label" for="date">Fecha de Vencimiento</label>
          <input class="form-control" id="fecha_venc" name="f_venc" placeholder="AAAA/MM/DD" type="text"/>
          <small class="form-text text-muted">Debe ser en formato Año/Mes/Dia</small>
        </div>
      </div>
    </div>
    <button type="button" class="mx-auto btn btn-danger" id="sendButton" onclick="send();">Enviar</button>
  </form>



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
