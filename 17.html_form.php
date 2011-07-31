<?php
  include "db_secure.php";

  if (!($connection = @ mysql_connect(DB_HOST, 'conference', 'conference'))) {
    showerror();
  }

  $id = mysqlclean($_GET, "id", 11, $connection);

  if (!isset($id)) {
    die('no id given');
  }

  if (!mysql_select_db('conference', $connection)) {
    showerror();
  }

  $query = "SELECT * FROM registrations2 WHERE id = {$id}";
  // echo $query;
 
  if (!$result = mysql_query($query)) {
    showerror();
  }

  if (mysql_num_rows($result) == 1) {
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
  } else {
    // something bad has happened
    exit;
  }
  

?>
<html>
<head>
<title>Update Registration form</title>
</head>

<body>
<form action="17.write_query.php" method="POST">
Name:    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
Email:   <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
Category:<select name="category">
           <option value="1">Staff
           <option value="2">Student
           <option value="3">Other
         </select><br>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit">
</form>

</body>
</html>
