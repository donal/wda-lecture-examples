<?php
  if ($_GET['submit'] != 'Show Wines') {
    header("Location: 08.html_form.php");
    exit;
  }
?>
<!DOCTYPE HTML PUBLIC
            "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Exploring Wines in a Region</title>
</head>

<body bgcolor="white">
<?php

  require 'db_secure.php';

  // Show all wines in a region in a <table>
  function displayWinesList($connection, $query, $regionName) {
    // Run the query on the server
    if (!($result = @ mysql_query ($query, $connection))) {
      showerror();
    }

    // Find out how many rows are available
    $rowsFound = @ mysql_num_rows($result);

    // If the query has results ...
    if ($rowsFound > 0) {
      // ... print out a header
      print "Wines of $regionName<br>";

      // and start a <table>.
      print "\n<table>\n<tr>" .
          "\n\t<th>Wine ID</th>" .
          "\n\t<th>Wine Name</th>" .
          "\n\t<th>Year</th>" .
          "\n\t<th>Winery</th>" .
          "\n\t<th>Description</th>\n</tr>";

      // Fetch each of the query rows
      while ($row = @ mysql_fetch_array($result)) {
        // Print one row of results
        print "\n<tr>\n\t<td>{$row["wine_id"]}</td>" .
            "\n\t<td>{$row["wine_name"]}</td>" .
            "\n\t<td>{$row["year"]}</td>" .
            "\n\t<td>{$row["winery_name"]}</td>" .
            "\n\t<td>{$row["description"]}</td>\n</tr>";
      } // end while loop body

      // Finish the <table>
      print "\n</table>";
    } // end if $rowsFound body

    // Report how many rows were found
    print "{$rowsFound} records found matching your criteria<br>";
  } // end of function

  // Connect to the MySQL server
  if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) {
    die("Could not connect");
  }

  // Secure the user parameter $regionName
  $regionName = mysqlclean($_GET, "regionName", 30, $connection);

  if (!mysql_select_db(DB_NAME, $connection)) {
    showerror();
  }

  // Start a query ...
  $query = "SELECT wine_id, wine_name, description, year, winery_name
        FROM  winery, region, wine
        WHERE  winery.region_id = region.region_id
        AND   wine.winery_id = winery.winery_id";

  // ... then, if the user has specified a region, add the regionName
  // as an AND clause ...
  if (isset($regionName) && $regionName != "All")
    $query .= " AND region_name = '{$regionName}'";

  // ... and then complete the query.
  $query .= " ORDER BY wine_name";

  // run the query and show the results
  displayWinesList($connection, $query, $regionName);
?>
</body>
</html>
