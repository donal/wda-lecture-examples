<?php
  if (strpos(basename($_SERVER[HTTP_REFERER]), "17.html_form.php") === false) {
    header("Location: 17.html_form.php");
    exit;
  }

  include "db_secure.php";

  if (!($connection = @ mysql_connect(DB_HOST, 'conference', 'conference'))) {
    showerror();
  }

  $name = mysqlclean($_POST, "name", 50, $connection);
  $email = mysqlclean($_POST, "email", 50, $connection);
  $category = mysqlclean($_POST, "category", 50, $connection);
  $id = mysqlclean($_POST, "id", 11, $connection);

  if (!mysql_select_db('conference', $connection)) {
    showerror();
  }

  $query = "UPDATE registrations2 SET name = '{$name}', email = '{$email}', category = {$category} WHERE id = {$id}";
  // echo $query;
 
  if (!mysql_query($query)) {
    showerror();
  }

  $resultsPageURL  = "17.receipt.php?name={$name}&email={$email}&category={$category}";

  header("Location: {$resultsPageURL}");
  exit();
