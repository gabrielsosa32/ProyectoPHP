<?php

class auth
{
/* User Login */
public function userLogin($usernameEmail,$password)
{
    try{
        $db = Database::StartUp();
        $hash_password= hash('sha256', $password); //Password encryption 
        $stmt = $db->prepare("SELECT uid FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password"); 
        $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR) ;
        $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
        $stmt->execute();
        $count=$stmt->rowCount();
        $data=$stmt->fetch(PDO::FETCH_OBJ);
        $db = null;

        if($count){
            $_SESSION['uid']=$data->uid; // Storing user session value
            return true;
        }
        else{
            return false;
        } 
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

/* User Registration */
public function userRegistration($username,$email,$user_escuela,$password)
{
    try{
        $db = Database::StartUp();
        $st = $db->prepare("SELECT uid FROM users WHERE username=:username OR email=:email"); 
        $st->bindParam(":username", $username,PDO::PARAM_STR);
        $st->bindParam(":email", $email,PDO::PARAM_STR);
        $st->execute();
        $count=$st->rowCount();

        if($count<1){
            $stmt = $db->prepare("INSERT INTO users(username,email,user_escuela,password) VALUES (:username,:email,:user_escuela,:hash_password)");
            $stmt->bindParam(":username", $username,PDO::PARAM_STR) ;
            $stmt->bindParam(":email", $email,PDO::PARAM_STR) ;
            $stmt->bindParam(":user_escuela", $user_escuela,PDO::PARAM_STR) ;
            $hash_password= hash('sha256', $password); //Password encryption
            $stmt->bindParam(":hash_password", $hash_password,PDO::PARAM_STR) ;
            $stmt->execute();
            $uid=$db->lastInsertId(); // Last inserted row id
            $db = null;
            $_SESSION['uid']=$uid;
            return true;
        }
        else{
            $db = null;
            return false;
        }

    } 
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

/* User Details */
public function userDetails($uid)
{
    try{
        $db = Database::StartUp();
        $stmt = $db->prepare("SELECT * FROM users WHERE uid=:uid"); 
        $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
        return $data;
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



public function listSchools()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM schools");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
