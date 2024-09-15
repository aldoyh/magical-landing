<?php
require_once 'db.php';

function get_products($sort = 'name', $order = 'ASC', $status = null, $limit = 10, $offset = 0) {
    $query = "SELECT * FROM products";
    $params = [];
    
    if ($status) {
        $query .= " WHERE status = ?";
        $params[] = $status;
    }
    
    $query .= " ORDER BY $sort $order LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    
    return db_select($query, $params);
}

function get_product($id) {
    return db_select_one("SELECT * FROM products WHERE id = ?", [$id]);
}

function create_product($data) {
    return db_insert('products', $data);
}

function update_product($id, $data) {
    db_update('products', $data, "id = $id");
}

function delete_product($id) {
    db_delete('products', "id = $id");
}

function get_total_revenue() {
    $result = db_select_one("SELECT SUM(price * total_sales) as total_revenue FROM products");
    return $result['total_revenue'] ?? 0;
}

function get_active_products_count() {
    $result = db_select_one("SELECT COUNT(*) as count FROM products WHERE status = 'Active'");
    return $result['count'] ?? 0;
}

function get_total_sales() {
    $result = db_select_one("SELECT SUM(total_sales) as total_sales FROM products");
    return $result['total_sales'] ?? 0;
}

function get_active_users_count() {
    // Assuming we have a users table
    $result = db_select_one("SELECT COUNT(*) as count FROM users WHERE status = 'Active'");
    return $result['count'] ?? 0;
}
