<?php
include 'includes/header.php';
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $stmt = $pdo->prepare("INSERT INTO items (type, title, description, category, location, date_lost_found, contact_email, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Handle file upload
    $imagePath = null;
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/images/';
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        $imagePath = $uploadDir . $imageName;
    }

    $stmt->execute([
        $_POST['type'],
        $_POST['title'],
        $_POST['description'],
        $_POST['category'],
        $_POST['location'],
        $_POST['date'],
        $_POST['email'],
        $imagePath
    ]);
    
    echo '<div class="alert alert-success">Item submitted successfully!</div>';
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4">Report Lost or Found Item</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Type</label>
                <select class="form-select" name="type" required>
                    <option value="lost">Lost Item</option>
                    <option value="found">Found Item</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea class="form-control" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category" required>
                    <?php 
                    $categories = $pdo->query("SELECT * FROM categories");
                    foreach ($categories as $cat) {
                        echo "<option value='{$cat['name']}'>{$cat['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Location</label>
                <input type="text" class="form-control" name="location" required>
            </div>
            <div class="mb-3">
                <label>Date</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="mb-3">
                <label>Contact Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label>Upload Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit Report</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>