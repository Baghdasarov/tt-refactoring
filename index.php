<?php

use TestRefactor\App;

require_once "vendor/autoload.php";

// Instantiate and initialize the application
$app = new App();
$app->init($argv[1] ?? null);

