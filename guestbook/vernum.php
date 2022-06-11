<?php

session_start();
$_SESSION['num']=rand(1000,9999);
echo $_SESSION['num'];
?>