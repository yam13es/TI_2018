<?php
  function val_rut($rut){
    $d_verificador = substr($rut, strpos($rut, "-")+1);
    $suma = 0;
    for($i = 0; $i<strpos($rut, "-");$i++){
      $digito = substr($rut, $i, 1);
      $suma += (int)$digito*(2+(strpos($rut, "-") - $i -1)%6);
    }
    return 11-$suma%11 == $d_verificador;
  }

  function val_mail($mail){
    return !(strpos($mail, "@") === false || strpos($mail, "@") == 0 || strpos($mail, "@") == strlen($mail)-1 ||
    strpos($mail, ".") === false || strpos($mail, ".") == 0 || strpos($mail, ".") == strlen($mail)-1 );
  }
 ?>
