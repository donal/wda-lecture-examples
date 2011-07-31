<?php
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

  // lock tables
  $lock_query = "LOCK TABLES registrations3 WRITE";
  if (!mysql_query($lock_query)) {
    showerror();
  }

  $id_query = "SELECT MAX(id) AS id FROM registrations3";
  if (!$result = mysql_query($id_query)) {
    showerror();
  }

  if (mysql_num_rows($result) == 1) {
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $next_id = $row['id'] + 1;
  } else if (mysql_num_rows($results) == 0) {
    $next_id = 1;
  } else {
    // something bad has happened
    exit;
  }

  $query = "INSERT INTO registrations3 VALUES ({$next_id}, '{$name}', '{$email}', {$category})";
  // echo $query;
 
  if (!mysql_query($query)) {
    showerror();
  }

  // unlock tables
  $unlock_query = "UNLOCK TABLES";
  if (!mysql_query($unlock_query)) {
    showerror();
  }
?>
<html>
<head>
<title>Registration feedback</title>
</head>

<body>
<?php
echo "The data you entered was:<br>";
echo "Name: {$name}<br>";
echo "Email: {$email}<br>";
echo "Category: {$category}<br>";
?>
</body>
</html>
