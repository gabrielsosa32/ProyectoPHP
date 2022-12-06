<?php

class project
{
	private $pdo;
    
    public $project_id;
    public $project_titulo;
    public $project_subtitulo;
    public $project_resumen;  
    public $project_problematica;
	public $project_interrogante;
	public $project_objetivo;
	public $project_solucion;
	public $project_pruebayconclusion;
	public $project_integrantes;
	public $project_escuela;
	public $project_comentarios;


    private $db_table_name = "projects";

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
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE CONCAT(`project_titulo`, `project_integrantes`) LIKE '%$search%' ");
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

	public function SearchAndListMySchool($user_escuela, $valueToSearch)
	{
		$search = $valueToSearch;

		if($search != ""){
			try{
				$result = array();
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE project_escuela = :school AND CONCAT(`project_titulo`, `project_integrantes`) LIKE '%$search%' ");
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
				$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE project_escuela = :school");
				$stm->bindParam(":school",$user_escuela);
				$stm->execute();

				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		
	}

	public function ListAllMySchool($user_escuela)
	{
		$school = $user_escuela;

		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE project_escuela = $school");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListMyProjects($project_integrante)
	{
		$member = $project_integrante;

		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM $this->db_table_name WHERE project_integrantes LIKE '%$member%'");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtain($project_id)
	{
        
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM $this->db_table_name WHERE project_id = ?");
			          

			$stm->execute(array($project_id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Delete($project_id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM $this->db_table_name WHERE project_id = ?");			          

			$stm->execute(array($project_id));
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
						project_titulo      		= ?,
						project_subtitulo          = ?, 
						project_resumen        = ?,
                        project_problematica        = ?,
						project_interrogante        = ?,
						project_objetivo        = ?,
						project_solucion        = ?,
						project_pruebayconclusion        = ?,
						project_integrantes        = ?,
						project_escuela        = ?,
						project_comentarios = ?
						
				    WHERE project_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
				    	$data->project_titulo, 
                        $data->project_subtitulo,                        
                        $data->project_resumen,
						$data->project_problematica,
						$data->project_interrogante,
						$data->project_objetivo,
						$data->project_solucion,
						$data->project_pruebayconclusion,
						$data->project_integrantes,
						$data->project_escuela,
						$data->project_comentarios,
                        $data->project_id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Register(project $data)
	{
		try 
		{
		$sql = "INSERT INTO $this->db_table_name (project_titulo,project_subtitulo,
		project_resumen,project_problematica,project_interrogante,project_objetivo,
		project_solucion,project_pruebayconclusion,project_integrantes,
		project_escuela,project_comentarios) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                     $data->project_titulo, 
                     $data->project_subtitulo,                        
                     $data->project_resumen,
					 $data->project_problematica,
					 $data->project_interrogante,
					 $data->project_objetivo,
					 $data->project_solucion,
					 $data->project_pruebayconclusion,
					 $data->project_integrantes,
					 $data->project_escuela,
					 $data->project_comentarios
                   
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}