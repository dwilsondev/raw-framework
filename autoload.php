<?php

    /**
     *
     * autoloader function
     *
     * Loads all core classes from system/core dir.
     *
     * @param string $class Class name.
     *
     * @return void
     *
     */
    function autoloader($class)
    {
        require_once SYS_PATH."core/".$class.".php";
    }

    spl_autoload_register("autoloader");

    // Load 3rd party libraries.
    require_once SYS_PATH.'vendor/twig/vendor/autoload.php'; // Twig template engine
    require_once SYS_PATH.'vendor/plates/vendor/autoload.php'; // Plates template engine
    require_once SYS_PATH.'vendor/mustache/vendor/autoload.php'; // Mustache template engine
	