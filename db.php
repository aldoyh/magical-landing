<?php
require_once 'config.php';

function db_connect() {
    global $db_host, $db_port, $db_name, $db_user, $db_password;
    
    $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_password";
    
    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
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
