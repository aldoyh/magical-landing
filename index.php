<?php
session_start();
require_once 'config.php';
require_once 'products.php';
require_once 'users.php';

// Create users table and add sample users if not exists
create_users_table();
$user_count = db_select_one("SELECT COUNT(*) as count FROM users")['count'];
if ($user_count == 0) {
    add_sample_users();
}

// Check if there are any products in the database
$product_count = db_select_one("SELECT COUNT(*) as count FROM products")['count'];
if ($product_count == 0) {
    // If no products exist, add sample products
    add_sample_products();
}

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

// Authentication check
if (!isset($_SESSION['user']) && $page != 'login') {
    header('Location: ?page=login');
    exit();
}

switch ($page) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = verify_user($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: ?page=dashboard');
                exit();
            } else {
                $error = "Invalid username or password";
            }
        }
        include 'templates/login.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: ?page=login');
        exit();

    case 'dashboard':
        $total_revenue = get_total_revenue();
        $active_products = get_active_products_count();
        $total_sales = get_total_sales();
        $active_users = get_active_users_count();
        
        include 'templates/dashboard.php';
        break;
    
    case 'products':
        // Check if user has admin role
        if ($_SESSION['user']['role'] !== 'admin') {
            include 'templates/access_denied.php';
            break;
        }

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
