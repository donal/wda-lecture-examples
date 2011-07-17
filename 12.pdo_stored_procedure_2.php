<?php
require_once('db_pdo.php');

try {
  $pdo = new PDO($dsn, DB_USER, DB_PW);
  
  // all errors will throw exceptions
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = 'SELECT * FROM wine WHERE wine_id = ?';
  $statement = $pdo->prepare($query);
  $values = array('1000');
  $statement->execute($values);
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($result);
  echo '</pre>';

  // close the connection by destroying the object 
  $pdo = null;
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

?>
