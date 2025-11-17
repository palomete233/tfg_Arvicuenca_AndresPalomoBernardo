<?php
    //Implemntamos la claase de conexion
    require_once "conex.php";

    class user_model{
        //Creamos la  conexion para crear la instnacia
        private $conex = null;

        public function __construct(){
            $this->conex = Conexion::getConex();
        }

        //Aqui empezamos a realizar los metodos que vamos a necesitar

        //Con este metdodo mostramos todos los usuarios que tenemos en la base de datos
        public function mostrarUsuarios(){
            try {
                $sql = $this->conex->prepare("SELECT * FROM usuarios");
                $sql->execute();
                $resul = $sql->fetchAll();

                return $resul;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        //Este metodo comprueba si el usuario existe en la base de datos
        public function UsuarioExiste($nom_user, $email){
            try{
                $sql = $this->conex->prepare("SELECT id_user FROM usuarios WHERE nom_user = ? OR email = ?");
                $sql->execute([$nom_user, $email]);
                return $sql->fetch() ? true: false;

            }catch(PDOException $e){
                error_log("Error: " . $e->getMessage());
            }
        }

        //Con este metodo insertamos un nuevo usuario en la base de datos
        public function insertarUser($nombre, $apellido, $nom_user, $password, $email, $direccion, $rol, $tipo_cliente){
            try {
                if($this->UsuarioExiste($nom_user, $email)){
                    return false;
                }else{
                    $hashPass = password_hash($password, PASSWORD_DEFAULT);
                    $sql = $this->conex->prepare("INSERT INTO usuarios (nombre, apellido, nom_user, password, email, direccion, rol, tipo_cliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $sql->execute([$nombre, $apellido, $nom_user, $hashPass, $email, $direccion, $rol, $tipo_cliente]);
                    return true;
                }
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
            }
        }

        //Este metodo nos ccomprueba que la contraseña esta hasheada y el usuario es correcto
        public function verificarUser($nom_user, $pass){
            try{
                $sql = $this->conex->prepare("select * from usuarios where nom_user = ?");
                $sql->execute([$nom_user]);
                $resul = $sql->fetchAll();

                if($resul && password_verify($pass, $resul[0]['password'])){
                    return $resul;

                }else{
                    return false;
                }

            }catch(PDOException $e){
                error_log("Error: " . $e->getMessage());

            }
        }

        //Con este metodo eliminamos un usuario de la base de datos
        public function delUser($id){
            try {
                $sql = $this->conex->prepare("DELETE FROM usuarios WHERE nom_user = ?");
                $sql->execute([$id]);
                echo "<p class='mensaje'>Usuario eliminado correctamente</p>";
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
            }
        }

        //Con este metodo obtenemos el rol para asi mandar a los usuarios a una pagina u otra
        public function obtenarRol($nom_user){
            try {
                $sql = $this->conex->prepare("select * from usuarios where nom_user = ?");
                $sql->execute([$nom_user]);

                $resul = $sql->fetchAll();

                if($resul){
                    return $resul[0]['rol'];
                }else{
                    return null;
                }
            } catch (\Throwable $th) {
                
            }
        }

        //Este metood comprueba si el email existe en la base de datos para que no haya email duplicados
        public function emailExiste($email){
            try{
                $sql = $this->conex->prepare("SELECT * FROM usuarios WHERE email = ?");
                $sql->execute([$email]);
                return $sql->fetchAll();

            }catch(PDOException $e){
                error_log("Error: " . $e->getMessage());
            }
        }

        //Con este metodo modificamos los permisos de un usuario
        public function modPermisos($nom_user, $rol){
            try {
                $sql = $this->conex->prepare("UPDATE usuarios SET rol = ? WHERE nom_user = ?");
                $sql->execute([$rol, $nom_user]);
                echo "<p class='mensaje'>Permisos modificados correctamente</p>";
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
            }
        }

       // Obtener descuento basado en el tipo de cliente, es decir dependideno el tipo de cliente le aplicamos un descuento u otro
        public function obtenerDescuentoCliente($nom_user) {
            try {
                $sql = $this->conex->prepare("SELECT tipo_cliente FROM usuarios WHERE nom_user = ?");
                $sql->execute([$nom_user]);
                $result = $sql->fetch();

                if ($result) {
                    switch ($result['tipo_cliente']) {
                        case 'taller':
                            return 0.15; // 15% descuento
                        case 'particular':
                            return 0.10; // 10% descuento
                        default:
                            return 0;
                    }
                }
                return 0;
            } catch (PDOException $e) {
                error_log("Error al obtener descuento: " . $e->getMessage());
                return 0;
            }
        }

    }
?>