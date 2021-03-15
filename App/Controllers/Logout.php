<?php

namespace App\Controllers;


class Logout extends \Core\Controller {

    /**
     * @return void
     */

    public function index(): void {
        unset($_SESSION['username']);  
        unset($_SESSION['type']);
        session_destroy();
        header("Location:login");
        exit();
    }
}
