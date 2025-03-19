<?php
include 'includes/header.php';
require_once 'includes/config.php';

$item = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$item->execute([$_GET['id']]);
$item = $item->fetch();

if (!$item) {
    header("Location: index.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-6">
        <?php if ($item['image_path']): ?>
        <img src="<?= $item['image_path'] ?>" class="img-fluid" alt="<?= $item['title'] ?>">
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <h2><?= $item['title'] ?></h2>
        <p><strong>Type:</strong> <?= ucfirst($item['type']) ?></p>
        <p><strong>Category:</strong> <?= $item['category'] ?></p>
        <p><strong>Location:</strong> <?= $item['location'] ?></p>
        <p><strong>Date:</strong> <?= date('F j, Y', strtotime($item['date_lost_found'])) ?></p>
        <p><strong>Description:</strong></p>
        <p><?= nl2br($item['description']) ?></p>
        <div class="alert alert-info">
            Contact: <a href="mailto:<?= $item['contact_email'] ?>"><?= $item['contact_email'] ?></a>
        </div>
    </div>
</div>

<!-- <?php include 'includes/footer.php'; ?> -->