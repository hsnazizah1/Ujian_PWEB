<?php
// Koneksi ke database
include 'db.php';

// Memeriksa apakah ada keyword pencarian
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil data produk (dengan atau tanpa pencarian)
$sql = "SELECT * FROM products";
if ($keyword) {
    $sql .= " WHERE name LIKE '%$keyword%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makeup Store CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <img src="logo.png" alt="Makeup Store Logo" class="logo"> <!-- Tambahkan logo -->
        <div class="container">
            <h1>Makeup Store</h1>
            <p>Manage your beauty products with ease</p>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Manage Products</h2>
            <!-- Form Tambah Produk -->
            <form action="add_product.php" method="POST">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" name="price" placeholder="Price" required>
                <button type="submit">Add Product</button>
            </form>

            <!-- Daftar Produk -->
            <h2>Product List</h2>
            <!-- Search Bar -->
            <form action="index.php" method="GET" style="margin-top: 20px;">
                <input type="text" name="search" placeholder="Search Products..." value="<?php echo $keyword; ?>">
                <button type="submit">Search</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['price']}</td>
                                    <td>
                                        <form action='delete_product.php' method='POST' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit'>Delete</button>
                                        </form>
                                        <form action='edit_product.php' method='GET' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit'>Edit</button>
                                        </form>
                                    </td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Makeup Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
