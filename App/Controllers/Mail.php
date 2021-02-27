<?php

namespace App\Controllers;
use App\Models\Update;
/**
 * Mail controller
 *
 */
class Mail extends \Core\Controller {

    /**
     * verify token
     *
     * @return void
     */
    public function index() {

        $_GET['token'] ?? null;

        $data = [
            'name'=>'kinga'
        ];

        $SecUpdate = new Update($data, 'users');
        $SecUpdate->editData(1);

        if ($SecUpdate) {
            echo "poszło";
        } else {
            echo "lipa";
        }

    }
}