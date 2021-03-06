<?php  declare(strict_types = 1);

namespace App\Models;

use PDO;
use App\Helpers\Alerts;
/**
 * Login model
 */
class LoginUser extends \Core\Model {

    private string $username;
    private string $password;

    public function __construct(array $data) {
        $this->username = $data['username'];
        $this->password = $data['password'];
    }

    public function loginUser() {

        $sql = "SELECT * FROM users 
                WHERE 
                username = :username";

		try {

            $query = static::getDB()->prepare($sql);
			$query->execute([
                ':username' => $this->username
            ]);
			$result = $query->fetch();

	        if ($query->rowCount() > 0) {
                if (password_verify($this->password , $result['password'])) {
					$_SESSION['username'] = $result['username'];
					$_SESSION['type'] = $result['type'];
                    ob_start();
                    header("Location:panel");
                    exit();
                } 
	        } else {
                Alerts::dangerAlert("Error","User not found");
            }
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
    }
}
