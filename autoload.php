<?php
// Function to autoload classes
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Directory where your classes are located
    $baseDir = __DIR__ . '/';

    // Possible file extensions
    $extensions = ['.model.php', '.class.php', '.controller.php', '.middleware.php'];

    // Check each possible file path
    foreach ($extensions as $extension) {
        $filePath = $baseDir . str_replace('.php', $extension, $path);
        if (file_exists($filePath)) {
            require $filePath;
            return;
        }
    }

    $ds=DIRECTORY_SEPARATOR;
    // If no file was found, throw a fatal error
    die("File for class '$class' not found.");
});
