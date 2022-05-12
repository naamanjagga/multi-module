<?php

namespace Multiple\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Multiple\Admin\Component\Escapers;


class LoginController extends Controller
{
    public function indexAction()
    {
    }
    public function validationAction()
    {
        $escaper = new Escapers;
        $email = $escaper->escapeHtml($_POST['email']);
        $password = $escaper->escapeHtml($_POST['password']);
        $collection = $this->mongo->test->users;
        $find = $collection->find(["email" => $email]);
        foreach ($find as $f) {
            if ($f->password == $password) {
                $this->logger->info('Login successfully');
               return $this->response->redirect('index?module=admin');
            }
            $this->logger->error('Something went wrong'); 
            return  $this->response->redirect('login');
            die;
        }
    }
}
