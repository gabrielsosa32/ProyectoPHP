<?php

class user
{
	private $pdo;
    
    public $uid;
	public $username;
	public $email;
	public $user_escuela;
    public $password;
    public $role;  
    public $user_created_at;
    public $user_status;

    private $db_table_name = "users";

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListAllUserInSchool($user_escuela, $valueToSearch)
	{
		$search = $valueToSearch;

		if($search != ""){
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE user_escuela = :school AND CONCAT(`username`, `email`) LIKE '%$search%' ");
				$stm->bindParam(":school",$user_escuela);
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		else{
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE user_escuela = :school");
				$stm->bindParam(":school",$user_escuela);
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		
	}

	public function SearchAndListAllUsers($valueToSearch)
	{
		$search = $valueToSearch;

		if($search != ""){
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE CONCAT(`username`, `email`) LIKE '%$search%' ");
				$stm->bindParam(":uid",$uid);
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		else{
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name");
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		
	}

	public function ListAll()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtain($uid)
	{
        
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM $this->db_table_name WHERE uid = ?");
			          

			$stm->execute(array($uid));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Delete($uid)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM $this->db_table_name WHERE uid = ?");			          

			$stm->execute(array($uid));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Update($data)
	{
		try 
		{	
			$sql = "UPDATE $this->db_table_name SET 
						username      		= ?,
						email          = ?, 
						user_escuela          = ?, 
						password          = ?, 
						role        = ?,
                        user_created_at        = ?,
                        user_status        = ?
						
				    WHERE uid = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->username, 
						$data->email,
						$data->user_escuela,
                        $data->password,                        
                        $data->role,
                        $data->user_created_at,
                        $data->user_status, 
                        $data->uid
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Register(user $data)
	{
		try 
		{
		$sql = "INSERT INTO $this->db_table_name (username,email,user_escuela,password) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					 $data->username, 
					 $data->email,
					 $data->user_escuela,
					 hash('sha256', $data->password)
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}