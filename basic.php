<?php
$username = "donal";
$password = "secret";

if (isset($_SERVER["PHP_AUTH_USER"]) && $_SERVER["PHP_AUTH_USER"] == $username && isset($_SERVER["PHP_AUTH_PW"]) && $_SERVER["PHP_AUTH_PW"] == $password) {
  echo "welcome!<br/>\n";
} else {
  header("WWW-Authenticate: Basic realm=\"Secure\"");
  header("HTTP/1.0 401 Unauthorized");

  echo "sorry";
}

