<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Registration;
use App\Helpers\Validation;
use App\Helpers\Mailer;
/**
 * Register controller
 */
class Register extends \Core\Controller {

    /**
     * @return void
     */

    private function test_input(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    public function index(): void {

        $val = new Validation();
        $data = [];
        $data['token'] = bin2hex(random_bytes(50));
        $urlVerify = $_SERVER['DOMAIN'].'/verify_email?token='.$data['token'];

        if (isset($_POST['submit'])) {
    	
            if ($val->name('username')->value($_POST['username'])->pattern('alpha')->required()) {
                $data['username'] = $this->test_input($_POST['username']);
            }
            if ($val->name('email')->value($_POST['email'])->pattern('email')->required()){
                $data['email'] = $this->test_input($_POST['email']); 
            }
            if ($val->name('password')->value($_POST['password'])->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required()) {
                $data['password'] = $this->test_input($_POST['password']);
            }

            if ($val->isSuccess()) {
                try {

                    $register = new Registration($data);
                    $register->rgisterUser();

                    if ($register)
                        
                        $sendMail = new Mailer();
                        $sendMail->send($data['email'], $urlVerify);
                        $data = [];

                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                } 
            }
        }
        View::renderTemplate('Home/form.html', [
            'data'    => $data,
            'error' => $val->getErrors()
        ]);     
    }
}

