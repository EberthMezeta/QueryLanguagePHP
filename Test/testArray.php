<?php 

/*
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
*/
//$FieldByDefault = [, , ];

function escapeCharacters($string){
    $characteres = ['(',')',' ']; 
    $string = str_replace($characteres,"",$string);
    return $string;
}

$Query = "nelson cadena(con chile) totopos patron(con salsa) ";

function changeFunctionCadena($string)
{  
    $candenaOccurrences = substr_count($string,"cadena");
    for ($i=0; $i < $candenaOccurrences; $i++) { 
        $initilPosition = strpos($string,"cadena");
        $initilEnd = strpos($string,")");
        $Length = $initilEnd -  $initilPosition;
        $stringExtrated = substr($string, $initilPosition,  $Length+1);
        $stringTrasled = parserCadenaToSQLstatement($stringExtrated);
        $string = str_replace($stringExtrated,$stringTrasled,$string);
    }
    return $string;          
}

function changeFunctionPatron($string)
{  
    $candenaOccurrences = substr_count($string,"patron");
    for ($i=0; $i < $candenaOccurrences; $i++) { 
        $initilPosition = strpos($string,"patron");
        $initilEnd = strpos($string,")");
        $Length = $initilEnd -  $initilPosition;
        $stringExtrated = substr($string, $initilPosition,  $Length+1);
        $stringTrasled = parserPatronToSQLstatement($stringExtrated);
        $string = str_replace($stringExtrated,$stringTrasled,$string);
    }
   return $string;    
}


function parserCadenaToSQLstatement($statement)
{
    $fields = ["products.product_name","products.quantity_per_unit","products.category"];
    $characteres = ["cadena","(",")"]; 
    $string = str_replace($characteres,"",$statement);
    $string = str_replace(" ","¨",$string);
    $fixstring = $string;
    $string = implode("='".$string."' OR ",$fields);
    return $string."='". $fixstring."'";
}

function parserPatronToSQLstatement($statement)
{
    $fields = ["products.product_name","products.quantity_per_unit","products.category"];
    $characteres = ["patron","(",")"]; 
    $string = str_replace($characteres,"",$statement);
    $string = str_replace(" ","¨",$string);
    $fixstring = $string;
    $string = implode("¨LIKE¨'%".$string."' OR ",$fields);
    return $string."¨LIKE¨'%".$fixstring."'";
}

echo $Query."\n";

$Query = changeFunctionCadena($Query);
$Query = changeFunctionPatron($Query);

echo $Query."\n";




//$Query3 = "Papas Potato AND NOT Chips AND CADENA(con chile) OR PATRON(sabri)";
//$Query = strtolower($Query);
//$fields = ["products.product_name","products.quantity_per_unit","products.category"];
//$q = preg_split("/\s+/", $Query);
//echo var_dump($q);

/*
if (strpos($Query,"CAMPOS")) {
    echo strpos($Query,"CAMPOS");
    echo "SI ESTA";
}else{
    echo "NO ESTAS";
}
*/
//$raw = explode("CAMPOS",$Query);
//var_dump($raw);
//$raw[1] = escapeCharacters($raw[1]);

//var_dump($raw);
//$s = "jose jose almenz baes";
//$s = str_replace("jose","maurio",$s);
//echo $s;

//$Query2 = preg_replace("/s{2,}/","-",$Query);
//echo "Query 1:";
//echo $Query2;

//$NewQuery =  explode("/S*/",$Query);
//echo "Query: ";
//$s= trim($Query);
//var_dump($s);

//var_dump($NewQuery);
?>