<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add(
    "/team",
    array(
        'controller' => 'team',
        'action'     => 'index'
    )
);

$router->add(
    "/team/submit",
    array(
        'controller' => 'team',
        'action'     => 'submit'
    )
);

$router->add(
    "/admin/login",
    array(
        'controller' => 'admin',
        'action'     => 'login'
    )
);

$router->add(
    "/admin",
    array(
        'controller' => 'admin',
        'action'     => 'index'
    )
);

return $router;