<?php

class task
{
	private $pdo;
    
    public $task_id;
    public $task_name;
    public $task_description;
    public $task_tags;  
    public $task_date;
    public $task_status;
    public $task_user_id;
    public $task_created_at;

    private $db_table_name = "tasks";

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

	public function SearchAndList($uid, $valueToSearch)
	{
		$search = $valueToSearch;

		if($search != ""){
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE task_user_id = :uid AND CONCAT(`task_name`, `task_description`, `task_tags`, `task_date`) LIKE '%$search%' ");
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
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE task_user_id = :uid");
				$stm->bindParam(":uid",$uid);
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		
	}

	public function ListAll($uid)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE task_user_id = :uid");
			$stm->bindParam(":uid",$uid);
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtain($task_id)
	{
        
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM $this->db_table_name WHERE task_id = ?");
			          

			$stm->execute(array($task_id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Delete($task_id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM $this->db_table_name WHERE task_id = ?");			          

			$stm->execute(array($task_id));
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
						task_name      		= ?,
						task_description          = ?, 
						task_tags        = ?,
                        task_date        = ?,
                        task_status        = ?,
                        task_user_id        = ?,
                        task_created_at         = ?
						
				    WHERE task_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
				    	$data->task_name, 
                        $data->task_description,                        
                        $data->task_tags,
                        $data->task_date,
                        $data->task_status, 
                        $data->task_user_id,
                        $data->task_created_at,
                        $data->task_id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Register(task $data)
	{
		try 
		{
		$sql = "INSERT INTO $this->db_table_name (task_name,task_description,task_tags,task_date,task_status,task_user_id) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                     $data->task_name, 
                     $data->task_description,                        
                     $data->task_tags,
                     $data->task_date,
                     $data->task_status, 
                     $data->task_user_id
                   
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}