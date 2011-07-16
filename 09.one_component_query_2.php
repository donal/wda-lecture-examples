<?php
  // Database activity occurs here -- process $_GET["input"]

  // This is the key to one-component querying:
  // Redirect the browser back to the calling page, using
  // the HTTP response header "Location:" and the PHP server
  // variable $_SERVER["HTTP_REFERER"]
  header("Location: {$_SERVER["HTTP_REFERER"]}");
  exit;
