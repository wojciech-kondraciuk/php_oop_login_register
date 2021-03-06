<?php

namespace App\Controllers;

use \Core\View;


class Panel extends \Core\Controller {

    /**
     * Panel controller
     *
     * @return void
     */
    public function index() {

        View::renderTemplate('home/panel.html'); 
    }

    public function logOut() {
        session_unset();
        session_destroy();
    }
}