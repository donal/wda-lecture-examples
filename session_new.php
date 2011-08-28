<?php
session_start();

echo session_id() . "<br/>\n";

$_SESSION['name'] = 'donal';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';
