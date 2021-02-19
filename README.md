# Raw Framework 2
Raw Framework is a simple, easy to use PHP MVC framework with built-in support for Twig, Plates, and Mustache template engines.

## Requirements
Raw Framework requires at least PHP 7.0.0 or higher and works with PHP 8. 

**If you're going build sites using Twig, you need PHP 7.2.5 or higher.**

## Installation with Composer
Run the following Composer command in your command line.

`composer require dwilsondev/raw-framework:2.0.*`

## Installation from Zip
Download zip from GitHub. It will have everything set up for you already. All you have to do is adjust your .htaccess.

## Prep
### Prepare Project Folder
Assuming you used to composer command from inside your project folder, move everything out of 

`vendor/dwilsondev/raw-framework` to the root of your project folder. It's okay if your OS asks to overwrite some files. Not required if you downloaded the zip.

### Configure .htaccess
Configure the root .htaccess if you rename the folder. 

`RewriteBase /my-website`

If you're using virtual host, set RewriteBase to `/`

## Loading Views
Use `$this->view` to load PHP or HTML files.

EXAMPLE (app/controllers/view.php):

```php
// In controllers/view.php, Load the homepage page with a title.
$this->view("homepage", array("title" => "My Awesome Website"));
```

## Accessing Data
Access data using the data array in your views like this `echo $data['title'];`

EXAMPLE (app/views/index.php):

`<h1><?php echo $data['title']; ?></h1>`

## Loading a Model
As a construct property (PHP 7.4)
```php
class User extends Controller
    {

        private $user;

        public function __construct()
        {
            $this->user = $this->model("User_Model");
        }
```

In a method
```php
        public function store()
        {
            $products = $this->model("Product_Model");
            
            $products->listInStock();
        }
```

## Loading Views With An Template Engine
Raw Framework supports Twig, Plates, and Mustache PHP template engines.

Use `$this->render` to load templates. The render function can also be used to load PHP and HTML files essentially acting as a substitute for `$this->view`

EXAMPLE:

`$this->render("about", array("title" => "About"));`

You can specify which template engine to use on a per-template bases using the $engine peram.

EXAMPLE:

```php
// Our default template engine is set to Twig,`
// but we want to load the about page with Plates instead.`
$this->render("about", array("title" => "About"), "plates");
```

When creating templates, the file types supported include .php, .twig, .mustache, and .html. If you are creating HTML files, they must end in .html and NOT .htm

## Accessing Data With Template Variables
Please refer to the respective template engine's docs to learn more about accessing data in templates.

For [Twig](https://twig.symfony.com/doc/3.x/templates.html#variables)

For [Plates](https://platesphp.com/templates/data/)

For [Mustache](https://github.com/bobthecow/mustache.php)

## Configure Template Engine Options
Raw Framework uses template engines to simply load views and uses the most basic of engine options for each template engine.

BUT, you can modify the template engine options to your liking inside of of the main controller at `system/core/controller.php` and modifying the `render` function

An example of customizing the `render` function with additional Mustache template options inside of `system/core/controller.php`.
![mustache options](https://d17m6ut2neq5l8.cloudfront.net/public/for_github/full-mustache-options.jpg)

Again, please refer to template engine documentation for more details.

## Controller Methods
`view (string $view_name, array $data = [])`

Loads a PHP or HTML file from views folder.

* $view_name (String) filename in the views folder. If the file is named homepage.php, you would enter "homepage" without the file extension. For names inside of folders you can enter something like "pages/hompage".

* $data (Array) optional array with the data to be passed into the view.

`render (string $template, array $data = [], string $engine, string $dir)`


Load a PHP template, a PHP file or HTML file.

* $template (String) filename in the views folder. If the file is named homepage.twig, you would enter "homepage" without the file extension. For names inside of folders you can enter something like "pages/hompage".

* $data (Array) optional array with the data to be passed into the template.

* $engine (String) optional string specifying which template engine to use to render the template. You can set this to either `"twig"`, `"plates"`, or `"mustache"`, otherwise it will try to load a PHP or HTML file.

* $dir (String) optional directory specifying where to load the template from. By default, templates are loaded from the views folder. By setting $dir, you can load a template from anywhere in your project. For example, loading from a folder called templates in app/ `app/templates`

`model (string $model_name)`

Load and instantiate a model.
* $model_name (String) name of the model file. If the file is named store_model.php, you would enter "store_model".

## Model Methods
`db ()`

Connect to database using PDO. Available when extending the main model. Be sure to configure your database connection before using this method.
EXAMPLE
```php
Class Store extends Model {
    
    private function listInStock() {
        $connect = $this->db();

        $sql = "SELECT `product_name` FROM `products` WHERE `instock` = ?";
        $statement = $connect->prepare($sql);
        $statement->execute(array("true"));
        $results = $statement->fetchAll();
        
        if(empty($results)) {
            return false;
        }
        
        return $results;
    }
    
}
```

## Config File
Located inside of the app folder is config.php. It contains a global constant which has configuration options for your project. You can use this config file to store additional options for your project.

Please do not store database config data, API keys, or any data that could put your project at risk as the CONFIG constant is accessible throughout the entire project. Instead, store database config in its own file or in the main model. Store API keys in their respective config files, via environment variables, or outside your project entirely.

* template_engine - Specify the default template engine to load when using the `render` function. Can be set to `"twig"`, `"plates"`, or `"mustache"`.

* ssl - Set SSL. This only effects the DOMAIN constant.

## Global Constants
Global constants are accessible throughout the entire project, mostly to set paths to important folders.

`APP_PATH` (Default: "app/") - App folder contains the main MVC.

`SYS_PATH` (Default: "system/") - System folder contains core of the framework.

`CONTROLLER_PATH` (Default: "app/controllers/") - Controllers folder contains all the app controllers.

`MODEL_PATH` (Default: "app/models/") - Models folder contains all the app models.

`VIEW_PATH` (Default: "app/views/") - Views folder contains all the app views.

`DEFAULT_CONTROLLER` (Default: "view") - Sets the default controller.

`DOMAIN` - Web address of the site. Will automatically switch to HTTPS if SSL is set to `true` in config.php. Can be used for setting absolute paths in your project.

`ROOT_FOLDER` - Name of project folder.

## Version History

### 2.0.0 - Feb 18th, 2021
* Updated global constants
* Moved config.php to app/
* Removed app_folder and default_controller from config.php. (redundant since they are defined constants)
* Support for sub folders in app/controllers (one level deep).
* Support for Mustache templates.
* Dropped support for Dwoo template system. (Looks like it's been abandoned) 😯