<?php

namespace App\Models;

use PDO;

/**
 * Register model
 */
class Registration extends \Core\Model {

    private $email;
    private $username;
    private $password;
    
    function __construct($data) {
        $this->email    = $data['email'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->datetime = date('Y-m-d H:i:s');
    }

    function rgisterUser() {
		
		$sql = "INSERT INTO register (username, password, email, created_at) VALUES (:username,:password,:email,:created_at)";
        
		try{
			
			$hash = password_hash($this->password, PASSWORD_BCRYPT);
			$query = static::getDB()->prepare($sql);
			
			$query->bindparam(":username", $this->username);
            $query->bindparam(":email", $this->email);
            $query->bindparam(":password", $hash);
            $query->bindParam(':created_at', $this->datetime);
            $query->execute(); 
				
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
    }
}
