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

  // selectDistinct() function shown in Example 6-9 goes here
  require "07.select_list.php";

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
