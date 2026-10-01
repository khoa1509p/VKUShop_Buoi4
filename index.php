<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'VKUShop - Buổi 4';
require __DIR__ . '/includes/header.php';
?>

<main class="main-container">
    <section class="hero">
        <h1>VKUShop — Buổi 4</h1>
        <p>
            Từ website chỉ đọc dữ liệu ở Buổi 3, VKUShop tiến lên CRUD:
            Create, Read, Update, Delete bằng PDO Prepared Statement.
        </p>
        <div class="hero-actions">
            <a class="btn" href="products.php">Quản lý sản phẩm</a>
            <a class="btn btn-secondary" href="categories.php">Quản lý danh mục</a>
        </div>
    </section>

    <section class="info-card lesson-flow-card">
        <h2>Flow của Buổi 4</h2>
        <div class="lesson-flow">
            <span>Form / Request</span>
            <strong>→</strong>
            <span>Validation</span>
            <strong>→</strong>
            <span>prepare()</span>
            <strong>→</strong>
            <span>execute()</span>
            <strong>→</strong>
            <span>MySQL</span>
            <strong>→</strong>
            <span>Redirect / Render</span>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
