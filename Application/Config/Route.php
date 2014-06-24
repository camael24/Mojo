<?php

/* @var $framework \Sohoa\Framework\Framework */

// Defines the defaults route
$this->setRessource(\Sohoa\Framework\Router::REST_UPDATE, null, 'post');
$this->setRessource(\Sohoa\Framework\Router::REST_DESTROY, null, 'get', '/(?<%s>[^/]+)/delete');
$this->get('/', ['as' => 'root', 'to' => 'Main#index']);
$this->get('/logout', ['as' => 'logout', 'to' => 'Main#logout']);
$this->get('/user/(?<user_id>[^/]+)/activate', ['as' => 'activate', 'to' => 'User#activate']);
$this->get('/user/(?<user_id>[^/]+)/unactivate', ['as' => 'unactivate', 'to' => 'User#unactivate']);
$this->get('/user/(?<user_id>[^/]+)/delete', ['as' => 'delete', 'to' => 'User#delete']);
$this->resource('admin');
$this->resource('user'); // Prefix a route
$this->resource('group');
$this->resource('permission');

//$this->any('/(?<controller>[a-zA-Z_]\w*)/(?<action>[a-zA-Z_]\w*)/(?<value>.+)?');
