<?php
  include "db_secure.php";

  if (!($connection = @mysql_connect(DB_HOST, 'conference', 'conference'))) {
    showerror();
  }
  if (!mysql_select_db('conference', $connection)) {
    showerror();
  }

  $deleted = false;

  if ($_POST['delete'] == 'Submit') {
    $id = mysqlclean($_POST, "registrant_id", 11, $connection);

    if (!isset($id)) {
      die('no id given');
    }

    $query = "DELETE FROM registrations2 WHERE id = {$id}";
    // echo $query;
 
    if (!mysql_query($query)) {
      showerror();
      exit;
    }

    if (mysql_affected_rows() != 1) {
      // something bad has happened
      exit;
    }
    $deleted = true;
    unset($_POST['delete']);
  }

  $query = "SELECT * FROM registrations2 ORDER BY name";
  // echo $query;
 
  if (!$result = mysql_query($query)) {
    showerror();
  }

  $registrants = array();
  if (mysql_num_rows($result) > 0) {
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $registrants[$row['id']] = $row;
    }
  }
?>
<html>
<head>
<title>Delete Registration form</title>

<script type="text/javascript">
function confirmDelete() {
}
</script>
</head>

<body>

<form action="19.delete.php" method="POST">
Registrant:<select name="registrant_id">
<?php foreach ($registrants as $id => $registrant): ?>
    <option value="<?php echo $id; ?>"><?php echo $registrant['name']; ?></option>
<?php endforeach; ?>
    </select><br>
  <input type="submit" name ="delete" value="Submit" onclick="confirm('Are you sure you want to delete this registrant?')">
</form>

<?php if ($deleted): ?>
Deleted registrant with id <?php echo $id; ?>.
<?php endif; ?>

</body>
</html>
