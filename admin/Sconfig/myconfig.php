<?php


$mysqli = new mysqli("localhost","root","","banphukien");


if ($mysqli->connect_error) {
   echo"loi ket noi"   .$mysqli->connect_error;
   exit();
}
?>