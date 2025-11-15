<?php
    require_once "conex.php";

    class LoginModel{
        private $conex = null;
        //En el constructor creamos la instancia de tipo conex para que se nos cree la conexion
        public function __construct(){
            $this->conex = Conexion::getConex();
        }
        //Este metodo comprueba que la contraseña y el usuario es correcto si es correcto devuelve un true y siguie si no nos da un false y nos saca un error
        
        public function login ($pass,$user){
            try {
                $sql = $this->conex->prepare("SELECT * FROM usuarios WHERE nom_user = ? AND password = ?");
                $sql->execute([$user,$pass]);
                if($sql->fetchAll()){
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                error_log("Error al logearse". $e->getMessage());
            }
        }
    }
?>