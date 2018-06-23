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
      var p_nombre = $("#nombre-producto").val();
      var p_id = $("#id-producto").val();
      var p_precio = $("#precio-producto").val();

      $.post("PHP/send/send_producto.php",
      {
        nombre:p_nombre,
        id:p_id,
        precio:p_precio
      },
      function(output){
        $("#collapse_top").collapse("show");
        var result = $.parseJSON(output);
        if(result[0] == 0){
          $("#alert_top").attr({"class":"alert alert-danger"});
        }else if(result[0] == 1){
          $("#alert_top").attr({"class":"alert alert-success"});
          $("#nombre-producto").val("");
          $("#id-producto").val("");
          $("#precio-producto").val("");
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
      <h4 id="Titulo">Ingreso de nuevo Producto</h4>
    </div>
    <div class="row">
      <div class="col">
        <form>
          <div class="form-group">
            <label for="id-producto">ID Producto</label>
            <input type="text" class="form-control" id="id-producto" placeholder="Ingrese el numero identificador">
          </div>
          <div class="form-group">
            <label for="precio-producto">Precio</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">$</span>
              </div>
              <input type="text" class="form-control" id="precio-producto" placeholder="">
            </div>
          </div>
        </form>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="nombre-producto">Nombre del Producto</label>
          <input type="text" class="form-control" id="nombre-producto" placeholder="Ingrese el nombre del producto">
        </div>
        <div style="text-align:center; height:100%;">
          <button type="button" style="vertical-align: middle; margin-bottom:10px;" class="mx-auto btn btn-danger" id="sendButton" onclick="send();">Enviar</button>
          <div class = "collapse" id="collapse_top" aria-expanded="true">
            <div class="alert alert-primary" role="alert" id="alert_top" style="width:100%;">
              <p id="top_alert_text"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="media" style="height:200px;">
            <img src="https://i.imgur.com/u9vhYOP.jpg" style="height:100%" class="image-responsive mx-auto">
            <img src="https://i.imgur.com/HMJrbZJ.jpg" style="height:100%" class="image-responsive mx-auto">
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
