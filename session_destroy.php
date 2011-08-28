<?php
session_start();

echo session_id() . "<br/>\n";
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

$_SESSION = array();

// session_destroy();

echo session_id() . "<br/>\n";
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

session_destroy();

echo session_id() . "<br/>\n";
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

