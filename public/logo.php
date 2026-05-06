<?php
$file = __DIR__ . '/../logo.png';
if (file_exists($file)) {
    header('Content-Type: image/png');
    header('Cache-Control: public, max-age=31536000');
    readfile($file);
} else {
    http_response_code(404);
}
