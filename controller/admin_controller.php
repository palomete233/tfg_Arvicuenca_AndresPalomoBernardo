<?php
    require_once "model/user_model.php";
    /**
     * Controlador de Productos
     * Hace que los usuarios administradores puedan acceder al panel de administracion
     */

    class Admin_controller{
        
        public function mostrarAdmin(){
            if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin"){
                header("Location: index.php?action=mostrarMenu");
                exit();
            }

            require_once "view/menuAdmin.php";
        }
    }
?>