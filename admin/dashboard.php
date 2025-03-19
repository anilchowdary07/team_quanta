<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once __DIR__ . '/../includes/config.php';

// Verify database connection
if (!$pdo) {
    die("Database connection failed");
}

// Header with corrected paths
include __DIR__ . '/../includes/header.php';

// Handle status updates
if (isset($_POST['status'])) {
    $stmt = $pdo->prepare("UPDATE items SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['status'], $_POST['id']]);
}

// Fetch items
$items = $pdo->query("SELECT * FROM items ORDER BY created_at DESC");
if (!$items) {
    die("Error fetching items: " . implode(" ", $pdo->errorInfo()));
}
?>

<h2 class="mb-4">Admin Dashboard</h2>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <!-- Table content remains the same -->
    </table>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>