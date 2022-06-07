<?php
/**
 * Application front end controller
 */
try {
    require_once '../bootstrap.php';
} catch (Exception $exception) {
    @mail(
        $_SERVER['SERVER_ADMIN'],
        'Uncaught excepption in file "' . $exception->getFile() . '" at line ' . $exception->getLine(),
        $exception->getMessage()
    );
}
