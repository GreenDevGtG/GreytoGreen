<?php

require 'app/config/app.php';
require 'env.php';
require ROOT_PATH . '/vendor/autoload.php';
require CTRL_PATH . '/default.php';

try {
    \Aston\Db\Connection::getPDO(DSN,USERNAME,PASSWORD);
} catch (PDOException $e){
    echo error('Error Server',404);
}

$api = new \GreenDev\Api();
$api->get('/','homeController');

// route

