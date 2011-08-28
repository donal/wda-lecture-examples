<?php
session_start();

echo session_id() . "<br/>\n";

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo '<pre>';
print_r($_COOKIE['PHPSESSID']);
echo '</pre>';

