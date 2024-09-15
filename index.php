<?php
require_once 'config.php';
require_once 'products.php';

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'dashboard':
        $total_revenue = get_total_revenue();
        $active_products = get_active_products_count();
        $total_sales = get_total_sales();
        $active_users = get_active_users_count();
        
        include 'templates/dashboard.php';
        break;
    
    case 'products':
        $sort = $_GET['sort'] ?? 'name';
        $order = $_GET['order'] ?? 'ASC';
        $status = $_GET['status'] ?? null;
        $page = max(1, $_GET['page'] ?? 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $products = get_products($sort, $order, $status, $limit, $offset);
        $total_products = db_select_one("SELECT COUNT(*) as count FROM products")['count'];
        $total_pages = ceil($total_products / $limit);
        
        include 'templates/product_list.php';
        break;
    
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
