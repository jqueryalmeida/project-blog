<?php
/**
 * Contains the settings of the database
 * Edit what you need to work with your database
 * The index env, by default we assume TRUE is the dev mode, FALSE for prod
 */

$database['database']['dev'] = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'blog',
	'login' => 'root',
	'password' => 'root',
	'env' => TRUE,
);


define('DATABASE', $database);