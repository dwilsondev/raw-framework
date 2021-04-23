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
    require_once "config.php";
    
    require_once "autoload.php";
    
    $go = new Kernel;

    $go->raw();