<?php
/**
 * ESTE ES UN CONTROLADOR DE EJEMPLO Y MODELO PARA OTROS, TENDRÁ COMENTADAS TODAS SUS PARTES Y FUNCIONALIDADES
 * ACLARAMOS QUE PARA CREAR UN NUEVO CONTROLADOR ES NECESARIO QUE EL ARCHIVO ESTÉ COMPUESTO POR:
 * DECLARACIÓN DEL NOMBRE DEL CONTROLADOR + UN PUNTO + LA PALABRA "CONTROLLER" Y TODO EN MINÚSCULAS, EJEMPLO:
 * nombredelcontrolador.controller.php
 */

/**
 * Las primeras líneas de un controlador tienen que ser la llamada al archivo modelo (repositorio) que se
 * encargará de realizar la conexión a la base de datos como también así de todas las acciones realizadas
 * sobre esta, claro que solo es necesario llamar a un modelo si se va a ser uso de el, sino, no es necesario.
 * Lo que si es importante es llamar al controlador core.controller.php, del cual deberán de extender todos
 * los demás controladores, de momento solo tiene una función de logout que puede ser llamada desde cualquier
 * lugar, pero se planea que en un futuro se agreguen más "funciones globales", además de esta única función, es
 * el controlador que permitirá al resto de controladores acceder a las funciones de autentificación de usuarios
 * (basicamente sesiones pero con validaciones dependiendo de distintas características que componen al registro
 * de un usuario).
 */

//require_once 'model/nombreDelModelo.php'; 
/**
 * La línea anterior sólo sirve de ejemplo de cómo llamar a un modelo
 */
require_once 'controller/core.controller.php';

/**
 * Creamos la clase principal del objeto, con el nombre del controlador escrito en formato camelCase agregando
 * al final del mismo la palabra Controller y lo hacemos extender de coreController, clase que viene del archivo
 * core.controller.php y hace de madre para el resto de controladores.
 */
class exampleController extends coreController{

    /**
     * Lo primero que debe de ir dentro de la clase principal de un controlador, son variables privadas que luego
     * inicializarán un nuevo objeto de los modelos(repositorios) que se vayan a utilizar en el controlador
     */
    
    private $model;
    private $auth;
    
    /**
     * Inicializamos una función constructora para el controlador
     */
    public function __CONSTRUCT(){
        //$this->model = new modelName(); 
        /**
         * En esta caso, si bien antes declaramos la variable privada $model, como en este controlador no hemos
         * llamado de forma real a ningún controlador real, la comentamos y la dejamos sólo como ejemplo
         */

        $this->auth = new auth();
        /**
         * Iniciamos un nuevo objeto del modelo auth.php que es extendido a este controlador a través
         * del coreController, este objeto se va a encargar de realizar todas las funciones relacionadas
         * con las sesiones y de todas colaborar con sus validaciones para determinar más adelante
         * quién tiene acceso a qué parte del controlador, qué tanto ve y qué tanto puede hacer en el mismo.
         * Tanto la variable privada $auth como la creación del objeto auth son OPCIONALES, si quieren hacer una
         * página, app o parte de una app que no requiera validaciones de sesión pueden omitir ambas cosas. 
         */
    }

