<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Display;
use App\Models\Add;
use App\Helpers\Validation;

class Panel extends \Core\Controller {

    /**
     * Panel controller
     *
     * @return void
     */
    public function addLink(): void {
        $val = new Validation();
        $data = [];

        $data['link'] = $val->test_input($_POST['link']);
        $data['name'] = $val->test_input($_POST['name']);
        

        if ($val->isSuccess()) {
            try {
                $newLink = new Add('links');
                $add = $newLink->AddData($data);

            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            } 
        }
    }

    public function logOut(): void{
        session_unset();
        session_destroy();
    }

    public function index(): void {

        $show = new Display('links');
        $showLinks = $show->getAllData();

        if (isset($_POST['submit'])) {
            $this->addLink();
            $showLinks = $show->getAllData();
        }

        View::renderTemplate('home/panel.html', [
            'showLinks' => $showLinks
        ]); 
    }
}