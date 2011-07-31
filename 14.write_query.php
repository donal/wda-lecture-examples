<?php
  include "db_secure.php";

  if (!($connection = @mysql_connect(DB_HOST, 'conference', 'conference'))) {
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
