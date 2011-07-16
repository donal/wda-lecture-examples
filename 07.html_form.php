<!DOCTYPE HTML PUBLIC
                 "-//W3C//DTD HTML 4.01 Transitional//EN"
                 "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Wines</title>
</head>
<body>
<form action="07.query_results.php" method="GET">
<?php
  require "db_secure.php";

  // selectDistinct() function
  function selectDistinct ($connection, $tableName, $attributeName, $pulldownName, $defaultValue) {
    $defaultWithinResultSet = FALSE;

    // Query to find distinct values of $attributeName in $tableName
    $distinctQuery = "SELECT DISTINCT {$attributeName} FROM
                {$tableName}";

    // Run the distinctQuery on the databaseName
    if (!($resultId = @ mysql_query ($distinctQuery, $connection)))
      showerror();

    // Start the select widget
    print "\n<select name=\"{$pulldownName}\">";

    // Retrieve each row from the query
    while ($row = @ mysql_fetch_array($resultId))
    {
     // Get the value for the attribute to be displayed
     $result = $row[$attributeName];

     // Check if a defaultValue is set and, if so, is it the
     // current database value?
     if (isset($defaultvalue) && $result == $defaultValue)
       // Yes, show as selected
       print "\n\t<option selected value=\"{$result}\">{$result}";
     else
       // No, just show as an option
       print "\n\t<option value=\"{$result}\">{$result}";
     print "</option>";
    }
    print "\n</select>";
  } // end of function

  // Connect to the server
  if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) {
    showerror();
  }

  if (!mysql_select_db(DB_NAME, $connection)) {
    showerror();
  }

  print "\nRegion: ";

  // Produce the select list
  // Parameters:
  // 1: Database connection
  // 2. Table that contains values
  // 3. Attribute that contains values
  // 4. <SELECT> element name
  // 5. Optional <OPTION SELECTED>
  selectDistinct($connection, "region", "region_name", "regionName", "All");
?>
<br>
<input type="submit" value="Show Wines">
</form>
</body>
</html>
