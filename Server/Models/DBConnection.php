<?php	
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "northwind";

try {
  $connection = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
  // set the PDO error mode to exception
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $exception) {
  echo "Connection failed: " . $exception->getMessage();
}
?>