<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
    '/' => 'tarea#index',
    '/create' => 'tarea#create',
    '/show/:id' => 'tarea#show',
    '/update/:id' => 'tarea#update',
    '/delete/:id' => 'tarea#delete'
);
