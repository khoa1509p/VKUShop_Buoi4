<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

$name = '';
$slug = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');

    if ($name === '') $errors['name'] = 'Vui lòng nhập tên danh mục.';
    if ($slug === '') $errors['slug'] = 'Vui lòng nhập slug.';

    // TODO 7: (Mở rộng) kiểm tra slug đã tồn tại bằng prepared statement.

    if (count($errors) === 0) {
        // TODO 7: Tự áp dụng prepare() + execute() để INSERT Category.
        $errors['save'] = 'TODO: Lưu Category vào database.';
    }
}

$pageTitle = 'Thêm danh mục - VKUShop';
require __DIR__ . '/includes/header.php';
?>
<main class="main-container">
    <h1 class="page-heading">Thêm danh mục</h1>
    <p class="page-subtitle">Tự áp dụng CREATE đã học từ Product.</p>
    <section class="form-card">
        <div class="todo-box"><strong>TODO:</strong> Đây là phần SV tự chuyển kỹ thuật từ Product CRUD sang Category CRUD.</div>
        <?php if (isset($errors['save'])): ?><div class="alert alert-warning"><?= e($errors['save']) ?></div><?php endif; ?>
        <form method="POST" action="create-category.php" novalidate>
            <div class="form-group"><label for="name">Tên danh mục *</label><input class="form-control <?= isset($errors['name']) ? 'input-error' : '' ?>" id="name" name="name" value="<?= e($name) ?>"><?php if (isset($errors['name'])): ?><p class="field-error"><?= e($errors['name']) ?></p><?php endif; ?></div>
            <div class="form-group"><label for="slug">Slug *</label><input class="form-control <?= isset($errors['slug']) ? 'input-error' : '' ?>" id="slug" name="slug" value="<?= e($slug) ?>"><?php if (isset($errors['slug'])): ?><p class="field-error"><?= e($errors['slug']) ?></p><?php endif; ?></div>
            <div class="form-actions"><button class="btn" type="submit">Lưu danh mục</button><a class="btn btn-secondary" href="categories.php">Hủy</a></div>
        </form>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
