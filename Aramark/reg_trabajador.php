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
     //$("#alert_top").attr({"class":"alert alert-danger"});
     var rut_ing = $("#rut-trabajador").val();
     var nombre_ing = $("#nombre-trabajador").val();

     $.post("PHP/send/send_trabajador.php",{rut:rut_ing,nombre:nombre_ing},
      function(output){
        $("#collapse_top").collapse("show");
        var result = $.parseJSON(output);
        if(result[0] == 0){
          $("#alert_top").attr({"class":"alert alert-danger"});
        }else if(result[0] == 1){
          $("#alert_top").attr({"class":"alert alert-success"});
          $("#rut-trabajador").val("");
          $("#nombre-trabajador").val("");
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
  <?php include "nav_bar.php" ?>
  <div><br></div>


  <form style="width: 70%; margin: 0 auto;">
    <div class = "collapse" id="collapse_top">
      <div class="alert alert-primary" role="alert" id="alert_top">
        <p id="top_alert_text"></p>
      </div>
    </div>
    <h4 id="Titulo">Ingreso de nuevo trabajador</h4>
    <div class="form-group">
      <label for="rut-trabajador">Rut</label> <p style="font-size: 11px"><i>(sin puntos y con guión)</i></p>
      <input type="text" class="form-control" id="rut-trabajador" placeholder="Ingrese el rut del trabajador">
    </div>
    <div class="form-group">
      <label for="nombre-trabajador">Nombre</label>
      <input type="text" class="form-control" id="nombre-trabajador" placeholder="Nombre para el registro">
    </div>
    <button type="button" class="mx-auto btn btn-danger" id="sendButton" onclick="send();">Enviar</button>
  </form>

  <div><br><br><br></div>
  <footer class = "footer">
    <div class = "container">
      <p id="foot_text">Avda. del Condor 760 Ciudad Empresarial, Huechuraba, Santiago, Chile <br>
                Telefono mesa central [56-2] 2385 1000</p>
    </div>
  </footer>
</body>
</html>
