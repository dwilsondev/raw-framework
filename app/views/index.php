<!doctype html>
<html>
    <head>
        <title>Raw Framework</title>

        <style>
            @import url('https://fonts.googleapis.com/css?family=Lato|Zilla+Slab');

            body {
                min-height: 100vh;
                margin: 0;
                font-family: 'Lato', sans-serif;
                font-size: calc(1.2em + 0.2vw);
                background: #212121;
                
            }

            h1 {
                font-family: 'Zilla Slab', sans-serif;
            }

            h3 {
                margin-top: 60px;
            }

            h3:first-child {
                margin-top: 0;
            }

            a {
                color: #ccc;
                text-decoration: none;
            }

            a:hover {
                color: whitesmoke;
            }

            li {
                line-height: 2;
            }

            code {
                background: #1d1d1d;
                padding: 3px;
            }

            header, footer {
                background: #b71c1c;
                color: #212121;
                padding: 1%;
                text-align: center;
            }

            header {
                padding: 2%;
            }

            main {
                color: #757575;
                min-height: 600px;
            }

            section {
                margin-bottom: 30px;
            }

            .container {
                width: 70%;
                margin: auto;
            }

            .ver {
                font-size: 18px;
            }
        </style>
    </head>

    <body>
		<header>
            <div class="container">
                <h1><?php echo $data['title']; ?> <span class="ver">2.0.0</span></h1>
            </div>
        </header>

        <main>
            <div class="container">
                <section>
                    <h2>Ready to go!</h2>
                    <p>This page was loaded successfully by the view controller.</p>
                </section>

                <section>
                    <h2>Getting Started</h2>
                    <ul>
                        <li>Change the behavior of this controller in app/controllers/view.php</li>
                        <li>Edit this page in app/views/index.php</li>
                        <li>The model for the view controller is in app/models/view_model.php</li>
                    </ul>
                </section>

                <section>
                    <h2>Loading Views</h2>

                    <p>Use <code>$this->view</code> to load PHP or HTML pages.</p>

                    <code>// In controllers/view.php, Load the homepage page with a title.</code><br>
                    <code>$this->view("homepage", array("title" => "My Awesome Website"));</code>
                </section>
                
                <section>
                    <h2>Access Data</h2>
                    <p>Access data using the data array in your views like this <code>echo $data['title'];</code></p>
                </section>

                <section>
                    <h2>Template Support</h2>
                    <p>Raw Framework supports Twig, Plates, and Mustache PHP template engines.</p>

                    <p>Use <code>$this->render</code> to load templates. By default, render searches for Twig files in app/views.</p>

                    <code>// In controllers/view.php, Load the about page using a template engine.</code><br>
                    <code>$this->render("about", array("title" => "About"));</code>

                    <p>You can change the default template system in system/config.php or on a per template bases by setting the <code>$engine</code> param like:</p>

                    <code>// Our default template engine is set to Twig, </code><br>
                    <code>// but we want to load the about page with Plates instead.</code><br>
                    <code>$this->render("about", array("title" => "About"), "plates");</code>
                    
                    <p>If you're using template systems, please refer to their docs to see how to access variables.</p>
                </section>

                <section>
                    <h3>Documentation</h3>
                    <p>Read the doc <a href="https://github.com/dwilsondev/raw-framework/" target="_blank" rel="noopener noreferrer">here</a>.</p>
                </section>
            </div>
        </main>

        <footer>
            <div class="container">
                <small>Raw Framework by <a href="https://github.com/dwilsondev/" target="_blank" rel="noopener noreferrer">DeAndre Wilson</a></small>
            </div>
        </footer>
    </body>
</html>