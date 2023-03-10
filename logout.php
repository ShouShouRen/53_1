<?php
session_start();
extract($_GET);
unset($_SESSION["AUTH"]);
header("Location:login.php");