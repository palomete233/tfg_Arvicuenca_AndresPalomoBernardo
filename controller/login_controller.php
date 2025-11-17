<?php
    session_start();
    require_once "model/login_model.php";
    require_once "model/user_model.php";

    /**
     * Controlador del Login
     * Gestiona todas las operaciones relacionadas con el login
     */

    class login_controller{

        //Este metodo nos lleva a la vista del home es decir la pagina de inicio
        public function index(){
            if(!isset($_SESSION['user'])){
                header("Location: index.php?action=inicio");
                $_SESSION["user"] = "";
                exit();
            }

            require_once "view/login.php";
        }

        //Este metodo nos hace el login y nos comprubea que el usuario y la contraseña son correctos
        public function login(){
            if(!isset($_SESSION["user"]) && $_SESSION["rol"] != "user" && $_SESSION["rol"] != "admin"){
                header("Location: ../index.php?action=inicio");
                exit();
            }

            $login = new LoginModel();
            $user = new user_model();

            $nom_user = $_POST['nom_user'];
            $pass = $_POST['password'];

            $resul = $login->login($pass, $nom_user);
            $result = $user->verificarUser($nom_user, $pass);

            if($resul === true || $result != null){
                //obtenemos el rol del usuario
                $rol = $user->obtenarRol($nom_user);

                if($rol){
                    $_SESSION["rol"] = $rol;
                    $_SESSION["user"] = $nom_user;
                    $_SESSION["email"] = $result[0]['email'];
                    $_SESSION["nom"] = $result[0]['nombre'];

                    //Agregramos las cookies para recordar el nombre de usuario
                    if(isset($_POST["recordar"])){
                        setcookie('recordar_user', $nom_user, time() + (7*24*60*60), '/');
                    } else {
                        setcookie('recordar_user', '', time() - 3600, '/');
                    }

                    if($_SESSION["rol"] == "admin"){
                        header("Location: index.php?action=mostrarAdmin");
                        exit();
                    } else {
                        header("Location: index.php?action=mostrarUser");
                        exit();

                    }

                }else{
                    echo "No se encontro el rol";
                    include "view/login.php";
                }
            }else{
                echo "<p class='error'>USUARIO O CONTRASEÑA INCORRECTOS</p>";
                include "view/login.php";
            }
        }

        //Este metodo elimina la cookie de recordar usuario
        public function delCookie(){
            if(!isset($_SESSION["user"]) && $_SESSION["rol"] != "user" && $_SESSION["rol"] != "admin"){
                header("Location: ../index.php?action=inicio");
                exit();
            }

            if(isset($_COOKIE["recordar_user"])){
                setcookie('recordar_user', '', time() - 3600, '/');
                echo "cookie eliminada";
            }else{
                echo "no hay cookie";
            }

            header("Location: index.php?action=inicio");
            exit();
        }

        //Este metodo destruye la sesion y nos lleva a la pagina de inicio
        public function logout(){
            session_start();
            session_unset();
            session_destroy();

            header("Location: index.php?action=inicio");
            exit();
        }
    }
?>