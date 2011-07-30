<?php
/**
 * MySQL Command Line
 *
 * Allows SQL queries to be run through a web interface
 * The original script and article was written by Kevin Yank
 * http://www.sitepoint.com/article/give-back-mysql-command-line
 * Modified by Donal Ellis for RMIT CSIT's course WDA 
 * 
 * @author Kevin Yanka
 */

require_once('db.php');

if (!$dbconn = mysql_connect(DB_HOST, DB_USER, DB_PW)) {
  echo 'Could not connect to mysql on ' . DB_HOST . "\n";
  exit;
}
?>

<html>
<head><title>MySQL Command Line</title></head>
<body onLoad="document.forms[0].elements['query'].focus()">

<?php

if (isset($_POST['submitquery'])) {

  if (get_magic_quotes_gpc()) {
    $_POST['query'] = stripslashes($_POST['query']);
  }

  echo '<p><b>Query:</b><br/>' . nl2br($_POST['query']) . '</p>';

  if (!mysql_select_db($_POST['database'], $dbconn)) {
    echo mysql_error() . "\n";
    exit;
  }

  if (!$result = mysql_query($_POST['query'])) {
    echo mysql_error() . "\n";
  } else {
    if (@mysql_num_rows($result)) {
      ?>
      <p><b>Result Set:</b></p>
      <table border="1">
      <thead>
      <tr>
      <?php
      for ($i = 0; $i < mysql_num_fields($result); $i++) {
        echo '<th>' . mysql_field_name($result, $i) . '</th>' . "\n";
      }
      ?>
      </tr>
      </thead>
      <tbody>
      <?php
      while ($row = mysql_fetch_row($result)) {
        echo '<tr>';
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
          echo '<td>' . $row[$i] . '</td>';
        }
        echo '</tr>' . "\n";
      }
      ?>
      </tbody>

      </table>
      <?php
    } else {
      echo '<p><b>Query OK:</b>' . mysql_affected_rows() . ' rows affected.</p>';
    }
  }
  echo '<hr/>';
}
?>


<p>Target Database:</p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<select name="database">

<?php
if (!$dbs = mysql_list_dbs()) {
  echo mysql_error() . "\n";
  exit;
}
for ($i = 0; $i < mysql_num_rows($dbs); $i++) {
  if (!$dbname = mysql_db_name($dbs, $i)) {
    echo mysql_error() . "\n";
    exit;
  }
  if ($dbname == $_POST['database']) {
    echo "<option selected=\"selected\" value=\"{$dbname}\">{$dbname}</option>\n";
  } else {
    echo "<option value=\"{$dbname}\">{$dbname}</option>\n";
  }
}
?>
</select>

<p>SQL Query:</p>
<textarea onFocus="this.select()" cols="60" rows="5" name="query">
<?php echo htmlspecialchars($_POST['query'])?>
</textarea>
<br/>
<input type="submit" name="submitquery" value="Submit Query (Alt-S)"
accesskey="S"/>
</form>

<?php

?>

</body>
</html>
