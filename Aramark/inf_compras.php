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
    <h3>Historial de compras</h3>
    <?php include "PHP/get/get_compras.php" ?>
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
