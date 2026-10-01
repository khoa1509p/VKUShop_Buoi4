<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

$productId = (int) ($_GET['id'] ?? 0);
if ($productId <= 0) {
    exit('ID sản phẩm không hợp lệ.');
}

// TODO 3:
// 1) prepare SELECT Product theo :id
// 2) execute()
// 3) fetch(PDO::FETCH_ASSOC)
// 4) Nếu không tìm thấy record thì dừng với thông báo phù hợp.

// Giá trị tạm để UI chạy trước khi hoàn thành TODO.
$name = '';
$price = '';
$stock = '';
$categoryId = 0;
$description = '';
$errors = [];

$categoryStmt = $pdo->query('SELECT id, name FROM categories ORDER BY name');
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    $categoryId = (int) ($_POST['category_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    // TODO 4: Áp dụng validation giống Create Product.

    if (count($errors) === 0) {
        // TODO 5: prepare() + execute() UPDATE Product WHERE id = :id.
        $errors['save'] = 'TODO: UPDATE Product bằng prepared statement.';
    }
}

$pageTitle = 'Sửa sản phẩm - VKUShop';
require __DIR__ . '/includes/header.php';
?>

<main class="main-container">
    <h1 class="page-heading">Sửa sản phẩm #<?= $productId ?></h1>
    <p class="page-subtitle">Hoàn thành SELECT một record, prefill form và UPDATE.</p>

    <section class="form-card">
        <div class="todo-box"><strong>TODO:</strong> SELECT Product bằng <code>prepare()</code> + <code>fetch()</code>, prefill dữ liệu; sau đó validation + UPDATE.</div>
        <?php if (isset($errors['save'])): ?><div class="alert alert-warning"><?= e($errors['save']) ?></div><?php endif; ?>

        <form method="POST" action="edit-product.php?id=<?= $productId ?>" novalidate>
            <div class="form-group"><label for="name">Tên sản phẩm *</label><input class="form-control" id="name" name="name" value="<?= e($name) ?>"></div>
            <div class="form-grid-2">
                <div class="form-group"><label for="price">Giá *</label><input class="form-control" id="price" name="price" value="<?= e($price) ?>"></div>
                <div class="form-group"><label for="stock">Tồn kho *</label><input class="form-control" id="stock" name="stock" type="number" min="0" value="<?= e($stock) ?>"></div>
            </div>
            <div class="form-group">
                <label for="category_id">Danh mục *</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="0">-- Chọn danh mục --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category['id'] ?>" <?= $categoryId === (int) $category['id'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group"><label for="description">Mô tả</label><textarea class="form-control" id="description" name="description"><?= e($description) ?></textarea></div>
            <div class="form-actions"><button class="btn" type="submit">Cập nhật</button><a class="btn btn-secondary" href="products.php">Hủy</a></div>
        </form>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
