<?php include 'includes/header.php'; ?>

<h1>Login</h1>

<?php if (isset($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action="?page=login" method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>

<?php include 'includes/footer.php'; ?>
