<?php
session_start();
require_once('./Connection.php');

// Get selected category
$selected_category = isset($_POST['category']) ? $_POST['category'] : (isset($_GET['category']) ? $_GET['category'] : null);

// Fetch all categories
$categories = [];
$cat_query = "SELECT * FROM categorie";
$cat_result = mysqli_query($conn, $cat_query);
while ($row = mysqli_fetch_assoc($cat_result)) {
    $categories[] = $row;
}

// Fetch products for selected category
$products = [];
if ($selected_category) {
    $prod_query = "SELECT * FROM produit 
                  WHERE RefCategorie = (
                      SELECT RefCat FROM categorie 
                      WHERE Nom = ? LIMIT 1
                  )";
    $stmt = mysqli_prepare($conn, $prod_query);
    mysqli_stmt_bind_param($stmt, "s", $selected_category);
    mysqli_stmt_execute($stmt);
    $prod_result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($prod_result)) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories - Your Store</title>
    <link rel="stylesheet" href="../../css/normalized.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="./css/kolchi.css">
    <style>
        /* Base Styles */
:root {
  --primary-color: #2d3436;
  --accent-color: #00b894;
  --light-bg: #f8f9fa;
  --text-color: #636e72;
  --transition: all 0.3s ease;
}

body {
  font-family: 'Roboto', sans-serif;
  color: var(--primary-color);
  background-color: var(--light-bg);
  line-height: 1.6;
}

/* Categories Page Structure */
.categories-page {
  max-width: 1280px;
  margin: 2rem auto;
  padding: 0 1.5rem;
}

.page-header {
  text-align: center;
  margin-bottom: 4rem;
  padding: 3rem 0;
  background: linear-gradient(135deg, #f6fbfd 0%, #eaf6f8 100%);
  border-radius: 1rem;
}

.page-header h1 {
  font-size: 2.5rem;
  color: var(--primary-color);
  margin-bottom: 1rem;
  font-weight: 700;
}

/* Categories Grid */
.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
  margin: 3rem 0;
}

.category-card {
  background: #fff;
  border-radius: 1rem;
  overflow: hidden;
  transition: var(--transition);
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
  position: relative;
  padding: 10px 20px;
}

.category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.category-card button {
  width: 100%;
  padding: 0;
  border: none;
  background: none;
  cursor: pointer;
  text-align: left;
}

.category-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-bottom: 3px solid var(--accent-color);
}

.category-info {
  padding: 1.5rem;
}

.category-name {
  font-size: 1.3rem;
  color: var(--primary-color);
  margin: 0;
  font-weight: 600;
}

/* Products Grid */
.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
  margin: 4rem 0;
}

.product-card {
  background: #fff;
  border-radius: 1rem;
  overflow: hidden;
  transition: var(--transition);
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.product-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.product-image {
  width: 100%;
  height: 250px;
  object-fit: cover;
  border-bottom: 2px solid #eee;
}

.product-info {
  padding: 1.5rem;
}

.product-title {
  font-size: 1.1rem;
  margin: 0 0 0.5rem;
  color: var(--primary-color);
}

.product-price {
  font-size: 1.2rem;
  color: var(--accent-color);
  font-weight: 700;
  margin: 0.5rem 0;
}

/* Buttons */
.btn {
  display: inline-block;
  padding: 0.8rem 1.5rem;
  background: var(--accent-color);
  color: #fff;
  border-radius: 0.7rem;
  text-decoration: none;
  font-weight: 500;
  transition: var(--transition);
  margin-top: 1rem;
}

.btn:hover {
  background: #009d7a;
  transform: translateY(-2px);
}

/* Empty States */
.no-products {
  text-align: center;
  padding: 4rem;
  font-size: 1.2rem;
  color: var(--text-color);
  border: 2px dashed #eee;
  border-radius: 1rem;
  margin: 3rem 0;
}

/* Responsive Design */
@media (max-width: 768px) {
  .categories-page {
    padding: 0 1rem;
  }
  
  .page-header h1 {
    font-size: 2rem;
  }
  
  .categories-grid,
  .products-grid {
    grid-template-columns: 1fr;
  }
  
  .category-image {
    height: 180px;
  }
  
  .product-image {
    height: 200px;
  }
}

@media (max-width: 480px) {
  .page-header {
    padding: 2rem 0;
  }
  
  .product-info {
    padding: 1rem;
  }
  
  .btn {
    width: 100%;
    text-align: center;
  }
}

/* Active Category Highlight */
[aria-current="page"] .category-card {
  border: 2px solid var(--accent-color);
  box-shadow: 0 0 0 3px rgba(0,184,148,0.2);
}

/* Loading Animation */
@keyframes shimmer {
  0% { background-position: -1000px 0 }
  100% { background-position: 1000px 0 }
}

.loading-card {
  animation: shimmer 2s infinite linear;
  background: linear-gradient(to right, #f6f7f8 8%, #edeef1 18%, #f6f7f8 33%);
  background-size: 1000px 104px;
}
    </style>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="./index.php"><img src="./imgs/KOlش.svg" alt="logo" class="logo-img"></a>
        </div>
    </div>
</header>

<div class="categories-page">
    <div class="page-header">
        <h1>Shop by Category</h1>
        <p>Explore our wide range of products</p>
    </div>

    <div class="categories-grid">
        <?php foreach ($categories as $category): ?>
            <form method="POST" action="./categorys.php" class="category-card">
                <button type="submit" name="category" value="<?= htmlspecialchars($category['Nom']) ?>">
                    <?php if(!empty($category['ImageURL'])): ?>
                        <img src="<?= htmlspecialchars($category['ImageURL']) ?>" alt="<?= htmlspecialchars($category['Nom']) ?>">
                    <?php else: ?>
                        <div class="placeholder-image"></div>
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($category['Nom']) ?></h3>
                </button>
            </form>
        <?php endforeach; ?>
    </div>

    <?php if ($selected_category): ?>
        <h2 class="selected-category-header">Products in <?= htmlspecialchars($selected_category) ?></h2>
        
        <?php if (!empty($products)): ?>
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?= htmlspecialchars($product['ImageURL']) ?>" alt="<?= htmlspecialchars($product['Designation']) ?>" class="product-image">
                        <div class="product-info">
                            <h3><?= htmlspecialchars($product['Designation']) ?></h3>
                            <p>Price: <?= number_format($product['PrixUnitaire'], 2) ?> MAD</p>
                            <a href="./product.php?id=<?= $product['Reference'] ?>" class="btn">View Product</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-products">No products found in this category</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="imgs/logo.svg" alt="logo" class="logo-img">
                </div>
                <div class="footer-links">
                    <ul>
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./about.php">About</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-socials">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 KolXi. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>