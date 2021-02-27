<?php

namespace App\Models;

use PDO;

/**
 * Register model
 */
class Registration extends \Core\Model {

    private string $email;
    private string $username;
    private string $password;
    private string $token;
    
    function __construct(array $data) {
        $this->email    = $data['email'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->token    = $data['token'];
    }

    function rgisterUser(): void {
		
		$sql = "INSERT INTO register (username, email, password, token, created_at) VALUES (:username,:email,:password,:token,:created_at)";
		
        try {
			$hash = password_hash($this->password, PASSWORD_BCRYPT);
            $datetime = date('Y-m-d H:i:s');

			$query = static::getDB()->prepare($sql);
			
			$query->bindparam(":username", $this->username);
            $query->bindparam(":email", $this->email);
            $query->bindparam(":password", $hash);
            $query->bindParam(':created_at', $datetime);
            $query->bindParam(':token', $this->token);
            $query->execute(); 
            
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
    }
}
