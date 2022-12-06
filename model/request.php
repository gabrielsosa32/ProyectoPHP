<?php

class request
{
	private $pdo;
    
    public $request_id;
    public $request_tipo;
    public $request_solicitante;
    public $request_detalle;
    public $request_estado;

    private $db_table_name = "requests";

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
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE CONCAT(`request_tipo`, `request_solicitante`, `request_estado`) LIKE '%$search%' ");
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

			$stm = $this->pdo->prepare("SELECT request_nombre FROM $this->db_table_name");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtain($request_id)
	{
        
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM $this->db_table_name WHERE request_id = ?");
			          

			$stm->execute(array($request_id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Delete($request_id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM $this->db_table_name WHERE request_id = ?");			          

			$stm->execute(array($request_id));
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
						request_tipo      		= ?,
						request_solicitante          = ?, 
                        request_detalle          = ?, 
						request_estado        = ?
						
				    WHERE request_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
				    	$data->request_tipo, 
                        $data->request_solicitante,                        
                        $data->request_detalle,
                        $data->request_estado,
                        $data->request_id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Register(request $data)
	{
		try 
		{
		$sql = "INSERT INTO $this->db_table_name (request_tipo,request_solicitante,request_detalle,request_estado) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                     $data->request_tipo, 
                     $data->request_solicitante,                        
                     $data->request_detalle,
                     $data->request_estado                   
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}