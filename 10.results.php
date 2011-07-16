<?php
  if ($_GET['submit'] != 'Show Wines') {
    header("Location: 10.html_form.php");
    exit;
  }

  require_once('10.wines.php');
  $regionName = $_GET['regionName'];
  $wines = getWines($regionName);
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
  if (isset($regionName) && $regionName != 'All') {
    echo "Wines of {$regionName}<br/>\n";
  }
?>
<table>
  <tr>
    <th>Wine ID</th>
    <th>Wine Name</th>
    <th>Year</th>
    <th>Winery</th>
    <th>Description</th>
  </tr>
<?php foreach($wines as $wine): ?>
  <tr>
    <td><?php echo $wine['wine_id']; ?></td>
    <td><?php echo $wine['wine_name']; ?></td>
    <td><?php echo $wine['year']; ?></td>
    <td><?php echo $wine['winery_name']; ?></td>
    <td><?php echo $wine['description']; ?></td>
  </tr>
<?php endforeach; ?>
</table>
<?php echo count($wines); ?> records found matching your criteria
</body>
</html>
