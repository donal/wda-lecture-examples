<?php

$username = "donal";
$password = "secret";

$now = time();
$salt = hash("sha256", "{$username}{$now}");
$pw_hash = hash("sha256", "{$salt}{$password}");

echo '<pre>';
print_r($salt);
echo '</pre>';

echo '<pre>';
print_r($pw_hash);
echo '</pre>';

$username2 = "donald";
$password2 = "secret";

$now = time();
$salt = hash("sha256", "{$username2}{$now}");
$pw_hash = hash("sha256", "{$salt}{$password2}");

echo '<pre>';
print_r($salt);
echo '</pre>';

echo '<pre>';
print_r($pw_hash);
echo '</pre>';

