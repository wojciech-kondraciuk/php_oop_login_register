<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;

class About extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index($request, $response, $service) {

        $user = new User();
        $arr = $user->getAll();


        View::renderTemplate('Home/about.html', [
            'name'    => 'Dave',
            'colours' => $arr
        ]);
    }
}


