<?php
    require_once __DIR__ . '/../config.php';
    
    class Conexion{
        public static $conex = null;
        //Creamos la conexion a la base de datos de esta manera lo hacemos para que no se creen varias intancias y no haya un problema de recurrencia
        public static function getConex(){
            if(self::$conex == null){
                try{
                    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                    self::$conex = new PDO($dsn, DB_USER, DB_PASS);
                    self::$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$conex->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                }catch(Exception $e){
                    die ("Error: " . $e->getMessage() . " en la linea " . $e->getLine());
                }
            }
            return self::$conex; 
        }
    }
?>