<?php

$string = "raining cats and dogs";

var_dump(preg_match("/cats/", $string));
var_dump(preg_match("/kats/", $string));
var_dump(preg_match("/c../", $string));
var_dump(preg_match("/CAT/", $string));
var_dump(preg_match("/CAT/i", $string));

$url = "http://www.rmit.edu.au";

var_dump(preg_match("/\\.au/", $url));

$string = "raining kittens and pups";

var_dump(preg_match("/p[aeiou]p/", $string));
var_dump(preg_match("/p[^u]p/", $string));
var_dump(preg_match("/^pups/", $string));
var_dump(preg_match("/pups$/", $string));

var_dump(preg_match("/w+/", $url));
var_dump(preg_match("/w{1,3}/", $url));
var_dump(preg_match("/w{3}/", $url));
var_dump(preg_match("/w{3,}/", $url));

$student_number1 = "3234567";
$student_number2 = "s9945678";

var_dump(preg_match("/[s0-9]{7,8}/", $student_number1));
var_dump(preg_match("/[s0-9]{7,8}/", $student_number2));

$pattern = "#^(ftp|http)://([a-zA-Z.]+)$#";
var_dump(preg_match($pattern, $url, $matches));
var_dump($matches);

