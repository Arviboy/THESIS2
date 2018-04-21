<?php
ob_start(); //output buffer
session_start();
$current_file = $_SERVER['SCRIPT_NAME']; //Server execution and environment information
if(isset($_SERVER['HTTP_REFERER']))
{
  $http_referer = $_SERVER['HTTP_REFERER'];
}
else
{
 $http_referer = '';
}


function loggedin()
{
if (isset($_SESSION['id'])&&!empty($_SESSION['id'])) // set session variables
{
return true;
}
else
{
return false;
}
}

?>
