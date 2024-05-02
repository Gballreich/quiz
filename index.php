<?php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');


// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route

$f3->route('GET /', function() {
    //echo '<h1>this is my quiz!</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');
});

//route for survey
$f3->route('GET|POST /survey', function($f3) {
    //echo '<h1>survey</
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //get arrays from post
        $name = $_POST['name'];
        $options = implode(", ", $_POST['options']);


        //save arrays in session
        $f3->set('SESSION.name', $name);
        $f3->set('SESSION.options', $options);

        //route to summary page
        $f3->reroute('summary');
        }

    // Render a view page
    $view = new Template();
    echo $view->render('views/survey.html');
});

//route for summary
$f3->route('GET|POST /summary', function() {
    //echo '<h1>survey</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/survey.html');
});




//Get the data from the model
//and add it to the F3 hive
$options = getOptions();
$f3->set('options', $options);

// Run Fat-Free
$f3->run();