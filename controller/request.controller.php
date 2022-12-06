<?php
require_once 'model/request.php';
require_once 'controller/core.controller.php';

class requestController extends coreController{
    
    private $model;
    private $auth;
    
    public function __CONSTRUCT(){
        $this->model = new request();
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
                    require_once 'view/request/request.view.php';
                    require_once 'view/footer.view.php';
                }
                else{
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

            if($userStatus == "1")
            {
                if($userLevel == "1")
                {
                    $request = new request();
        
                    if(isset($_REQUEST['request_id'])){
                    $request = $this->model->Obtain($_REQUEST['request_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/request/request-admin.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2")
                {
                    $request = new request();
        
                    if(isset($_REQUEST['request_id'])){
                    $request = $this->model->Obtain($_REQUEST['request_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.supervisor.view.php';
                    require_once 'view/request/request-edit.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "3")
                {
                    $request = new request();
        
                    if(isset($_REQUEST['request_id'])){
                    $request = $this->model->Obtain($_REQUEST['request_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.directivo.view.php';
                    require_once 'view/request/request-edit.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "4")
                {
                    $request = new request();
        
                    if(isset($_REQUEST['request_id'])){
                    $request = $this->model->Obtain($_REQUEST['request_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.docente.view.php';
                    require_once 'view/request/request-edit.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "5")
                {
                    $request = new request();
        
                    if(isset($_REQUEST['request_id'])){
                    $request = $this->model->Obtain($_REQUEST['request_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.alumno.view.php';
                    require_once 'view/request/request-edit.view.php';
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
                $request = new request();
        
                $request->request_id = $_REQUEST['request_id'];
                $request->request_tipo = $_REQUEST['request_tipo'];
                $request->request_solicitante = $_REQUEST['request_solicitante'];
                $request->request_detalle = $_REQUEST['request_detalle'];
                $request->request_estado = $_REQUEST['request_estado'];
              
        
                $request->request_id > 0 
                    ? $this->model->Update($request)
                    : $this->model->Register($request);
                
                $url= '?c=request';
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

            if($userStatus == "1")
            {
            $this->model->Delete($_REQUEST['request_id']);
            $url= '?c=request';
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
}