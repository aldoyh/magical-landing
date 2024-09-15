<?php
// Database configuration
$db_host = getenv('PGHOST');
$db_port = getenv('PGPORT');
$db_name = getenv('PGDATABASE');
$db_user = getenv('PGUSER');
$db_password = getenv('PGPASSWORD');

// Other configuration settings
define('SITE_NAME', 'Product Dashboard');
define('BASE_URL', '/');
