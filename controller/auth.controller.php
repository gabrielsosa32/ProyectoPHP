<?php

require_once 'model/database.php';

class authController
{
/* User Login */
public function userLogin($usernameEmail,$password)
{
try{
$db = StartUp();
$hash_password= hash('sha256', $password); //Password encryption 
$stmt = $db->prepare("SELECT user_id FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password"); 
$stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR) ;
$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
$stmt->execute();
$count=$stmt->rowCount();
$data=$stmt->fetch(PDO::FETCH_OBJ);
$db = null;
if($count)
{
$_SESSION['user_id']=$data->user_id; // Storing user session value
return true;
}
else
{
return false;
} 
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}

/* User Registration */
public function userRegistration($username,$password,$email)
{
try{
$db = StartUp();
$st = $db->prepare("SELECT user_id FROM users WHERE username=:username OR email=:email"); 
$st->bindParam("username", $username,PDO::PARAM_STR);
$st->bindParam("email", $email,PDO::PARAM_STR);
$st->execute();
$count=$st->rowCount();
if($count<1)
{
$stmt = $db->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
$stmt->bindParam("username", $username,PDO::PARAM_STR) ;
$hash_password= hash('sha256', $password); //Password encryption
$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
$stmt->execute();
$user_id=$db->lastInsertId(); // Last inserted row id
$db = null;
$_SESSION['user_id']=$user_id;
return true;
}
else
{
$db = null;
return false;
}

} 
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
}

/* User Details */
public function userDetails($user_id)
{
    try{
        $db = StartUp();
        $stmt = $db->prepare("SELECT email,username FROM users WHERE user_id=:user_id"); 
        $stmt->bindParam("user_id", $user_id,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
        return $data;
    }
    catch(PDOException $e) {
     echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
}
