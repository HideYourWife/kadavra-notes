<?php
define('START', true);
require __DIR__.'/env.php';


App::init();
App::$kernel->launch();
