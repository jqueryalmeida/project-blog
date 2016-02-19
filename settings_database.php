<?php

$database_settings = array(
	'type' => 'mysql',
	'host' => 'localhost',
	'login' => 'root',
	'password' => 'root',
	'database' => 'blog',
	'options' => array(),
	'env' => 'dev',
);

extract($database_settings);