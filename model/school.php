<?php

class school
{
	private $pdo;
    
    public $school_id;
    public $school_nombre;
    public $school_direccion;
    public $school_telefono;  

    private $db_table_name = "schools";

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

	public function SearchAndList($valueToSearch)
	{
		$search = $valueToSearch;

		if($search != ""){
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE CONCAT(`school_nombre`, `school_direccion`, `school_telefono`) LIKE '%$search%' ");
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
				$stm->bindParam(":uid",$uid);
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

			$stm = $this->pdo->prepare("SELECT school_nombre FROM $this->db_table_name");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtain($school_id)
	{
        
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM $this->db_table_name WHERE school_id = ?");
			          

			$stm->execute(array($school_id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Delete($school_id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM $this->db_table_name WHERE school_id = ?");			          

			$stm->execute(array($school_id));
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
						school_nombre      		= ?,
						school_direccion          = ?, 
						school_telefono        = ?
						
				    WHERE school_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
				    	$data->school_nombre, 
                        $data->school_direccion,                        
                        $data->school_telefono,
                        $data->school_id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Register(school $data)
	{
		try 
		{
		$sql = "INSERT INTO $this->db_table_name (school_nombre,school_direccion,school_telefono) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                     $data->school_nombre, 
                     $data->school_direccion,                        
                     $data->school_telefono                   
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}