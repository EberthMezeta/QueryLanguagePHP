<?php 


$Values = Array();

$Values["Key"] = 0 ;
$Values["Key"]++;
$Values["Key"]++;
$Values["Key"]++;
$Values["Key"]++;
$Values["Key2"]= "3";
$Values["Key3"]= 7;

try {
    echo $Values["key5"];
} catch (Exception $th) {
    echo $th;
}
//var_dump($Values);

//$Query = "Papas Potato AND NOT Chips AND CADENA(con chile) OR PATRON(sabri) CAMPOS(products.description,)";
//$Query = strtolower($Query);

//$q = preg_split("/\s+/", $Query);
//echo var_dump($q);



//$Query2 = preg_replace("/s{2,}/","-",$Query);
//echo "Query 1:";
//echo $Query2;

//$NewQuery =  explode("/S*/",$Query);
//echo "Query: ";
//$s= trim($Query);
//var_dump($s);

//var_dump($NewQuery);
?>