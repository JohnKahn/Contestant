<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add(
    "/login",
    array(
        'controller' => 'team',
        'action'     => 'login'
    )
);

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

return $router;