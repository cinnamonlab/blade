<?php

define('__APP__', __DIR__ . "/..");

include "../vendor/autoload.php";

$view = \Framework\Blade\View::make( "sample" );
echo $view->with('footer', 'WITH specified footer')
        ->with(array('title' => 'Sample Title'))
        ->get();