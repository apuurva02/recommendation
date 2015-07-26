<?php
session_start();
if(session_destroy()) 
{
echo"successfully logged out";

}
?>
<html><a href="homepg.html">Home</a>