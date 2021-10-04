<?php 
class queryMaker 
{
    private $fields = ["products.product_name","products.quantity_per_unit","products.category"];
    private $tables = ["products"];
    private $stringquery;

    public function __construct($query) {
        if (strpos($query,"CAMPOS")) {
            $rawFields = explode("CAMPOS",$query);
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

    function escapeCharacters($string){
        $characteres = ['(',')',' ']; 
        $string = str_replace($characteres,"",$string);
        return $string;
    }


    public function printFileds()
    {
        var_dump($this->fields);
        var_dump($this->tables);
    }

    public function builder()
    {
        $statemantQuery = "SELECT ";
        $fields = implode(",",$this->fields);
        $tables = implode(" INNER JOIN ", $this->tables);
        $statemantQuery .= $fields . " FROM ". $tables. " WHERE ";
        echo $statemantQuery;
       // $rawQuery = $this->stringquery;


        //return $statemantQuery;
    }




}   
    $Query = "Papas Potato AND NOT Chips AND CADENA(con chile) OR PATRON(sabri) CAMPOS(products.description,products.category,emplooyes.SAT)";
    $Query = "Papas";
    $queryMakerObject = new queryMaker($Query);
    $queryMakerObject->printFileds();
    $queryMakerObject ->builder();

?>