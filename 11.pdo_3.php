<?php
require_once('pdo.inc.php');

try {
  $pdo = new PDO($dsn, $username, $password);
  
  // all errors will throw exceptions
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = 'SELECT * FROM wine';
  $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

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
