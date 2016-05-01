<?php
/**
 * Contains the settings of the database
 * Edit what you need to work with your database
 * The index env, by default we assume TRUE is the dev mode, FALSE for prod
 */

$database['database']['default'] = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'btsdev',
	'login' => 'bts-dev',
	'password' => 'BTS$10D3V',
	'env' => TRUE,
);

$database['database']['blog'] = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'blog',
	'login' => 'blog',
	'password' => 'merl9910A$',
	'env' => TRUE,
);

$database['database']['dev'] = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'blog',
	'login' => 'root',
	'password' => 'root',
	'env' => TRUE,
);


define('DATABASE', $database);