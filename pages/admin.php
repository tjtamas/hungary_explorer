<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

$username = $_SESSION['username'] ?? 'Admin';
$page = $_GET['page'] ?? 'registrations';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/modern.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/admin.css'); ?>">
</head>
<body class="admin-body">
    
    <!-- Top Bar -->
    <div class="admin-header">
        <div class="admin-header-left">
            <h1>🔐 Admin Panel</h1>
        </div>
        <div class="admin-header-right">
            <span>👤 <?php echo htmlspecialchars($username); ?></span>
            <a href="<?php echo url('config/logout.php'); ?>" class="btn-logout">🚪 Kilépés</a>
        </div>
    </div>

    <!-- Layout: Sidebar + Content -->
    <div class="admin-layout">
        
      <!-- Sidebar Menu -->
<aside class="admin-sidebar">
    <nav class="admin-menu">
        <a href="?page=registrations" class="menu-item <?php echo $page === 'registrations' ? 'active' : ''; ?>">
            📋 Jelentkezések / Tábor 2026
        </a>
    </nav>
</aside>

        <!-- Main Content -->
        <main class="admin-content">
            <?php
           if ($page === 'registrations') {
    include __DIR__ . '/../admin/registrations.php';
}
            ?>
        </main>

    </div>

</body>
</html>