<?php
include 'includes/header.php';
require_once 'includes/config.php';

$type = basename($_SERVER['PHP_SELF'], '.php');
$items = $pdo->prepare("SELECT * FROM items WHERE type = ? ORDER BY created_at DESC");
$items->execute([$type]);
?>

<h2 class="mb-4"><?= ucfirst($type) ?> Items</h2>

<div class="row">
    <?php while ($item = $items->fetch()): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <?php if ($item['image_path']): ?>
            <img src="<?= $item['image_path'] ?>" class="card-img-top" alt="<?= $item['title'] ?>">
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?= $item['title'] ?></h5>
                <p class="card-text"><?= substr($item['description'], 0, 100) ?>...</p>
                <a href="item-details.php?id=<?= $item['id'] ?>" class="btn btn-primary">View Details</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>