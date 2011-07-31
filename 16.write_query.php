<?php
  if (basename($_SERVER[HTTP_REFERER]) != "16.html_form.html") {
    header("Location: 16.html_form.html");
    exit;
  }

  include "db_secure.php";

  if (!($connection = @ mysql_connect(DB_HOST, 'conference', 'conference'))) {
    showerror();
  }

  $name = mysqlclean($_POST, "name", 50, $connection);
  $email = mysqlclean($_POST, "email", 50, $connection);
  $category = mysqlclean($_POST, "category", 50, $connection);

  if (!mysql_select_db('conference', $connection)) {
    showerror();
  }

  $query = "INSERT INTO registrations2 (name, email, category) VALUES ('{$name}', '{$email}', {$category})";

  // echo $query;
 
  if (!mysql_query($query)) {
    showerror();
  }

  $resultsPageURL  = "16.receipt.php?name={$name}&email={$email}&category={$category}";

  header("Location: {$resultsPageURL}");
  exit();
