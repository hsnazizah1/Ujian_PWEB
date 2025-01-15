<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <img src="logo.png" alt="Makeup Store Logo" class="logo"> <!-- Tambahkan logo -->
        <div class="container">
            <h1>Edit Product</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <form action="update_product.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="text" name="name" value="<?php echo $product['name']; ?>" placeholder="Product Name" required>
                <input type="number" name="price" value="<?php echo $product['price']; ?>" placeholder="Price" required>
                <button type="submit">Update Product</button>
            </form>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Makeup Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
