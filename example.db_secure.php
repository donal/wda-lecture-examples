<?php

define('DB_HOST', '<your host and port>');
define('DB_NAME', '<your db>');
define('DB_USER', '<your username>');
define('DB_PW',   '<your password>');

function showerror() {
  die("Error " . mysql_errno() . " : " . mysql_error());
}

function mysqlclean($array, $index, $maxlength, $connection) {
  if (isset($array["{$index}"])) {
     $input = substr($array["{$index}"], 0, $maxlength);
     $input = mysql_real_escape_string($input, $connection);
     return ($input);
  }
  return NULL;
}

function shellclean($array, $index, $maxlength) {
  if (isset($array["{$index}"])) {
    $input = substr($array["{$index}"], 0, $maxlength);
    $input = EscapeShellArg($input);
    return ($input);
  }
  return NULL;
}

