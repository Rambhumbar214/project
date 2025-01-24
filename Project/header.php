<?php
session_start();
?>

<header>
    <nav>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
            <a href="admin.php">Admin Panel</a>
        <?php } ?>
    </nav>
</header>
