<?php
$num=$_POST['num'];
session_start();
if($num==$_SESSION['num']){
    echo true;
}else{
    echo false;
}
