<?php
    
    require_once './libs/router.php';
    require_once './app/controllers/libros.api.controllers.php';
    require_once './app/controllers/user.api.controllers.php';
    require_once './app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());

    $router->addRoute('libros'      ,            'GET',     'librosApiController',   'getAll');
    $router->addRoute('libros/:id'  ,            'GET',     'librosApiController',   'get'   );
    $router->addRoute('libros/:Id'  ,            'DELETE',  'librosApiController',   'delete');
    $router->addRoute('libros'  ,                'POST',    'librosApiController',   'create');
    $router->addRoute('libros/:id'  ,            'PUT',     'librosApiController',   'update');

    $router->addRoute('user/token'    ,            'GET',     'UserApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);