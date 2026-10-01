<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

// TODO 2: Sau khi hoàn thành INSERT, thay mảng tạm này bằng SELECT từ bảng categories.
$categories = [
    ['id' => 1, 'name' => 'Áo'],
    ['id' => 2, 'name' => 'Phụ kiện'],
    ['id' => 3, 'name' => 'Quà tặng'],
];

$name = '';
$price = '';
$stock = '';
$categoryId = 0;
$description = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    $categoryId = (int) ($_POST['category_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    if ($name === '') {
        $errors['name'] = 'Vui lòng nhập tên sản phẩm.';
    }

    if ($price === '') {
        $errors['price'] = 'Vui lòng nhập giá.';
    } elseif (!is_numeric($price)) {
        $errors['price'] = 'Giá phải là số.';
    } elseif ((float) $price <= 0) {
        $errors['price'] = 'Giá phải lớn hơn 0.';
    }

    if ($stock === '') {
        $errors['stock'] = 'Vui lòng nhập tồn kho.';
    } elseif (filter_var($stock, FILTER_VALIDATE_INT) === false || (int) $stock < 0) {
        $errors['stock'] = 'Tồn kho phải là số nguyên từ 0 trở lên.';
    }

    $allowedCategoryIds = [];
    foreach ($categories as $category) {
        $allowedCategoryIds[] = (int) $category['id'];
    }
    if (!in_array($categoryId, $allowedCategoryIds, true)) {
        $errors['category_id'] = 'Vui lòng chọn danh mục hợp lệ.';
    }

    if (count($errors) === 0) {
        // TODO 1: Dùng prepare() + execute() để INSERT Product.
        // Sau khi INSERT thành công: redirect về products.php?created=1 rồi exit.
        $errors['save'] = 'TODO: Lưu Product vào database bằng prepared statement.';
    }
}

$pageTitle = 'Thêm sản phẩm - VKUShop';
require __DIR__ . '/includes/header.php';
?>

<main class="main-container">
    <h1 class="page-heading">Thêm sản phẩm</h1>
    <p class="page-subtitle">Form Buổi 2 + database Buổi 3 → INSERT bằng prepared statement.</p>

    <div class="form-layout">
        <section class="form-card">
            <div class="todo-box"><strong>TODO:</strong> 1) INSERT Product bằng prepared statement. 2) Thay mảng Category tạm bằng SELECT từ database.</div>
            <?php if (isset($errors['save'])): ?>
                <div class="alert alert-warning"><?= e($errors['save']) ?></div>
            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) > 0): ?>
                <div class="alert alert-warning">Form còn lỗi. Hãy kiểm tra các trường bên dưới.</div>
            <?php endif; ?>

            <form method="POST" action="create-product.php" novalidate>
                <div class="form-group">
                    <label for="name">Tên sản phẩm <span class="required">*</span></label>
                    <input class="form-control <?= isset($errors['name']) ? 'input-error' : '' ?>" id="name" name="name" type="text" value="<?= e($name) ?>">
                    <?php if (isset($errors['name'])): ?><p class="field-error"><?= e($errors['name']) ?></p><?php endif; ?>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="price">Giá (VND) <span class="required">*</span></label>
                        <input class="form-control <?= isset($errors['price']) ? 'input-error' : '' ?>" id="price" name="price" type="text" inputmode="numeric" value="<?= e($price) ?>">
                        <?php if (isset($errors['price'])): ?><p class="field-error"><?= e($errors['price']) ?></p><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="stock">Tồn kho <span class="required">*</span></label>
                        <input class="form-control <?= isset($errors['stock']) ? 'input-error' : '' ?>" id="stock" name="stock" type="number" min="0" value="<?= e($stock) ?>">
                        <?php if (isset($errors['stock'])): ?><p class="field-error"><?= e($errors['stock']) ?></p><?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category_id">Danh mục <span class="required">*</span></label>
                    <select class="form-control <?= isset($errors['category_id']) ? 'input-error' : '' ?>" id="category_id" name="category_id">
                        <option value="0">-- Chọn danh mục --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= (int) $category['id'] ?>" <?= $categoryId === (int) $category['id'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['category_id'])): ?><p class="field-error"><?= e($errors['category_id']) ?></p><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description"><?= e($description) ?></textarea>
                </div>

                <div class="form-actions">
                    <button class="btn" type="submit">Lưu sản phẩm</button>
                    <a class="btn btn-secondary" href="products.php">Hủy</a>
                </div>
            </form>
        </section>

        <aside class="info-card">
            <h2>Điểm mới</h2>
            <ul>
                <li>Sau TODO 2, Category sẽ được đọc từ database.</li>
                <li>Validation vẫn chạy ở server.</li>
                <li>INSERT dùng <strong>prepare()</strong> + <strong>execute()</strong>.</li>
                <li>Thành công thì redirect về danh sách.</li>
            </ul>
        </aside>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
