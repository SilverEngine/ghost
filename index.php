<?php

define('DS', DIRECTORY_SEPARATOR);
define('EXT', '.php');
define('URL', 'http://localhost/ghost/');
define('ROOT', dirname(__DIR__) . DS . 'ghost');

include ('src/old.php');
include ('src/GhostEngine.php');

$tmp = new Template("views/welcome.ghost.php", array("name" => 'bla'));
echo $tmp->render();


