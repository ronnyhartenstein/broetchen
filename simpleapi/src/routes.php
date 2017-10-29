<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->group('/api', function () use ($app) {
    $app->post('/login', function (ServerRequestInterface $request, ResponseInterface $response) {
        $params = json_decode(file_get_contents('php://input'), true);
//        dump($params);
        if (empty($params['email_address']) || empty($params['password'])) {
            return $response->withJson(['error' => 'Email or Pwd empty'], 401);
        }
        $users = json_decode(file_get_contents(ROOT_DIR.'/db/users.json'), true);
        $myusers = array_filter($users, function($n) use ($params) {
            return $n['email'] == $params['email_address'] && $n['password'] == $params['password'];
        });
        if (count($myusers) == 1) {
            $myuser = $myusers[0];
            return $response->withJson(['sessionid' => md5($myuser['email'])]);
        } else {
            return $response->withJson(['error' => 'User not found'], 401);
        }
    });

    $app->get('/services', function (ServerRequestInterface $request, ResponseInterface $response) {
        $services = json_decode(file_get_contents(ROOT_DIR.'db/services.json'), true);
        return $response->withJson($services);
    });

    $app->get('/orders', function (ServerRequestInterface $request, ResponseInterface $response) {

    });

    $app->post('/orders', function (ServerRequestInterface $request, ResponseInterface $response) {
        $oders = json_decode(file_get_contents('php://input'), true);
    });
});