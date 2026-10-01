<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

$sql = '
    SELECT
        p.id,
        p.name,
        p.price,
        p.stock,
        p.description,
        p.icon,
        c.name AS category_name
    FROM products p
    JOIN categories c
        ON c.id = p.category_id
    ORDER BY p.id DESC
';

$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Search + khoảng giá vẫn lọc trên PHP array như Buổi 3.
// Search bằng SQL + prepared statement sẽ được học ở Buổi 7.
$keyword = trim($_GET['keyword'] ?? '');
$minPriceInput = trim($_GET['min_price'] ?? '');
$maxPriceInput = trim($_GET['max_price'] ?? '');

$minPrice = $minPriceInput === '' ? null : (int) $minPriceInput;
$maxPrice = $maxPriceInput === '' ? null : (int) $maxPriceInput;

$filteredProducts = [];
foreach ($products as $product) {
    $matchesKeyword = $keyword === '' || stripos($product['name'], $keyword) !== false;
    $matchesMinPrice = $minPrice === null || $product['price'] >= $minPrice;
    $matchesMaxPrice = $maxPrice === null || $product['price'] <= $maxPrice;

    if ($matchesKeyword && $matchesMinPrice && $matchesMaxPrice) {
        $filteredProducts[] = $product;
    }
}

$pageTitle = 'Sản phẩm - VKUShop';
require __DIR__ . '/includes/header.php';
?>

<main class="main-container">
    <h1 class="page-heading">Quản lý sản phẩm</h1>
    <p class="page-subtitle">Danh sách đã chạy từ Buổi 3. Các nút Thêm / Sửa / Xóa dẫn đến phần TODO của Buổi 4.</p>

    <?php if (($_GET['created'] ?? '') === '1'): ?>
        <div class="alert alert-success">✓ Đã thêm sản phẩm.</div>
    <?php elseif (($_GET['updated'] ?? '') === '1'): ?>
        <div class="alert alert-success">✓ Đã cập nhật sản phẩm.</div>
    <?php elseif (($_GET['deleted'] ?? '') === '1'): ?>
        <div class="alert alert-success">✓ Đã xóa sản phẩm.</div>
    <?php endif; ?>

    <div class="page-actions">
        <a class="btn" href="create-product.php">+ Thêm sản phẩm</a>
        <a class="btn btn-secondary" href="categories.php">Quản lý danh mục</a>
    </div>

    <section class="search-box">
        <form class="search-form" method="GET" action="products.php">
            <input class="form-control" type="text" name="keyword" placeholder="Tìm sản phẩm..." value="<?= e($keyword) ?>">
            <input class="form-control" type="number" min="0" name="min_price" placeholder="Giá từ" value="<?= e($minPriceInput) ?>">
            <input class="form-control" type="number" min="0" name="max_price" placeholder="Giá đến" value="<?= e($maxPriceInput) ?>">
            <button class="btn" type="submit">Lọc sản phẩm</button>
        </form>
        <p class="search-note">Buổi 4 tập trung CRUD. Search vẫn dùng kiến thức cũ và lọc sau fetchAll().</p>
    </section>

    <?php if (count($filteredProducts) === 0): ?>
        <div class="empty-state">Không tìm thấy sản phẩm phù hợp.</div>
    <?php else: ?>
        <section class="product-grid">
            <?php foreach ($filteredProducts as $product): ?>
                <article class="product-card">
                    <div class="product-thumb"><?= e($product['icon']) ?></div>
                    <div class="product-body">
                        <h2 class="product-name"><?= e($product['name']) ?></h2>
                        <p class="product-category"><?= e($product['category_name']) ?></p>
                        <p class="product-price"><?= number_format((float) $product['price'], 0, ',', '.') ?> đ</p>
                        <div class="product-meta">
                            <?php if ($product['stock'] > 0): ?>
                                <span class="badge badge-in-stock">Còn hàng: <?= (int) $product['stock'] ?></span>
                            <?php else: ?>
                                <span class="badge badge-out-stock">Hết hàng</span>
                            <?php endif; ?>
                            <?php if ($product['price'] >= 300000): ?>
                                <span class="badge badge-premium">Cao cấp</span>
                            <?php endif; ?>
                        </div>

                        <div class="card-actions">
                            <a class="btn btn-secondary btn-small" href="edit-product.php?id=<?= (int) $product['id'] ?>">Sửa</a>
                            <form class="inline-form" method="POST" action="delete-product.php">
                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                <button class="btn btn-danger btn-small" type="submit">Xóa</button>
                            </form>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
