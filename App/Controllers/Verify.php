<?php

namespace App\Controllers;
use App\Models\Update;
/**
 * Verify controller
 *
 */
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
    
                $up = new Update(['verified'=> 1], 'register');
                $up->editData($update['id']);
    
                echo 'Success, możesz sie zalogować';
            } else {
                echo "token jest nieaktualny";
            }
        }
    }
}