<?php

    /**
     *
     * controller is the main controller class. It provides methods for accessing
     * views, models, and templates.
     *
     */
    class Controller
    {

        /**
         * View function
         *
         * Load php and html files from the app/views folder.
         *
         * @param string $view_name The path to the html or php file.
         *
         * @param array $data Data array the page has access to.
         *
         * @return void
         */
        public function view($view_name, $data = [])
        {
            $view_name = filter_var($view_name, FILTER_SANITIZE_STRING);
            
            if (file_exists(VIEW_PATH.strtolower($view_name).".php")) {
                include VIEW_PATH.strtolower($view_name).".php";
            } elseif (file_exists(VIEW_PATH.strtolower($view_name).".html")) {
                include VIEW_PATH.strtolower($view_name).".html";
            } else {
                echo 'The view "'.$view_name.'" could not be found in '.'/app/views/';
            }
        }
        
        /**
         * Render function.
         *
         * This function works much like the view function,
         * but has added params for loading templates engines.
         *
         * By default it renders templates using the template engine specified
         * in system/config.php. This can be overridden by setting the engine param.
         * For example, if the default template engine is set to "twig", but
         * you want to load a template using "php" or "plates". Render function
         * can be used as an alternative to the view function when loading PHP and HTML.
         *
         * @param string $template Path to the template file.
         *
         * @param array $data Data array the template has access to.
         *
         * @param string $engine Overrides template engine setting in system/config.php.
         * Should be set to either "php", "html", "twig", "plates", or "mustache".
         *
         * @param string $dir tells template engine where the template
         * dir files are stored. This is set to the app/views folder by default.
         *
         * @return void
         */
        public function render($template, $data = [], $engine = "", $dir = "")
        {
            //include "system/config.php";
            
            // If no working dir is specified, set it to the views folder.
            if (empty($dir)) {
                $dir = VIEW_PATH;
            }
            
            // If template engine hasn't been set, set engine to the default
            // found in config.php.
            if (empty($engine)) {
                $template_engine = CONFIG["template_engine"];
            } else {
                $template_engine = $engine;
            }

            // Render views using a template engine, html, or good ol PHP.
            if ($template_engine == "twig") {
                
                // Render template using Twig.
                $loader = new \Twig\Loader\FilesystemLoader($dir);
                $twig = new \Twig\Environment($loader);
                
                echo $twig->render($template.".twig", $data);
            } elseif ($template_engine == "plates") {
                
                // Render template using Plates.
                $templates = new League\Plates\Engine($dir);
                echo $templates->render($template, $data);
            } elseif ($template_engine == "mustache") {

                // Render template using Mustache.
                $mustache = new Mustache_Engine(array(
                    'loader' => new Mustache_Loader_FilesystemLoader($dir)
                ));

                $tpl = $mustache->loadTemplate($template.".mustache"); // loads __DIR__.'/views/foo.mustache';
                echo $tpl->render($data);
            } else {

                // Render template using PHP or HTML
                $this->view($template, $data);
            }
        }

        /**
         * Model function
         *
         * Loads models and instantiates model class.
         *
         * @param string $model_name The path to the file located in app/models.
         *
         * @return void
         */
        public function model($model_name)
        {
            include MODEL_PATH.strtolower($model_name).".php";

            return new $model_name();
        }
    }
