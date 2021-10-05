<?php 
class queryMaker 
{
    private $fields = ["products.product_name","products.quantity_per_unit","products.category"];
    private $tables = ["products"];
    private $operators = ["not","or","and"];
    private $stringquery;

    public function __construct($query) {
        if (strpos($query,"campos")) {
            $rawFields = explode("campos",$query);
            $rawFields[1] = $this->escapeCharacters($rawFields[1]);
            $this->fields = explode(",",$rawFields[1]);
            $this->tables = $this->getTables();
            $this->stringquery = $rawFields[0];
        }
        $this->stringquery = $query;
    }

    private function getTables()
    {
        $newFields = [];
        $arrayfields =  $this->fields;
        $sizeOfArray = sizeof($this->fields);
        
        for ($i=0; $i < $sizeOfArray; $i++) { 
            $table = explode(".",$arrayfields[$i]);
            if (!in_array($table[0],$newFields)) {
               $newFields[]= $table[0];
            }
        }
        return $newFields;
    }

    private function escapeCharacters($string){
        $characteres = ['(',')',' ']; 
        $string = str_replace($characteres,"",$string);
        return $string;
    }


    public function printFileds()
    {
        var_dump($this->fields);
        var_dump($this->tables);
    }

    private function changeFunctionCadena($string)
    {  
        $candenaOccurrences = substr_count($string,"cadena");
        for ($i=0; $i < $candenaOccurrences; $i++) { 
            $initilPosition = strpos($string,"cadena");
            $initilEnd = strpos($string,")");
            $Length = $initilEnd -  $initilPosition;
            $stringExtrated = substr($string, $initilPosition,  $Length+1);
            $stringTrasled = $this->parserCadenaToSQLstatement($stringExtrated);
            $string = str_replace($stringExtrated,$stringTrasled,$string);
        }
        return $string;          
    }

    private function changeFunctionPatron($string)
    {  
        $candenaOccurrences = substr_count($string,"patron");
            for ($i=0; $i < $candenaOccurrences; $i++) { 
                $initilPosition = strpos($string,"patron");
                $initilEnd = strpos($string,")");
                $Length = $initilEnd -  $initilPosition;
                $stringExtrated = substr($string, $initilPosition,  $Length+1);
                $stringTrasled = $this->parserPatronToSQLstatement($stringExtrated);
                $string = str_replace($stringExtrated,$stringTrasled,$string);
            }
        return $string;    
    }

    private function parserCadenaToSQLstatement($statement)
    {
        $fieldsF = $this->fields;
        $characteres = ["cadena","(",")"]; 
        $string = str_replace($characteres,"",$statement);
        $string = str_replace(" ","¨",$string);
        $fixstring = $string;
        $string = implode("='".$string."' or ",$fieldsF);
        return $string."='". $fixstring."'";
    }

    private function parserPatronToSQLstatement($statement){
        $fieldsF = $this->fields;
        $characteres = ["patron","(",")"]; 
        $string = str_replace($characteres,"",$statement);
        $string = str_replace(" ","¨",$string);
        $fixstring = $string;
        $string = implode("¨LIKE¨'%".$string."%' or ",$fieldsF);
        return $string."¨LIKE¨'%".$fixstring."%'";
    }

    private function parserWordToSQLstatement($word)
    {
        $fieldsF = $this->fields;
        $string = implode("¨LIKE¨'%".$word."%' or ",$fieldsF);
        return $string."¨LIKE¨'%".$word."%'";
    }

    private  function isStatementSQL($word)
    {
        if (preg_match("/[a-zA-Z0-9-]*=/",$word)||preg_match("/¨LIKE¨/",$word)) {
            return true;
        }
        return false;
    }


    public function builder()
    {
        $QueryStatement = "SELECT ";
        $fieldsF = implode(",",$this->fields);
        $tables = implode(" INNER JOIN ", $this->tables);
        $QueryStatement .= $fieldsF . " FROM ". $tables. " WHERE ";
        $rawQuery = $this->stringquery;
        $rawQuery = $this->changeFunctionCadena($rawQuery);
        $rawQuery = $this->changeFunctionPatron($rawQuery);
    
        $rawQuery = trim($rawQuery);
        $words = explode(" ",$rawQuery);
        $sizeArray = sizeof($words);
     
        $QueryWhereStatement = "";
        for ($i=0; $i < $sizeArray ; $i++) { 
            if (!in_array($words[$i],$this->operators)&& !$this->isStatementSQL($words[$i])) {
                $QueryWhereStatement .= " ". $this->parserWordToSQLstatement($words[$i]);
               
            }else{
                $QueryWhereStatement .= " ".$words[$i];
               
            }
        } 
        $FinalQuery = $QueryStatement."".$QueryWhereStatement;
        $FinalQuery = str_replace("¨"," ",$FinalQuery);
        return  $FinalQuery;
    }
}   
?>