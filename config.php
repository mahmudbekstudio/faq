<?php
if ( !defined('PATHROOT') )
	define('PATHROOT', dirname(__FILE__) . '/');

define('BASEPATH', '');

define('DEFAULTMODULE', 'fontend');
define('DEFAULTCONTROLLER', 'default');
define('DEFAULTACTION', 'index');

define('DEFAULTTHEME', 'default');

define('PATHLIB', PATHROOT . 'lib/');
define('PATHMOD', PATHROOT . 'modules/');

define('DEBUG', false);

define('DBTABLEPREFIX', 'table_');
define('DBNAME', 'db');
define('DBUSER', 'root');
define('DBPASSWORD', '');
define('DBHOST', 'localhost');
define('DBCHARSET', 'utf8');
define('DBCOLLATE', '');