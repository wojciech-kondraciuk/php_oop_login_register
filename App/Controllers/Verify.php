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
    
                Alerts::successAlert("Success","This is a Bootstrap danger alert");
            } else {
                Alerts::dangerAlert("Danger!","This is a Bootstrap danger alert");
            }
        }
        View::renderTemplate('base.html'); 
    }
}