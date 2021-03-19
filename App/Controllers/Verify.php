<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Update;
use App\Helpers\Alerts;

class Verify extends \Core\Controller {

    /**
     * Verify token
     *
     * @return void
     */
    public function index() {

        if (isset($_GET['token'])) {
            $update = Update::existsToken($_GET['token']);
        
            if ($update) {
    
                $up = new Update(['verified'=> 1], 'users');
                $up->editData($update['id']);
    
                Alerts::successAlert("Success!","Verify your emaile <br><br> <a href='/login' class='btn btn-success'>Back to login</a>");
            } else {
                Alerts::dangerAlert("Error!","Email address has not been verified");
            }
        }
        View::renderTemplate('base.html'); 
    }
}