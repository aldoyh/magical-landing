<?php include 'includes/header.php'; ?>

<h1>Dashboard</h1>

<div class="metrics">
    <div class="metric">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#66FCF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        <h2>Total Revenue</h2>
        <p>$<?php echo number_format($total_revenue, 2); ?></p>
    </div>
    <div class="metric">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#66FCF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
        <h2>Active Products</h2>
        <p><?php echo $active_products; ?></p>
    </div>
    <div class="metric">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#66FCF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
        <h2>Total Sales</h2>
        <p><?php echo $total_sales; ?></p>
    </div>
    <div class="metric">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#66FCF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        <h2>Active Users</h2>
        <p><?php echo $active_users; ?></p>
    </div>
</div>

<h2>Recent Products</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Price</th>
            <th>Total Sales</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $recent_products = get_products('created_at', 'DESC', null, 5);
        foreach ($recent_products as $product):
        ?>
        <tr>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['status']); ?></td>
            <td>$<?php echo number_format($product['price'], 2); ?></td>
            <td><?php echo $product['total_sales']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="?page=products" class="view-all-btn">View All Products</a>

<?php include 'includes/footer.php'; ?>
