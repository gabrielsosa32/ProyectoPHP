<?php
$model = new auth();

$errorMsgReg='';
$errorMsgLogin='';
/* Login Form */
if (!empty($_POST['loginSubmit'])) 
{
$usernameEmail=$_POST['usernameEmail'];
$password=$_POST['password'];
if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
{
$uid=$model->userLogin($usernameEmail,$password);
if($uid)
{
$url=BASE_URL.'index.php';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgLogin="Revisar datos de ingreso.";
}
}
}

/* Signup Form */
if (!empty($_POST['signupSubmit'])) 
{
$username=$_POST['usernameReg'];
$email=$_POST['emailReg'];
$user_escuela=$_POST['escuelaReg'];
$password=$_POST['passwordReg'];
/* Regular expression check */
$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.([a-zA-Z]{2,4})$~i', $email);
$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

if($username_check && $email_check && $password_check) 
{
$uid=$model->userRegistration($username,$email,$user_escuela,$password);
if($uid)
{
$url=BASE_URL.'index.php';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgReg="Nombre de usuario o email ya existentes.";
}
}
}
?>