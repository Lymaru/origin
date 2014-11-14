<?php
header('Content-type: text/html; Charset=utf-8');
require './core/Autoloader.php';
require './core/Application.php';

$config = './protected/config/config.php';

Application::create($config)->start();
?>