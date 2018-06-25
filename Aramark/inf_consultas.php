<html style="height:100%;">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="sticky-footer-navbar.css" rel="stylesheet">
  <title>Registro electronico - Aramark</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <script>
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
          $("#rut-tarjeta").html("Rut:" + result[3]);
          id_cliente = id_ing;
        }else{
          $("#collapse-id").collapse("hide");
        }
      }
    );
    $.post("PHP/get/load_consulta_cliente.php",
    {
      id:id_ing
    }, function(output){
      var result = $.parseJSON(output);
      var i;
      var tablafinal = "";
      for(i=0; i<result[0].length;i++){
        tablafinal +="<tr><td>"+result[0][i]+"</td>"+
        "<td>"+result[1][i]+"</td>"+
        "<td style='text-align: center;'>"+result[2][i]+"</td>"+
        "<td style='text-align: center;'>"+result[3][i]+"</td>"
        +"</tr>";
      }
      $("#t_body").html(tablafinal);
      $("#numero_total").html(result[4]);
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
      <h4 id="probar">Ingrese una consulta</h4>
      <form>
        <div class="form-group">
          <label for="id-cliente">ID cliente</label>
          <input type="text" class="form-control" id="id-cliente" placeholder="Ingrese el numero identificador" onchange="get_cliente();">
        </div>
      </form>
      <div class = "collapse" id = "collapse-id">
        <div class="card" style="margin:0 auto; width:70%;background-color:#FFFFFF">
          <div class="card-body" style="color:#000000">
            <div class = "container">
              <div class="row">
                <div class="col">
                  <h2 id="nombre-tarjeta"></h2>
                  <h7 id="rut-tarjeta"></h7>
                  <br><br><br>
                </div>
              </div>
              <div class = "row">
                <div class = "col">

                  <h4>Historial de compras</h4>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"> Fecha</th>
                        <th scope="col" >Producto</th>
                        <th scope="col" style="text-align: center;">Cantidad</th>
                        <th scope="col" style="text-align: center;">$</th>
                      </tr>
                    </thead>
                    <tbody id="t_body">
                      <tr></tr>
                    </tbody>
                  </table>

                </div>
              </div>
              <div class="row">
                <div class="col">
                  <b>Total a pagar:</b>
                </div>
                <div class="col" style="text-align:right;">
                  <p style="padding-right:80px" id="numero_total"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
