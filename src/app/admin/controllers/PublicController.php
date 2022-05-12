<?php

namespace Multiple\Admin\Controllers;

use Phalcon\Mvc\Controller;

class PublicController extends Controller
{
    public function indexAction()
    {
        $collection = $this->mongo->test->products;
        $find = $collection->find();
        $this->view->find = $find;
    }
    public function productAction()
    {
    }
    public function addproductAction()
    {
        $db = $this->mongo->test;
        $collection = $db->products;
        $insertOneResult = $collection->insertOne([
            'name' => $_POST['name'],
            'category' => $_POST['category'],
            'price' => $_POST['price'],
            'stock' => $_POST['stock'],
            'meta_fields' => [$_POST['label'], $_POST['value']],
            'Variations' => [$_POST['v_name'], $_POST['v_value'],$_POST['v_price']],
        ]);
        $this->response->redirect('index?module=admin');
    }
    public function deleteProductAction()
    {
        $id = $_POST['delete'];
        $collection = $this->mongo->test->products;
        $find = $collection->deleteOne(array("_id" => new \MongoDB\BSON\ObjectID($id)));
        $this->response->redirect('index?module=admin');
    }
    public function updateProductAction()
    {
        $id = $_POST['update'];
        $collection = $this->mongo->test->products;
        $find = $collection->find(array("_id" => new \MongoDB\BSON\ObjectID($id)));
        $this->view->find = $find;
    }
    public function updateAction()
    {
        if (isset($_POST['updatebtn'])) {
            $id = $_POST['updatebtn'];
            $collection = $this->mongo->test->products;
            $update = $collection->updateOne(
                array("_id" => new \MongoDB\BSON\ObjectID($id)),
                ['$set' => [
                    'name'     => $_POST['name'],
                    'category' => $_POST['category'],
                    'price'     => $_POST['price'],
                    'stock'     => $_POST['stock'],
                    'meta_fields' => [$_POST['label'] => $_POST['value']],
                    'Variations' => [$_POST['v_name'] => $_POST['v_value']],
                ]]

            );
            $this->response->redirect('index?module=admin');
        }
        
    }
    public function quickViewAction()
    {
        $id = $_POST['view'];
        $collection = $this->mongo->test->products;
        $find = $collection->find(array("_id" => new \MongoDB\BSON\ObjectID($id)));
        $this->view->find = $find; 
    }
    
}