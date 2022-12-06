<?php
if(!empty($_SESSION['uid']))
{
$session_uid=$_SESSION['uid'];
$model = new auth();
}
if(empty($session_uid))
{
echo "Sin logear";
}   

?>