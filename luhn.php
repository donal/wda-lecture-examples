<?php

$cc_number = "1234026084";
$sum = 0;

for ($x = strlen($cc_number) + 1; $x >= 0; $x -= 2) {
  $sum += intval(substr($cc_number, $x, 1)); 
} 

for ($x = strlen($cc_number); $x >= 0; $x -= 2) {
  $value = 2 * intval(substr($cc_number, $x, 1)); 
  if ($value > 10) {
    $value -= 9;
  }
  $sum += $value;
  
} 

if ($sum % 10 == 0) {
  echo "valid cc number\n";
} else {
  echo "invalid cc number\n";
}
