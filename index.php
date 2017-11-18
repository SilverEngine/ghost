<?php



require_once  'vendor/autoload.php';

$components = new Silver\Ghost\Core\ComponentsLoader;
$ghost = new \Silver\Ghost\Core\Template($components);

echo $ghost->render("template", array(

    "info"=>array(
        "name"    => "lotfio",
        "age"     => 24,
        "country" => "algeria",
        "city"    => "algiers",
        "phone"   => "+21377021547658"
    ),

    "title"  => "Welcome to ghost",
    "INFO"   => "Developer Information"
));