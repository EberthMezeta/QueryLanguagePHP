<?php 
    $cad = "CADENA(con chile)";
    $patron = "/\([a-zA-Z]+[\s][a-zA-Z]+\)/i";
    $ca2= preg_replace($patron,"-",$cad);
    echo $ca2
?>