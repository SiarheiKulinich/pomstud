<?php
function get_db() {
    static $db;
    if (!$db) {
        $config = include __DIR__ . '/config.php';
        $db = new PDO('sqlite:' . $config['db_path']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $db;
}

function migrate() {
    $db = get_db();
    $db->exec("CREATE TABLE IF NOT EXISTS customers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT,
        phone TEXT,
        created_at TEXT NOT NULL
    )");
}
