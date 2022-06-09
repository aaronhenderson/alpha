<?php

session_start();

/**
 * Error reporting switch
 */
switch ($_SERVER['REMOTE_ADDR']) {
    case '127.0.0.1':
        error_reporting(E_ALL);
        break;
    default:
        error_reporting(-1);
        break;
}


/**
 * Register autoloader with the SPL
 */
spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class_path = __DIR__ . DIRECTORY_SEPARATOR . 'src'. DIRECTORY_SEPARATOR . $class . '.php';

    if (file_exists($class_path) === false) {
        throw new Exception('Failed to autoload class "' . $class . '"', 500);
    }

    return require_once $class_path;
});


/**
 * Routing switch
 */
switch ($_SERVER['REQUEST_URI']){
    case '/home':
    case '/index.php':
        header('Location: /', true, 301);
        break;

    case '/':
        $template = new Template('pages/home.html');
        echo $template->get();
        break;

    default:
        try {
            $template = new Template('pages/' . $_SERVER['REQUEST_URI'] . '.html');
            echo $template->get();
        } catch (\Exception\NotFoundException $e) {
            header('Content-type: text/html', true, 404);
            $template = new Template('errors/404.html');
            echo $template->get();
        }
        break;
}

/*
 * Close any open mysqli connections
 */
\Mysqli\DB::close();