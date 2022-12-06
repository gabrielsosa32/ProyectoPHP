<?php
require_once 'model/school.php';
require_once 'controller/core.controller.php';

class schoolController extends coreController{
    
    private $model;
    private $auth;
    
    public function __CONSTRUCT(){
        $this->model = new school();
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
                    require_once 'view/school/school.view.php';
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
                    $school = new school();
        
                    if(isset($_REQUEST['school_id'])){
                    $school = $this->model->Obtain($_REQUEST['school_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/school/school-edit.view.php';
                    require_once 'view/footer.view.php';
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
                $school = new school();
        
                $school->school_id = $_REQUEST['school_id'];
                $school->school_nombre = $_REQUEST['school_nombre'];
                $school->school_direccion = $_REQUEST['school_direccion'];
                $school->school_telefono = $_REQUEST['school_telefono'];
              
        
                $school->school_id > 0 
                    ? $this->model->Update($school)
                    : $this->model->Register($school);
                
                $url= '?c=school';
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
            $this->model->Delete($_REQUEST['school_id']);
            $url= '?c=school';
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