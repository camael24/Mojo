<?php

/* @var $framework \Sohoa\Framework\Framework */

// Defines the defaults route
$this->get('/', ['as' => 'root','to' => 'Main#index']);
$this->resource('admin');
$this->resource('user'); // Prefix a route

//$this->any('/(?<controller>[a-zA-Z_]\w*)/(?<action>[a-zA-Z_]\w*)/(?<value>.+)?');

$err = $this->getFramework()->getErrorHandler();

// The following line allow to transform every php errors as an exception \ErrorException
$err->handleErrorsAsException();

$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ALL_ERROR, 'Error#Default');
$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ERROR_404, 'Error#Err404');
