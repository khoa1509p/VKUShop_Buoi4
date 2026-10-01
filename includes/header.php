<?php
$pageTitle = $pageTitle ?? 'VKUShop';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="index.php"><span class="brand-mark">V</span><span>VKUShop</span></a>
        <nav class="main-nav">
            <a href="index.php">Trang chủ</a>
            <a href="products.php">Sản phẩm</a>
            <a href="create-product.php">Thêm sản phẩm</a>
            <a href="categories.php">Danh mục</a>
        </nav>
    </div>
</header>
