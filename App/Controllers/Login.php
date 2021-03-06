<?php

namespace App\Controllers;

use \Core\View;
use App\Helpers\Validation;
use App\Models\LoginUser;

class Login extends \Core\Controller {

    /**
     * @return void
     */

    public function index(): void {

        $val = new Validation();
        $data = [];

        if (isset($_POST['submit'])) {

            if ($val->name('username')->value($_POST['username'])->pattern('alpha')->required()) {
                $data['username'] = $val->test_input($_POST['username']);
            }
            if ($val->name('password')->value($_POST['password'])->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required()) {
                $data['password'] = $val->test_input($_POST['password']);
            }

            if ($val->isSuccess()) {
                try {
                    $login = new LoginUser($data);
                    $login->loginUser();
                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                } 
            }
        }

        View::renderTemplate('Home/loginForm.html', [
            'data'    => $data,
            'error' => $val->getErrors()
        ]);
    }
}
