<?php

namespace App\Controllers;

use App\Models\Database;
use App\Helpers\View;

class DatabaseController
{
    public function createAction($username, $quote)
    {
        $db = new Database();
        
        if($db->create($username, $quote)) {
            View::redirect();
        }
    }

    public function readAction($quote)
    {
        $db = new Database();

        $db_quote = $db->read($quote);

        if(!empty($db_quote)) {
            echo View::getView('quotes/quote', $db_quote);
        } else {
            echo View::error403();
        }
    }

    public function updateAction($id, $username, $quote)
    {
        $db = new Database();
        
        if($db->update($id, $username, $quote)) {
            View::redirect();
        }
    }

    public function deleteAction($id)
    {
        $db = new Database();
        
        if($db->delete($id)) {
            View::redirect();
        }
    }
}