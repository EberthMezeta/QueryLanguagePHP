<?php 

class DBgetData
 {
    public function get_Array_Result($connection, $query)
    {
        $statement= $connection-> prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
 }


?>