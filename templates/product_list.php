<?php include 'includes/header.php'; ?>

<h1>Products</h1>

<div class="filters">
    <form action="" method="GET">
        <input type="hidden" name="page" value="products">
        <select name="status">
            <option value="">All Status</option>
            <option value="Active" <?php echo $status == 'Active' ? 'selected' : ''; ?>>Active</option>
            <option value="Draft" <?php echo $status == 'Draft' ? 'selected' : ''; ?>>Draft</option>
            <option value="Archived" <?php echo $status == 'Archived' ? 'selected' : ''; ?>>Archived</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <a href="?page=products&action=create" class="add-product-btn">Add New Product</a>
</div>

<table>
    <thead>
        <tr>
            <th><a href="?page=products&sort=name&order=<?php echo $sort == 'name' && $order == 'ASC' ? 'DESC' : 'ASC'; ?>">Name <?php echo $sort == 'name' ? ($order == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
            <th>Status</th>
            <th><a href="?page=products&sort=price&order=<?php echo $sort == 'price' && $order == 'ASC' ? 'DESC' : 'ASC'; ?>">Price <?php echo $sort == 'price' ? ($order == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
            <th><a href="?page=products&sort=total_sales&order=<?php echo $sort == 'total_sales' && $order == 'ASC' ? 'DESC' : 'ASC'; ?>">Total Sales <?php echo $sort == 'total_sales' ? ($order == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
            <th><a href="?page=products&sort=created_at&order=<?php echo $sort == 'created_at' && $order == 'ASC' ? 'DESC' : 'ASC'; ?>">Created At <?php echo $sort == 'created_at' ? ($order == 'ASC' ? '▲' : '▼') : ''; ?></a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><span class="status-badge status-<?php echo strtolower($product['status']); ?>"><?php echo htmlspecialchars($product['status']); ?></span></td>
            <td>$<?php echo number_format($product['price'], 2); ?></td>
            <td><?php echo $product['total_sales']; ?></td>
            <td><?php echo date('Y-m-d H:i:s', strtotime($product['created_at'])); ?></td>
            <td>
                <a href="?page=products&action=edit&id=<?php echo $product['id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="?page=products&action=delete&id=<?php echo $product['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=products&page=<?php echo $i; ?>" <?php echo $page == $i ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<?php include 'includes/footer.php'; ?>
