<?php

//define('DS', DIRECTORY_SEPARATOR);
//define('EXT', '.php');
//define('URL', 'http://localhost/ghost/');
//define('ROOT', dirname(__DIR__) . DS . 'ghost');
//
//include ('src/old.php');
//include ('src/GhostEngine.php');
//
//$tmp = new Template("views/welcome.ghost.php", array("name" => 'bla'));
//echo $tmp->render();

require_once  'vendor/autoload.php';

$components = new Silver\Ghost\Core\ComponentsLoader;
$ghost = new \Silver\Ghost\Core\Template($components);

echo $ghost->render("template", array(
    "name" => "ahmed",
    "age" => array(
        "firstt" => 25
    )
));