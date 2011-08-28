<?php

$pattern = "/^[A-Z0-9._%+-]+@([A-Z0-9.-]+\.[A-Z]{2,4})$/i";
$email = "donal@whackyland.com";
// $email = "donal@gmail.com";

var_dump(preg_match($pattern, $email, $matches));
var_dump($matches[1]);

$domain = $matches[1];

if (function_exists("getmxrr") && function_exists("gethostbyname")) {
  if (!getmxrr($domain, $temp) || gethostbyname($domain) == $domain) {
     echo "domain doesn't exist\n";
  }
}

var_dump($temp);
