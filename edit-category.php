<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

$categoryId = (int) ($_GET['id'] ?? 0);
if ($categoryId <= 0) exit('ID danh mục không hợp lệ.');

// TODO 8: Tự làm SELECT Category theo id, fetch(), prefill, validation và UPDATE.
$name = '';
$slug = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $errors['save'] = 'TODO: Hoàn thiện Category Update.';
}

$pageTitle = 'Sửa danh mục - VKUShop';
require __DIR__ . '/includes/header.php';
?>
<main class="main-container">
    <h1 class="page-heading">Sửa danh mục #<?= $categoryId ?></h1>
    <section class="form-card">
        <div class="todo-box"><strong>TODO:</strong> Tự áp dụng flow Edit Product cho Category.</div>
        <?php if (isset($errors['save'])): ?><div class="alert alert-warning"><?= e($errors['save']) ?></div><?php endif; ?>
        <form method="POST" action="edit-category.php?id=<?= $categoryId ?>">
            <div class="form-group"><label>Tên danh mục *</label><input class="form-control" name="name" value="<?= e($name) ?>"></div>
            <div class="form-group"><label>Slug *</label><input class="form-control" name="slug" value="<?= e($slug) ?>"></div>
            <div class="form-actions"><button class="btn" type="submit">Cập nhật</button><a class="btn btn-secondary" href="categories.php">Hủy</a></div>
        </form>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
