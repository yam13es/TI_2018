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
      var c_nombre = $("#nombre-cliente").val();
      var c_id = $("#id-cliente").val();
      var c_rut = $("#rut-cliente").val();

      $.post("PHP/send/send_cliente.php",
      {
        nombre:c_nombre,
        id:c_id,
        rut:c_rut
      },
      function(output){
        $("#collapse_top").collapse("show");
        var result = $.parseJSON(output);
        if(result[0] == 0){
          $("#alert_top").attr({"class":"alert alert-danger"});
        }else if(result[0] == 1){
          $("#alert_top").attr({"class":"alert alert-success"});
          $("#nombre-cliente").val("");
          $("#id-cliente").val("");
          $("#rut-cliente").val("");
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
        <div class="media" style="height:100%">
            <img src="https://i.imgur.com/A4e6MSs.jpg" class="image-responsive mx-auto">
        </div>
      </div>
      <div class="col">
        <form style="width: 100%;margin: 0 auto">
          <div class = "collapse" id="collapse_top" aria-expanded="true">
            <div class="alert alert-primary" role="alert" id="alert_top">
              <p id="top_alert_text"></p>
            </div>
          </div>
          <h4 id="Titulo">Ingreso de nuevo Cliente</h4>

            <div class="form-group">
              <label for="nombre-cliente">Nombre Completo</label>
              <input type="text" class="form-control" id="nombre-cliente" placeholder="Ingrese el nombre del cliente">
            </div>
            <div class="form-group">
              <label for="id-cliente">ID-ENAP</label> <p style="font-size:12px"><i>(Numero que identifica al trabajador dentro de ENAP)</i></p>
              <input type="text" class="form-control" id="id-cliente" placeholder="Ingrese el numero identificador">
            </div>
            <div class="form-group">
              <label for="rut-cliente">Rut</label>
              <input type="text" class="form-control" id="rut-cliente" placeholder="Ingrese el rut del cliente">
            </div>
            <button type="button" class="mx-auto btn btn-danger" id="sendButton" onclick="send();">Enviar</button>
        </form>
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
