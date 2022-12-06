<?php
require_once 'model/user.php';
require_once 'controller/core.controller.php';

class userController extends coreController{
    
    private $model;
    private $auth;
    
    public function __CONSTRUCT(){
        $this->model = new user();
        $this->auth = new auth();
    }
    
    public function Index(){

        if(!empty($_SESSION['uid'])){
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid); 
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;

            if($userStatus == "1"){
                if($userLevel == "1"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/user/user.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.supervisor.view.php';
                    require_once 'view/user/user.allinschool.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "3"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.directivo.view.php';
                    require_once 'view/user/user.allinschool.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "4"){
                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.docente.view.php';
                    require_once 'view/user/user.allinschool.view.php';
                    require_once 'view/footer.view.php';
                }
                
            }
            else{
                $url= '?c=welcome';
                header("Location: $url");
            }
        }
        else{
            $url= '?c=welcome';
            header("Location: $url");
        }
        
 
       
    }
    
    public function Edit(){

        if(!empty($_SESSION['uid'])){
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid); 
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;

            if($userStatus == "1"){
                if($userLevel != "1"){
                    $url= '?c=welcome';
                    header("Location: $url");
                }
                elseif($userLevel == "1"){
                    $user = new user();
        
                    if(isset($_REQUEST['uid'])){
                        $user = $this->model->Obtain($_REQUEST['uid']);
                    }

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/user/user-edit.view.php';
                    require_once 'view/footer.view.php';
                }
            }
            else{
                $url= '?c=welcome';
                header("Location: $url");
            }
        }
        else{
            $url= '?c=welcome';
            header("Location: $url");
        } 
    }
                    
    public function Save(){
        if(!empty($_SESSION['uid'])){
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid); 
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;

            if($userStatus == "1"){
                if($userLevel != "1"){
                    $url= '?c=welcome';
                    header("Location: $url");
                }
                elseif($userLevel == "1"){
                    $user = new user();
        
                    $user->uid = $_REQUEST['uid'];
                    $user->username = $_REQUEST['username'];
                    $user->email = $_REQUEST['email'];
                    $user->user_escuela = $_REQUEST['user_escuela'];
                    $user->password = $_REQUEST['password'];
                    $user->role = $_REQUEST['role'];
                    $user->user_status = $_REQUEST['user_status'];
                

                    $user->uid > 0 
                        ? $this->model->Update($user)
                        : $this->model->Register($user);
                    
                    header('Location: index.php?c=user');
                }
            }
            else{
                $url= '?c=welcome';
                header("Location: $url");
            }
        }
        else{
            $url= '?c=welcome';
            header("Location: $url");
        }
    }
    
    public function Delete(){
        if(!empty($_SESSION['uid'])){
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid); 
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;

            if($userStatus == "1"){
                if($userLevel != "1"){
                    $url= '?c=welcome';
                    header("Location: $url");
                }
                elseif($userLevel == "1"){
                    $this->model->Delete($_REQUEST['uid']);
                    header('Location: index.php?c=user');
                }
            }
            else{
                $url= '?c=welcome';
                header("Location: $url");
            }
        }
        else{
            $url= '?c=welcome';
            header("Location: $url");
        }
    }
}