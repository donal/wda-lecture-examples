<?php
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
?>
