<?php
require_once 'config.php';

function db_connect() {
    $databaseUrl = 'sqlite:' . __DIR__ . '/db.sqlite';
    $pdo = new PDO($databaseUrl);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tables if they don't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        status TEXT NOT NULL,
        price REAL NOT NULL,
        total_sales INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    return $pdo;
}

function db_query($query, $params = []) {
    $pdo = db_connect();
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt;
}

function db_select($query, $params = []) {
    $stmt = db_query($query, $params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function db_select_one($query, $params = []) {
    $stmt = db_query($query, $params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function db_insert($table, $data) {
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    db_query($query, array_values($data));
    return db_connect()->lastInsertId();
}

function db_update($table, $data, $where) {
    $set = implode(' = ?, ', array_keys($data)) . ' = ?';
    $query = "UPDATE $table SET $set WHERE $where";
    db_query($query, array_values($data));
}

function db_delete($table, $where) {
    $query = "DELETE FROM $table WHERE $where";
    db_query($query);
}
