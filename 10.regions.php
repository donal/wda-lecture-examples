<?php
  if (basename($_SERVER[SCRIPT_NAME]) != "10.html_form.php") {
    header("Location: 10.html_form.php");
    exit;
  }

  require_once "db_secure.php";

  // selectDistinct() function
  function getRegions() {
    // Connect to the server
    if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) {
     showerror();
    }

    if (!mysql_select_db(DB_NAME, $connection)) {
     showerror();
    }

    // Query to find distinct values of $attributeName in $tableName
    $distinctQuery = "SELECT DISTINCT region_id, region_name FROM region";

    // Run the distinctQuery on the databaseName
    if (!($resultId = @ mysql_query ($distinctQuery, $connection))) {
      showerror();
    }

    $regions = array();

    // Retrieve each row from the query
    while ($row = @ mysql_fetch_array($resultId)) {
      // Get the value for the attribute to be displayed
      $regions[$row['region_name']] = $row['region_name'];
    }

    return $regions;
  } // end of function

