<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Phương thức không hợp lệ.');
}

$productId = (int) ($_POST['id'] ?? 0);
if ($productId <= 0) {
    exit('ID sản phẩm không hợp lệ.');
}

// TODO 6: DELETE Product bằng prepare() + execute().
// Sau khi xóa: redirect về products.php?deleted=1 rồi exit.
exit('TODO: Xóa Product bằng prepared statement.');
