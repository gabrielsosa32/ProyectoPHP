<?php
require_once 'model/task.php';
require_once 'controller/core.controller.php';

class taskController extends coreController{
    
    private $model;
    private $auth;
    
    public function __CONSTRUCT(){
        $this->model = new task();
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
                    require_once 'view/menu/menu.user.view.php';
                    require_once 'view/task/task.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/task/task.view.php';
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

            if($userStatus == "1")
            {
                if($userLevel == "1")
                {
                    $task = new task();
        
                    if(isset($_REQUEST['task_id'])){
                    $task = $this->model->Obtain($_REQUEST['task_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.user.view.php';
                    require_once 'view/task/task-edit.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2")
                {   
                    $task = new task();
        
                    if(isset($_REQUEST['task_id'])){
                    $task = $this->model->Obtain($_REQUEST['task_id']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/task/task-edit.view.php';
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
                $task = new task();
        
                $task->task_id = $_REQUEST['task_id'];
                $task->task_name = $_REQUEST['task_name'];
                $task->task_description = $_REQUEST['task_description'];
                $task->task_tags = $_REQUEST['task_tags'];
                $task->task_date = $_REQUEST['task_date'];  
                $task->task_status = $_REQUEST['task_status'];
                $task->task_user_id = $userDetails->uid;  
              
        
                $task->task_id > 0 
                    ? $this->model->Update($task)
                    : $this->model->Register($task);
                
                $url= '?c=task';
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
            $this->model->Delete($_REQUEST['task_id']);
            $url= '?c=task';
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