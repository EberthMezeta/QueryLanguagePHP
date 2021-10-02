<?php 
    //Se añaden los objetos que van a servir
    require_once("./DBConnection.php");
    require_once("./DBgetData.php");
    require_once("./queryMaker.php");
    //Se recibe la query


    $ObjectConnection = new DBConnection();
    $ObjectGetData = new DBgetData();
    
    $query = "SELECT product_name FROM products WHERE product_name='Northwind Traders Beer'";

    $connection = $ObjectConnection->get_connection();

    $ArrayResult= $ObjectGetData->get_Array_Result($connection,$query);

    var_dump($ArrayResult);


    
?>