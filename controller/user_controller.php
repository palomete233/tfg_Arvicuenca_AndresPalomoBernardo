<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    require_once "model/user_model.php";

        /**
         * Controlador de Usuarios
         * Gestiona todas las operaciones relacionadas con los usuarios
         * - CRUD de usuarios
         */

    class User_controller{

        private $user;
        public function __construct(){
            $this->user = new User_model();
        }

        // Con este metodo mostramos la vista del usuario
        public function mostrarUser(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "user" && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            include "view/parteUser.php";
        }

        // Con este metodo obtenemos el descuento del usuario logueado y lo aplicamos en el carrito
        public function obtenerDescuento() {
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            header('Content-Type: application/json');

            if(isset($_SESSION['user'])) {
                $descuento = $this->user->obtenerDescuentoCliente($_SESSION['user']);
                echo json_encode(['descuento' => $descuento]);
            } else {
                echo json_encode(['descuento' => 0]);
            }
            exit();
        }

        // Con este metodo registramos un nuevo usuario en la base de datos
        public function registrarse(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "user" && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $nom = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $nom_user = $_POST['nom_user'];
                $pass = $_POST['password'];
                $email = $_POST['email'];
                $direccion = $_POST['direccion'];
                $rol = $_POST['rol'];
                $tipo_cliente = $_POST['tipo_cliente'];

                $_SESSION['nombre'] = $nom;
                $_SESSION['email'] = $email;

                $resul = $this->user->insertarUser($nom, $apellido, $nom_user, $pass, $email, $direccion, $rol, $tipo_cliente);

                if ($resul === true) {
                    echo "<p class='mensaje'>Usuario registrado correctamente</p>";
                    include "view/registrarse.php";
                } else {
                    echo "<p class='error'>El nombre de usuario o el correo ya existen</p>";
                    include "view/registrarse.php";
                }
            } else {
                require_once "view/registrarse.php";
            }
        }

        // Con este metodo eliminamos un usuario de la base de datos
        public function eliminarUser(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $nom = $_POST["nombre"];
                $userLog = $_SESSION["user"];

                $this->user->delUser($nom);
                $users = $this->user->mostrarUsuarios();

                if ($nom == $userLog) {
                    session_destroy();
                    header("Location: ../index.php?action=inicio");
                    exit();
                } else {
                    include "view/delUser.php";
                }
            } else {
                $users = $this->user->mostrarUsuarios();
                require_once "view/delUser.php";
            }
        }

        // Con este metodo modificamos los permisos de un usuario es decir cambiar el rol
        public function modPermisos(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $nom_user = $_POST["nom_user"];
                $rol = $_POST["rol"];

                $this->user->modPermisos($nom_user, $rol);
            }

            $users = $this->user->mostrarUsuarios();
            require_once "view/modPermisos.php";
        }

        // Con este metodo mostramos la vista de contacto
        public function mostrarContacto(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            require_once "view/paginaContacto.php";
        }

        // Con este metodo mostramos la vista de consultas
        public function mostrarConsultas(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            require_once "view/consultas.php";
        }

        // Con este metodo enviamos el correo con la consulta o reporte del usuario
        public function enviar(){
            if (!isset($_SESSION["user"]) && $_SESSION["rol"] != "user" && $_SESSION["rol"] != "admin") {
                header("Location: ../index.php?action=inicio");
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = $_POST['nombre'];
                $ape = $_POST['apellido'];
                $email = $_POST['email'];
                $mensaje = $_POST['mensaje'];

                $mail = new PHPMailer(true);

                try {
                    //Configuracion del servidor
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'palomobernardoandres@gmail.com';
                    $mail->Password = 'omlc wgqi pcxb umfn';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    //Configuracion remitente
                    $mail->setFrom("palomobernardoandres@gmail.com", "ArviCuenca");
                    $mail->addAddress($email);

                    //Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Reporte de problema / consulta';

                    // Cuerpo del correo con estilo y estructura
                    $mail->Body = "
                                    <div style='font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 20px;'>
                                        <div style='max-width: 600px; margin: auto; background-color: #fff; border-radius: 8px; padding: 20px;'>
                                            <h2 style='color: #113c83;'>Nuevo mensaje de $nombre $ape</h2>
                                            <p style='font-size: 16px; color: #333;'>
                                                Has recibido un nuevo reporte o consulta a través del formulario de contacto.
                                            </p>
                                            <div style='background-color: #f0f2f5; padding: 15px; border-radius: 6px; margin-top: 10px;'>
                                                <p style='font-size: 15px; color: #444; white-space: pre-line;'>$mensaje</p>
                                            </div>
                                            <p style='margin-top: 25px; font-size: 14px; color: #666;'>
                                                <strong>Enviado por:</strong> $nombre $ape<br>
                                                <strong>Fecha:</strong> " . date('d/m/Y H:i') . "
                                            </p>
                                            <hr style='margin: 20px 0; border: none; border-top: 1px solid #ddd;'>
                                            <p style='font-size: 13px; color: #999; text-align: center;'>
                                                Este correo fue generado automáticamente. Por favor, no respondas directamente a este mensaje.
                                            </p>
                                        </div>
                                    </div>
                                ";

                    $mail->AltBody = "Nuevo mensaje de $nombre $ape:\n\n$mensaje\n\nFecha: " . date('d/m/Y H:i');
                    $mail->send();

                    echo "<p class='mensaje'>El mensaje se ha enviado correctamente</p>";
                    include "view/consultas.php";
                } catch (PDOException $e) {
                    echo "error" . $e->getMessage();
                }
            } else {
                echo "<p class='error'>Error al enviar el mensaje</p>";
                include "view/consultas.php";
            }
        }
}
