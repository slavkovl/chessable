<?php

$router->get('chessable', 'BranchesController@index');
$router->post('chessable', 'BranchesController@store');

$router->get('chessable/users', 'UsersController@index');
$router->post('chessable/users', 'UsersController@store');

$router->get('chessable/transactions', 'TransactionsController@index');
$router->post('chessable/transactions', 'TransactionsController@store');

$router->get('chessable/reports', 'ReportsController@index');