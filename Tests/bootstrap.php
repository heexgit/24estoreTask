<?php

// register class autoloader
require_once 'Libs'.DIRECTORY_SEPARATOR.'LibManager.php';
spl_autoload_register(array('\TwentyTwoEstore\Libs\LibManager', 'autoload'), true);

