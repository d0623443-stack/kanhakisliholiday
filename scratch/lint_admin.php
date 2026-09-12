<?php
$dirs = ['app/Controllers/Admin', 'app/Views/admin'];
$errors = 0;
foreach ($dirs as $dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $output = [];
            $res = 0;
            exec("c:\\xampp8.2\\php\\php.exe -l \"" . $file->getPathname() . "\"", $output, $res);
            if ($res !== 0) {
                echo "SYNTAX ERROR in " . $file->getPathname() . ":\n" . implode("\n", $output) . "\n";
                $errors++;
            } else {
                echo "OK: " . $file->getPathname() . "\n";
            }
        }
    }
}
if ($errors === 0) {
    echo "\nAll files passed PHP lint with 0 syntax errors!\n";
} else {
    echo "\nFound $errors syntax errors!\n";
}
