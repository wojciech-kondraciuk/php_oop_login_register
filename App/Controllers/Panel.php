<?php

namespace App\Controllers;

use \Core\View;
use \Core\Router;
use App\Models\Display;
use App\Models\Add;
use App\Models\Delete;
use App\Models\Update;
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
        $data['tag'] = $val->test_input($_POST['tag']);
        

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
        $val = new Validation();
        $data = [];
        $show = new Display('links');
        $showLinks = $show->getAllData();

        //add
        if (isset($_POST['add'])) {
            $this->addLink();
            header("Location:panel");
            exit;
        }
        //delete
        if (isset($_GET['delete'])) {
            $del = new Delete('links');
            $del->deleteById($_GET['delete']);
            header("Location:panel");
            exit;
        }
        //edit
        if (isset($_GET['edit'])) {
            $row = new Display('links');
            $update = $row->getRecordByID($_GET['edit']);

            View::renderTemplate('components/modal.html', [
                'header' => 'Edit item',
                'items' => $update,
                'action' => 'edit'
            ]); 
        }

        if (isset($_POST['edit'])) {
            $data['link'] = $val->test_input($_POST['link']);
            $data['name'] = $val->test_input($_POST['name']);
            $data['tag'] = $val->test_input($_POST['tag']);

            if ($val->isSuccess()) {
                try {
                    $up = new Update($data, 'links');
                    $up->editData($_GET['edit']);
                    header("Location:panel");
                    exit;
                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                } 
            }
        }

        if (isset($_GET['add'])) {
            View::renderTemplate('components/modal.html', [
                'header' => 'Add new item',
                'action' => 'add'
            ]); 
        }
        
        View::renderTemplate('home/panel.html', [
            'showLinks' => $showLinks
        ]); 
    }
}