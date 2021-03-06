<?php
require_once('db_pdo.php');

try {
  $pdo = new PDO($dsn, DB_USER, DB_PW);
  
  // all errors will throw exceptions
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = 'SELECT * FROM wine';
  $result = $pdo->query($query);

  // echo '<pre>';
  // print_r($result);
  // echo '</pre>';

  // also try PDO::FETCH_NUM, PDO::FETCH_ASSOC and PDO::FETCH_BOTH
  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    // echo '<pre>';
    // print_r($row);
    // echo '</pre>';

    echo $row->wine_name . "<br/>\n";
  }

  // close the connection by destroying the object 
  $pdo = null;
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

?>
