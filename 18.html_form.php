<?php
  include "db_secure.php";

  if (!($connection = @ mysql_connect(DB_HOST, 'conference', 'conference'))) {
    showerror();
  }
  if (!mysql_select_db('conference', $connection)) {
    showerror();
  }

  if (!isset($_GET['registrant'])) {

    $query = "SELECT * FROM registrations2 ORDER BY name";
    // echo $query;
 
    if (!$result = mysql_query($query)) {
      showerror();
    }

    $registrants = array();
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $registrants[$row['id']] = $row;
    }
  } else if ($_GET['registrant'] == 'Submit') {
    $id = mysqlclean($_GET, "registrant_id", 11, $connection);

    if (!isset($id)) {
      die('no id given');
    }

    $query = "SELECT * FROM registrations2 WHERE id = {$id}";
    // echo $query;
 
    if (!$result = mysql_query($query)) {
      showerror();
    }

    if (mysql_num_rows($result) == 1) {
      $edit_registrant = mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
      // something bad has happened
      exit;
    }
  }
?>
<html>
<head>
<title>Update Registration form</title>
</head>

<body>

<?php if (!isset($_GET['registrant'])): ?>
<form action="18.html_form.php" method="GET">
Registrant:<select name="registrant_id">
<?php foreach ($registrants as $id => $registrant): ?>
    <option value="<?php echo $id; ?>"><?php echo $registrant['name']; ?></option>
<?php endforeach; ?>
    </select><br>
  <input type="submit" name ="registrant" value="Submit">
</form>
<?php endif; ?>

<?php if (isset($edit_registrant) && !empty($edit_registrant)): ?>
<form action="18.write_query.php" method="POST">
Name:    <input type="text" name="name" value="<?php echo $edit_registrant['name']; ?>"><br>
Email:   <input type="text" name="email" value="<?php echo $edit_registrant['email']; ?>"><br>
Category:<select name="category">
           <option value="1">Staff
           <option value="2">Student
           <option value="3">Other
         </select><br>
<input type="hidden" name="id" value="<?php echo $edit_registrant['id']; ?>">
<input type="submit">
</form>
<?php endif; ?>

</body>
</html>
