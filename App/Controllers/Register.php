<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Registration;
use App\Helpers\Validation;
/**
 * Register controller
 */
class Register extends \Core\Controller {

    /**
     * Show the index page
     *
     * @return void
     */

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    public function index() {

        $errors = [];
        $data = [];

        if (isset($_POST['submit'])) {
    	
            if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['username'])) {
                $errors['username'] = 'Username, alphanumeric & longer than or equals 5 chars';
            } else {
                $data['username'] = $this->test_input($_POST['username']);
            }

            if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['password'])) {
                $errors['password'] = 'Password must be 8-12 characters and 1 number ';
            }
            else {
                $data['password'] = $this->test_input($_POST['password']);
            }

            $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 

            if (!preg_match ($pattern, $_POST['email'])) {  
                $errors['email'] = 'Incorrect email address'; 
            } else {  
                $data['email'] = $this->test_input($_POST['email']);  
            }  

            if (!$errors) {
                 
                try {
                    
                    $register = new Registration($data);
                    $register->rgisterUser();

                    if ($register)
                        $data = [];
                        echo 'Success';

                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                } 
            } 

          
        }
        View::renderTemplate('Home/form.html', [
            'data'    => $data,
            'error' => $errors
        ]);     
    }
}


