<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query('SELECT id, name, slug FROM categories ORDER BY id DESC');
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Danh mục - VKUShop';
require __DIR__ . '/includes/header.php';
?>

<main class="main-container">
    <h1 class="page-heading">Quản lý danh mục</h1>
    <p class="page-subtitle">Phần thực hành độc lập: áp dụng kỹ thuật Product CRUD sang Category CRUD.</p>

    <?php if (($_GET['created'] ?? '') === '1'): ?><div class="alert alert-success">✓ Đã thêm danh mục.</div><?php endif; ?>
    <?php if (($_GET['updated'] ?? '') === '1'): ?><div class="alert alert-success">✓ Đã cập nhật danh mục.</div><?php endif; ?>
    <?php if (($_GET['deleted'] ?? '') === '1'): ?><div class="alert alert-success">✓ Đã xóa danh mục.</div><?php endif; ?>
    <?php if (($_GET['delete_error'] ?? '') === 'in_use'): ?><div class="alert alert-danger">Không thể xóa: danh mục đang được Product sử dụng.</div><?php endif; ?>

    <div class="page-actions">
        <a class="btn" href="create-category.php">+ Thêm danh mục</a>
        <a class="btn btn-secondary" href="products.php">Quản lý sản phẩm</a>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead><tr><th>ID</th><th>Tên</th><th>Slug</th><th>Thao tác</th></tr></thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= (int) $category['id'] ?></td>
                    <td><strong><?= e($category['name']) ?></strong></td>
                    <td><?= e($category['slug']) ?></td>
                    <td>
                        <a class="btn btn-secondary btn-small" href="edit-category.php?id=<?= (int) $category['id'] ?>">Sửa</a>
                        <form class="inline-form" method="POST" action="delete-category.php">
                            <input type="hidden" name="id" value="<?= (int) $category['id'] ?>">
                            <button class="btn btn-danger btn-small" type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
