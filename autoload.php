<?php
//Function to autoload classes
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Adjust the path based on your directory structure and naming convention
    $path = str_replace('.php', '.model.php', $path);
    
    $file = __DIR__ . '/' . $path;

    if (file_exists($file)) {
        require $file;
    }
    else{
        //If it's a .class.php file
        $path = str_replace('.model.php', '.class.php', $path);
        $file = __DIR__ . '/' . $path;
        if (file_exists($file)) {
            require $file;
        }
        else{
            //Throw a fatal error
            die("File '$file' containing class '$class' not found.");
        }
    }
});
