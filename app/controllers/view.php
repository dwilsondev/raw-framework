<?php

    /**
     *
     * By default, this controller handles all page requests. In addition, the
     * corresponding view model is loaded.
     *
     */
    class View extends Controller
    {
        private $view;
        
        /**
         * Construct function
         *
         * This function loads the corresponding model for the view controller.
         */
        public function __construct()
        {
            $this->view = $this->model("View_Model");
        }
        
        /**
         * Index function
         *
         * This is an example index function to shows how to create a data array
         * and load a page passing in that data.
         * @return void
         */
        public function index()
        {
            $data["title"] = "Raw Framework"; // Optional data array that's passed into view.

            $this->view("index", $data); // Load a page called index.php from app/views.
        }
    }
