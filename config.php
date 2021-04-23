<?php
    
    /**
     *
     * This config file contains settings for Raw Framework. You may add any
     * additional config settings here. The data in this file should be accessible globally
     * in your project, but you may need to load this file manually.
     *
     */
    define("APP_PATH", "app/");

    define("SYS_PATH", "system/");

    define("CONTROLLER_PATH", "app/controllers/");

    define("MODEL_PATH", "app/models/");

    define("VIEW_PATH", "app/views/");

    define("DEFAULT_CONTROLLER", "view");

    define("ROOT_FOLDER", basename(dirname(__FILE__))."/");

    define("CONFIG", array(

        "template_engine" => "twig", // Default template engine.
        "ssl" => false, // Enable or disable SSL. Will effect the DOMAIN global constant.

    ));

    if(CONFIG['ssl'] == true) {
        define("DOMAIN", "https://".$_SERVER['HTTP_HOST']."/");
    } else {
        define("DOMAIN", "http://".$_SERVER['HTTP_HOST']."/");
    }