<?php declare(strict_types = 1);

namespace App\Models;

use PDO;

/**
 * Display model
 */

class Display extends \Core\Model {
	
    private string $tablename;

    public function __construct($tablename) {
        $this->tablename = $tablename;
    }

    public function getAllData(): array {
        $query = static::getDB()->prepare("SELECT * FROM $this->tablename ORDER BY `id` ASC");
        $query->execute();
        return $query->fetchAll();
    }
	
    public function getLastRecordDESC(): array {
        $query = static::getDB()->prepare("SELECT * FROM $this->tablename ORDER BY 'id' DESC LIMIT 1");
        $query->execute();
		if ($query->rowCount() > 0) {
			return $data = $query->fetch();
		}
    }

 	public function getRecordByID($id) {
        $id = intval($id);
        $query = static::getDB()->prepare("SELECT * FROM `$this->tablename` WHERE `id`= $id");
        $query->execute();
        return $query->fetch();
    }
    
    public function getSelectValue($id, $secName) {
        $query = static::getDB()->prepare("SELECT $id, $secName  FROM `$this->tablename` ORDER BY 'id'");
        $query->execute();
        return $query->fetchAll();
    }
}

