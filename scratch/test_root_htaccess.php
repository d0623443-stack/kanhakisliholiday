<?php
// Let's create root .htaccess
$rootHtaccess = "<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^$ public/ [L]
    RewriteRule (.*) public/$1 [L]
</IfModule>
";
file_put_contents('.htaccess', $rootHtaccess);

// Update public/.htaccess with the working rule
$pub = file_get_contents('public/.htaccess');
$pub = str_replace(
    'RewriteRule ^([\s\S]*)$ index.php/$1 [L,NC,QSA]',
    'RewriteRule ^ index.php [L]',
    $pub
);
file_put_contents('public/.htaccess', $pub);

$urls = [
    'http://localhost/kanhakisliholiday/',
    'http://localhost/kanhakisliholiday/admin',
    'http://localhost/kanhakisliholiday/admin/login',
    'http://localhost/kanhakisliholiday/safari',
    'http://localhost/kanhakisliholiday/public/admin/login',
    'http://localhost:8080/admin/login',
];

foreach ($urls as $u) {
    $ch = curl_init($u);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "$u => HTTP $code\n";
}
