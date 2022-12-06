<?php

require_once 'controller/core.controller.php';

class welcomeController extends coreController {

    private $auth;
    
    public function __CONSTRUCT(){
        $this->auth = new auth();
    }

    public function Index () {

        if(!empty($_SESSION['uid'])){
            $session_uid=$_SESSION['uid'];
            $auth = new auth();
            $userDetails=$auth->userDetails($session_uid); 
            $userLevel = $userDetails->role;
            $userStatus = $userDetails->user_status;
            $showUserLevel = "";

            if($userLevel == 1){
                $showUserLevel = "Administrador";
            }
            elseif($userLevel == 2){
                $showUserLevel = "Supervisor";
            }
            elseif($userLevel == 3){
                $showUserLevel = "Directivo";
            }
            elseif($userLevel == 4){
                $showUserLevel = "Docente";
            }
            elseif($userLevel == 5){
                $showUserLevel = "Alumno";
            }

            if($userStatus == "1"){
                if($userLevel == "1"){
                    require_once 'library/authenticate.php';

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.admin.view.php';
                    require_once 'view/welcome.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "2"){
                    require_once 'library/authenticate.php';

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.supervisor.view.php';
                    require_once 'view/welcome.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "3"){
                    require_once 'library/authenticate.php';

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.directivo.view.php';
                    require_once 'view/welcome.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "4"){
                    require_once 'library/authenticate.php';

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.docente.view.php';
                    require_once 'view/welcome.view.php';
                    require_once 'view/footer.view.php';
                }
                elseif($userLevel == "5"){
                    require_once 'library/authenticate.php';

                    require_once 'view/header.view.php';
                    require_once 'view/menu/menu.alumno.view.php';
                    require_once 'view/welcome.view.php';
                    require_once 'view/footer.view.php';
                }
            }
            else{
                require_once 'library/authenticate.php';

                require_once 'view/header.view.php';
                require_once 'view/menu/menu.user.view.php';
                require_once 'view/welcome.inactive.view.php';
                require_once 'view/footer.view.php';
            }
        }
        else{
            require_once 'library/authenticate.php';

            require_once 'view/header.view.php';
            require_once 'view/menu/menu.loggedout.view.php';
            require_once 'view/welcome.loggedout.view.php';
            require_once 'view/footer.view.php';
        } 
        
    }

}