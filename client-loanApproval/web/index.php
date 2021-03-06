<?php
require_once '../vendor/autoload.php'; 

$app = new Silex\Application();
$app['debug'] = false;
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views/',
));

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;


/**
 * Redirection du / sur /loanApproval
 */
$app->get('/', function() use($app) {
    return $app->redirect('/loanApproval');
});
/**
 * Home page loanApproval
 */
$app->get('/loanApproval', function() use($app) {
    return $app['twig']->render('form.html.twig', array(
        'path_web' => __DIR__
    ));
});

/**
 * Load the page for the login
 */
$app->get('/loanApproval/login', function() use($app) {
    
    return $app['twig']->render('login.html.twig', array(
        'login' => "",
        'password' => "",
        'error' => ""
    ));   
});

/**
 * Method post to allow or refuse the connection
 */
$app->post('/loanApproval/login', function(Request $request) use($app) {
    if (empty($request->get('login')) || empty($request->get('password'))) {
        return $app['twig']->render('login.html.twig', array(
            'login' => $request->get('login'),
            'password' => $request->get('password'),
            'error' => 'Tous les champs doivent être remplis'
        ));
    }
    
    if ($request->get('login') == 'admin' || $request->get('password') == 'admin') {
        $app['session']->set('user', array(
            'user' => 'admin', 
            'password' => 'admin'
        ));
 
        return $app->redirect('/loanApproval/admin');
        
    } else {
        return $app['twig']->render('login.html.twig', array(
            'login' => $request->get('login'),
            'password' => $request->get('password'),
            'error' => 'Le mot de passe ou le login est incorrecte'
        ));
    } 
});

/**
 * Access to the admin page with all the actions for the accounts
 */
$app->get('/loanApproval/admin', function() use($app) {
    if ($app['session']->get('user')['user'] == 'admin' && $app['session']->get('user')['password'] == 'admin') {
        return $app['twig']->render('admin.html.twig',array());
    } else {
        $response = new Response();
        $response->setContent("Vous devez vous connecter pour accéder à cette partie du site");
        $response->setStatusCode(401, 'Please sign in.');
        return $response;
    }   
});

/**
 * Method to disconnect
 */
$app->get('loanApproval/disconnect', function() use($app) {
    $app['session']->set('user',array());
    return $app->redirect('/loanApproval');
});


$app->run(); 
