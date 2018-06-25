<?php
echo '<nav class="navbar navbar-expand-lg navbar-light border-bottom border-top">
      <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
        </li>
        <li class="nav-item dropdown" id="nav_cv">
              <a class="nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compra y Venta</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="cv_compra.php">Compra</a>
              <a class="dropdown-item" href="cv_venta.php">Venta</a>
            </div>
        </li>
          <li class="nav-item dropdown" id="nav_inf">
              <a class="nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informe</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="inf_consultas.php">Consultas</a>
              <a class="dropdown-item" href="inf_compras.php">Compra</a>
              <a class="dropdown-item" href="inf_ventas.php">Venta</a>
              <a class="dropdown-item" href="inf_inventario.php">Inventarios</a>
              <a class="dropdown-item" href="inf_registros.php">Registros</a>
            </div>
        </li>
        <li class="nav-item dropdown active" id="nav_reg">
              <a class="nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Registro</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="reg_cliente.php">Cliente</a>
              <a class="dropdown-item" href="reg_producto.php">Producto</a>
              <a class="dropdown-item" href="reg_proveedor.php">Proveedor</a>
              <a class="dropdown-item" href="reg_trabajador.php">Trabajador</a>
            </div>
        </li>
      </ul>
</nav>';
 ?>
