<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <li><a href="<?php echo BASE_URL; ?>?page=products">Products</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <li>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></li>
                    <li><a href="<?php echo BASE_URL; ?>?page=logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
