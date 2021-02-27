<?php

namespace App\Controllers;

use \Core\View;
use App\Helpers\Validation;
/**
 * Mail controller
 *
 */
class Mail extends \Core\Controller {

    /**
     * Show the index page
     *
     * @return void
     */
    public function index() {
        /*
        $to_email = "nefren.games@gmail.com";
        $subject = "Simple Email Test via PHP";
        $body = "Hi,nn This is test email send by PHP Script";
        $headers = "From: sender\'s email";
         
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
        }
        */

        $email = 'nefren.games@gmail.com';
        $username = 'admin12';
        $password = '123456';
        $age = 29;
        
        $val = new Validation();
        //$val->name('email')->value($email)->pattern('email')->required();
        $val->name('username')->value($username)->pattern('alpha')->required();
        //$val->name('password')->value($password)->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();
        //$val->name('age')->value($age)->min(18)->max(40);
        
        if($val->isSuccess()){
            echo "Validation ok!";
        }else{
            echo "Validation error!";
            var_dump($val->getErrors());
        }

    }
}