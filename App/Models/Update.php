<?php declare(strict_types = 1);

namespace App\Models;

use PDO;

/**
 * Update model
 */
class Update extends \Core\Model {

    private string $tablename;
    private array $data;

    public function __construct($data, $tablename) {
        $this->data = $data;
        $this->tablename = $tablename;
    }

    function editData(int $id): int {
        try {
            $sql = "UPDATE $this->tablename SET ";

            foreach ($this->data as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . ", ";
            }
    
            $pat = "+-0*/";
            $sql .= $pat;
            $sql = str_replace(", " . $pat, " ", $sql);
            $sql .= " WHERE `id` = $id";
    
            $query = static::getDB()->prepare($sql);
    
            foreach ($this->data as $key => $value) {
                $query->bindParam(":$key", $this->data[$key]);
            }

            $query->execute();

            return true;

        } catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
    }

    public function existsToken(string $token): string {
        $db = static::getDB();
        //$stmt = $db->query('SELECT * FROM register WHERE token='$token' LIMIT 1')
    }
}
