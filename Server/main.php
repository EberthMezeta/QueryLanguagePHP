<?php 
    //Se añaden los objetos que van a servir
    require_once("./DBConnection.php");
    require_once("./DBgetData.php");
    require_once("./queryMaker.php");
    //Se recibe la query
    $rawQuery = $_GET['q'];
    //$rawQuery = "Condiments";
    $ObjectConnection = new DBConnection();
    $ObjectGetData = new DBgetData();
    $rawQuery = strtolower($rawQuery);
    //echo $rawQuery;
    $ObjectQueryMaker = new queryMaker($rawQuery);
    $query = $ObjectQueryMaker->builder();
    $connection = $ObjectConnection->get_connection();
    $ArrayResult= $ObjectGetData->get_Array_Result($connection,$query);
    var_dump($ArrayResult);


    
?>