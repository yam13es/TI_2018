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
      var p_nombre = $("#nombre-proveedor").val();
      var p_correo = $("#correo-proveedor").val();
      var p_direccion = $("#direccion-proveedor").val();
      var p_numero = $("#numero-proveedor").val();
      var p_ciudad = $("#ciudad-proveedor").val();
      var p_fono = $("#fono-proveedor").val();

      $.post("PHP/send/send_proveedor.php",
      {
        nombre:p_nombre,
        correo:p_correo,
        direccion:p_direccion,
        numero:p_numero,
        ciudad:p_ciudad,
        fono:p_fono
      },
      function(output){
        $("#collapse_top").collapse("show");
        var result = $.parseJSON(output);
        if(result[0] == 0){
          $("#alert_top").attr({"class":"alert alert-danger"});
        }else if(result[0] == 1){
          $("#alert_top").attr({"class":"alert alert-success"});
          $("#nombre-proveedor").val("");
          $("#correo-proveedor").val("");
          $("#direccion-proveedor").val("");
          $("#numero-proveedor").val("");
          $("#ciudad-proveedor").val("");
          $("#fono-proveedor").val("");
        }
        $("#top_alert_text").html(result[1]);
      }
    );


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


  <div class="container" style="padding:0;width:100%;">
    <div class="row">
      <div class="col">
        <form style="width: 100%;margin: 0 auto">
          <div class = "collapse" id="collapse_top" aria-expanded="true">
            <div class="alert alert-primary" role="alert" id="alert_top">
              <p id="top_alert_text"></p>
            </div>
          </div>
          <h4 id="Titulo">Ingreso de nuevo Proveedor</h4>

            <div class="form-group">
              <label for="nombre-proveedor">Nombre Completo</label>
              <input type="text" class="form-control" id="nombre-proveedor" placeholder="Ingrese el nombre del proveedor">
            </div>
            <div class="form-group">
              <label for="correo-proveedor">Correo</label>
              <input type="text" class="form-control" id="correo-proveedor" placeholder="Ingrese el correo de contacto">
            </div>
            <div class="container" style="padding:0; margin-left:0">
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="direccion-proveedor">Direccion</label>
                    <input type="text" class="form-control" id="direccion-proveedor" placeholder="Calle, Comuna, etc.">
                  </div>
                </div>
              </div>
              <div class = "row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="numero-proveedor">N°</label>
                    <input type="number" class="form-control" id="numero-proveedor" placeholder="">
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <label for="ciudad-proveedor">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad-proveedor" placeholder="">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="fono-proveedor">Teléfono</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">+56</span>
                </div>
                <input type="text" class="form-control" id="fono-proveedor" placeholder="">
              </div>
            </div>
            <button type="button" class="mx-auto btn btn-danger" id="sendButton" onclick="send();">Enviar</button>
        </form>
      </div>
      <div class="col">
        <div class="media" style="max-height:500">
  				<img src="https://i.imgur.com/AWpoYlH.jpg" class="image-responsive mx-auto">
  			</div>
      </div>
    </div>
  </div>


  <div><br><br><br></div>
  <footer class = "footer">
    <div class = "container">
      <p id="foot_text">Avda. del Condor 760 Ciudad Empresarial, Huechuraba, Santiago, Chile <br>
                Telefono mesa central [56-2] 2385 1000</p>
    </div>
  </footer>
</body>
</html>
