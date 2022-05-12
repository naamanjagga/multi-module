<?php

error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
// print_r( BASE_PATH); die;

require_once BASE_PATH .'/vendor/autoload.php';

$loader = new Loader();

$loader
    ->registerDirs([dirname(__DIR__) . '/app/library/'])
    ->register();

$container = new FactoryDefault();

$container->set(
    'router',
    function () {
        $router = new Router();

        $router->setDefaultModule('admin');

        $router->add(
            '/login',
            [
                'module'     => 'admin',
                'controller' => 'login',
                'action'     => 'index',
            ]
        );
        $router->add(
            '/public/validation',
            [
                'module'     => 'admin',
                'controller' => 'login',
                'action'     => 'validation',
            ]
        );
        $router->add(
            '/quickView',
            [
                'controller' => 'index',
                'action'     => 'quickView',
            ]
        );
        $router->add(
            '/productDetail',
            [
                'controller' => 'index',
                'action'     => 'productDetail',
            ]
        );

        $router->add(
            '/admin/products/:action',
            [
                'module'     => 'admin',
                'controller' => 'products',
                'action'     => 1,
            ]
        );

        $router->add(
            '/public/login',
            [
                'module'     => 'admin',
                'controller' => 'login',
                'action'     => 'index',
            ]
        );

        return $router;
    }
);



$application = new Application($container);
$application->registerModules([
    'frontend' => [
        'className' => 'Multiple\Frontend\Module',
        'path'      => BASE_PATH . '/app/frontend/Module.php'
    ],
    'admin'  => [
        'className' => 'Multiple\Admin\Module',
        'path'      => BASE_PATH . '/app/admin/Module.php'
    ]
]);
try {
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}

// $application->main();


// use Phalcon\Di\FactoryDefault;
// use Phalcon\Mvc\Application;
// use Phalcon\Mvc\Router;



// // Define some absolute path constants to aid in locating resources
// define('BASE_PATH', dirname(__DIR__));
// define('APP_PATH', BASE_PATH . '/app');

// require_once BASE_PATH . '/vendor/autoload.php';

// $container = new FactoryDefault();

// $container->set(
//     'router',
//     function () {
//         $router = new Router();

//         $router->setDefaultModule('front');

//         $router->add(
//             '/login',
//             [
//                 'module'     => 'back',
//                 'controller' => 'login',
//                 'action'     => 'index',
//             ]
//         );

//         $router->add(
//             '/admin/products/:action',
//             [
//                 'module'     => 'back',
//                 'controller' => 'products',
//                 'action'     => 1,
//             ]
//         );

//         $router->add(
//             '/products/:action',
//             [
//                 'controller' => 'products',
//                 'action'     => 1,
//             ]
//         );

//         return $router;
//     }
// );

// $application = new Application($container);

// $application->registerModules(
//     [
//         'front' => [
//             'className' => \Multi\Front\Module::class,
//             'path'      => '../apps/front/Module.php',
//         ],
//         'back'  => [
//             'className' => \Multi\Back\Module::class,
//             'path'      => '../apps/back/Module.php',
//         ]
//     ]
// );

// try {
//     $response = $application->handle(
//         $_SERVER["REQUEST_URI"]
//     );

//     $response->send();
// } catch (\Exception $e) {
//     echo $e->getMessage();
// }