    /**
     * Listo, hasta ahora tenemos el controlador armado y listo para recibir su primer función.
     * Es altamente recomendable que TODOS los controladores tengan una función Index, debido a que de forma
     * predeterminada, cada vez que se intente acceder a un controlador y no se declare a qué función/acción
     * del mismo ir, lo que automáticamente hace esta app es cargar la función Index. La declaramos y aprovechamos
     * a aclarar que es neseario que todas las funciones sean declaradas como públicas para poder ser llamadas. 
     * También aclaramos que si bien como se ha dicho antes es altamente recomendable realizar una función Index
     * esto no quiere decir que sea obligatorio, depende de las funciones que esperemos que cumpla el controlaor
     */
    public function Index()
    {
        /**
         * Ahora, vamos a comenzar a preparar todo para el funcionamiento de las validaciones y generar la
         * estructura básica que debería tener cualquier función/acción que vaya a realizar/mostrar distintas
         * cosas dependiendo de las validaciones de sesión que determinaremos en la estructura.
         * Lo siguiente a aclarar es que para acceder a un controlador y sus funciones lo hacemos a través
         * de la URL enviando parámetros a través del archivo index.php, ¿cómo funciona exactamente?,
         * si quisieramos acceder a este controlador, tendríamos que ir a www.nuestraweb.com/index.php?c=example
         * como se puede apreciar añadimos "?c=example" luego de acceder al archivo index.php, a este archivo
         * a través del parámetro "c" le de determinamos que queremos acceder a ese controlador, no es necesario
         * nombrar ni el archivo ni el nombre completo de la clase, sólo con colocar el nombre que declarado al
         * crear el archivo controlador es suficiente, si añadimos más cosas no funcionará.
         * Por defecto ingresaremos al controlador Index ya que no hemos declarado que vaya a ninguna función
         * o acción específica, eso lo veremos más adelante.
         */

        /**
         * Iniciamos lo necesario para las validaciones y  la estructura base para que funcionen las mismas y
         * lo primero a validar es corroborar que la sesión no tenga un "uid" (id de usuario) vacío, si esto
         * está vacío quiere decir que quién esté viendo nuestra web/usando nuestra app no tiene iniciada 
         * ninguna sesión, si la sesión NO tiene el uid vacío, por lo tanto hay un usuario logueado, comenzamos
         * a construir los objetos necesarios, declarar las variables necesarias y obtener los datos necesarios
         * para las validaciones.
         */

        if(!empty($_SESSION['uid']))
        {
            $session_uid=$_SESSION['uid']; //almacenamos el valor de uid en una variable
            $auth = new auth(); //declaramos nuevamente la creación de un objeto auth
            $userDetails=$auth->userDetails($session_uid); 
            /**
             * Solicitamos al objeto auth que nos traiga del mismo todos los detalles(características) que le
             * pertenecen y lo conforman, y enviamos el parámetor uid que la función userDetails está esperando
             * desde el modelo mismo, para poder devolver sólo los detalles del usuario logueado.
             */
            $userLevel = $userDetails->role; //alacenamos en una variable el rol del usuario
            $userStatus = $userDetails->user_status; //almacenamos en una variable el estado del usuario

            /**
             * Con respecto a las últimas dos variables, es importante saber que el rol y estado de usuario
             * puede variar infinitamente, todo depende de la cantidad de roles o estados queramos que
             * un usuario pueda tener.
             * En esta app los usuarios pueden tener sólo 2 roles distintos e individuales: "1" para los
             * usuarios normales y "2" para los usuarios administradores.
             * Lo mismo con los estados, sólo hay 2 posibilidades: "1" para los usuarios activos y "0" para
             * los inactivos.
             */

            if($userStatus == "1")
            /**
             * Validamos que el usuario sea activo
             */
            {
                /**
                 * Si es activo, vamos a validar qué hace la función o qué muestra dependiendo los distintos
                 * niveles/roles de usuario.
                 * Puede mostrar una vista (archivos guardados dentro de la carpeta view que contienen en su 99%
                 * puro código HTML, JS Y CSS), o también puede ejecutar alguna función específica como puede
                 * ser realizar distintas operaciones sobre una tabla de la base de datos dependiendo del modelo
                 * utilizado. 
                 * Normalmente si queremos mostrar algo visual, no llamamos a una vista individual, sino que
                 * llamamos a distintas vistas que muestran distintas partes de la interfaz de usuario, si quieren
                 * revisar el algún otro controlador podrán ver que muestran distintos menús de navegación y
                 * distintos contenidos dependiendo del estado o rol del usuario, y muchas veces si no cumplen con
                 * la validación de rol o estado, se los redirecciona a otro controlador con el método header.
                 * Las posibilidades de lo que realiza una función de un controlador son infintas, en este caso
                 * sólo mostraremos a través de un echo distintos textos
                 */
                if($userLevel == "1"){
                    /**
                     * Si el nivel del usuario es 1, osea, usuario normal lanzamos un echo con un string y le
                     * encadenamos al mismo el nombre de usuario del usuario logueado gracias a $userDetails
                     */
                    echo "Bienvenido usuario ". $userDetails->username;
                }
                elseif($userLevel == "2"){
                    /**
                     * Realizamos lo mismo si el nivel de usuario es 2, pero cambiamos lo que dice el string
                     */
                    echo "Bienvenido administrador " . $userDetails->username . ". ¡Eres superpoderoso!";
                }
                /**
                 * En esta estructura condicional no colocamos un else, debido a que no se espera que el usuario
                 * tenga un rol distinto a 1 o 2
                 */
            }
            else
            {
                /**
                 * Declaramos lo que pasa si el usuario NO tiene estado "1", osea, no es un usuario activo.
                 * Aclaremos que en este caso sólo hay un else debido a que sólo queremos que haya una posibilidad
                 * de estado de usuario activo. En este caso mostraremos un echo avisando de su estado.
                 */
                echo "Ustéd no es un usuario activo, contacte a un administrador para volver a activar su usuario";
            }
        }
        else
        {
            /**
             * En este else declaramos lo que pasa si el usuario NO tiene una sesión iniciada.
             */
            echo "Ustéd no tiene una sesión iniciada, por favor inicie sesión o regístrese.";
        } 

        /**
         * Antes de finalizar esta función Index, se vuelve a dejar en claro que lo que que puede llegar a realizar
         * esta o cualquier otra función es ilimitado, en este caso solo hemos hecho que muestre algunos strings
         * en pantalla dependiendo de el estado de la sesión y del estado y rol del usuario. Pero podríamos hacer
         * que realice cualquier cosa que queramos, generar una vista, realizar acciones, redireccionar, etc.
         */

    }

    /**
     * Ahora declararemos una segunda función llamada Galletitas, a la cual accederemos a través de los parámetros
     * "?c=example&a=Galletitas", como verán agregamos a la URL un segundo parámetro llamado "a" el cual se encarga
     * de determinar a qué acción/función queremos ir del controlador.
     * Además, en esta segunda función no aplicaremos validación alguna de usuario, sólo mostraremos un string.
     */

    public function Galletitas()
    {
        echo "Bienvenido, tomá una galletita.";
    }

    /**
     * Lo último que dejaremos en este controlador de ejemplo, es una función que sólo tendrá la estructura
     * de validación para que pueda ser fácilmente duplicada donde se necesite usar, sin comentarios alguno.
     */

    public function EstructuraValidaciónSesión()
    {
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
                    //Que pasa si es administrador
                }
                elseif($userLevel == "2"){
                    //Que pasa si es supervisor
                }
                elseif($userLevel == "3"){
                    //Que pasa si es directivo
                }
                elseif($userLevel == "4"){
                    //Que pasa si es docente
                }
                elseif($userLevel == "5"){
                    //Que pasa si es alumno
                }
            }
            else{
                echo "Ustéd no es un usuario activo, contacte a un administrador para volver a activar su usuario";
            }
        }
        else{
            echo "Ustéd no tiene una sesión iniciada, por favor inicie sesión o regístrese.";
        } 
    }
    
}