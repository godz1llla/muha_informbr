<?php
/**
 * Конфигурация базы данных
 * Qyzylorda Times News Portal
 */

return [
    'host' => 'localhost',
    'database' => 'informnews',
    'username' => 'informnews_user',
    'password' => 'PASSWORD',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];