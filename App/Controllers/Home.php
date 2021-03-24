<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Display;

class Home extends \Core\Controller {

    /**
     * @return void
     */

    public function index() {
        View::renderTemplate('index.html');
    }  
}
?>