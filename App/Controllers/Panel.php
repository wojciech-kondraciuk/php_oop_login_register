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

        if ($val->name('link')->value($_POST['link'])->required()) {
            $data['link'] = $val->test_input($_POST['link']);
        }

        if ($val->name('name')->value($_POST['name'])->required()) {
            $data['name'] = $val->test_input($_POST['name']);
        }

        if ($val->name('tag')->value($_POST['tag'])->required()) {
            $data['tag'] = $val->test_input($_POST['tag']);
        }

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
        $send = false;

        if (isset($_POST['submit'])) {
            $this->addLink();
            $showLinks = $show->getAllData();
            $send = true;
        } else {
            $send = false;
        }

        View::renderTemplate('home/panel.html', [
            'showLinks' => $showLinks,
            'send' => $send
        ]); 
    }
}