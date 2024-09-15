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
    // Placeholder: Return a static number for now
    return 100;
}

function add_sample_products() {
    $sample_products = [
        ['name' => 'Laptop Pro', 'status' => 'Active', 'price' => 1299.99, 'total_sales' => 50],
        ['name' => 'Smartphone X', 'status' => 'Active', 'price' => 799.99, 'total_sales' => 100],
        ['name' => 'Wireless Earbuds', 'status' => 'Active', 'price' => 129.99, 'total_sales' => 200],
        ['name' => 'Smart Watch', 'status' => 'Active', 'price' => 249.99, 'total_sales' => 75],
        ['name' => 'Gaming Console', 'status' => 'Draft', 'price' => 499.99, 'total_sales' => 0],
    ];

    foreach ($sample_products as $product) {
        create_product($product);
    }
}
