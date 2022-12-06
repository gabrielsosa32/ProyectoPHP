<?php
require_once 'model/project.php';
require_once 'controller/core.controller.php';

class projectController extends coreController{
    
    private $model;
    private $auth;
    
    public function __CONSTRUCT(){
        $this->model = new project();
        $this->auth = new auth();
    }
    
    public function Index(){

        if(!empty($_SESSION['uid']))
        {
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid);
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;

            if($userStatus == "1")
            {
                if($userLevel == "1"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/project/project.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.supervisor.view.php';
                    require_once 'view/project/project.allinschool.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "3"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.directivo.view.php';
                    require_once 'view/project/project.allinschool.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "4"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.docente.view.php';
                    require_once 'view/project/project.allinschool.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "5"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.alumno.view.php';
                    require_once 'view/project/project.myprojects.view.php';
                    require_once 'view/footer.view.php';
                }
            }
            else
            {
                $url= '?c=welcome';
                header("Location: $url");
            }
        }
        else
        {
            $url= '?c=welcome';
            header("Location: $url");
        } 
       
    }
    
    public function Edit(){

        if(!empty($_SESSION['uid']))
        {
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid);
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;
            $userEscuela = $userDetails->user_escuela;

            if($userStatus == "1")
            {
                if($userLevel == "1")
                {
                    $project = new project();
        
                    if(isset($_REQUEST['project_id'])){
                    $project = $this->model->Obtain($_REQUEST['project_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/project/project-edit.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2")
                {   
                    $project = new project();
        
                    if(isset($_REQUEST['project_id'])){
                    $project = $this->model->Obtain($_REQUEST['project_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.supervisor.view.php';
                    require_once 'view/project/project-comments.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "3")
                {   
                    $project = new project();
        
                    if(isset($_REQUEST['project_id'])){
                    $project = $this->model->Obtain($_REQUEST['project_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.directivo.view.php';
                    require_once 'view/project/project-comments.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "4")
                {   
                    $project = new project();
        
                    if(isset($_REQUEST['project_id'])){
                    $project = $this->model->Obtain($_REQUEST['project_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.docente.view.php';
                    require_once 'view/project/project-comments.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "5")
                {   
                    $project = new project();
        
                    if(isset($_REQUEST['project_id'])){
                    $project = $this->model->Obtain($_REQUEST['project_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.alumno.view.php';
                    require_once 'view/project/project-edit.view.php';
                    require_once 'view/footer.view.php';
                }
            }
            else
            {
                $url= '?c=welcome';
                header("Location: $url");    
            }
        }
        else
        {
            $url= '?c=welcome';
            header("Location: $url");
        }

    }
    
    public function Save(){

        if(!empty($_SESSION['uid']))
        {
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid);
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;

            if($userStatus == "1")
            {
                $project = new project();
        
                $project->project_id = $_REQUEST['project_id'];
                $project->project_titulo = $_REQUEST['project_titulo'];
                $project->project_subtitulo = $_REQUEST['project_subtitulo'];
                $project->project_resumen = $_REQUEST['project_resumen'];
                $project->project_problematica = $_REQUEST['project_problematica'];  
                $project->project_interrogante = $_REQUEST['project_interrogante'];
                $project->project_objetivo = $_REQUEST['project_objetivo'];
                $project->project_solucion = $_REQUEST['project_solucion'];
                $project->project_pruebayconclusion = $_REQUEST['project_pruebayconclusion'];
                $project->project_integrantes = $_REQUEST['project_integrantes'];
                $project->project_escuela = $_REQUEST['project_escuela'];
                $project->project_comentarios = $_REQUEST['project_comentarios'];
        
                $project->project_id > 0 
                    ? $this->model->Update($project)
                    : $this->model->Register($project);
                
                $url= '?c=project';
                header("Location: $url");
            }
            else
            {
                $url= '?c=welcome';
                 header("Location: $url");
            }
        }
        else
        {
            $url= '?c=welcome';
            header("Location: $url");
        }
        
    }
    
    public function Delete(){

        if(!empty($_SESSION['uid']))
        {
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid);
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;
            $userEscuela = $userDetails->user_escuela;

            if($userStatus == "1")
            {
                if($userLevel == "1")
                {
                    $this->model->Delete($_REQUEST['project_id']);
                    $url= '?c=project';
                    header("Location: $url");
                }
                elseif($userLevel == "2")
                {   
                    $url= '?c=welcome';
                    header("Location: $url");  
                }
                elseif($userLevel == "3")
                {   
                    $url= '?c=welcome';
                    header("Location: $url");  
                }
                elseif($userLevel == "4")
                {   
                    $url= '?c=welcome';
                    header("Location: $url");  
                }
                elseif($userLevel == "5")
                {   
                    $this->model->Delete($_REQUEST['project_id']);
                    $url= '?c=project';
                    header("Location: $url");
                }
            }
            else
            {
                $url= '?c=welcome';
                header("Location: $url");    
            }
        }
        else
        {
            $url= '?c=welcome';
            header("Location: $url");
        }
    }
}