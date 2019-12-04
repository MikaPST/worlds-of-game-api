<?php

use Wog\Http\Request;
use Wog\Http\Response;
use Wog\Controller\Api\UserController;
use Wog\Controller\Api\LoginController;
use Wog\Model\UserModel;


$routes = json_decode(file_get_contents("../config/routes.json"));


require './../vendor/autoload.php';
try {
    $request = new Request;
    $response = new Response;

    if ("options" === $request->getMethod()) {
        $response->setStatus(200, "OK");
    } else {
        foreach (json_decode(file_get_contents("../config/routes.json")) as $routes) {
            if ($request->getUri() === $routes->path) {
                if ($request->getMethod() === $routes->method) {
                    $controllerName = $routes->controller;
                    $methodName = $routes->action;
                    $controller = new $controllerName($request, $response);
                    $response = $controller->$methodName();
                    throw new Exception();
                } else {
                    $response->setStatus(405, "Method Not Allowed");
                    $response->setJsonErr("Method: " . $request->getMethod() . " Not Allowed");
                }
            }

        }
        $response->setStatus(404, "Not Found");
        $response->setJsonErr("Uri: " . $request->getUri() . " Not Found");
    }

} catch (Exception $exception) {
} catch (Throwable $exception) {
    $response->setStatus(500, "Internal Server Error");
    $response->setJsonErr("Erreur :" . $exception->getMessage() . " dans le fichier :" . $exception->getFile() . " a la ligne" . $exception->getLine());
}


//$response->finalSend();