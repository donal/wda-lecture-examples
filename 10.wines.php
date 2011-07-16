<?php
  if (basename($_SERVER[SCRIPT_NAME]) != "10.results.php") {
    header("Location: 10.html_form.php");
    exit;
  }

  require 'db_secure.php';

  // get all wines
  function getWines($regionName) {
    // Connect to the server
    if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) {
     showerror();
    }

    if (!mysql_select_db(DB_NAME, $connection)) {
     showerror();
    }

    // manually clean data
    $regionName = substr($regionName, 0, 30);
    $regionName = mysql_real_escape_string($regionName, $connection);

    // Start a query ...
    $query = "SELECT wine_id, wine_name, description, year, winery_name
          FROM  winery, region, wine
          WHERE  winery.region_id = region.region_id
          AND   wine.winery_id = winery.winery_id";

    // ... then, if the user has specified a region, add the regionName
    // as an AND clause ...
    if (isset($regionName) && $regionName != "All") {
      $query .= " AND region_name = '{$regionName}'";
    }

    // ... and then complete the query.
    $query .= " ORDER BY wine_name";

    // Run the query on the server
    if (!($result = @ mysql_query ($query, $connection))) {
      showerror();
    }

    // Find out how many rows are available
    $rowsFound = @ mysql_num_rows($result);

    $wines = array();

    // If the query has results ...
    if ($rowsFound > 0) {
      // Fetch each of the query rows
      while ($row = @ mysql_fetch_assoc($result)) {
        $wines[$row['wine_id']] = $row;
      } // end while loop body
    } // end if $rowsFound body

    return $wines;
  } // end of function

