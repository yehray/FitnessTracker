<?php
  session_start();
  if(empty($_SESSION['username'])){ 
    echo "not logged in";
  }
?>