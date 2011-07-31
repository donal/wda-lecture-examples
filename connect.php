<?php
/**
 * MySQL connection check
 *
 * Checks the connection to the local install of MySQL
 * 
 * @author Donal Ellis <donal.ellis@rmit.edu.au>
 * @version 1.0
 * @package Connect
 */

require_once('db.php');

if (!$dbconn = mysql_connect(DB_HOST, DB_USER, DB_PW)) {
  echo 'Could not connect to mysql on ' . DB_HOST . "\n";
  exit;
}

echo 'Connected to mysql on ' . DB_HOST . "<br/>\n";

if (!mysql_select_db(DB_NAME, $dbconn)) {
  echo 'Could not use database ' . DB_NAME . "\n";
  echo mysql_error() . "\n";
  exit;
}

echo 'Connected to database ' . DB_NAME . "<br/>\n";

?>
