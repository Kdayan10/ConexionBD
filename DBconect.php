 <?php
  class Database{
        public  $db; //controldores db
        private static $dns = "mysql:localhost;dbname=Nueva";
        private static $user = "root"; //usuario de la conexion
        private static $pass = ""; //contraseña del usuario
        private static $instance; //instancia de la conexion 
    
        public function _construct_(){
          $this->db = new PDO(self::$dns, self::$user, self::$pass);
        }

        public static function getInstance(){
            if(!isset(self::$instance)){
                $object = _CLASS_;
                self::$instance = new $object;
            }
            return self::$instance;
        }

        public function insertar($nombre, $apellido, $edad, $email){
           
            try {
              $conexion = Database::getInstance();//obtiene la instancia de la clase
              $query = $conexion->db->prepare("INSERT INTO persona (nombre, apellido, email, edad) VALUES (:nombre, :apellido, :email, :edad)");
              $query->execute(
                array(
                    ':nombre' => $nombre,
                    ':apellido' => $apellido,
                    ':email' => $email,
                    ':edad' => $edad,
                )
            );

            return 1; //retorna 1 si fue exitoso

        } catch(PDOException $error){
            echo $error;
            return 0; // retporna 0 si falla

            }
        }
    
    }

?>