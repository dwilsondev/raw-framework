<?php

    /**
     * 
     * @author DeAndre Wilson <hmu@drewilson.dev>
     * 
     * @link https://github.com/dwilsondev
     * 
     * @version 2.0.1
     * 
     * This file loads a new instance of Raw Framework. Config data is loaded
     * to set folder paths.
     * 
     */
    require_once "app/config.php";
    
    require_once "system/core/autoload.php";

    define("APP_PATH", "app/");

    define("SYS_PATH", "system/");

    define("CONTROLLER_PATH", "app/controllers/");

    define("MODEL_PATH", "app/models/");

    define("VIEW_PATH", "app/views/");

    define("DEFAULT_CONTROLLER", "view");

    if(CONFIG['ssl'] == true) {
        define("DOMAIN", "https://".$_SERVER['HTTP_HOST']."/");
    } else {
        define("DOMAIN", "http://".$_SERVER['HTTP_HOST']."/");
    }

    define("ROOT_FOLDER", basename(dirname(__FILE__))."/");
    
    $go = new Kernel;

    $go->raw();