<?php
require_once 'db.php';

function create_users_table() {
    $query = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        role TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    db_query($query);
}

function create_user($username, $password, $role) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    return db_insert('users', [
        'username' => $username,
        'password' => $hashed_password,
        'role' => $role
    ]);
}

function get_user_by_username($username) {
    return db_select_one("SELECT * FROM users WHERE username = ?", [$username]);
}

function verify_user($username, $password) {
    $user = get_user_by_username($username);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function add_sample_users() {
    $sample_users = [
        ['username' => 'admin', 'password' => 'admin123', 'role' => 'admin'],
        ['username' => 'user', 'password' => 'user123', 'role' => 'user']
    ];

    foreach ($sample_users as $user) {
        create_user($user['username'], $user['password'], $user['role']);
    }
}
