<?php

namespace Multiple\Admin;

use Phalcon\Loader;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;
use Multiple\Admin\Component\Escapers;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(
        DiInterface $container = null
    )
    {
        $loader = new Loader();
        $loader->registerNamespaces(
            [
                'Multiple\Admin\Controllers' => BASE_PATH . '/app/admin/controllers/',
                'Multiple\Admin\Component' => APP_PATH . '/admin/components/',
            ]
        );

        $loader->register();
    }

    public function registerServices(DiInterface $container)
    {
        // Registering a dispatcher
        $container->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace(
                    'Multiple\Admin\Controllers'
                );

                return $dispatcher;
            }
        );

        $container->set(
            'view',
            function () {
                $view = new View();
                $view->setViewsDir(
                    BASE_PATH . '/app/admin/views/'
                );

                return $view;
            }
        );
        $container->set(
            'mongo',
            function () {
                $mongo =  new \MongoDB\Client("mongodb+srv://m001-student:m001-mongodb-basics@sandbox.j4aug.mongodb.net/myFirstDatabase?retryWrites=true&w=majority");
                return $mongo;
            }
        );
        $container->set('escaper', new Escapers);
       
        $container->set(
            'logger',
            function () {
                $adapter = new Stream(APP_PATH.'/admin/storage/logs/login.log');
                $logger  = new Logger(
                    'messages',
                    [
                        'login' => $adapter,
                    ]
                );
                return $logger;
            }
        );
    }
}
