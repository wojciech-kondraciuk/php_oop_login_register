<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Display;

class Home extends \Core\Controller {

    /**
     * @return void
     */

    public function index() {
        $show = new Display('links');
        $showLinks = $show->getAllData();

        View::renderTemplate('index.html', [
            'showLinks' => $showLinks
        ]);
    }
}
