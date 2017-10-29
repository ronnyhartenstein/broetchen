<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\User;

$app->group('/api', function () use ($app) {
    $app->post('/login', function (ServerRequestInterface $request, ResponseInterface $response) {
        $params = json_decode(file_get_contents('php://input'), true);
//        dump($params);
        if (empty($params['email_address']) || empty($params['password'])) {
            return $response->withJson(['error' => 'Email or Pwd empty'], 400);
        }
        $user = new \App\User;
        $myuser = $user->isValid($params['email_address'], $params['password']);
        if ($myuser) {
            return $response->withJson(['sessionid' => md5($myuser['email'])]);
        } else {
            return $response->withJson(['error' => 'User not found'], 401);
        }
    });

    $app->get('/services', function (ServerRequestInterface $request, ResponseInterface $response) {
        $services = json_decode(file_get_contents(ROOT_DIR.'/db/services.json'), true);
        return $response->withJson($services);
    });

    $app->get('/orders/{sessionid}', function (ServerRequestInterface $request, ResponseInterface $response, $params) {
        if (empty($params['sessionid'])) {
            return $response->withJson(['error' => 'Session needed'], 400);
        }
        $user = new \App\User;
        $myuser = $user->getBySession($params['sessionid']);
        if (!$myuser) {
            return $response->withJson(['error' => 'User not found'], 401);
        }

        $json = ROOT_DIR.'/db/orders-'.$myuser['email'].'.json';
        if (!file_exists($json)) {
            return $response->withJson([]);
        }
        $orders = json_decode(file_get_contents($json), true);
        return $response->withJson($orders);

    });

    $app->post('/orders', function (ServerRequestInterface $request, ResponseInterface $response) {
        $params = json_decode(file_get_contents('php://input'), true);
        if (empty($params['sessionid'])) {
            return $response->withJson(['error' => 'Session needed'], 400);
        }
        if (empty($params['orders'])) {
            return $response->withJson(['error' => 'Orders needed'], 400);
        }
        $user = new \App\User;
        $myuser = $user->getBySession($params['sessionid']);
        if (!$myuser) {
            return $response->withJson(['error' => 'User not found'], 401);
        }
        $json = ROOT_DIR.'/db/orders-'.$myuser['email'].'.json';
        file_put_contents($json, json_encode($params['orders'], JSON_PRETTY_PRINT));
    });
});
