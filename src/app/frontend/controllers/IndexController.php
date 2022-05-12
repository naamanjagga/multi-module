<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $collection = $this->mongo->test->products;
        $find = $collection->find();
        $this->view->find = $find;
    }
    public function quickViewAction()
    {
        $id = $_POST['view'] ;
        $collection = $this->mongo->test->products;
        $find = $collection->find(array("_id" => new \MongoDB\BSON\ObjectID($id)));
        $this->view->find = $find; 
    }
    public function productDetailAction()
    {
        $id = $_POST['product'];
        $collection =  $this->mongo->test->products;
        $find = $collection->find(array("_id" => new \MongoDB\BSON\ObjectID($id)));
        $this->view->find = $find;
    
    }
}
