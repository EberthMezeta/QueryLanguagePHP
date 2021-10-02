<?php	
class DBConnection
{
  private $serverName = "localhost";
  private $userName = "root";
  private $password = "";
  private $databaseName = "northwind";
  private $connection;

  public function __construct()
  {
    try {
      $connectionString = "mysql:host=".$this->serverName.";dbname=".$this->databaseName;
      $this->connection = new PDO($connectionString, $this->userName, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch (PDOException $exception) {
      echo "Connection failed: " . $exception->getMessage();
    }
  }

  public function get_connection()
  {
    return $this->connection;
  }

}

 $con = new DBConnection();
 $connx= $con->get_connection();

 $stmt =  $connx -> prepare("SELECT product_name FROM products WHERE product_name='Northwind Traders Beer'");

$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($result);

?>